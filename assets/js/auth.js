function getAuthApiBase() {
    const apiUrl = window.API_URL || 'https://us-central1-lckq3wt5kgl7mekgfpxu1vd4nczzl0.cloudfunctions.net/api';
    const normalized = apiUrl.replace(/\/+$/, '');

    if (normalized.toLowerCase().endsWith('/auth')) {
        return normalized;
    }

    if (normalized.toLowerCase().endsWith('/api')) {
        return `${normalized}/auth`;
    }

    return `${normalized}/auth`;
}

const AUTH_API_BASE = getAuthApiBase();
const AUTH_API_LOGIN = `${AUTH_API_BASE}/login`;
const AUTH_API_REFRESH = `${AUTH_API_BASE}/refresh`;
const AUTH_API_ME = `${AUTH_API_BASE}/me`;
const AUTH_STORAGE_KEY = 'tontrackr_auth';
const AUTH_ID_TOKEN_KEY = 'tontrackr_id_token';
const AUTH_REFRESH_TOKEN_KEY = 'tontrackr_refresh_token';
const AUTH_EXPIRES_AT_KEY = 'tontrackr_auth_expires_at';
const AUTH_TOKEN_BUFFER_MS = 60000;

function getStoredAuthData() {
    const stored = localStorage.getItem(AUTH_STORAGE_KEY);
    if (!stored) return null;

    try {
        return JSON.parse(stored);
    } catch (error) {
        console.warn('Could not parse stored auth data:', error);
        return null;
    }
}

function saveAuthData(authData) {
    localStorage.setItem(AUTH_STORAGE_KEY, JSON.stringify(authData));
    if (authData.id_token) {
        localStorage.setItem(AUTH_ID_TOKEN_KEY, authData.id_token);
    }
    if (authData.refresh_token) {
        localStorage.setItem(AUTH_REFRESH_TOKEN_KEY, authData.refresh_token);
    }
    if (authData.email) {
        localStorage.setItem('tontrackr_user_email', authData.email);
    }
    if (authData.role) {
        localStorage.setItem('tontrackr_user_role', authData.role);
    }
    if (authData.uid) {
        localStorage.setItem('tontrackr_user_uid', authData.uid);
    }
    if (authData.expires_at) {
        localStorage.setItem(AUTH_EXPIRES_AT_KEY, authData.expires_at.toString());
    }
}

async function loginUser(email, password) {
    const response = await fetch(AUTH_API_LOGIN, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({ email, password })
    });

    if (!response.ok) {
        const errorText = await response.text();
        throw new Error(errorText || 'Login request failed.');
    }

    return response.json();
}

async function tryRestoreSession(redirectUrl = 'dashboard.php') {
    const authData = getStoredAuthData();
    if (!authData) {
        return false;
    }

    try {
        await refreshIdTokenIfNeeded();
        window.location.href = redirectUrl;
        return true;
    } catch (error) {
        return false;
    }
}

function clearAuthData() {
    localStorage.removeItem(AUTH_STORAGE_KEY);
    localStorage.removeItem(AUTH_ID_TOKEN_KEY);
    localStorage.removeItem(AUTH_REFRESH_TOKEN_KEY);
    localStorage.removeItem('tontrackr_user_email');
    localStorage.removeItem('tontrackr_user_role');
    localStorage.removeItem('tontrackr_user_uid');
    localStorage.removeItem(AUTH_EXPIRES_AT_KEY);
}

function isTokenExpired(authData) {
    if (!authData) {
        return true;
    }

    const expiresAt = Number(localStorage.getItem(AUTH_EXPIRES_AT_KEY)) || authData.expires_at;
    if (!expiresAt) {
        return true;
    }

    return Date.now() >= expiresAt - AUTH_TOKEN_BUFFER_MS;
}

async function refreshIdToken() {
    const authData = getStoredAuthData();
    if (!authData || !authData.refresh_token) {
        throw new Error('No refresh token available.');
    }

    const response = await fetch(AUTH_API_REFRESH, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({ refresh_token: authData.refresh_token })
    });

    if (!response.ok) {
        clearAuthData();
        const errorText = await response.text();
        throw new Error(errorText || 'Token refresh failed.');
    }

    const refreshed = await response.json();
    const newAuthData = {
        ...authData,
        id_token: refreshed.id_token,
        refresh_token: refreshed.refresh_token,
        expires_in: refreshed.expires_in,
        expires_at: Date.now() + (refreshed.expires_in * 1000)
    };

    saveAuthData(newAuthData);
    return newAuthData;
}

async function refreshIdTokenIfNeeded() {
    const authData = getStoredAuthData();
    if (!authData) {
        throw new Error('No auth data found.');
    }

    if (isTokenExpired(authData)) {
        return refreshIdToken();
    }

    return authData;
}

function getIdToken() {
    const authData = getStoredAuthData();
    return authData ? authData.id_token : null;
}

async function fetchWithAuth(url, options = {}) {
    const authData = await refreshIdTokenIfNeeded();
    const token = authData.id_token;
    if (!token) {
        clearAuthData();
        throw new Error('No ID token available.');
    }

    const headers = new Headers(options.headers || {});
    headers.set('Authorization', `Bearer ${token}`);
    headers.set('Accept', headers.get('Accept') || 'application/json');

    const response = await fetch(url, {
        ...options,
        headers
    });

    if (!response.ok) {
        if (response.status === 401 || response.status === 403) {
            clearAuthData();
        }
        const errorText = await response.text();
        throw new Error(errorText || 'Request failed.');
    }

    const contentType = response.headers.get('content-type') || '';
    const text = await response.text();

    if (!text) {
        return null;
    }

    if (contentType.includes('application/json')) {
        try {
            return JSON.parse(text);
        } catch (error) {
            return text;
        }
    }

    return text;
}

async function getCurrentUserProfile() {
    return fetchWithAuth(AUTH_API_ME, {
        method: 'GET'
    });
}

async function requireAuthOrRedirect(redirectUrl = 'login.php') {
    try {
        await refreshIdTokenIfNeeded();
    } catch (error) {
        clearAuthData();
        window.location.href = redirectUrl;
        throw error;
    }
}
