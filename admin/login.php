<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#08796b">
  <title>Medical Archives | Admin Access</title>
  <style>
    *{margin:0;padding:0;box-sizing:border-box}
    :root{--green-dark:#103f34;--green-main:#08796b;--green-hover:#066458;--green-light:#80d5b0;--text-dark:#163e34;--text-muted:#60796f;--glass-border:rgba(255,255,255,.75)}
    html{min-height:100%;scroll-behavior:smooth}
    body{min-height:100vh;font-family:Arial,Helvetica,sans-serif;color:var(--text-dark);background:radial-gradient(circle at 8% 10%,rgba(113,202,163,.32),transparent 35%),radial-gradient(circle at 90% 85%,rgba(53,143,110,.22),transparent 34%),linear-gradient(135deg,#eaf6ef,#dcebe3);overflow-x:hidden}
    button,input{font:inherit}button,a{-webkit-tap-highlight-color:transparent}button{cursor:pointer}
    .background-circle{position:fixed;z-index:0;pointer-events:none;border-radius:50%}.circle-a{width:350px;height:350px;top:-120px;right:8%;background:rgba(255,255,255,.27)}.circle-b{width:280px;height:280px;bottom:-100px;left:25%;background:rgba(77,164,125,.11)}
    .container{position:relative;z-index:1;width:100%;min-height:100vh;padding:24px;display:flex;align-items:stretch;justify-content:center}
    .main-panel{width:100%;max-width:1600px;min-height:calc(100vh - 48px);display:flex;overflow:hidden;border:1px solid rgba(255,255,255,.8);border-radius:30px;background:rgba(255,255,255,.19);box-shadow:0 25px 70px rgba(23,75,55,.14),inset 0 1px 1px rgba(255,255,255,.8);backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px)}
    .left-side{position:relative;isolation:isolate;width:53%;min-height:760px;overflow:hidden;display:flex;flex-direction:column;justify-content:space-between;padding:48px;color:white;background:#075e50}
    .left-side>img{position:absolute;inset:0;z-index:-2;width:100%;height:100%;object-fit:cover;object-position:center}
    .left-side::before{content:"";position:absolute;inset:0;z-index:-1;background:linear-gradient(145deg,rgba(7,55,43,.83),rgba(3,105,89,.68),rgba(6,48,43,.86))}
    .left-side::after{content:"";position:absolute;z-index:-1;width:350px;height:350px;top:-100px;right:-110px;border:1px solid rgba(255,255,255,.19);border-radius:50%;box-shadow:0 0 0 35px rgba(255,255,255,.045),0 0 0 75px rgba(255,255,255,.025);pointer-events:none}
    .brand{position:relative;z-index:2;display:flex;align-items:center;gap:17px;min-width:0}
    .brand-icon{width:62px;height:62px;flex-shrink:0;display:flex;justify-content:center;align-items:center;overflow:hidden;padding:5px;border:1px solid rgba(255,255,255,.8);border-radius:18px;background:rgba(255,255,255,.92);color:var(--green-main);font-size:43px;font-weight:400;box-shadow:0 8px 28px rgba(0,0,0,.1),inset 0 1px 1px rgba(255,255,255,.5);backdrop-filter:blur(15px);-webkit-backdrop-filter:blur(15px)}
    .brand-icon img{display:block;width:100%;height:100%;object-fit:contain;border-radius:12px}.brand-icon.logo-fallback::after{content:"+";font-size:43px;font-weight:400;line-height:1;color:var(--green-main)}
    .brand h2{font-family:Georgia,"Times New Roman",serif;font-size:clamp(24px,2.2vw,33px);line-height:1.2;font-weight:600}.brand p{margin-top:7px;font-size:13px;letter-spacing:1.3px;color:rgba(255,255,255,.82)}
    .hero-text{position:relative;z-index:2;max-width:650px;margin:70px 0}.system-label{display:inline-flex;align-items:center;gap:10px;padding:12px 18px;margin-bottom:28px;border:1px solid rgba(255,255,255,.36);border-radius:30px;background:rgba(255,255,255,.13);font-size:13px;font-weight:600;letter-spacing:.6px;backdrop-filter:blur(14px);-webkit-backdrop-filter:blur(14px)}
    .status-dot{width:9px;height:9px;border-radius:50%;background:#9af2c3;box-shadow:0 0 14px rgba(154,242,195,.75)}.hero-text h1{font-family:Georgia,"Times New Roman",serif;font-size:clamp(42px,4.2vw,67px);line-height:1.1;letter-spacing:-1.3px;margin-bottom:25px}.hero-text h1 span{color:#a3edc7}.hero-text p{max-width:580px;color:rgba(255,255,255,.89);font-size:17px;line-height:1.9}
    .left-footer{position:relative;z-index:2;padding-top:22px;border-top:1px solid rgba(255,255,255,.23);font-size:12px;line-height:1.7;color:rgba(255,255,255,.77)}
    .right-side{width:47%;min-width:0;display:flex;align-items:center;justify-content:center;padding:44px;background:rgba(245,251,247,.31)}.form-wrapper{width:100%;max-width:510px;margin:auto}
    .heading-label{display:inline-block;margin-bottom:13px;color:var(--green-main);font-size:13px;font-weight:700;letter-spacing:2px;text-transform:uppercase}.form-wrapper h1{margin-bottom:12px;color:var(--green-dark);font-family:Georgia,"Times New Roman",serif;font-size:clamp(34px,3vw,45px);font-weight:600;line-height:1.2;letter-spacing:-.7px}.subtitle{margin-bottom:30px;color:var(--text-muted);font-size:17px;line-height:1.65}
    .form-box{width:100%;padding:33px;border:1px solid var(--glass-border);border-radius:23px;background:rgba(255,255,255,.52);box-shadow:0 15px 40px rgba(25,77,55,.09),inset 0 1px 0 rgba(255,255,255,.88);backdrop-filter:blur(22px);-webkit-backdrop-filter:blur(22px)}
    .form-group{margin-bottom:23px}.form-group label{display:block;margin-bottom:11px;color:#204c40;font-size:15px;font-weight:700}.input-box{position:relative;width:100%}.input-box input{display:block;width:100%;height:56px;padding:0 51px;border:1px solid rgba(131,164,149,.42);border-radius:12px;outline:none;background:rgba(255,255,255,.73);color:#173f34;font-size:16px;box-shadow:inset 0 1px 3px rgba(19,73,52,.025);transition:border-color .25s,box-shadow .25s,background .25s}.input-box input::placeholder{color:#90a39a;font-size:15px}.input-box input:focus{border-color:#178b71;background:rgba(255,255,255,.96);box-shadow:0 0 0 4px rgba(23,139,113,.11)}
    .input-icon{position:absolute;left:16px;top:50%;width:21px;height:21px;display:flex;align-items:center;justify-content:center;transform:translateY(-50%);pointer-events:none;color:#39876e}.input-icon svg{width:21px;height:21px;fill:none;stroke:currentColor;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
    .eye{position:absolute;top:50%;right:12px;width:36px;height:36px;display:flex;align-items:center;justify-content:center;transform:translateY(-50%);border:0;border-radius:9px;background:transparent;color:#438372;transition:background .2s}.eye:hover{background:rgba(8,121,107,.1)}.eye svg{width:21px;height:21px;fill:none;stroke:currentColor;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
    .login-btn{width:100%;min-height:56px;margin-top:3px;padding:15px 20px;border:1px solid rgba(255,255,255,.24);border-radius:12px;background:linear-gradient(135deg,#108a72,#086558);color:white;font-size:15px;font-weight:700;letter-spacing:.8px;box-shadow:0 8px 18px rgba(8,101,88,.19),inset 0 1px 0 rgba(255,255,255,.17);transition:transform .2s,box-shadow .2s,background .2s}.login-btn:hover{transform:translateY(-2px);background:linear-gradient(135deg,#0b7965,#06574d);box-shadow:0 12px 24px rgba(8,101,88,.25)}.login-btn:active{transform:translateY(0)}
    .divider{display:flex;align-items:center;gap:17px;margin:26px 0;color:#81948a;font-size:13px;font-weight:600}.divider::before,.divider::after{content:"";flex:1;height:1px;background:rgba(125,157,142,.32)}
    .create-btn{width:100%;min-height:54px;display:flex;align-items:center;justify-content:center;gap:10px;padding:13px 16px;border:1px solid rgba(22,135,127,.45);border-radius:12px;background:rgba(255,255,255,.64);color:#08756e;font-size:14px;font-weight:700;box-shadow:inset 0 1px 0 rgba(255,255,255,.85);transition:background .25s,border-color .25s,transform .25s}.create-btn:hover{background:rgba(255,255,255,.95);border-color:#16877f;transform:translateY(-1px)}.create-symbol{font-size:22px;font-weight:400;line-height:1}
    .back-home{text-align:center;margin-top:26px}.back-home a{display:inline-flex;align-items:center;gap:9px;padding:8px;color:#287965;text-decoration:none;font-size:14px;font-weight:600;transition:color .2s}.back-home a:hover{color:#104e3e}.hidden{display:none!important}
    .notice{margin-top:14px;color:#a43636;font-size:13px;line-height:1.5;min-height:0}.notice:empty{display:none}
    @media(max-width:1100px){.container{padding:16px}.main-panel{min-height:calc(100vh - 32px)}.left-side{width:46%;padding:34px}.right-side{width:54%;padding:32px}.brand h2{font-size:26px}.hero-text h1{font-size:clamp(38px,4.5vw,52px)}.hero-text p{font-size:16px}.form-box{padding:27px}}
    @media(max-width:760px){.container{display:block;padding:0}.main-panel{flex-direction:column;min-height:100vh;border:0;border-radius:0;overflow:visible;background:transparent;box-shadow:none}.left-side{width:100%;min-height:400px;padding:27px 25px;border-radius:0 0 28px 28px}.brand{gap:13px}.brand-icon{width:52px;height:52px;border-radius:15px}.brand h2{font-size:24px}.brand p{font-size:11px;letter-spacing:.8px}.hero-text{margin:42px 0}.system-label{padding:10px 14px;margin-bottom:20px;font-size:11px}.hero-text h1{font-size:clamp(36px,8vw,48px);margin-bottom:17px}.hero-text p{font-size:15px;line-height:1.8}.left-footer{padding-top:16px;font-size:11px}.right-side{width:100%;padding:34px 22px 45px;background:transparent}.form-wrapper{max-width:520px}.form-wrapper h1{font-size:37px}.subtitle{font-size:16px;margin-bottom:25px}.form-box{padding:26px 22px;border-radius:20px;background:rgba(255,255,255,.64)}.form-group{margin-bottom:22px}.form-group label{font-size:15px}.input-box input{height:55px;font-size:16px}.login-btn{min-height:55px;font-size:14px}.create-btn{min-height:53px;font-size:14px}}
    @media(max-width:380px){.left-side{padding:24px 19px;min-height:390px}.brand h2{font-size:21px}.brand p{font-size:10px}.hero-text h1{font-size:34px}.hero-text p{font-size:14px}.right-side{padding:30px 15px 38px}.form-wrapper h1{font-size:33px}.form-box{padding:23px 17px}.input-box input{padding-left:44px;padding-right:44px;font-size:15px}}
    button:focus-visible,a:focus-visible{outline:3px solid #218d71;outline-offset:4px}
    @media(prefers-reduced-motion:reduce){*,*::before,*::after{scroll-behavior:auto!important;transition-duration:.01ms!important;animation-duration:.01ms!important}}
  </style>
</head>
<body>
  <div class="background-circle circle-a"></div>
  <div class="background-circle circle-b"></div>
  <main class="container">
    <div class="main-panel">
      <section class="left-side" aria-label="Medical Archives introduction">
        <img src="Beacon-HOspital-Banner-MEdical-scaled.jpg" alt="" aria-hidden="true" onerror="this.style.display='none'">
        <div class="brand">
          <div class="brand-icon" aria-label="Medical Archives logo">
            <img src="LOGO- Medical ARCHIEVES.png" alt="Medical Archives logo" onerror="this.remove();this.parentElement.classList.add('logo-fallback')">
          </div>
          <div><h2>Medical Archives</h2><p>Digital Prescription Records</p></div>
        </div>
        <div class="hero-text">
          <div class="system-label"><span class="status-dot"></span>Administrator Portal</div>
          <h1>Smarter Records.<br><span>Safer Medication.</span></h1>
          <p>A digital solution for managing prescription records, patient medication history, dispensing transactions, and drugstore information securely and efficiently.</p>
        </div>
        <footer class="left-footer">&copy; 2026 Medical Archives - Secure Digital Records</footer>
      </section>
      <section class="right-side" aria-label="Administrator login and registration">
        <div class="form-wrapper">
          <div id="loginSection">
            <span class="heading-label">Administrator Portal</span>
            <h1>Welcome Back</h1>
            <p class="subtitle">Sign in to manage prescriptions, medicines, customer accounts, and records.</p>
            <div class="form-box">
              <div class="form-group">
                <label for="adminLoginUser">Username or Email</label>
                <div class="input-box">
                  <span class="input-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"></circle><path d="M5 21v-2a7 7 0 0 1 14 0v2"></path></svg></span>
                  <input type="text" id="adminLoginUser" placeholder="Enter username or email" autocomplete="username" required>
                </div>
              </div>
              <div class="form-group">
                <label for="adminLoginPassword">Password</label>
                <div class="input-box">
                  <span class="input-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="4" y="10" width="16" height="11" rx="2"></rect><path d="M8 10V7a4 4 0 0 1 8 0v3"></path></svg></span>
                  <input type="password" id="adminLoginPassword" placeholder="Enter your password" autocomplete="current-password" required>
                  <button type="button" class="eye" aria-label="Show password" aria-pressed="false" onclick="togglePassword('adminLoginPassword',this)"><svg viewBox="0 0 24 24"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"></path><circle cx="12" cy="12" r="3"></circle></svg></button>
                </div>
              </div>
              <button type="button" class="login-btn" onclick="adminLogin()">SIGN IN TO ADMIN PANEL</button>
              <p class="notice" id="loginNotice" role="status" aria-live="polite"></p>
              <div class="divider"><span>OR</span></div>
              <button type="button" class="create-btn" onclick="showRegister()"><span class="create-symbol" aria-hidden="true">+</span>Create Admin Account</button>
            </div>
            <div class="back-home"><a href="../index.php"><span aria-hidden="true">&larr;</span>Back to Home</a></div>
          </div>
          <div id="registerSection" class="hidden">
            <span class="heading-label">Administrator Registration</span>
            <h1>Create Account</h1>
            <p class="subtitle">Register an administrator account for Medical Archives.</p>
            <div class="form-box">
              <div class="form-group"><label for="adminFullName">Full Name</label><div class="input-box"><span class="input-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"></circle><path d="M5 21v-2a7 7 0 0 1 14 0v2"></path></svg></span><input type="text" id="adminFullName" placeholder="Enter your full name" autocomplete="name" required></div></div>
              <div class="form-group"><label for="adminUsername">Username</label><div class="input-box"><span class="input-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"></circle><path d="M5 21v-2a7 7 0 0 1 14 0v2"></path></svg></span><input type="text" id="adminUsername" placeholder="Create a username" autocomplete="username" required></div></div>
              <div class="form-group"><label for="adminEmail">Email Address</label><div class="input-box"><span class="input-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="2"></rect><path d="m3 7 9 6 9-6"></path></svg></span><input type="email" id="adminEmail" placeholder="Enter your email address" autocomplete="email" required></div></div>
              <div class="form-group"><label for="adminPassword">Password</label><div class="input-box"><span class="input-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="4" y="10" width="16" height="11" rx="2"></rect><path d="M8 10V7a4 4 0 0 1 8 0v3"></path></svg></span><input type="password" id="adminPassword" placeholder="Create a password" autocomplete="new-password" required><button type="button" class="eye" aria-label="Show password" aria-pressed="false" onclick="togglePassword('adminPassword',this)"><svg viewBox="0 0 24 24"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"></path><circle cx="12" cy="12" r="3"></circle></svg></button></div></div>
              <div class="form-group"><label for="adminConfirmPassword">Confirm Password</label><div class="input-box"><span class="input-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="4" y="10" width="16" height="11" rx="2"></rect><path d="M8 10V7a4 4 0 0 1 8 0v3"></path></svg></span><input type="password" id="adminConfirmPassword" placeholder="Re-enter your password" autocomplete="new-password" required><button type="button" class="eye" aria-label="Show password" aria-pressed="false" onclick="togglePassword('adminConfirmPassword',this)"><svg viewBox="0 0 24 24"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"></path><circle cx="12" cy="12" r="3"></circle></svg></button></div></div>
              <button type="button" class="login-btn" onclick="adminRegister()">CREATE ADMIN ACCOUNT</button>
              <p class="notice" id="registerNotice" role="status" aria-live="polite"></p>
              <div class="divider"><span>OR</span></div>
              <button type="button" class="create-btn" onclick="showLogin()"><span aria-hidden="true">&larr;</span>Back to Login</button>
            </div>
            <div class="back-home"><a href="../index.php"><span aria-hidden="true">&larr;</span>Back to Home</a></div>
          </div>
        </div>
      </section>
    </div>
  </main>
  <script>
    function setNotice(id, message) {
      const notice = document.getElementById(id);
      if (notice) notice.textContent = message;
    }

    function showRegister() {
      document.getElementById('loginSection').classList.add('hidden');
      document.getElementById('registerSection').classList.remove('hidden');
      setNotice('loginNotice', '');
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function showLogin() {
      document.getElementById('registerSection').classList.add('hidden');
      document.getElementById('loginSection').classList.remove('hidden');
      setNotice('registerNotice', '');
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

    function getAdminAccounts() {
      try {
        const parsed = JSON.parse(localStorage.getItem('adminAccounts') || '[]');
        return Array.isArray(parsed) ? parsed : [];
      } catch (error) {
        throw new Error('Unable to read saved admin accounts in this browser.');
      }
    }

    function adminRegister() {
      const fullName = document.getElementById('adminFullName').value.trim();
      const username = document.getElementById('adminUsername').value.trim();
      const email = document.getElementById('adminEmail').value.trim();
      const password = document.getElementById('adminPassword').value;
      const confirmPassword = document.getElementById('adminConfirmPassword').value;
      const error = message => setNotice('registerNotice', message);
      error('');

      if (!fullName || !username || !email || !password || !confirmPassword) return error('Please complete all fields.');
      if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) return error('Please enter a valid email address.');
      if (username.length < 3) return error('Username must contain at least 3 characters.');
      if (password.length < 6) return error('Password must be at least 6 characters.');
      if (password !== confirmPassword) return error('Passwords do not match.');

      let accounts;
      try { accounts = getAdminAccounts(); }
      catch (e) { return error(e.message); }

      const normalizedUsername = username.toLowerCase();
      const normalizedEmail = email.toLowerCase();
      const exists = accounts.some(account => account && (
        String(account.username || '').toLowerCase() === normalizedUsername ||
        String(account.email || '').toLowerCase() === normalizedEmail
      ));
      if (exists) return error('Username or email already exists.');

      // Frontend demonstration only. Production credentials must be managed by a secure backend.
      accounts.push({ fullName, username, email, password });
      try { localStorage.setItem('adminAccounts', JSON.stringify(accounts)); }
      catch (e) { return error('Unable to save the account in this browser.'); }

      alert('Admin account created successfully!');
      ['adminFullName','adminUsername','adminEmail','adminPassword','adminConfirmPassword'].forEach(id => document.getElementById(id).value = '');
      showLogin();
      document.getElementById('adminLoginUser').value = email;
      document.getElementById('adminLoginPassword').focus();
    }

    function adminLogin() {
      const user = document.getElementById('adminLoginUser').value.trim();
      const password = document.getElementById('adminLoginPassword').value;
      const error = message => setNotice('loginNotice', message);
      error('');
      if (!user || !password) return error('Please enter your username/email and password.');

      let accounts;
      try { accounts = getAdminAccounts(); }
      catch (e) { return error(e.message); }

      const normalizedUser = user.toLowerCase();
      const account = accounts.find(item => item && (
        String(item.username || '').toLowerCase() === normalizedUser ||
        String(item.email || '').toLowerCase() === normalizedUser
      ) && item.password === password);

      if (!account) return error('Invalid admin username/email or password.');

      const currentAdmin = { fullName: account.fullName, username: account.username, email: account.email };
      try { localStorage.setItem('currentAdmin', JSON.stringify(currentAdmin)); }
      catch (e) { return error('Unable to save the current admin session.'); }

      alert('Admin login successful!');
      window.location.href = 'dashboard.php';
    }

    // Allow Enter to submit the currently displayed form.
    document.addEventListener('keydown', event => {
      if (event.key !== 'Enter') return;
      if (!document.getElementById('registerSection').classList.contains('hidden')) {
        event.preventDefault(); adminRegister();
      } else if (document.activeElement && ['adminLoginUser', 'adminLoginPassword'].includes(document.activeElement.id)) {
        event.preventDefault(); adminLogin();
      }
    });
  </script>
<script>
async function maApi(path,body){const r=await fetch('../api/'+path,{method:body?'POST':'GET',headers:{'Content-Type':'application/json'},credentials:'same-origin',body:body?JSON.stringify(body):undefined});const j=await r.json();if(!r.ok||!j.success)throw new Error(j.data?.message||'Request failed');return j.data;}
async function adminRegister(){const full_name=document.getElementById('adminFullName').value.trim(),username=document.getElementById('adminUsername').value.trim(),email=document.getElementById('adminEmail').value.trim(),password=document.getElementById('adminPassword').value,confirm=document.getElementById('adminConfirmPassword').value;if(password!==confirm)return setNotice('registerNotice','Passwords do not match.');try{await maApi('auth/register/admin',{full_name,username,email,password});alert('Admin account created. You can now sign in.');showLogin();document.getElementById('adminLoginUser').value=email;}catch(e){setNotice('registerNotice',e.message);}}
async function adminLogin(){const username=document.getElementById('adminLoginUser').value.trim(),password=document.getElementById('adminLoginPassword').value;try{await maApi('auth/login/admin',{username,password});location.href='dashboard.php';}catch(e){setNotice('loginNotice',e.message);}}
</script>
</body>
</html>
