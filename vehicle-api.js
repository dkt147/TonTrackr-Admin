window.API_URL = window.API_URL || 'https://us-central1-lckq3wt5kgl7mekgfpxu1vd4nczzl0.cloudfunctions.net/api';

async function apiRequest(path, options = {}) {
    const token = localStorage.getItem('tontrackr_id_token');
    const headers = new Headers(options.headers || {});
    headers.set('Accept', 'application/json');
    headers.set('Authorization', `Bearer ${token}`);
    if (options.body && !headers.has('Content-Type')) {
        headers.set('Content-Type', 'application/json');
    }
    const response = await fetch(`${window.API_URL}${path}`, { ...options, headers });
    const contentType = response.headers.get('content-type') || '';
    const rawText = await response.text();
    let data = null;
    if (rawText) {
        try {
            data = JSON.parse(rawText);
        } catch (error) {
            data = rawText;
        }
    }
    if (!response.ok) {
        const message = data?.error || data?.message || 'Request failed';
        throw new Error(message);
    }
    return data;
}

async function getVehicles(driverId = '') {
    const query = driverId ? `?driver_id=${encodeURIComponent(driverId)}` : '';
    return apiRequest(`/vehicles${query}`);
}

async function createVehicle(payload) {
    return apiRequest('/vehicles', { method: 'POST', body: JSON.stringify(payload) });
}

async function updateVehicle(vehicleId, payload) {
    return apiRequest(`/vehicles/${encodeURIComponent(vehicleId)}`, { method: 'PUT', body: JSON.stringify(payload) });
}

async function deleteVehicle(vehicleId) {
    return apiRequest(`/vehicles/${encodeURIComponent(vehicleId)}`, { method: 'DELETE' });
}

async function getVehicle(vehicleId, driverId = '') {
    const query = driverId ? `?driver_id=${encodeURIComponent(driverId)}` : '';
    return apiRequest(`/vehicles/${encodeURIComponent(vehicleId)}${query}`);
}
