<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TonTrackr</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700;800&family=Bitter:ital,wght@1,500;1,600&display=swap"
        rel="stylesheet">
    <style>
        /*
          Palette pulled straight from the client's brand guide:
          --green (7489C)      #74AA50
          --teal  (4165C)      #1D6960
          --dark-green (4296C) #3E5824
          --tan   (4241C)      #BAAC88
          --cream               #D7D2C9
          --black               #000000
          Gradient direction per brand doc: Teal -> Green
        */
        :root {
            --green: #74AA50;
            --teal: #1D6960;
            --dark-green: #3E5824;
            --tan: #BAAC88;
            --cream: #D7D2C9;
            --black: #000000;
        }

        * {
            box-sizing: border-box;
        }

        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            font-family: 'Poppins', sans-serif;
            overflow: hidden;
            background: var(--black);
        }

        .hero-section {
            position: relative;
            width: 100vw;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            background: linear-gradient(to bottom, var(--dark-green) 0%, #1c2413 45%, var(--black) 100%);
        }

        .grain-overlay {
            position: absolute;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            background-image: radial-gradient(rgba(255, 255, 255, 0.05) 1px, transparent 1px);
            background-size: 3px 3px;
            opacity: 0.4;
        }

        .brand-lockup {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 110px;
        }

        .brand-mark {
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .brand-mark-icon {
            width: 44px;
            height: 44px;
            object-fit: contain;
        }

        .brand-name {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 45px;
            letter-spacing: -0.02em;
            color: #ffffff;
        }

        .content-overlay {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 600px;
            padding: 40px 24px 60px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            color: #ffffff;
        }

        .btn-group {
            display: flex;
            flex-direction: column;
            gap: 12px;
            width: 100%;
            max-width: 340px;
        }

        .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 17px 20px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            border: none;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .btn-primary {
            background: var(--green);
            color: #ffffff;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        .btn-primary:hover {
            transform: scale(1.02);
            background: #83b962;
        }

        .btn-outline {
            background: var(--dark-green);
            color: #ffffff;
            border: none;
        }

        .btn-outline:hover {
            background: #465f2b;
        }

        @media (max-width: 480px) {
            .content-overlay {
                padding: 30px 20px 40px;
            }
        }
    </style>
</head>

<body>

    <div class="hero-section">
        <div class="grain-overlay"></div>

        <div class="brand-lockup">
            <div class="brand-mark">
                <img src="assets/images/logo1.png" alt="TonTrackr icon" class="brand-mark-icon">
            </div>
            <h1 class="brand-name">TonTrackr</h1>
        </div>

        <div class="content-overlay">
            <div class="btn-group">
                <button class="btn btn-primary" onclick="window.location.href='login.php'">Get Started</button>
                <button class="btn btn-outline" onclick="window.location.href='signin.php'">Sign In</button>
            </div>
        </div>
    </div>

</body>

</html>