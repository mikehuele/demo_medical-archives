<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#08796b">
    <title>Medical Archives | Customer Access</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --green-dark: #103f34;
            --green-main: #08796b;
            --green-hover: #066458;
            --green-light: #80d5b0;
            --text-dark: #163e34;
            --text-muted: #60796f;
            --glass-white: rgba(255,255,255,.48);
            --glass-border: rgba(255,255,255,.75);
        }
        html { min-height: 100%; scroll-behavior: smooth; }
        body {
            min-height: 100vh; font-family: Arial, Helvetica, sans-serif; color: var(--text-dark); overflow-x: hidden;
            background: radial-gradient(circle at 8% 10%,rgba(113,202,163,.32),transparent 35%),
                        radial-gradient(circle at 90% 85%,rgba(53,143,110,.22),transparent 34%),
                        linear-gradient(135deg,#eaf6ef,#dcebe3);
        }
        button, input { font: inherit; }
        button, a { -webkit-tap-highlight-color: transparent; }
        button { cursor: pointer; }
        .background-circle { position: fixed; z-index: 0; pointer-events: none; border-radius: 50%; filter: blur(1px); }
        .circle-a { width: 350px; height: 350px; top: -120px; right: 8%; background: rgba(255,255,255,.27); }
        .circle-b { width: 280px; height: 280px; bottom: -100px; left: 25%; background: rgba(77,164,125,.11); }
        .container { position: relative; z-index: 1; width: 100%; min-height: 100vh; padding: 24px; display: flex; justify-content: center; }
        .main-panel {
            width: 100%; max-width: 1600px; min-height: calc(100vh - 48px); display: flex; overflow: hidden;
            border: 1px solid rgba(255,255,255,.8); border-radius: 30px; background: rgba(255,255,255,.19);
            box-shadow: 0 25px 70px rgba(23,75,55,.14), inset 0 1px 1px rgba(255,255,255,.8);
            backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
        }
        .left-side { position: relative; isolation: isolate; width: 53%; min-height: 760px; overflow: hidden; display: flex; flex-direction: column; justify-content: space-between; padding: 48px; color: white; background: #075e50; }
        .left-side > img { position: absolute; inset: 0; z-index: -2; width: 100%; height: 100%; object-fit: cover; object-position: center; }
        .left-side::before { content: ""; position: absolute; inset: 0; z-index: -1; background: linear-gradient(145deg,rgba(7,55,43,.83),rgba(3,105,89,.68),rgba(6,48,43,.86)); }
        .left-side::after { content: ""; position: absolute; z-index: -1; width: 350px; height: 350px; top: -100px; right: -110px; border: 1px solid rgba(255,255,255,.19); border-radius: 50%; box-shadow: 0 0 0 35px rgba(255,255,255,.045),0 0 0 75px rgba(255,255,255,.025); pointer-events: none; }
        .brand { display: flex; align-items: center; gap: 17px; position: relative; z-index: 2; min-width: 0; }
        .brand-icon {
            width: 62px; height: 62px; flex-shrink: 0; display: flex; justify-content: center; align-items: center;
            overflow: hidden; padding: 5px; border: 1px solid rgba(255,255,255,.8); border-radius: 18px;
            background: rgba(255,255,255,.94); color: var(--green-dark); font-size: 43px; font-weight: 400;
            box-shadow: 0 8px 28px rgba(0,0,0,.1),inset 0 1px 1px rgba(255,255,255,.5);
            backdrop-filter: blur(15px); -webkit-backdrop-filter: blur(15px);
        }
        .brand-icon img { display: block; width: 100%; height: 100%; object-fit: contain; border-radius: 12px; }
        .brand-icon.logo-fallback::after { content: "+"; font-size: 43px; font-weight: 400; line-height: 1; color: var(--green-main); }
        .brand h2 { font-family: Georgia,"Times New Roman",serif; font-size: clamp(24px,2.2vw,33px); line-height: 1.2; font-weight: 600; }
        .brand p { margin-top: 7px; font-size: 13px; letter-spacing: 1.3px; color: rgba(255,255,255,.82); }
        .hero-text { position: relative; z-index: 2; max-width: 650px; margin: 70px 0; }
        .system-label { display: inline-flex; align-items: center; gap: 10px; padding: 12px 18px; margin-bottom: 28px; border: 1px solid rgba(255,255,255,.36); border-radius: 30px; background: rgba(255,255,255,.13); font-size: 13px; font-weight: 600; letter-spacing: .6px; backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px); }
        .status-dot { width: 9px; height: 9px; border-radius: 50%; background: #9af2c3; box-shadow: 0 0 14px rgba(154,242,195,.75); }
        .hero-text h1 { font-family: Georgia,"Times New Roman",serif; font-size: clamp(42px,4.2vw,67px); line-height: 1.1; letter-spacing: -1.3px; margin-bottom: 25px; }
        .hero-text h1 span { color: #a3edc7; }
        .hero-text p { max-width: 580px; color: rgba(255,255,255,.89); font-size: 17px; line-height: 1.9; }
        .left-footer { position: relative; z-index: 2; padding-top: 22px; border-top: 1px solid rgba(255,255,255,.23); font-size: 12px; line-height: 1.7; color: rgba(255,255,255,.77); }
        .right-side { width: 47%; min-width: 0; display: flex; align-items: center; justify-content: center; padding: 44px; background: rgba(245,251,247,.31); }
        .form-wrapper { width: 100%; max-width: 510px; margin: auto; }
        .heading-label { display: inline-block; margin-bottom: 13px; color: var(--green-main); font-size: 13px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; }
        .form-wrapper h1 { margin-bottom: 12px; color: var(--green-dark); font-family: Georgia,"Times New Roman",serif; font-size: clamp(34px,3vw,45px); font-weight: 600; line-height: 1.2; letter-spacing: -.7px; }
        .subtitle { margin-bottom: 30px; color: var(--text-muted); font-size: 17px; line-height: 1.65; }
        .form-box { width: 100%; padding: 33px; border: 1px solid var(--glass-border); border-radius: 23px; background: rgba(255,255,255,.66); box-shadow: 0 15px 40px rgba(25,77,55,.09),inset 0 1px 0 rgba(255,255,255,.88); backdrop-filter: blur(22px); -webkit-backdrop-filter: blur(22px); }
        .form-group { margin-bottom: 23px; }
        .form-group label { display: block; margin-bottom: 11px; color: #204c40; font-size: 15px; font-weight: 700; }
        .input-box { position: relative; width: 100%; }
        .input-box input { display: block; width: 100%; height: 56px; padding: 0 51px; border: 1px solid rgba(131,164,149,.55); border-radius: 12px; outline: none; background: rgba(255,255,255,.9); color: #173f34; font-size: 16px; box-shadow: inset 0 1px 3px rgba(19,73,52,.025); transition: border-color .25s,box-shadow .25s,background .25s; }
        .input-box input::placeholder { color: #71877d; font-size: 15px; }
        .input-box input:focus { border-color: #178b71; background: #fff; box-shadow: 0 0 0 4px rgba(23,139,113,.11); }
        .input-icon { position: absolute; left: 16px; top: 50%; width: 21px; height: 21px; display: flex; align-items: center; justify-content: center; transform: translateY(-50%); pointer-events: none; color: #39876e; }
        .input-icon svg { width: 21px; height: 21px; fill: none; stroke: currentColor; stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round; }
        .eye { position: absolute; top: 50%; right: 12px; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; transform: translateY(-50%); border: none; border-radius: 9px; background: transparent; color: #438372; transition: background .2s; }
        .eye:hover { background: rgba(8,121,107,.10); }
        .eye svg { width: 21px; height: 21px; fill: none; stroke: currentColor; stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round; }
        .login-btn { position: relative; overflow: hidden; width: 100%; min-height: 56px; margin-top: 3px; padding: 15px 20px; border: 1px solid rgba(255,255,255,.24); border-radius: 12px; background: linear-gradient(135deg,#108a72,#086558); color: #fff; font-size: 15px; font-weight: 700; letter-spacing: .8px; box-shadow: 0 8px 18px rgba(8,101,88,.19),inset 0 1px 0 rgba(255,255,255,.17); transition: transform .2s,box-shadow .2s,background .2s; }
        .login-btn:hover { transform: translateY(-2px); background: linear-gradient(135deg,#0b7965,#06574d); box-shadow: 0 12px 24px rgba(8,101,88,.25); }
        .login-btn:active { transform: translateY(0); }
        .divider { display: flex; align-items: center; gap: 17px; margin: 26px 0; color: #6f8479; font-size: 13px; font-weight: 600; }
        .divider::before,.divider::after { content: ""; flex: 1; height: 1px; background: rgba(125,157,142,.42); }
        .google-btn { display: flex; justify-content: center; align-items: center; gap: 12px; width: 100%; min-height: 54px; border: 1px solid rgba(125,157,142,.55); border-radius: 12px; background: rgba(255,255,255,.85); color: #315e50; font-size: 15px; font-weight: 700; box-shadow: inset 0 1px 0 rgba(255,255,255,.85); transition: background .25s,border-color .25s,transform .25s; }
        .google-btn:hover { background: #fff; border-color: #82b9a1; transform: translateY(-1px); }
        .google-icon { width: 23px; height: 23px; flex-shrink: 0; }
        .google-icon svg { display: block; width: 100%; height: 100%; }
        .create-text { margin-top: 25px; color: #526e61; text-align: center; font-size: 14px; line-height: 1.9; }
        .create-text button { margin-left: 4px; border: none; background: none; color: #08796b; font-size: 14px; font-weight: 700; cursor: pointer; }
        .create-text button:hover { color: #064e43; text-decoration: underline; }
        .back-home { margin-top: 26px; text-align: center; }
        .back-home a { display: inline-flex; align-items: center; gap: 9px; padding: 8px; color: #287965; text-decoration: none; font-size: 14px; font-weight: 600; transition: color .2s; }
        .back-home a:hover { color: #104e3e; }
        .hidden { display: none !important; }
        button:focus-visible,a:focus-visible { outline: 3px solid #218d71; outline-offset: 4px; }
        @media (max-width: 1100px) {
            .container { padding: 16px; }
            .main-panel { min-height: calc(100vh - 32px); }
            .left-side { width: 46%; padding: 34px; }
            .right-side { width: 54%; padding: 32px; }
            .brand h2 { font-size: 26px; }
            .hero-text h1 { font-size: clamp(38px,4.5vw,52px); }
            .hero-text p { font-size: 16px; }
            .form-box { padding: 27px; }
        }
        @media (max-width: 760px) {
            .container { display: block; padding: 0; }
            .main-panel { flex-direction: column; min-height: 100vh; border: none; border-radius: 0; overflow: visible; background: transparent; box-shadow: none; }
            .left-side { width: 100%; min-height: 400px; padding: 27px 25px; border-radius: 0 0 28px 28px; }
            .brand { gap: 13px; }
            .brand-icon { width: 52px; height: 52px; border-radius: 15px; }
            .brand h2 { font-size: 24px; }
            .brand p { font-size: 11px; letter-spacing: .8px; }
            .hero-text { margin: 42px 0; }
            .system-label { padding: 10px 14px; margin-bottom: 20px; font-size: 11px; }
            .hero-text h1 { font-size: clamp(36px,8vw,48px); margin-bottom: 17px; }
            .hero-text p { font-size: 15px; line-height: 1.8; }
            .left-footer { padding-top: 16px; font-size: 11px; }
            .right-side { width: 100%; padding: 34px 22px 45px; background: transparent; }
            .form-wrapper { max-width: 520px; }
            .form-wrapper h1 { font-size: 37px; }
            .subtitle { font-size: 16px; margin-bottom: 25px; }
            .form-box { padding: 26px 22px; border-radius: 20px; background: rgba(255,255,255,.78); }
            .form-group { margin-bottom: 22px; }
            .form-group label { font-size: 15px; }
            .input-box input { height: 55px; font-size: 16px; }
            .login-btn { min-height: 55px; font-size: 14px; }
            .google-btn { min-height: 53px; font-size: 14px; }
            .create-text { font-size: 13px; }
            .create-text button { font-size: 14px; }
        }
        @media (max-width: 380px) {
            .left-side { padding: 24px 19px; min-height: 390px; }
            .brand h2 { font-size: 21px; }
            .brand p { font-size: 10px; }
            .hero-text h1 { font-size: 34px; }
            .hero-text p { font-size: 14px; }
            .right-side { padding: 30px 15px 38px; }
            .form-wrapper h1 { font-size: 33px; }
            .form-box { padding: 23px 17px; }
            .input-box input { padding-left: 44px; padding-right: 44px; font-size: 15px; }
        }
        @media (prefers-reduced-motion: reduce) {
            *,*::before,*::after { scroll-behavior: auto !important; transition-duration: .01ms !important; animation-duration: .01ms !important; }
        }
    </style>
</head>
<body>
    <div class="background-circle circle-a"></div>
    <div class="background-circle circle-b"></div>
    <main class="container">
        <div class="main-panel">
            <section class="left-side">
                <img src="../assets/images/Beacon-HOspital-Banner-MEdical-scaled.jpg" alt="Medical Archives" onerror="this.style.display='none'">
                <div class="brand">
                    <div class="brand-icon" aria-label="Medical Archives logo">
                        <img src="../assets/images/LOGO- Medical ARCHIEVES.png" alt="Medical Archives logo" onerror="this.remove(); this.parentElement.classList.add('logo-fallback');">
                    </div>
                    <div><h2>Medical Archives</h2><p>Digital Prescription Records</p></div>
                </div>
                <div class="hero-text">
                    <div class="system-label"><span class="status-dot"></span>Drugstore Management System</div>
                    <h1>Smarter Records.<br><span>Safer Medication.</span></h1>
                    <p>A digital solution for managing prescription records, patient medication history, dispensing transactions, and drugstore information securely and efficiently.</p>
                </div>
                <footer class="left-footer">&copy; 2026 Medical Archives - Secure Digital Records</footer>
            </section>

            <section class="right-side">
                <div class="form-wrapper">
                    <div id="loginSection">
                        <span class="heading-label">Customer Portal</span>
                        <h1>Welcome Back</h1>
                        <p class="subtitle">Sign in to access your prescription records and medication history.</p>
                        <div class="form-box">
                            <div class="form-group">
                                <label for="customerLoginUser">Username or Email</label>
                                <div class="input-box">
                                    <span class="input-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"></circle><path d="M5 21v-2a7 7 0 0 1 14 0v2"></path></svg></span>
                                    <input type="text" id="customerLoginUser" placeholder="Enter username or email" autocomplete="username" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="customerLoginPassword">Password</label>
                                <div class="input-box">
                                    <span class="input-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="4" y="10" width="16" height="11" rx="2"></rect><path d="M8 10V7a4 4 0 0 1 8 0v3"></path></svg></span>
                                    <input type="password" id="customerLoginPassword" placeholder="Enter your password" autocomplete="current-password" required>
                                    <button type="button" class="eye" aria-label="Show password" aria-pressed="false" onclick="togglePassword('customerLoginPassword', this)"><svg viewBox="0 0 24 24"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"></path><circle cx="12" cy="12" r="3"></circle></svg></button>
                                </div>
                            </div>
                            <button type="button" class="login-btn" onclick="customerLogin()">SIGN IN TO YOUR ACCOUNT</button>
                            <div class="divider"><span>OR</span></div>
                            <button type="button" class="google-btn" onclick="googleLogin()">
                                <span class="google-icon" aria-hidden="true"><svg viewBox="0 0 48 48"><path fill="#EA4335" d="M24 9.5c3.5 0 6.4 1.2 8.7 3.4l6.5-6.5C35.2 2.5 30.1 0 24 0 14.6 0 6.5 5.4 2.5 13.3l7.6 5.9C12 13.1 17.5 9.5 24 9.5z" transform="translate(0 3)"/><path fill="#4285F4" d="M46.1 24.5c0-1.6-.1-3.2-.4-4.7H24v9h12.4c-.5 2.9-2.2 5.3-4.7 6.9l7.5 5.8c4.4-4.1 6.9-10.1 6.9-17z" transform="translate(0 -1)"/><path fill="#FBBC05" d="M9.9 28.8c-.6-1.5-.9-3.1-.9-4.8s.3-3.3.9-4.8l-7.6-5.9A23.9 23.9 0 0 0 0 24c0 3.9.9 7.5 2.3 10.7l7.6-5.9z" transform="translate(1)"/><path fill="#34A853" d="M24 48c6.5 0 12-2.1 16-5.7l-7.5-5.8c-2.1 1.4-4.8 2.2-8.5 2.2-6.5 0-12-3.6-14-9.7l-7.6 5.9C6.5 42.6 14.6 48 24 48z" transform="translate(0 -3)"/></svg></span>
                                Continue with Google
                            </button>
                            <div class="create-text">Don't have a customer account? <button type="button" onclick="showRegister()">Create Account</button></div>
                        </div>
                        <div class="back-home"><a href="../index.php"><span aria-hidden="true">&larr;</span> Back to Home</a></div>
                    </div>

                    <div id="registerSection" class="hidden">
                        <span class="heading-label">Join Medical Archives</span>
                        <h1>Create Account</h1>
                        <p class="subtitle">Register to access your digital prescription records.</p>
                        <div class="form-box">
                            <div class="form-group">
                                <label for="customerFullName">Full Name</label>
                                <div class="input-box"><span class="input-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"></circle><path d="M5 21v-2a7 7 0 0 1 14 0v2"></path></svg></span><input type="text" id="customerFullName" placeholder="Enter your full name" autocomplete="name" required></div>
                            </div>
                            <div class="form-group">
                                <label for="customerUsername">Username</label>
                                <div class="input-box"><span class="input-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"></circle><path d="M5 21v-2a7 7 0 0 1 14 0v2"></path></svg></span><input type="text" id="customerUsername" placeholder="Create a username" autocomplete="username" required></div>
                            </div>
                            <div class="form-group">
                                <label for="customerEmail">Email Address</label>
                                <div class="input-box"><span class="input-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="2"></rect><path d="m3 7 9 6 9-6"></path></svg></span><input type="email" id="customerEmail" placeholder="Enter your email address" autocomplete="email" required></div>
                            </div>
                            <div class="form-group">
                                <label for="customerPassword">Password</label>
                                <div class="input-box"><span class="input-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="4" y="10" width="16" height="11" rx="2"></rect><path d="M8 10V7a4 4 0 0 1 8 0v3"></path></svg></span><input type="password" id="customerPassword" placeholder="Create a password" autocomplete="new-password" required><button type="button" class="eye" aria-label="Show password" aria-pressed="false" onclick="togglePassword('customerPassword', this)"><svg viewBox="0 0 24 24"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"></path><circle cx="12" cy="12" r="3"></circle></svg></button></div>
                            </div>
                            <div class="form-group">
                                <label for="customerConfirmPassword">Confirm Password</label>
                                <div class="input-box"><span class="input-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="4" y="10" width="16" height="11" rx="2"></rect><path d="M8 10V7a4 4 0 0 1 8 0v3"></path></svg></span><input type="password" id="customerConfirmPassword" placeholder="Re-enter your password" autocomplete="new-password" required><button type="button" class="eye" aria-label="Show password" aria-pressed="false" onclick="togglePassword('customerConfirmPassword', this)"><svg viewBox="0 0 24 24"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"></path><circle cx="12" cy="12" r="3"></circle></svg></button></div>
                            </div>
                            <button type="button" class="login-btn" onclick="customerRegister()">CREATE CUSTOMER ACCOUNT</button>
                            <div class="divider"><span>OR</span></div>
                            <button type="button" class="google-btn" onclick="googleLogin()"><span class="google-icon" aria-hidden="true"><svg viewBox="0 0 48 48"><path fill="#EA4335" d="M24 9.5c3.5 0 6.4 1.2 8.7 3.4l6.5-6.5C35.2 2.5 30.1 0 24 0 14.6 0 6.5 5.4 2.5 13.3l7.6 5.9C12 13.1 17.5 9.5 24 9.5z" transform="translate(0 3)"/><path fill="#4285F4" d="M46.1 24.5c0-1.6-.1-3.2-.4-4.7H24v9h12.4c-.5 2.9-2.2 5.3-4.7 6.9l7.5 5.8c4.4-4.1 6.9-10.1 6.9-17z" transform="translate(0 -1)"/><path fill="#FBBC05" d="M9.9 28.8c-.6-1.5-.9-3.1-.9-4.8s.3-3.3.9-4.8l-7.6-5.9A23.9 23.9 0 0 0 0 24c0 3.9.9 7.5 2.3 10.7l7.6-5.9z" transform="translate(1)"/><path fill="#34A853" d="M24 48c6.5 0 12-2.1 16-5.7l-7.5-5.8c-2.1 1.4-4.8 2.2-8.5 2.2-6.5 0-12-3.6-14-9.7l-7.6 5.9C6.5 42.6 14.6 48 24 48z" transform="translate(0 -3)"/></svg></span>Continue with Google</button>
                            <div class="create-text">Already have an account? <button type="button" onclick="showLogin()">Sign In</button></div>
                        </div>
                        <div class="back-home"><a href="../index.php"><span aria-hidden="true">&larr;</span> Back to Home</a></div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <script>
        function showRegister() {
            document.getElementById('loginSection').classList.add('hidden');
            document.getElementById('registerSection').classList.remove('hidden');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
        function showLogin() {
            document.getElementById('registerSection').classList.add('hidden');
            document.getElementById('loginSection').classList.remove('hidden');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
        function togglePassword(id, button) {
            const input = document.getElementById(id);
            if (!input) return;
            const show = input.type === 'password';
            input.type = show ? 'text' : 'password';
            button.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
            button.setAttribute('aria-pressed', String(show));
        }
        function getCustomerAccounts() {
            try {
                const accounts = JSON.parse(localStorage.getItem('customerAccounts') || '[]');
                return Array.isArray(accounts) ? accounts : [];
            } catch (error) {
                alert('Unable to read saved customer accounts.');
                return null;
            }
        }
        function customerRegister() {
            const fullName = document.getElementById('customerFullName').value.trim();
            const username = document.getElementById('customerUsername').value.trim();
            const email = document.getElementById('customerEmail').value.trim();
            const password = document.getElementById('customerPassword').value;
            const confirmPassword = document.getElementById('customerConfirmPassword').value;
            if (!fullName || !username || !email || !password || !confirmPassword) {
                alert('Please complete all fields.'); return;
            }
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                alert('Please enter a valid email address.'); return;
            }
            if (username.length < 3) { alert('Username must contain at least 3 characters.'); return; }
            if (password.length < 6) { alert('Password must be at least 6 characters.'); return; }
            if (password !== confirmPassword) { alert('Passwords do not match.'); return; }
            const accounts = getCustomerAccounts();
            if (accounts === null) return;
            const existing = accounts.find(account => account && (
                String(account.username || '').toLowerCase() === username.toLowerCase() ||
                String(account.email || '').toLowerCase() === email.toLowerCase()
            ));
            if (existing) { alert('Username or email already exists.'); return; }
            /* Frontend demonstration only. Real accounts should be managed by a secure backend. */
            accounts.push({ fullName, username, email, password });
            try {
                localStorage.setItem('customerAccounts', JSON.stringify(accounts));
            } catch (error) {
                alert('Unable to save the account in this browser.'); return;
            }
            alert('Customer account created successfully!');
            ['customerFullName','customerUsername','customerEmail','customerPassword','customerConfirmPassword'].forEach(id => document.getElementById(id).value = '');
            showLogin();
            document.getElementById('customerLoginUser').value = email;
            document.getElementById('customerLoginPassword').focus();
        }
        function customerLogin() {
            const user = document.getElementById('customerLoginUser').value.trim();
            const password = document.getElementById('customerLoginPassword').value;
            if (!user || !password) { alert('Please enter your username/email and password.'); return; }
            const accounts = getCustomerAccounts();
            if (accounts === null) return;
            const account = accounts.find(item => item && (
                String(item.username || '').toLowerCase() === user.toLowerCase() ||
                String(item.email || '').toLowerCase() === user.toLowerCase()
            ) && item.password === password);
            if (!account) { alert('Invalid customer username/email or password.'); return; }
            const currentCustomer = { fullName: account.fullName, username: account.username, email: account.email };
            try {
                localStorage.setItem('currentCustomer', JSON.stringify(currentCustomer));
            } catch (error) {
                alert('Unable to save the current customer session.'); return;
            }
            alert('Customer login successful!');
            window.location.href = 'dashboard.php';
        }
        function googleLogin() {
            alert('Google Sign-In is not connected yet. To enable it, configure Google Identity Services and implement authentication with your backend.');
        }
        document.addEventListener('keydown', event => {
            if (event.key === 'Enter') {
                const loginVisible = !document.getElementById('loginSection').classList.contains('hidden');
                const activeElement = document.activeElement;
                if (activeElement && activeElement.tagName === 'INPUT') {
                    event.preventDefault();
                    if (loginVisible) customerLogin(); else customerRegister();
                }
            }
        });
    </script>
<script>
async function maApi(path,body){const r=await fetch('../api/'+path,{method:body?'POST':'GET',headers:{'Content-Type':'application/json'},credentials:'same-origin',body:body?JSON.stringify(body):undefined});const j=await r.json();if(!r.ok||!j.success)throw new Error(j.data?.message||'Request failed');return j.data;}
async function customerRegister(){const full_name=document.getElementById('customerFullName').value.trim(),username=document.getElementById('customerUsername').value.trim(),email=document.getElementById('customerEmail').value.trim(),password=document.getElementById('customerPassword').value,confirm=document.getElementById('customerConfirmPassword').value;if(password!==confirm)return alert('Passwords do not match.');try{await maApi('auth/register/customer',{full_name,username,email,password});alert('Customer account created. You can now sign in.');showLogin();document.getElementById('customerLoginUser').value=email;}catch(e){alert(e.message);}}
async function customerLogin(){const username=document.getElementById('customerLoginUser').value.trim(),password=document.getElementById('customerLoginPassword').value;try{await maApi('auth/login/customer',{username,password});location.href='dashboard.php';}catch(e){alert(e.message);}}
</script>
</body>
</html>
