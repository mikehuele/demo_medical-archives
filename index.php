<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Archives | Login</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --green-dark: #123f33;
            --green-main: #23745d;
            --green-light: #6ac3a1;
            --text-dark: #193d32;
            --text-muted: #647970;
            --glass-border: rgba(255, 255, 255, .65);
        }
        body {
            font-family: Arial, Helvetica, sans-serif;
            min-height: 100vh;
            color: var(--text-dark);
            background:
                radial-gradient(circle at 10% 10%, rgba(116, 200, 165, .28), transparent 35%),
                radial-gradient(circle at 90% 90%, rgba(73, 151, 124, .22), transparent 35%),
                linear-gradient(135deg, #eaf5ef, #dcebe3);
            overflow-x: hidden;
        }
        a { -webkit-tap-highlight-color: transparent; }
        .container { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 30px; }
        .main-panel {
            width: 100%; max-width: 1450px; min-height: calc(100vh - 60px);
            display: flex; overflow: hidden; position: relative;
            border: 1px solid rgba(255, 255, 255, .8); border-radius: 30px;
            background: rgba(255, 255, 255, .20);
            box-shadow: 0 25px 70px rgba(27, 78, 58, .13), inset 0 1px 1px rgba(255, 255, 255, .65);
            backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
        }
        .image-section {
            width: 55%; min-height: 680px; position: relative; overflow: hidden;
            display: flex; flex-direction: column; justify-content: space-between;
            padding: 50px; color: white;
            background-image: linear-gradient(135deg, rgba(10, 57, 43, .70), rgba(19, 92, 68, .48), rgba(9, 46, 39, .76)), url("assets/images/Beacon-HOspital-Banner-MEdical-scaled.jpg");
            background-size: cover; background-position: center;
        }
        .circle-one, .circle-two, .circle-three { position: absolute; pointer-events: none; border-radius: 50%; }
        .circle-one {
            width: 330px; height: 330px; top: -130px; right: -100px;
            border: 1px solid rgba(255, 255, 255, .24); background: rgba(255, 255, 255, .04);
            box-shadow: 0 0 0 35px rgba(255, 255, 255, .035), 0 0 0 70px rgba(255, 255, 255, .025);
        }
        .circle-two { width: 250px; height: 250px; bottom: -100px; left: -90px; border: 1px solid rgba(255, 255, 255, .20); background: rgba(255, 255, 255, .04); }
        .circle-three { width: 110px; height: 110px; top: 40%; right: 12%; border: 1px solid rgba(255, 255, 255, .15); background: rgba(255, 255, 255, .04); backdrop-filter: blur(8px); }
        .brand { position: relative; z-index: 2; display: flex; align-items: center; gap: 15px; min-width: 0; }
        .brand-logo {
            width: 58px; height: 58px; flex-shrink: 0; padding: 5px;
            display: flex; align-items: center; justify-content: center; overflow: hidden;
            border: 1px solid rgba(255, 255, 255, .65); border-radius: 18px;
            background: rgba(255, 255, 255, .92); color: var(--green-dark);
            box-shadow: 0 8px 25px rgba(0, 0, 0, .10), inset 0 1px 1px rgba(255, 255, 255, .45);
            backdrop-filter: blur(15px); -webkit-backdrop-filter: blur(15px);
        }
        .brand-logo img { display: block; width: 100%; height: 100%; object-fit: contain; border-radius: 12px; }
        .brand-logo.logo-fallback::after { content: "+"; font-size: 36px; line-height: 1; font-weight: 800; color: var(--green-main); }
        .brand h1 { font-family: Georgia, "Times New Roman", serif; font-size: 29px; letter-spacing: .3px; font-weight: 600; line-height: 1.15; }
        .brand p { margin-top: 7px; font-size: 11px; letter-spacing: 1.8px; text-transform: uppercase; color: rgba(255, 255, 255, .78); }
        .image-content { position: relative; z-index: 2; max-width: 540px; margin: auto 0; padding: 65px 0; }
        .tag {
            display: inline-flex; align-items: center; gap: 9px; padding: 10px 16px; margin-bottom: 24px;
            border: 1px solid rgba(255, 255, 255, .28); border-radius: 30px;
            background: rgba(255, 255, 255, .12); color: white; font-size: 11px; font-weight: 600;
            letter-spacing: .8px; text-transform: uppercase; backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px);
        }
        .tag-dot { width: 7px; height: 7px; border-radius: 50%; background: #8cf0bd; box-shadow: 0 0 12px rgba(140, 240, 189, .8); }
        .image-content h2 { font-family: Georgia, "Times New Roman", serif; font-size: clamp(38px, 4vw, 58px); line-height: 1.12; letter-spacing: -1.2px; margin-bottom: 24px; }
        .image-content h2 span { color: #a6edcc; }
        .image-content p { max-width: 480px; font-size: 15px; line-height: 1.9; color: rgba(255, 255, 255, .85); }
        .image-footer { position: relative; z-index: 2; padding-top: 20px; border-top: 1px solid rgba(255, 255, 255, .18); color: rgba(255, 255, 255, .70); font-size: 11px; letter-spacing: .3px; }
        .selection-section {
            width: 45%; min-width: 0; display: flex; align-items: center; justify-content: center;
            padding: 55px; position: relative; background: rgba(244, 250, 246, .23);
        }
        .selection-box { width: 100%; max-width: 440px; position: relative; z-index: 2; }
        .welcome-label { display: inline-block; margin-bottom: 16px; color: var(--green-main); font-size: 11px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; }
        .header { margin-bottom: 34px; }
        .header h2 { color: var(--green-dark); font-family: Georgia, "Times New Roman", serif; font-size: 42px; font-weight: 600; letter-spacing: -1px; margin-bottom: 12px; }
        .header p { color: var(--text-muted); font-size: 14px; line-height: 1.7; }
        .login-card {
            display: block; position: relative; overflow: hidden; padding: 26px; margin-bottom: 20px;
            text-decoration: none; color: inherit; border: 1px solid var(--glass-border); border-radius: 21px;
            background: rgba(255, 255, 255, .48);
            box-shadow: 0 8px 25px rgba(26, 77, 57, .055), inset 0 1px 0 rgba(255, 255, 255, .8);
            backdrop-filter: blur(18px); -webkit-backdrop-filter: blur(18px);
            transition: transform .3s ease, border-color .3s ease, box-shadow .3s ease, background .3s ease;
        }
        .login-card::before { content: ""; position: absolute; width: 140px; height: 140px; top: -75px; right: -50px; border-radius: 50%; background: rgba(56, 139, 107, .07); transition: transform .4s ease; }
        .login-card:hover { transform: translateY(-5px); border-color: rgba(49, 132, 100, .45); background: rgba(255, 255, 255, .72); box-shadow: 0 18px 35px rgba(26, 77, 57, .12), inset 0 1px 0 rgba(255, 255, 255, .95); }
        .login-card:hover::before { transform: scale(1.35); }
        .login-card:focus-visible { outline: 3px solid #398e6c; outline-offset: 4px; }
        .card-top { display: flex; align-items: center; gap: 17px; margin-bottom: 17px; position: relative; z-index: 1; }
        .card-icon {
            width: 56px; height: 56px; flex-shrink: 0; display: flex; align-items: center; justify-content: center;
            border-radius: 17px; border: 1px solid rgba(255, 255, 255, .85);
            background: linear-gradient(145deg, rgba(80, 166, 126, .18), rgba(80, 166, 126, .07)); color: #286c51;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, .8);
        }
        .card-icon svg { width: 27px; height: 27px; stroke: currentColor; stroke-width: 1.8; fill: none; stroke-linecap: round; stroke-linejoin: round; }
        .card-title { flex: 1; min-width: 0; }
        .card-title h3 { color: var(--green-dark); font-size: 19px; margin-bottom: 6px; }
        .card-title span { color: #6a8879; font-size: 11px; letter-spacing: .5px; }
        .card-arrow { width: 32px; height: 32px; flex-shrink: 0; display: flex; justify-content: center; align-items: center; color: var(--green-main); font-size: 20px; border: 1px solid rgba(53, 123, 94, .17); border-radius: 50%; background: rgba(255, 255, 255, .55); transition: color .3s, background .3s, transform .3s; }
        .login-card:hover .card-arrow { color: white; background: var(--green-main); transform: translateX(3px); }
        .login-card > p { position: relative; z-index: 1; color: var(--text-muted); font-size: 13px; line-height: 1.8; margin-bottom: 19px; }
        .card-link { position: relative; z-index: 1; display: flex; align-items: center; gap: 8px; color: var(--green-main); font-size: 12px; font-weight: 700; letter-spacing: .3px; }
        .security {
            display: flex; align-items: center; justify-content: center; gap: 10px; margin-top: 27px; padding: 15px 17px;
            border: 1px solid rgba(255, 255, 255, .68); border-radius: 13px; background: rgba(255, 255, 255, .27);
            color: #6a8175; text-align: center; font-size: 11px; line-height: 1.6;
            backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px);
        }
        .security svg { width: 18px; height: 18px; flex-shrink: 0; stroke: #438568; stroke-width: 1.8; fill: none; stroke-linecap: round; stroke-linejoin: round; }
        .bottom-note { margin-top: 24px; text-align: center; color: #82928a; font-size: 10px; }
        @media (max-width: 1050px) {
            .container { padding: 18px; }
            .main-panel { min-height: calc(100vh - 36px); }
            .image-section { width: 46%; padding: 35px; }
            .selection-section { width: 54%; padding: 35px; }
            .brand h1 { font-size: 23px; }
            .brand-logo { width: 50px; height: 50px; }
            .image-content h2 { font-size: 40px; }
            .header h2 { font-size: 36px; }
            .login-card { padding: 22px; }
        }
        @media (max-width: 760px) {
            .container { padding: 0; display: block; }
            .main-panel { min-height: 100vh; border: none; border-radius: 0; flex-direction: column; background: rgba(255, 255, 255, .18); }
            .image-section { width: 100%; min-height: auto; padding: 28px 25px 35px; border-radius: 0 0 28px 28px; }
            .brand h1 { font-size: 22px; }
            .brand p { font-size: 9px; letter-spacing: 1.2px; }
            .brand-logo { width: 47px; height: 47px; border-radius: 14px; }
            .image-content { padding: 45px 0 35px; }
            .image-content h2 { font-size: 35px; }
            .image-content p { font-size: 13px; line-height: 1.8; }
            .tag { font-size: 9px; margin-bottom: 18px; }
            .image-footer { font-size: 10px; }
            .circle-three { display: none; }
            .selection-section { width: 100%; padding: 35px 23px 40px; background: transparent; }
            .selection-box { max-width: 480px; }
            .header { margin-bottom: 26px; }
            .header h2 { font-size: 35px; }
            .header p { font-size: 13px; }
            .login-card { padding: 22px; border-radius: 18px; }
            .card-icon { width: 49px; height: 49px; border-radius: 14px; }
            .card-title h3 { font-size: 17px; }
            .card-title span { font-size: 10px; }
            .card-top { gap: 12px; }
            .security { margin-top: 23px; }
        }
        @media (max-width: 380px) {
            .selection-section { padding: 30px 16px; }
            .login-card { padding: 18px; }
            .card-top { gap: 10px; }
            .card-title h3 { font-size: 15px; }
            .card-arrow { width: 28px; height: 28px; }
        }
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { scroll-behavior: auto !important; transition-duration: .01ms !important; animation-duration: .01ms !important; }
        }
    </style>
</head>
<body>
    <main class="container">
        <div class="main-panel">
            <section class="image-section" aria-label="Medical Archives introduction">
                <div class="circle-one" aria-hidden="true"></div>
                <div class="circle-two" aria-hidden="true"></div>
                <div class="circle-three" aria-hidden="true"></div>

                <div class="brand">
                    <div class="brand-logo" aria-label="Medical Archives logo">
                        <img src="LOGO- Medical ARCHIEVES.png" alt="Medical Archives logo"
                             onerror="this.remove(); this.parentElement.classList.add('logo-fallback');">
                    </div>
                    <div>
                        <h1>Medical Archives</h1>
                        <p>Digital Prescription Records</p>
                    </div>
                </div>

                <div class="image-content">
                    <div class="tag"><span class="tag-dot" aria-hidden="true"></span>Drugstore Management System</div>
                    <h2>Smarter Records.<br><span>Safer Medication.</span></h2>
                    <p>A digital solution for managing prescription records, patient medication history, dispensing transactions, and drugstore information securely and efficiently.</p>
                </div>

                <footer class="image-footer">&copy; 2026 Medical Archives &middot; Digital Prescription Records</footer>
            </section>

            <section class="selection-section" aria-label="Choose account type">
                <div class="selection-box">
                    <header class="header">
                        <span class="welcome-label">Welcome Back</span>
                        <h2>Get Started</h2>
                        <p>Select your account type to access the Medical Archives system.</p>
                    </header>

                    <a href="admin/login.php" class="login-card">
                        <div class="card-top">
                            <div class="card-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24"><path d="M12 15v2"></path><path d="M7 10V7a5 5 0 0 1 10 0v3"></path><rect x="4" y="10" width="16" height="11" rx="2"></rect><path d="m9 15 2 2 4-4"></path></svg>
                            </div>
                            <div class="card-title"><h3>Admin Login</h3><span>ADMINISTRATOR ACCESS</span></div>
                            <div class="card-arrow" aria-hidden="true">&rarr;</div>
                        </div>
                        <p>Manage prescriptions, customer accounts, medicine records, inventory, and system activities.</p>
                        <span class="card-link">Continue as Admin <span aria-hidden="true">&rarr;</span></span>
                    </a>

                    <a href="customer/login.php" class="login-card">
                        <div class="card-top">
                            <div class="card-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"></circle><path d="M5 21v-2a7 7 0 0 1 14 0v2"></path><path d="M19 8h3"></path><path d="M20.5 6.5v3"></path></svg>
                            </div>
                            <div class="card-title"><h3>Customer Login</h3><span>CUSTOMER ACCESS</span></div>
                            <div class="card-arrow" aria-hidden="true">&rarr;</div>
                        </div>
                        <p>View your prescription records, medication history, and personal account information.</p>
                        <span class="card-link">Continue as Customer <span aria-hidden="true">&rarr;</span></span>
                    </a>

                    <div class="security">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11z"></path><path d="m9 12 2 2 4-4"></path></svg>
                        <span>Secure access to your digital prescription records.</span>
                    </div>
                    <div class="bottom-note">Medical Archives &middot; Digital Prescription Records</div>
                </div>
            </section>
        </div>
    </main>
</body>
</html>
