<?php require_once __DIR__.'/../includes/session.php'; require_role('admin'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Medical Archives | Admin Dashboard</title>
<style>
:root{
  --green:#075c4d;
  --green-2:#0a745f;
  --green-3:#dff3ed;
  --mint:#f1faf7;
  --line:#dcebe6;
  --text:#16332d;
  --muted:#78908a;
  --white:#fff;
  --shadow:0 8px 25px rgba(7,92,77,.08);
  --danger:#d94d57;
  --warning:#eea62a;
  --success:#25a56a;
}
*{box-sizing:border-box}
body{
  margin:0;
  font-family:Inter,Segoe UI,Arial,sans-serif;
  background:#f6fbf9;
  color:var(--text);
}
button,input,select,textarea{font:inherit}
button{cursor:pointer}
.app{display:flex;min-height:100vh}
.sidebar{
  width:245px;background:linear-gradient(180deg,#075c4d,#06483d);
  color:white;padding:18px 14px;position:fixed;left:0;top:0;bottom:0;
  display:flex;flex-direction:column;z-index:10;
}
.brand{display:flex;align-items:center;gap:10px;padding:5px 9px 25px}
.brand-mark{
  width:38px;height:38px;border-radius:10px;background:white;color:var(--green);
  display:grid;place-items:center;font-weight:900;font-size:21px;
}
.brand h2{font-size:17px;margin:0}
.brand small{font-size:9px;opacity:.75}
.nav-title{font-size:10px;text-transform:uppercase;letter-spacing:1.2px;opacity:.55;margin:3px 10px 8px}
.nav{display:flex;flex-direction:column;gap:5px}
.nav button{
  border:0;background:transparent;color:#dceee9;text-align:left;padding:11px 12px;
  border-radius:9px;display:flex;align-items:center;gap:11px;font-size:13px;
}
.nav button:hover,.nav button.active{background:rgba(255,255,255,.14);color:white}
.nav-icon{width:20px;text-align:center;font-size:13px}
.sidebar-bottom{margin-top:auto;border-top:1px solid rgba(255,255,255,.12);padding-top:14px}
.admin-mini{display:flex;align-items:center;gap:9px;margin-bottom:13px}
.avatar{width:34px;height:34px;border-radius:50%;background:#dff3ed;color:var(--green);display:grid;place-items:center;font-weight:700;font-size:12px}
.admin-mini strong{display:block;font-size:12px}
.admin-mini span{font-size:10px;opacity:.65}
.logout{width:100%;border:0;background:rgba(255,255,255,.1);color:white;padding:10px;border-radius:8px}
.main{margin-left:245px;width:calc(100% - 245px)}
.topbar{
  height:64px;background:white;border-bottom:1px solid var(--line);
  display:flex;align-items:center;justify-content:space-between;padding:0 30px;
  position:sticky;top:0;z-index:5;
}
.search{width:min(390px,42vw);position:relative}
.search input{width:100%;border:1px solid var(--line);border-radius:9px;padding:10px 13px 10px 36px;outline:none;background:#fbfefd}
.search input:focus{border-color:#83c7b5}
.search:before{content:"⌕";position:absolute;left:13px;top:8px;color:#72918a;font-size:17px}
.top-actions{display:flex;align-items:center;gap:15px}
.icon-btn{border:0;background:transparent;color:#58766e;font-size:17px}
.user-chip{display:flex;align-items:center;gap:8px;font-size:12px}
.page{padding:27px 30px 40px}
.page-head{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:22px}
.page-head h1{font-size:23px;margin:0 0 5px}
.page-head p{margin:0;color:var(--muted);font-size:12px}
.btn{
  border:0;border-radius:8px;padding:10px 15px;background:var(--green);color:white;font-size:12px;font-weight:600;
}
.btn:hover{background:var(--green-2)}
.btn.light{background:white;color:var(--green);border:1px solid var(--line)}
.btn.danger{background:#fff0f1;color:var(--danger)}
.grid{display:grid;gap:16px}
.stats{grid-template-columns:repeat(4,1fr)}
.card{background:white;border:1px solid var(--line);border-radius:12px;box-shadow:var(--shadow)}
.stat{padding:18px;display:flex;justify-content:space-between;align-items:center}
.stat-label{font-size:11px;color:var(--muted);margin-bottom:5px}
.stat-value{font-size:25px;font-weight:700}
.stat-change{font-size:10px;color:var(--success);margin-top:4px}
.stat-icon{width:42px;height:42px;border-radius:11px;background:var(--green-3);display:grid;place-items:center;color:var(--green);font-weight:800}
.two-col{grid-template-columns:1.55fr 1fr;margin-top:17px}
.card-head{padding:16px 18px;border-bottom:1px solid var(--line);display:flex;justify-content:space-between;align-items:center}
.card-head h3{margin:0;font-size:13px}
.card-head a{font-size:11px;color:var(--green);cursor:pointer}
.card-body{padding:15px 18px}
table{width:100%;border-collapse:collapse;font-size:11px}
th{color:#7b918b;font-weight:600;text-align:left;padding:9px 8px;background:#f8fcfa}
td{padding:11px 8px;border-bottom:1px solid #edf4f1}
tr:last-child td{border-bottom:0}
.badge{display:inline-block;padding:4px 8px;border-radius:20px;font-size:9px;font-weight:700}
.badge.green{background:#e4f7ee;color:#20895b}
.badge.yellow{background:#fff4dc;color:#b67816}
.badge.red{background:#ffeaec;color:#c53d49}
.badge.gray{background:#eef4f2;color:#6f8780}
.quick{display:grid;gap:9px}
.quick button{
  border:1px solid var(--line);background:#fff;border-radius:9px;padding:12px;
  display:flex;align-items:center;gap:10px;text-align:left;color:var(--text);font-size:11px;
}
.quick button:hover{border-color:#9dcfc1;background:#f7fcfa}
.qicon{width:30px;height:30px;border-radius:8px;background:var(--green-3);color:var(--green);display:grid;place-items:center;font-weight:700}
.toolbar{display:flex;gap:9px;flex-wrap:wrap;margin-bottom:14px}
.toolbar input,.toolbar select,.form-control{
  border:1px solid var(--line);background:white;border-radius:8px;padding:10px 11px;outline:none;color:var(--text);
}
.toolbar input{min-width:230px;flex:1}
.toolbar select{min-width:140px}
.form-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:14px}
.form-group{display:flex;flex-direction:column;gap:6px}
.form-group.full{grid-column:1/-1}
.form-group label{font-size:11px;font-weight:700}
textarea.form-control{min-height:90px;resize:vertical}
.form-actions{display:flex;justify-content:flex-end;gap:8px;margin-top:16px}
.section{display:none}
.section.active{display:block}
.empty{padding:50px 20px;text-align:center;color:var(--muted)}
.modal-wrap{
  display:none;position:fixed;inset:0;background:rgba(4,42,35,.4);z-index:30;align-items:center;justify-content:center;padding:20px;
}
.modal-wrap.show{display:flex}
.modal{width:min(560px,100%);background:white;border-radius:14px;box-shadow:0 20px 60px rgba(0,0,0,.18);padding:22px}
.modal h2{font-size:18px;margin:0 0 4px}.modal p{font-size:11px;color:var(--muted);margin:0 0 18px}
.toast{
  position:fixed;right:25px;bottom:25px;background:#075c4d;color:white;padding:12px 16px;border-radius:9px;
  font-size:12px;box-shadow:var(--shadow);display:none;z-index:50
}
.toast.show{display:block}
@media(max-width:1000px){
  .sidebar{width:210px}.main{margin-left:210px;width:calc(100% - 210px)}
  .stats{grid-template-columns:repeat(2,1fr)}.two-col{grid-template-columns:1fr}
}
@media(max-width:720px){
  .sidebar{position:fixed;width:70px;padding:12px 8px}.brand h2,.brand small,.nav-title,.nav button span,.admin-mini div,.logout{display:none}
  .brand{justify-content:center;padding-bottom:20px}.nav button{justify-content:center}.nav-icon{width:auto}
  .main{margin-left:70px;width:calc(100% - 70px)}.topbar{padding:0 15px}.page{padding:20px 15px}
  .search{width:45vw}.page-head{gap:10px}.form-grid{grid-template-columns:1fr}
  .form-group.full{grid-column:auto}
}

/* ===== GLASS UI REFRESH: larger, clearer and more interactive ===== */
:root{
  --glass-bg:rgba(255,255,255,.64);
  --glass-border:rgba(255,255,255,.78);
  --glass-shadow:0 18px 45px rgba(7,72,61,.12);
  --text:#143d35;
}
html{scroll-behavior:smooth}
body{
  font-size:15px!important;
  line-height:1.55;
  background:
    radial-gradient(ellipse at 8% 5%,rgba(125,224,194,.35),transparent 34%),
    radial-gradient(ellipse at 95% 18%,rgba(169,221,210,.42),transparent 30%),
    linear-gradient(135deg,#edf8f4 0%,#f7fbfa 48%,#e8f5f0 100%)!important;
  background-attachment:fixed;
}
.sidebar{
  background:linear-gradient(160deg,rgba(5,83,69,.94),rgba(3,54,48,.97))!important;
  backdrop-filter:blur(22px);-webkit-backdrop-filter:blur(22px);
  box-shadow:8px 0 35px rgba(3,54,48,.12);
  border-right:1px solid rgba(255,255,255,.16);
  padding:24px 17px!important;
}
.brand{padding-bottom:32px!important}
.brand-mark{box-shadow:0 8px 22px rgba(0,0,0,.12);border-radius:13px!important}
.brand h2{font-size:19px!important;letter-spacing:-.4px}
.brand small{font-size:11px!important}
.nav-title{font-size:11px!important;margin-bottom:12px!important}
.nav{gap:8px!important}
.nav button{
  padding:13px 14px!important;border-radius:12px!important;
  font-size:14px!important;transition:transform .22s ease,background .22s ease,box-shadow .22s ease;
}
.nav button:hover{transform:translateX(3px);background:rgba(255,255,255,.16)!important}
.nav button.active{background:rgba(255,255,255,.2)!important;box-shadow:inset 3px 0 #b9f3df,0 7px 18px rgba(0,0,0,.08)}
.nav-icon{font-size:17px!important}
.avatar{width:40px!important;height:40px!important;font-size:13px!important}
.admin-mini strong,.customer-mini strong{font-size:14px!important}
.admin-mini span,.customer-mini span{font-size:11px!important}
.logout{padding:12px!important;border-radius:11px!important;font-size:13px!important;transition:.2s}
.logout:hover{background:rgba(255,255,255,.2)!important;transform:translateY(-1px)}
.main{min-width:0}
.topbar{
  height:78px!important;padding:0 clamp(18px,3vw,42px)!important;
  background:rgba(255,255,255,.55)!important;
  border-bottom:1px solid rgba(255,255,255,.8)!important;
  backdrop-filter:blur(22px);-webkit-backdrop-filter:blur(22px);
  box-shadow:0 8px 25px rgba(7,92,77,.04);
}
.search{width:min(470px,48vw)!important}
.search input{padding:13px 15px 13px 42px!important;border-radius:13px!important;font-size:14px!important;background:rgba(255,255,255,.75)!important}
.search:before{top:10px!important;font-size:20px!important}
.icon-btn{font-size:21px!important}
.user-chip{font-size:14px!important}
.page{padding:clamp(22px,3vw,42px)!important;max-width:1800px;margin:0 auto}
.page-head{margin-bottom:26px!important;align-items:center!important;gap:18px}
.page-head h1{font-size:clamp(27px,2.2vw,36px)!important;letter-spacing:-1px;line-height:1.2}
.page-head p{font-size:14px!important;margin-top:7px!important}
.btn{padding:12px 18px!important;border-radius:11px!important;font-size:14px!important;box-shadow:0 7px 17px rgba(7,92,77,.12);transition:transform .2s,box-shadow .2s,background .2s}
.btn:hover{transform:translateY(-2px);box-shadow:0 11px 23px rgba(7,92,77,.18)}
.btn.light{background:rgba(255,255,255,.72)!important}
.grid{gap:20px!important}
.stats{gap:18px!important}
.card,.profile-card,.profile-details{
  background:var(--glass-bg)!important;
  border:1px solid var(--glass-border)!important;
  border-radius:20px!important;
  box-shadow:var(--glass-shadow)!important;
  backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px);
  transition:transform .24s ease,box-shadow .24s ease,border-color .24s ease;
  overflow:hidden;
}
.card:hover{box-shadow:0 22px 48px rgba(7,72,61,.15)!important;border-color:rgba(255,255,255,.98)!important}
.stat{padding:24px!important;min-height:130px}
.stat-label{font-size:13px!important;margin-bottom:8px!important}
.stat-value{font-size:clamp(29px,2.4vw,38px)!important;letter-spacing:-1px}
.stat-change,.stat-info{font-size:12px!important}
.stat-icon{width:52px!important;height:52px!important;border-radius:15px!important;font-size:15px}
.two-col{gap:20px!important;margin-top:22px!important}
.card-head{padding:20px 23px!important;background:rgba(255,255,255,.25);border-bottom:1px solid rgba(255,255,255,.7)!important}
.card-head h3{font-size:16px!important}
.card-head a{font-size:13px!important;text-decoration:none}
.card-head a:hover{text-decoration:underline}
.card-body{padding:22px 23px!important}
table{font-size:13px!important;white-space:nowrap}
th{font-size:12px!important;padding:13px 12px!important;background:rgba(231,246,240,.72)!important}
td{padding:15px 12px!important;border-bottom:1px solid rgba(13,94,76,.09)!important}
tbody tr{transition:background .18s ease}
tbody tr:hover{background:rgba(220,245,236,.48)}
.badge{font-size:11px!important;padding:5px 10px!important}
.quick{gap:12px!important}
.quick button,.quick-item{
  padding:15px!important;border-radius:13px!important;font-size:13px!important;
  background:rgba(255,255,255,.55)!important;transition:transform .2s,border-color .2s,background .2s;
}
.quick button:hover{transform:translateY(-2px);background:rgba(255,255,255,.88)!important}
.qicon,.quick-icon{width:38px!important;height:38px!important;border-radius:11px!important;font-size:12px}
.toolbar{gap:12px!important}
.toolbar input,.toolbar select,.form-control{
  padding:13px 14px!important;border-radius:11px!important;font-size:14px!important;
  background:rgba(255,255,255,.76)!important;border:1px solid rgba(153,198,184,.52)!important;
  transition:border-color .2s,box-shadow .2s;
}
.toolbar input:focus,.toolbar select:focus,.form-control:focus,.search input:focus{
  border-color:#4bb69a!important;box-shadow:0 0 0 4px rgba(75,182,154,.13);outline:none;
}
.toolbar input{min-width:220px}
.form-grid{gap:18px!important}
.form-group{gap:8px!important}
.form-group label{font-size:13px!important}
textarea.form-control{min-height:120px}
.form-actions{margin-top:22px!important}
.welcome-card{
  padding:clamp(25px,3vw,38px)!important;border-radius:22px!important;margin-bottom:22px!important;
  background:linear-gradient(125deg,rgba(5,92,77,.96),rgba(10,128,107,.86))!important;
  box-shadow:0 20px 45px rgba(5,92,77,.2);position:relative;overflow:hidden;
}
.welcome-card:after{content:"";position:absolute;width:250px;height:250px;border:1px solid rgba(255,255,255,.17);border-radius:50%;right:8%;top:-130px;box-shadow:0 0 0 30px rgba(255,255,255,.035),0 0 0 60px rgba(255,255,255,.025);pointer-events:none}
.welcome-card h2{font-size:clamp(24px,2.3vw,34px)!important}
.welcome-card p{font-size:14px!important}
.welcome-avatar{width:68px!important;height:68px!important;font-size:20px!important;box-shadow:0 10px 25px rgba(0,0,0,.12)}
.profile-grid{gap:22px!important;grid-template-columns:minmax(240px,320px) minmax(0,1fr)!important}
.profile-card,.profile-details{padding:28px!important}
.profile-avatar{width:94px!important;height:94px!important;font-size:28px!important}
.profile-card h2{font-size:21px!important}
.profile-card p{font-size:13px!important}
.profile-details h3{font-size:17px!important}
.info-box{padding:16px!important;border-radius:12px!important;background:rgba(255,255,255,.42)}
.info-box label{font-size:12px!important}
.info-box strong{font-size:14px!important;overflow-wrap:anywhere}
.modal-wrap{background:rgba(4,35,30,.42)!important;backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px)}
.modal{background:rgba(250,255,253,.92)!important;border:1px solid rgba(255,255,255,.9);border-radius:22px!important;padding:30px!important;box-shadow:0 30px 90px rgba(0,0,0,.25)!important;backdrop-filter:blur(25px)}
.modal h2{font-size:23px!important}.modal p{font-size:13px!important}
.toast{padding:15px 20px!important;border:1px solid rgba(255,255,255,.3);border-radius:13px!important;font-size:14px!important;box-shadow:0 16px 38px rgba(0,0,0,.2)}
.section.active{animation:sectionIn .32s ease both}
@keyframes sectionIn{from{opacity:0;transform:translateY(8px)}to{opacity:1;transform:translateY(0)}}
@media(max-width:1100px){
  .page{padding:24px!important}
  .stats{grid-template-columns:repeat(2,minmax(0,1fr))!important}
  .two-col{grid-template-columns:1fr!important}
}
@media(max-width:720px){
  .sidebar{width:76px!important;padding:14px 8px!important}
  .brand{padding:5px 0 24px!important}
  .brand-mark{width:43px!important;height:43px!important}
  .brand h2,.brand small,.nav-title,.nav button span:not(.nav-icon),.admin-mini div,.customer-mini div,.logout{display:none!important}
  .nav button{justify-content:center!important;padding:14px 8px!important}
  .nav-icon{font-size:19px!important}
  .main{margin-left:76px!important;width:calc(100% - 76px)!important}
  .topbar{height:70px!important;padding:0 12px!important;gap:10px}
  .search{width:min(54vw,360px)!important}
  .search input{font-size:12px!important;padding:11px 8px 11px 32px!important}
  .search:before{left:10px!important;top:8px!important}
  .top-actions{gap:7px!important}
  .user-chip{gap:5px!important;font-size:11px!important}
  .user-chip .avatar{width:32px!important;height:32px!important}
  .page{padding:20px 13px 30px!important}
  .page-head{align-items:flex-start!important;flex-direction:column}
  .page-head h1{font-size:26px!important}
  .stats{grid-template-columns:1fr!important;gap:12px!important}
  .stat{min-height:110px;padding:19px!important}
  .card-body{padding:16px!important}
  .card-head{padding:16px!important}
  .toolbar input{min-width:100%;width:100%}
  .toolbar select{flex:1;min-width:0}
  .profile-grid{grid-template-columns:1fr!important}
  .profile-info{grid-template-columns:1fr!important}
  .welcome-card{padding:22px!important}
  .welcome-card h2{font-size:23px!important}
  .welcome-avatar{width:52px!important;height:52px!important;flex-shrink:0}
  table{min-width:620px}
  .card-body:has(table){overflow-x:auto}
  .modal{padding:22px!important;max-height:90vh;overflow-y:auto}
}
@media(prefers-reduced-motion:reduce){*,*::before,*::after{animation-duration:.01ms!important;transition-duration:.01ms!important;scroll-behavior:auto!important}}

</style>

<style id="large-interface-font-update">
/* Larger, easier-to-read interface */
html { font-size: 18px !important; }
body { font-size: 1rem !important; line-height: 1.65 !important; }
h1, .page-title, .section-title { font-size: clamp(2rem, 2.6vw, 2.7rem) !important; line-height: 1.2 !important; }
h2 { font-size: 1.65rem !important; line-height: 1.3 !important; }
h3 { font-size: 1.3rem !important; line-height: 1.35 !important; }
p, label, .description, .subtitle, .muted, small { font-size: 1rem !important; line-height: 1.6 !important; }
.sidebar, .sidebar a, .sidebar button, nav, nav a, .nav-link, .menu-item {
  font-size: 1.02rem !important;
}
button, .btn, input, select, textarea {
  font: inherit !important;
  min-height: 48px;
}
button, .btn { padding: 12px 18px !important; }
input, select, textarea { padding: 13px 15px !important; }
table { font-size: 1rem !important; }
th { font-size: .96rem !important; padding: 16px 18px !important; }
td { font-size: 1rem !important; padding: 16px 18px !important; line-height: 1.55 !important; }
.card, .stat-card, .glass-card, .panel, .content-card {
  padding: clamp(20px, 2vw, 30px) !important;
}
.stat-value, .stat-number, .metric-value, .number {
  font-size: clamp(2rem, 2.7vw, 2.8rem) !important;
  line-height: 1.15 !important;
}
.stat-label, .metric-label { font-size: 1rem !important; }
.sidebar { width: 285px; }
main, .main-content, .content, .dashboard-content { padding: clamp(24px, 3vw, 42px) !important; }
.modal, .modal-content, .dialog { max-width: min(900px, 94vw) !important; padding: 30px !important; }
.badge, .status, .tag, .pill { font-size: .9rem !important; padding: 6px 11px !important; }
@media (max-width: 900px) {
  html { font-size: 16px !important; }
  .sidebar { width: min(280px, 84vw); }
  main, .main-content, .content, .dashboard-content { padding: 20px !important; }
  th, td { padding: 12px 13px !important; }
}
</style>


<style id="final-design-refresh">
/* Modern, balanced Medical Archives admin interface */
:root{
  --green:#075c4d;
  --green-2:#0a745f;
  --green-3:#dff3ed;
  --mint:#f1faf7;
  --line:#dfebe6;
  --text:#153b33;
  --muted:#6f8981;
  --shadow:0 12px 32px rgba(17,76,63,.075);
}
html{font-size:16px!important;scroll-behavior:smooth}
body{
  font-family:Inter,"Segoe UI",Arial,sans-serif!important;
  font-size:14px!important;line-height:1.5!important;color:var(--text);
  background:radial-gradient(circle at 8% 0%,rgba(203,239,226,.55),transparent 26%),
             linear-gradient(135deg,#f3faf7 0%,#f8fbfa 58%,#edf7f3 100%)!important;
  background-attachment:fixed;
}
.app{min-height:100vh}
.sidebar{
  width:260px!important;padding:24px 15px!important;
  background:linear-gradient(160deg,#075c4d 0%,#064a3e 58%,#063d35 100%)!important;
  border-right:1px solid rgba(255,255,255,.12);
  box-shadow:7px 0 28px rgba(5,62,52,.12);
}
.brand{gap:12px!important;padding:5px 8px 28px!important;min-width:0}
.brand-mark{
  width:44px!important;height:44px!important;min-width:44px;border-radius:13px!important;
  padding:5px;background:#fff!important;display:grid;place-items:center;
  box-shadow:0 8px 20px rgba(0,0,0,.14);overflow:hidden;
}
.brand-mark img{display:block;width:100%;height:100%;object-fit:contain;border-radius:8px}
.brand-mark.logo-fallback::after{content:"+";font-size:28px;font-weight:800;line-height:1;color:var(--green)}
.brand h2{font-size:17px!important;letter-spacing:-.35px;line-height:1.15!important;margin:0 0 4px!important;white-space:nowrap}
.brand small{display:block;font-size:10px!important;line-height:1.35!important;color:rgba(255,255,255,.72)}
.nav-title{font-size:10px!important;letter-spacing:1.5px!important;margin:2px 10px 10px!important;color:#bfe5d9;opacity:.82}
.nav{gap:6px!important}
.nav button{
  width:100%;padding:12px 12px!important;min-height:44px;border-radius:11px!important;
  font-size:13px!important;font-weight:500;color:#e0f1ec!important;
  transition:background .2s ease,transform .2s ease,box-shadow .2s ease;
}
.nav button:hover{background:rgba(255,255,255,.11)!important;transform:translateX(2px)}
.nav button.active{background:rgba(255,255,255,.17)!important;color:#fff!important;box-shadow:inset 3px 0 #a9e7d3,0 5px 14px rgba(0,0,0,.08)}
.nav-icon{width:21px!important;font-size:16px!important}
.sidebar-bottom{padding-top:16px!important;border-color:rgba(255,255,255,.16)!important}
.admin-mini{gap:10px!important}
.avatar{width:38px!important;height:38px!important;font-size:12px!important;font-weight:800}
.admin-mini strong{font-size:12px!important}
.admin-mini span{font-size:10px!important;color:#d0e9e1}
.logout{min-height:42px;padding:10px!important;border:1px solid rgba(255,255,255,.13)!important;border-radius:10px!important;font-size:12px!important}
.main{margin-left:260px!important;width:calc(100% - 260px)!important;min-width:0}
.topbar{
  height:72px!important;padding:0 clamp(20px,3vw,42px)!important;gap:18px;
  background:rgba(255,255,255,.82)!important;border-bottom:1px solid rgba(220,235,229,.9)!important;
  box-shadow:0 4px 18px rgba(18,75,61,.035);backdrop-filter:blur(18px);-webkit-backdrop-filter:blur(18px);
}
.search{width:min(440px,50%)!important;max-width:100%;}
.search input{width:100%;min-height:43px!important;padding:10px 14px 10px 40px!important;border:1px solid #dcebe5!important;border-radius:12px!important;background:#f8fcfa!important;font-size:13px!important;box-shadow:none!important}
.search:before{top:8px!important;left:13px!important;font-size:20px!important}
.top-actions{gap:14px!important}
.icon-btn{width:38px;height:38px;border-radius:11px!important;transition:background .2s}
.icon-btn:hover{background:#eff8f4}
.user-chip{font-size:12px!important;gap:9px!important;white-space:nowrap}
.page{width:100%;max-width:1680px;margin:0 auto;padding:30px clamp(20px,3vw,42px) 42px!important}
.page-head{margin-bottom:22px!important;gap:16px}
.page-head h1{font-size:clamp(25px,2vw,32px)!important;line-height:1.2!important;letter-spacing:-.8px;margin:0 0 6px!important}
.page-head p{font-size:13px!important;line-height:1.5!important;color:var(--muted);margin:0!important}
.btn{min-height:40px!important;padding:10px 15px!important;border:1px solid transparent;border-radius:10px!important;font-size:12px!important;font-weight:700;box-shadow:0 5px 13px rgba(7,92,77,.10);transition:transform .2s,box-shadow .2s,background .2s}
.btn:hover{transform:translateY(-1px);box-shadow:0 8px 18px rgba(7,92,77,.14)}
.btn.light{box-shadow:none!important;background:#fff!important;border-color:var(--line)!important}
.grid{gap:17px!important}
.stats{grid-template-columns:repeat(4,minmax(0,1fr))!important;gap:16px!important}
.card{padding:0!important;background:rgba(255,255,255,.91)!important;border:1px solid rgba(221,236,229,.96)!important;border-radius:16px!important;box-shadow:var(--shadow)!important;overflow:hidden;transition:box-shadow .22s,border-color .22s,transform .22s}
.card:hover{box-shadow:0 16px 34px rgba(17,76,63,.105)!important;border-color:#cde5db!important}
.stat{padding:20px!important;min-height:118px;gap:12px}
.stat-label{font-size:12px!important;line-height:1.35!important;color:var(--muted);margin-bottom:8px!important}
.stat-value{font-size:clamp(27px,2.2vw,35px)!important;line-height:1.05!important;letter-spacing:-1px;font-weight:800!important;color:#143d34}
.stat-change,.stat-info{font-size:11px!important;line-height:1.4!important;margin-top:7px!important}
.stat-icon{width:45px!important;height:45px!important;min-width:45px;border-radius:13px!important;background:#e4f5ee!important;color:#08735e!important;font-size:12px!important}
.two-col{grid-template-columns:minmax(0,1.55fr) minmax(270px,1fr)!important;gap:17px!important;margin-top:19px!important}
.card-head{padding:17px 20px!important;background:linear-gradient(180deg,rgba(245,251,248,.8),rgba(255,255,255,.35))!important;border-bottom:1px solid #e7f0ec!important}
.card-head h3{font-size:14px!important;font-weight:750;letter-spacing:-.15px;margin:0}
.card-head a{font-size:12px!important;font-weight:700;color:#08735e!important;text-decoration:none}
.card-head a:hover{text-decoration:underline}
.card-body{padding:18px 20px!important}
table{width:100%;border-collapse:separate;border-spacing:0;font-size:12px!important;white-space:nowrap}
th{font-size:10px!important;text-transform:uppercase;letter-spacing:.45px;color:#718982!important;font-weight:750!important;padding:12px 11px!important;background:#f4faf7!important}
td{font-size:12px!important;padding:13px 11px!important;line-height:1.45!important;border-bottom:1px solid #edf3f0!important}
tbody tr:hover{background:#f6fbf8}
.badge{font-size:10px!important;padding:5px 9px!important;border-radius:7px!important;letter-spacing:.1px}
.quick{gap:9px!important}
.quick button{width:100%;padding:11px 12px!important;border:1px solid #e0ece7!important;border-radius:12px!important;background:#fff!important;font-size:12px!important;font-weight:600;min-height:55px;box-shadow:none;transition:transform .2s,border-color .2s,background .2s}
.quick button:hover{transform:translateY(-1px);border-color:#b9ddcf!important;background:#f7fcf9!important}
.quick button b{margin-left:auto;color:#77948a;font-size:19px;font-weight:500}
.qicon{width:34px!important;height:34px!important;min-width:34px;border-radius:10px!important;background:#e8f6f0!important;color:#08735e!important;font-size:11px!important}
.toolbar{gap:10px!important;margin-bottom:15px!important}
.toolbar input,.toolbar select,.form-control{min-height:42px!important;padding:10px 12px!important;border:1px solid #d9e9e2!important;border-radius:10px!important;background:#fff!important;font-size:13px!important}
.toolbar input{min-width:190px}
.history-toolbar{display:grid!important;grid-template-columns:minmax(230px,1.5fr) minmax(190px,1fr) minmax(170px,.8fr) minmax(170px,.8fr);align-items:center}
.history-toolbar input,.history-toolbar select{width:100%;min-width:0!important}
@media(max-width:1180px){.history-toolbar{grid-template-columns:repeat(2,minmax(0,1fr))}}
@media(max-width:760px){.history-toolbar{grid-template-columns:1fr}.history-toolbar input,.history-toolbar select{width:100%;min-width:0}}
.toolbar input:focus,.toolbar select:focus,.form-control:focus,.search input:focus{outline:none;border-color:#68b9a1!important;box-shadow:0 0 0 3px rgba(71,169,139,.13)!important}
.form-grid{gap:16px!important}
.form-group{gap:7px!important}
.form-group label{font-size:12px!important;font-weight:700;color:#35564e}
textarea.form-control{min-height:100px!important}
.form-actions{margin-top:20px!important}
.modal-wrap{backdrop-filter:blur(6px);-webkit-backdrop-filter:blur(6px)}
.modal{width:min(600px,100%)!important;max-height:90vh;overflow:auto;padding:26px!important;border-radius:17px!important;border:1px solid #e2eee8;box-shadow:0 25px 70px rgba(0,0,0,.18)!important}
.modal h2{font-size:21px!important;line-height:1.25!important}
.modal p{font-size:12px!important}
.toast{font-size:12px!important;border-radius:11px!important;padding:13px 17px!important}
.section.active{animation:sectionIn .22s ease both}
@keyframes sectionIn{from{opacity:0;transform:translateY(5px)}to{opacity:1;transform:translateY(0)}}
@media(max-width:1180px){
  .sidebar{width:235px!important}.main{margin-left:235px!important;width:calc(100% - 235px)!important}
  .stats{grid-template-columns:repeat(2,minmax(0,1fr))!important}
  .two-col{grid-template-columns:minmax(0,1fr)!important}
}
@media(max-width:760px){
  .sidebar{width:72px!important;padding:15px 8px!important}
  .brand{justify-content:center;padding:3px 0 24px!important;gap:0!important}
  .brand-mark{width:43px!important;height:43px!important;min-width:43px}
  .brand h2,.brand small,.nav-title,.nav button span:not(.nav-icon),.admin-mini>div:not(.avatar),.logout{display:none!important}
  .nav button{justify-content:center!important;padding:12px 6px!important}
  .nav-icon{width:auto!important;font-size:18px!important}
  .main{margin-left:72px!important;width:calc(100% - 72px)!important}
  .topbar{height:64px!important;padding:0 13px!important;gap:8px}
  .search{width:min(56vw,340px)!important}
  .search input{font-size:11px!important;padding:10px 7px 10px 30px!important}
  .search:before{left:9px!important;top:7px!important;font-size:17px!important}
  .top-actions{gap:4px!important}.user-chip{font-size:11px!important;gap:5px!important}
  .user-chip .avatar{width:31px!important;height:31px!important}
  .page{padding:22px 14px 30px!important}
  .page-head{align-items:flex-start!important;flex-direction:column}
  .page-head h1{font-size:25px!important}
  .stats{grid-template-columns:repeat(2,minmax(0,1fr))!important;gap:11px!important}
  .stat{padding:15px!important;min-height:105px;gap:8px}
  .stat-label{font-size:11px!important}.stat-value{font-size:27px!important}
  .stat-icon{width:36px!important;height:36px!important;min-width:36px;border-radius:10px!important}
  .card-head{padding:15px 14px!important}.card-body{padding:14px!important}
  .card-body:has(table){overflow-x:auto}
  table{min-width:590px}
  .toolbar input{min-width:100%;width:100%}.toolbar select{flex:1;min-width:0}
  .form-grid{grid-template-columns:1fr!important}.form-group.full{grid-column:auto}
  .modal{padding:20px!important}
}
@media(max-width:430px){
  .stats{grid-template-columns:1fr!important}
  .stat{min-height:92px}
  .top-actions .icon-btn{display:none}
}
@media(prefers-reduced-motion:reduce){*,*::before,*::after{animation-duration:.01ms!important;transition-duration:.01ms!important;scroll-behavior:auto!important}}

/* Static system banner for the dashboard. Replace the image path with your own banner. */
.system-banner{
  position:relative;
  isolation:isolate;
  min-height:190px;
  display:flex;
  align-items:center;
  overflow:hidden;
  margin:0 0 22px;
  padding:clamp(24px,3.2vw,38px);
  border-radius:19px;
  background:linear-gradient(115deg,#075c4d 0%,#087763 54%,#43a88d 100%);
  box-shadow:0 16px 34px rgba(7,92,77,.17);
  color:#fff;
}
.system-banner::before{
  content:"";
  position:absolute;
  z-index:-1;
  inset:0;
  background:linear-gradient(90deg,rgba(3,55,47,.92) 0%,rgba(4,82,68,.82) 48%,rgba(3,74,62,.22) 100%);
}
.system-banner-image{
  position:absolute;
  z-index:-2;
  inset:0;
  width:100%;
  height:100%;
  object-fit:cover;
  object-position:center 45%;
}
.system-banner.banner-fallback::after{
  content:"";
  position:absolute;
  z-index:-1;
  width:300px;
  height:300px;
  right:6%;
  top:-100px;
  border:1px solid rgba(255,255,255,.2);
  border-radius:50%;
  box-shadow:0 0 0 28px rgba(255,255,255,.045),0 0 0 58px rgba(255,255,255,.035),0 0 0 90px rgba(255,255,255,.025);
  pointer-events:none;
}
.system-banner-content{max-width:650px;position:relative;z-index:1}
.system-banner-kicker{
  display:inline-flex;
  align-items:center;
  gap:8px;
  margin:0 0 10px;
  color:#d8fff0;
  font-size:10px;
  font-weight:800;
  letter-spacing:1.6px;
  text-transform:uppercase;
}
.system-banner-kicker::before{content:"";width:22px;height:2px;border-radius:2px;background:#b7f2d8}
.system-banner h2{
  max-width:620px;
  margin:0 0 9px;
  color:#fff;
  font-size:clamp(25px,2.6vw,35px);
  font-weight:800;
  letter-spacing:-.9px;
  line-height:1.13;
}
.system-banner p{max-width:540px;margin:0;color:rgba(255,255,255,.85);font-size:13px;line-height:1.6}
.system-banner-tag{
  display:inline-flex;
  align-items:center;
  gap:7px;
  margin-top:17px;
  padding:7px 11px;
  border:1px solid rgba(255,255,255,.27);
  border-radius:999px;
  background:rgba(255,255,255,.12);
  color:#fff;
  font-size:10px;
  font-weight:700;
  backdrop-filter:blur(8px);
}
.system-banner-tag::before{content:"";width:7px;height:7px;border-radius:50%;background:#a8f2cc;box-shadow:0 0 0 3px rgba(168,242,204,.16)}
@media(max-width:760px){
  .system-banner{min-height:175px;margin-bottom:17px;padding:22px;border-radius:15px}
  .system-banner h2{font-size:24px;letter-spacing:-.5px}
  .system-banner p{font-size:12px;max-width:100%}
  .system-banner-tag{margin-top:12px}
}
</style>


<style id="readable-font-size-fix">
/* Improved readability: increase text sizing without breaking the layout. */
html { font-size: 16px !important; }
body { font-size: 16px !important; line-height: 1.55 !important; }
.brand h2 { font-size: 20px !important; line-height: 1.2 !important; }
.brand small { font-size: 12px !important; line-height: 1.4 !important; }
.brand-mark { flex-shrink: 0; }
.nav-title { font-size: 12px !important; letter-spacing: 1.35px !important; }
.nav button { font-size: 15px !important; line-height: 1.35 !important; padding-top: 13px !important; padding-bottom: 13px !important; }
.nav-icon { font-size: 18px !important; }
.admin-mini strong { font-size: 14px !important; }
.admin-mini span { font-size: 12px !important; }
.logout { font-size: 14px !important; }
.topbar { min-height: 76px !important; }
.search input { font-size: 15px !important; min-height: 46px !important; }
.search:before { top: 10px !important; }
.icon-btn { font-size: 22px !important; }
.user-chip { font-size: 15px !important; }
.page-head h1 { font-size: clamp(28px, 2.25vw, 35px) !important; line-height: 1.2 !important; }
.page-head p { font-size: 15px !important; line-height: 1.55 !important; }
.btn { font-size: 14px !important; min-height: 44px !important; padding: 11px 16px !important; }
.stat { padding: 22px !important; min-height: 128px !important; }
.stat-label { font-size: 15px !important; line-height: 1.4 !important; margin-bottom: 8px !important; }
.stat-value { font-size: clamp(31px, 2.4vw, 39px) !important; line-height: 1.08 !important; }
.stat-change, .stat-info { font-size: 13px !important; line-height: 1.45 !important; }
.stat-icon { width: 49px !important; height: 49px !important; min-width: 49px !important; font-size: 14px !important; }
.card-head { padding: 19px 21px !important; }
.card-head h3 { font-size: 17px !important; line-height: 1.4 !important; }
.card-head a { font-size: 14px !important; }
.card-body { padding: 20px 21px !important; }
table { font-size: 14px !important; }
th { font-size: 12px !important; line-height: 1.4 !important; padding: 14px 12px !important; letter-spacing: .35px !important; }
td { font-size: 14px !important; line-height: 1.5 !important; padding: 15px 12px !important; }
.badge { font-size: 12px !important; line-height: 1.25 !important; padding: 6px 10px !important; }
.quick { gap: 11px !important; }
.quick button { font-size: 14px !important; min-height: 60px !important; padding: 13px 14px !important; }
.qicon { width: 38px !important; height: 38px !important; min-width: 38px !important; font-size: 12px !important; }
.toolbar input, .toolbar select, .form-control { font-size: 15px !important; min-height: 46px !important; padding: 12px 14px !important; }
.form-group label { font-size: 14px !important; line-height: 1.4 !important; }
textarea.form-control { min-height: 115px !important; }
.modal h2 { font-size: 24px !important; }
.modal p { font-size: 14px !important; line-height: 1.55 !important; }
.toast { font-size: 14px !important; }
.system-banner { min-height: 205px !important; }
.system-banner-kicker { font-size: 12px !important; line-height: 1.5 !important; letter-spacing: 1.2px !important; }
.system-banner h2 { font-size: clamp(30px, 2.9vw, 40px) !important; line-height: 1.15 !important; }
.system-banner p { font-size: 16px !important; line-height: 1.6 !important; }
.system-banner-tag { font-size: 12px !important; padding: 8px 12px !important; }
@media (max-width: 1180px) {
  .nav button { font-size: 14px !important; }
  .stat-label { font-size: 14px !important; }
  .stat-value { font-size: 34px !important; }
  th { font-size: 12px !important; }
  td { font-size: 14px !important; }
}
@media (max-width: 760px) {
  .brand-mark { width: 43px !important; height: 43px !important; min-width: 43px !important; }
  .topbar { min-height: 66px !important; }
  .search input { font-size: 12px !important; min-height: 42px !important; }
  .search:before { top: 7px !important; }
  .user-chip { font-size: 12px !important; }
  .page-head h1 { font-size: 28px !important; }
  .page-head p { font-size: 14px !important; }
  .stat { padding: 16px !important; min-height: 110px !important; }
  .stat-label { font-size: 13px !important; }
  .stat-value { font-size: 30px !important; }
  .stat-change, .stat-info { font-size: 12px !important; }
  .card-head { padding: 16px !important; }
  .card-head h3 { font-size: 16px !important; }
  .card-body { padding: 16px !important; }
  .toolbar input, .toolbar select, .form-control { font-size: 14px !important; }
  .system-banner { min-height: 190px !important; padding: 24px !important; }
  .system-banner h2 { font-size: 27px !important; }
  .system-banner p { font-size: 14px !important; }
  .system-banner-kicker { font-size: 10px !important; letter-spacing: .8px !important; }
  .system-banner-tag { font-size: 11px !important; }
}
@media (max-width: 430px) {
  .stats { grid-template-columns: 1fr !important; }
  .stat { min-height: 100px !important; }
  .system-banner { padding: 20px !important; }
  .system-banner h2 { font-size: 25px !important; }
}
</style>


<style id="strong-readable-font-fix">
/* Stronger type sizing so the dashboard is visibly easier to read. */
html { font-size: 18px !important; }
body { font-size: 18px !important; line-height: 1.6 !important; }
.brand h2 { font-size: 22px !important; }
.brand small { font-size: 13px !important; }
.nav-title { font-size: 13px !important; }
.nav button { font-size: 17px !important; line-height: 1.4 !important; padding: 15px 14px !important; }
.nav-icon { font-size: 19px !important; }
.admin-mini strong { font-size: 16px !important; }
.admin-mini span { font-size: 13px !important; }
.logout { font-size: 16px !important; }
.topbar { min-height: 82px !important; }
.search input { font-size: 17px !important; min-height: 50px !important; }
.icon-btn { font-size: 24px !important; }
.user-chip { font-size: 16px !important; }
.page-head h1 { font-size: clamp(32px, 2.6vw, 42px) !important; line-height: 1.2 !important; }
.page-head p { font-size: 17px !important; }
.btn { font-size: 16px !important; min-height: 48px !important; padding: 12px 18px !important; }
.stat { padding: 24px !important; min-height: 140px !important; }
.stat-label { font-size: 17px !important; line-height: 1.4 !important; }
.stat-value { font-size: clamp(36px, 2.8vw, 46px) !important; }
.stat-change, .stat-info { font-size: 14px !important; }
.stat-icon { width: 54px !important; height: 54px !important; min-width: 54px !important; font-size: 16px !important; }
.card-head { padding: 22px 24px !important; }
.card-head h3 { font-size: 19px !important; }
.card-head a { font-size: 16px !important; }
.card-body { padding: 23px 24px !important; }
table { font-size: 16px !important; }
th { font-size: 14px !important; line-height: 1.45 !important; padding: 16px 14px !important; }
td { font-size: 16px !important; line-height: 1.55 !important; padding: 17px 14px !important; }
.badge { font-size: 13px !important; padding: 7px 11px !important; }
.quick button { font-size: 16px !important; min-height: 64px !important; }
.toolbar input, .toolbar select, .form-control { font-size: 17px !important; min-height: 50px !important; padding: 14px 16px !important; }
.form-group label { font-size: 16px !important; }
.modal h2 { font-size: 28px !important; line-height: 1.3 !important; }
.modal p { font-size: 16px !important; }
.toast { font-size: 16px !important; }
.system-banner { min-height: 225px !important; }
.system-banner-kicker { font-size: 14px !important; }
.system-banner h2 { font-size: clamp(34px, 3.2vw, 46px) !important; }
.system-banner p { font-size: 18px !important; }
.system-banner-tag { font-size: 14px !important; }
.record-editor .form-control:disabled { opacity: 1; color: #243f38; background: #edf6f2 !important; cursor: default; }
.record-editor [readonly] { opacity: 1; color: #243f38; background: #edf6f2 !important; }
[hidden] { display: none !important; }
@media (max-width: 900px) {
  html, body { font-size: 16px !important; }
  .nav button { font-size: 15px !important; }
  .page-head h1 { font-size: 30px !important; }
  .page-head p { font-size: 15px !important; }
  .stat-label { font-size: 15px !important; }
  .stat-value { font-size: 34px !important; }
  th { font-size: 13px !important; }
  td { font-size: 15px !important; }
  .system-banner h2 { font-size: 30px !important; }
  .system-banner p { font-size: 16px !important; }
}
@media (max-width: 720px) {
  .nav button { font-size: 14px !important; }
  .search input { font-size: 14px !important; }
  .page-head h1 { font-size: 27px !important; }
  .page-head p { font-size: 14px !important; }
  .stat-label { font-size: 14px !important; }
  .stat-value { font-size: 31px !important; }
  .card-head h3 { font-size: 16px !important; }
  .card-body { padding: 16px !important; }
  th { font-size: 12px !important; }
  td { font-size: 14px !important; padding: 13px 11px !important; }
  .toolbar input, .toolbar select, .form-control { font-size: 14px !important; }
  .modal h2 { font-size: 23px !important; }
}
</style>


<style id="functional-records-readability">
.record-editor .form-control:disabled,.record-editor [readonly]{opacity:1;color:#243f38;background:#edf6f2!important;cursor:default}
[hidden]{display:none!important}
.modal-wrap .modal{max-height:90vh;overflow:auto}
.modal-wrap .form-control{width:100%;min-width:0}
.modal-wrap .form-grid{align-items:start}
@media(max-width:720px){.modal-wrap{padding:12px}.modal-wrap .modal{padding:20px!important}.modal-wrap .form-grid{grid-template-columns:1fr!important}.modal-wrap .form-group.full{grid-column:auto!important}}
</style>


<style id="admin-profile-enhancement">
  .avatar-button {
    border: 0 !important;
    padding: 0 !important;
    cursor: pointer;
    font: inherit;
    flex: 0 0 auto;
    transition: transform .18s ease, box-shadow .18s ease;
  }
  .avatar-button:hover { transform: translateY(-1px); box-shadow: 0 0 0 4px rgba(185,243,223,.22); }
  .avatar-button:focus-visible, .admin-name-button:focus-visible {
    outline: 3px solid #91d8bf;
    outline-offset: 3px;
  }
  .admin-name-button {
    appearance: none;
    border: 0;
    padding: 5px 0;
    background: transparent;
    color: #16332d;
    font-size: inherit;
    font-weight: 800;
    cursor: pointer;
  }
  .admin-profile-grid { align-items: stretch; }
  #profile .profile-card {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 10px;
    min-height: 300px;
  }
  #profile .admin-profile-avatar {
    display: grid;
    place-items: center;
    background: linear-gradient(135deg,#075c4d,#0a806b);
    color: #fff;
    border: 5px solid #e1f4ed;
    box-shadow: 0 8px 24px rgba(7,92,77,.17);
    margin-bottom: 5px;
  }
  #profile .profile-card h2 { margin: 0; color: #173b33; text-align: center; }
  #profile .profile-card p { margin: 0 0 4px; color: #526d65; text-align: center; }
  .admin-profile-pill {
    margin: 2px 0 8px;
    display: inline-flex;
    align-items: center;
    border: 1px solid #c9e8da;
    border-radius: 999px;
    padding: 6px 12px;
    background: #edf9f3;
    color: #075c4d;
    font-size: 12px;
    font-weight: 700;
  }
  #profile .profile-details { min-width: 0; }
  #profile .profile-info { gap: 13px; }
  #profile .info-box { min-width: 0; background: #f9fcfa; }
  #profile .info-box strong { display: block; overflow-wrap: anywhere; }
  #adminProfileEditModal .form-group label { color: #274d42; }
  @media(max-width:760px) {
    #profile .profile-card { min-height: 250px; }
    #profile .profile-info { grid-template-columns: 1fr; }
    .user-chip { gap: 7px !important; }
  }
</style>


<style id="balanced-glass-ui-and-avatar-fix">
/* Balanced sizing for a normal 100% browser zoom */
:root {
  --green: #075c4d;
  --green-2: #0a745f;
  --green-3: #e1f4ed;
  --line: #d8e8e1;
  --text: #173b33;
  --muted: #607a72;
  --shadow: 0 10px 28px rgba(7, 74, 61, .08);
}
html { font-size: 16px !important; scroll-behavior: smooth; }
body {
  font-size: 14px !important;
  line-height: 1.5 !important;
  background:
    radial-gradient(ellipse at 10% 0%, rgba(149, 218, 194, .22), transparent 34%),
    radial-gradient(ellipse at 100% 15%, rgba(173, 218, 207, .20), transparent 32%),
    linear-gradient(135deg, #eef7f3 0%, #f7faf9 55%, #edf6f2 100%) !important;
  background-attachment: fixed;
}
button, input, select, textarea { font-family: inherit !important; }

/* Keep the application comfortably sized on a typical desktop screen. */
body .sidebar {
  width: 246px !important;
  padding: 22px 14px !important;
  background: linear-gradient(160deg, rgba(7, 92, 77, .97), rgba(4, 61, 52, .98)) !important;
  box-shadow: 8px 0 28px rgba(4, 57, 48, .12) !important;
  border-right: 1px solid rgba(255,255,255,.18) !important;
}
body .brand { padding: 4px 7px 26px !important; gap: 11px !important; }
body .brand h2 { font-size: 17px !important; line-height: 1.2 !important; }
body .brand small { font-size: 10px !important; line-height: 1.4 !important; }
body .nav-title { font-size: 10px !important; letter-spacing: 1.2px !important; margin: 3px 10px 10px !important; }
body .nav { gap: 6px !important; }
body .nav button {
  min-height: 42px !important;
  padding: 10px 12px !important;
  border-radius: 10px !important;
  font-size: 13px !important;
  line-height: 1.35 !important;
}
body .nav-icon { font-size: 16px !important; }
body .main { margin-left: 246px !important; width: calc(100% - 246px) !important; min-width: 0 !important; padding: 0 !important; }
body .topbar {
  height: 68px !important;
  min-height: 68px !important;
  padding: 0 28px !important;
  gap: 16px !important;
  background: rgba(255,255,255,.76) !important;
  border-bottom: 1px solid rgba(209, 230, 220, .85) !important;
  box-shadow: 0 6px 22px rgba(8, 76, 61, .055) !important;
  backdrop-filter: blur(18px) saturate(135%) !important;
  -webkit-backdrop-filter: blur(18px) saturate(135%) !important;
}
body .search { width: min(420px, 48%) !important; }
body .search input {
  width: 100% !important;
  min-height: 40px !important;
  padding: 9px 13px 9px 38px !important;
  border: 1px solid rgba(188, 215, 204, .85) !important;
  border-radius: 11px !important;
  background: rgba(255,255,255,.82) !important;
  font-size: 13px !important;
  box-shadow: inset 0 1px 2px rgba(9, 72, 58, .025) !important;
}
body .search:before { top: 7px !important; left: 12px !important; font-size: 19px !important; }
body .top-actions, body .user-chip { display: flex !important; align-items: center !important; gap: 10px !important; }
body .user-chip { font-size: 13px !important; white-space: nowrap; }

/* Fix the avatar buttons: force a true circle despite global button sizing rules. */
body button.avatar-button,
body .avatar.avatar-button,
#topbarAdminAvatar,
#sidebarAdminAvatar {
  display: inline-grid !important;
  place-items: center !important;
  box-sizing: border-box !important;
  width: 40px !important;
  height: 40px !important;
  min-width: 40px !important;
  max-width: 40px !important;
  min-height: 40px !important;
  max-height: 40px !important;
  flex: 0 0 40px !important;
  aspect-ratio: 1 / 1 !important;
  padding: 0 !important;
  margin: 0 !important;
  border-radius: 50% !important;
  line-height: 1 !important;
  text-align: center !important;
  font-size: 12px !important;
  font-weight: 800 !important;
  overflow: hidden !important;
  vertical-align: middle !important;
  background: linear-gradient(145deg, #e4f7ef, #cbeadd) !important;
  color: #075c4d !important;
  border: 2px solid rgba(255,255,255,.92) !important;
  box-shadow: 0 3px 10px rgba(5, 72, 58, .13) !important;
}
body button.avatar-button:hover {
  transform: translateY(-1px) !important;
  box-shadow: 0 0 0 4px rgba(96, 188, 157, .18), 0 7px 15px rgba(5, 72, 58, .15) !important;
}
body .admin-mini { align-items: center !important; gap: 9px !important; }
body .admin-mini strong { font-size: 12px !important; line-height: 1.35 !important; }
body .admin-mini span { font-size: 10px !important; line-height: 1.35 !important; }
body .admin-name-button { font-size: 13px !important; line-height: 1.3 !important; font-weight: 700 !important; }

/* Clearer, layered glass surfaces without making text hard to read. */
body .page {
  width: 100% !important;
  max-width: 1600px !important;
  margin: 0 auto !important;
  padding: 26px clamp(20px, 2.4vw, 34px) 38px !important;
}
body .page-head { margin-bottom: 20px !important; gap: 14px !important; }
body .page-head h1 { font-size: clamp(25px, 2vw, 31px) !important; line-height: 1.2 !important; letter-spacing: -.55px !important; margin: 0 0 5px !important; }
body .page-head p { font-size: 13px !important; line-height: 1.5 !important; margin: 0 !important; color: var(--muted) !important; }
body .grid { gap: 16px !important; }
body .stats { gap: 14px !important; }
body .card,
body .profile-card,
body .profile-details {
  background: linear-gradient(145deg, rgba(255,255,255,.88), rgba(247,253,250,.78)) !important;
  border: 1px solid rgba(255,255,255,.92) !important;
  outline: 1px solid rgba(193, 222, 209, .45);
  border-radius: 16px !important;
  box-shadow: 0 10px 28px rgba(8, 73, 59, .075), inset 0 1px 0 rgba(255,255,255,.85) !important;
  backdrop-filter: blur(16px) saturate(125%) !important;
  -webkit-backdrop-filter: blur(16px) saturate(125%) !important;
  transition: box-shadow .2s ease, transform .2s ease, border-color .2s ease !important;
}
body .card:hover {
  box-shadow: 0 15px 32px rgba(8, 73, 59, .105), inset 0 1px 0 rgba(255,255,255,.9) !important;
  border-color: rgba(167, 215, 196, .8) !important;
}
body .stat { padding: 19px !important; min-height: 112px !important; gap: 12px !important; }
body .stat-label { font-size: 12px !important; line-height: 1.4 !important; margin-bottom: 6px !important; }
body .stat-value { font-size: clamp(27px, 2.1vw, 34px) !important; line-height: 1.12 !important; }
body .stat-change, body .stat-info { font-size: 11px !important; line-height: 1.4 !important; }
body .stat-icon { width: 44px !important; height: 44px !important; min-width: 44px !important; border-radius: 13px !important; }
body .two-col { gap: 16px !important; margin-top: 18px !important; }
body .card-head { padding: 16px 19px !important; background: rgba(237, 248, 243, .7) !important; border-bottom: 1px solid rgba(209, 229, 219, .8) !important; }
body .card-head h3 { font-size: 15px !important; line-height: 1.4 !important; }
body .card-head a { font-size: 12px !important; }
body .card-body { padding: 18px 19px !important; }
body .page table { width: 100% !important; font-size: 12px !important; line-height: 1.45 !important; white-space: nowrap !important; }
body .page th { padding: 11px 10px !important; font-size: 10px !important; line-height: 1.4 !important; letter-spacing: .35px !important; }
body .page td { padding: 12px 10px !important; font-size: 12px !important; line-height: 1.45 !important; }
body .badge { font-size: 10px !important; padding: 4px 8px !important; border-radius: 7px !important; }
body .btn { min-height: 38px !important; padding: 9px 14px !important; font-size: 12px !important; line-height: 1.35 !important; border-radius: 9px !important; }
body .toolbar { gap: 9px !important; margin-bottom: 13px !important; }
body .toolbar input, body .toolbar select, body .form-control {
  min-height: 40px !important;
  padding: 9px 11px !important;
  font-size: 13px !important;
  border-radius: 9px !important;
  border: 1px solid rgba(183, 213, 200, .88) !important;
  background: rgba(255,255,255,.86) !important;
}
body .form-group { gap: 6px !important; }
body .form-group label { font-size: 12px !important; line-height: 1.4 !important; }
body .modal { width: min(560px, 94vw) !important; max-height: 88vh !important; padding: 24px !important; border-radius: 17px !important; background: rgba(250,255,252,.94) !important; border: 1px solid rgba(255,255,255,.95) !important; box-shadow: 0 22px 60px rgba(4, 49, 41, .23) !important; backdrop-filter: blur(22px) saturate(130%) !important; }
body .modal h2 { font-size: 21px !important; line-height: 1.3 !important; }
body .modal p { font-size: 12px !important; line-height: 1.5 !important; }
body .toast { font-size: 12px !important; padding: 12px 16px !important; border-radius: 10px !important; }
body .system-banner {
  min-height: 190px !important;
  padding: 28px clamp(22px, 2.5vw, 34px) !important;
  border: 1px solid rgba(255,255,255,.38) !important;
  box-shadow: 0 15px 34px rgba(4, 73, 60, .17), inset 0 1px 0 rgba(255,255,255,.22) !important;
}
body .system-banner h2 { font-size: clamp(27px, 2.35vw, 36px) !important; line-height: 1.16 !important; }
body .system-banner p { font-size: 13px !important; line-height: 1.55 !important; }
body .system-banner-kicker { font-size: 10px !important; }

/* The large profile image must remain perfectly circular. */
#profile .admin-profile-avatar {
  box-sizing: border-box !important;
  width: 96px !important;
  height: 96px !important;
  min-width: 96px !important;
  min-height: 96px !important;
  max-width: 96px !important;
  max-height: 96px !important;
  flex: 0 0 96px !important;
  aspect-ratio: 1 / 1 !important;
  border-radius: 50% !important;
  padding: 0 !important;
  line-height: 1 !important;
  overflow: hidden !important;
}
#profile .profile-card { padding: 24px !important; min-height: 270px !important; gap: 9px !important; }
#profile .profile-details { padding: 24px !important; }
#profile .profile-details h3 { font-size: 16px !important; margin-bottom: 15px !important; }
#profile .info-box { padding: 13px !important; background: rgba(255,255,255,.72) !important; }
#profile .info-box label { font-size: 11px !important; }
#profile .info-box strong { font-size: 13px !important; }

@media (max-width: 1120px) {
  body .sidebar { width: 225px !important; }
  body .main { margin-left: 225px !important; width: calc(100% - 225px) !important; }
  body .stats { grid-template-columns: repeat(2, minmax(0, 1fr)) !important; }
  body .two-col { grid-template-columns: minmax(0, 1fr) !important; }
}
@media (max-width: 760px) {
  body .sidebar { width: 70px !important; padding: 14px 7px !important; }
  body .brand { justify-content: center !important; padding: 4px 0 22px !important; }
  body .brand h2, body .brand small, body .nav-title, body .nav button span:not(.nav-icon), body .admin-mini > div:not(.avatar), body .logout { display: none !important; }
  body .brand-mark { width: 42px !important; height: 42px !important; min-width: 42px !important; }
  body .nav button { justify-content: center !important; padding: 11px 5px !important; }
  body .nav-icon { width: auto !important; font-size: 17px !important; }
  body .main { margin-left: 70px !important; width: calc(100% - 70px) !important; }
  body .topbar { height: 62px !important; min-height: 62px !important; padding: 0 12px !important; gap: 8px !important; }
  body .search { width: min(56vw, 330px) !important; }
  body .search input { min-height: 37px !important; font-size: 11px !important; padding: 8px 8px 8px 29px !important; }
  body .search:before { left: 9px !important; top: 6px !important; font-size: 16px !important; }
  body .user-chip { gap: 6px !important; }
  body button.avatar-button, body .avatar.avatar-button, #topbarAdminAvatar, #sidebarAdminAvatar { width: 35px !important; height: 35px !important; min-width: 35px !important; min-height: 35px !important; max-width: 35px !important; max-height: 35px !important; flex-basis: 35px !important; }
  body .admin-name-button { font-size: 11px !important; }
  body .page { padding: 20px 14px 28px !important; }
  body .page-head h1 { font-size: 25px !important; }
  body .stats { grid-template-columns: repeat(2, minmax(0, 1fr)) !important; gap: 10px !important; }
  body .stat { min-height: 96px !important; padding: 14px !important; }
  body .stat-value { font-size: 26px !important; }
  body .card-head { padding: 14px !important; }
  body .card-body { padding: 14px !important; }
  body .page .card-body:has(table) { overflow-x: auto !important; }
  body .page table { min-width: 560px; }
  body .toolbar input { min-width: 100% !important; width: 100% !important; }
  body .toolbar select { flex: 1; min-width: 0 !important; }
  body .form-grid { grid-template-columns: 1fr !important; }
  body .form-group.full { grid-column: auto !important; }
  body .modal { padding: 20px !important; }
  #profile .profile-grid { grid-template-columns: 1fr !important; }
  #profile .profile-card { min-height: 235px !important; }
}
@media (max-width: 430px) {
  body .stats { grid-template-columns: 1fr !important; }
  body .system-banner { min-height: 175px !important; padding: 20px !important; }
  body .system-banner h2 { font-size: 25px !important; }
}
@media (prefers-reduced-motion: reduce) {
  *, *::before, *::after { animation-duration: .01ms !important; transition-duration: .01ms !important; scroll-behavior: auto !important; }
}
</style>


<style id="hamburger-navbar-layout">
/* Hamburger drawer navigation: keeps the dashboard content full-width at 100% zoom. */
html { scrollbar-gutter: stable; }
body.sidebar-menu-open { overflow: hidden; }
body .sidebar {
  position: fixed !important;
  inset: 0 auto 0 0 !important;
  width: 285px !important;
  height: 100vh !important;
  height: 100dvh !important;
  max-height: 100vh !important;
  max-height: 100dvh !important;
  overflow-x: hidden !important;
  overflow-y: auto !important;
  overscroll-behavior: contain;
  transform: translateX(-105%) !important;
  visibility: hidden !important;
  transition: transform .26s ease, visibility .26s ease !important;
  z-index: 60 !important;
  padding: 22px 14px !important;
  box-shadow: 14px 0 38px rgba(4, 57, 48, .19) !important;
}
body .app.sidebar-open .sidebar {
  transform: translateX(0) !important;
  visibility: visible !important;
}
body .sidebar .brand { justify-content: flex-start !important; gap: 11px !important; padding: 4px 7px 26px !important; }
body .sidebar .brand h2 { display: block !important; font-size: 17px !important; line-height: 1.2 !important; white-space: nowrap; }
body .sidebar .brand small { display: block !important; font-size: 10px !important; line-height: 1.4 !important; }
body .sidebar .nav-title { display: block !important; font-size: 10px !important; margin: 3px 10px 10px !important; }
body .sidebar .nav { display: flex !important; gap: 6px !important; }
body .sidebar .nav button {
  display: flex !important;
  justify-content: flex-start !important;
  width: 100% !important;
  min-height: 43px !important;
  padding: 10px 12px !important;
  font-size: 13px !important;
  line-height: 1.35 !important;
}
body .sidebar .nav button span:not(.nav-icon) { display: inline !important; }
body .sidebar .nav-icon { width: 21px !important; min-width: 21px !important; font-size: 16px !important; }
body .sidebar .sidebar-bottom { display: block !important; margin-top: auto !important; }
body .sidebar .admin-mini { display: flex !important; align-items: center !important; gap: 9px !important; }
body .sidebar .admin-mini > div { display: block !important; min-width: 0; }
body .sidebar .admin-mini strong { display: block !important; font-size: 12px !important; }
body .sidebar .admin-mini span { display: block !important; font-size: 10px !important; }
body .sidebar .logout { display: block !important; width: 100% !important; min-height: 42px !important; margin-top: 10px !important; }
body .main { margin-left: 0 !important; width: 100% !important; min-width: 0 !important; padding: 0 !important; }
body .topbar {
  position: sticky !important;
  top: 0 !important;
  z-index: 10 !important;
  display: flex !important;
  justify-content: flex-start !important;
  gap: 15px !important;
  padding: 0 clamp(16px, 2.5vw, 34px) !important;
}
.hamburger-toggle {
  appearance: none !important;
  -webkit-appearance: none !important;
  width: 42px !important;
  height: 42px !important;
  min-width: 42px !important;
  max-width: 42px !important;
  min-height: 42px !important;
  max-height: 42px !important;
  flex: 0 0 42px !important;
  display: inline-flex !important;
  flex-direction: column !important;
  align-items: center !important;
  justify-content: center !important;
  gap: 5px !important;
  padding: 0 !important;
  margin: 0 !important;
  border: 1px solid #dcebe5 !important;
  border-radius: 12px !important;
  background: rgba(255,255,255,.88) !important;
  color: #075c4d !important;
  box-shadow: 0 3px 10px rgba(7,92,77,.05) !important;
  cursor: pointer !important;
  transition: background .18s ease, border-color .18s ease, box-shadow .18s ease !important;
}
.hamburger-toggle:hover, .hamburger-toggle[aria-expanded="true"] {
  background: #e8f6f0 !important;
  border-color: #acd8c8 !important;
  box-shadow: 0 5px 14px rgba(7,92,77,.10) !important;
}
.hamburger-toggle:focus-visible { outline: 3px solid rgba(42,145,111,.35) !important; outline-offset: 3px !important; }
.hamburger-toggle span { display: block !important; width: 18px !important; height: 2px !important; min-height: 0 !important; border-radius: 2px !important; background: #075c4d !important; transition: transform .2s ease, opacity .2s ease !important; }
.hamburger-toggle[aria-expanded="true"] span:first-child { transform: translateY(7px) rotate(45deg); }
.hamburger-toggle[aria-expanded="true"] span:nth-child(2) { opacity: 0; }
.hamburger-toggle[aria-expanded="true"] span:last-child { transform: translateY(-7px) rotate(-45deg); }
body .search { flex: 1 1 360px !important; width: auto !important; max-width: 480px !important; min-width: 0 !important; }
body .top-actions { margin-left: auto !important; flex: 0 0 auto !important; }
.sidebar-backdrop {
  display: none !important;
  position: fixed !important;
  inset: 0 !important;
  z-index: 50 !important;
  width: 100% !important;
  height: 100% !important;
  min-height: 0 !important;
  max-width: none !important;
  margin: 0 !important;
  padding: 0 !important;
  border: 0 !important;
  border-radius: 0 !important;
  background: rgba(7, 34, 29, .42) !important;
  backdrop-filter: blur(3px) !important;
  -webkit-backdrop-filter: blur(3px) !important;
  cursor: pointer !important;
}
body .app.sidebar-open .sidebar-backdrop { display: block !important; }
@media (max-width: 760px) {
  body .sidebar { width: min(285px, 86vw) !important; padding: 18px 12px !important; }
  body .topbar { min-height: 62px !important; height: 62px !important; gap: 10px !important; padding: 0 12px !important; }
  .hamburger-toggle { width: 40px !important; height: 40px !important; min-width: 40px !important; max-width: 40px !important; min-height: 40px !important; max-height: 40px !important; flex-basis: 40px !important; }
  body .search { flex: 1 1 auto !important; width: auto !important; max-width: none !important; }
  body .search input { min-width: 0 !important; width: 100% !important; }
  body .top-actions { gap: 5px !important; }
  body .user-chip { gap: 5px !important; }
  body .admin-name-button { max-width: 95px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
}
@media (max-width: 430px) {
  body .topbar { gap: 8px !important; padding: 0 9px !important; }
  .hamburger-toggle { width: 38px !important; height: 38px !important; min-width: 38px !important; max-width: 38px !important; min-height: 38px !important; max-height: 38px !important; flex-basis: 38px !important; }
  body .search input { font-size: 11px !important; }
  body .admin-name-button { display: none !important; }
}
@media (prefers-reduced-motion: reduce) {
  body .sidebar, .hamburger-toggle, .hamburger-toggle span { transition-duration: .01ms !important; }
}
</style>

</head>
<body>
<div class="app">
  <aside class="sidebar" id="adminSidebar" aria-label="Admin navigation">
    <div class="brand">
      <div class="brand-mark" aria-label="Medical Archives logo">
        <img src="LOGO- Medical ARCHIEVES.png" alt="Medical Archives logo" onerror="this.remove(); this.parentElement.classList.add('logo-fallback');">
      </div>
      <div><h2>Medical Archives</h2><small>Digital Prescription Records</small></div>
    </div>
    <div class="nav-title">Admin Menu</div>
    <nav class="nav">
      <button class="active" data-page="dashboard"><span class="nav-icon">▦</span><span>Dashboard</span></button>
      <button data-page="prescriptions"><span class="nav-icon">▤</span><span>Add Prescription</span></button>
      <button data-page="patients"><span class="nav-icon">♙</span><span>Patient Records</span></button>
      <button data-page="medicines"><span class="nav-icon">▥</span><span>Drug / Medicine Records</span></button>
      <button data-page="history"><span class="nav-icon">◷</span><span>Medication History</span></button>
      <button data-page="logs"><span class="nav-icon">≡</span><span>Activity Logs</span></button>
      <button data-page="accounts"><span class="nav-icon">♙</span><span>Manage Accounts</span></button>
    </nav>
    <div class="sidebar-bottom">
      <div class="admin-mini">
        <button type="button" class="avatar avatar-button" id="sidebarAdminAvatar" aria-label="Open admin profile" title="Open admin profile" onclick="openAdminProfile()">AD</button>
        <div><strong id="sidebarAdminName">Admin</strong><span id="sidebarAdminPosition">System Administrator</span></div>
      </div>
      <button class="logout" onclick="window.location.href='../logout.php'">Logout</button>
    </div>
  </aside>
  <button type="button" class="sidebar-backdrop" id="sidebarBackdrop" aria-label="Close navigation menu" tabindex="-1" onclick="closeSidebar()"></button>

  <main class="main">
    <header class="topbar">
      <button type="button" class="hamburger-toggle" id="sidebarToggle" aria-label="Open navigation menu" aria-controls="adminSidebar" aria-expanded="false" onclick="toggleSidebar()">
        <span></span><span></span><span></span>
      </button>
      <div class="search"><input id="globalSearch" placeholder="Search records..." oninput="globalSearch()"></div>
      <div class="top-actions">
        <div class="user-chip">
          <button type="button" class="avatar avatar-button" id="topbarAdminAvatar" aria-label="Open admin profile" title="Open admin profile" onclick="openAdminProfile()">AD</button>
          <button type="button" class="admin-name-button" id="topbarAdminName" onclick="openAdminProfile()">Admin</button>
        </div>
      </div>
    </header>

    <div class="page">
      <!-- DASHBOARD -->
      <section id="dashboard" class="section active">
        <div class="page-head">
          <div><h1>Dashboard</h1><p>Overview of system records and activities</p></div>
        </div>
        <section class="system-banner banner-fallback" aria-label="Medical Archives system banner">
          <!-- Replace this image path with your preferred system banner image. -->
          <img class="system-banner-image" src="Banner.jpg" alt="" aria-hidden="true" onerror="this.style.display='none';this.parentElement.classList.add('banner-fallback');">
          <div class="system-banner-content">
            <div class="system-banner-kicker">Medical Archives • Digital Prescription Records</div>
            <h2>Smarter Records.<br>Safer Medication.</h2>
            <p>Keep prescription records organized and make patient and medicine information easier to manage.</p>
            <span class="system-banner-tag">Secure digital record management</span>
          </div>
        </section>
        <div class="grid stats">
          <div class="card stat"><div><div class="stat-label">Total Prescriptions</div><div class="stat-value">0</div><div class="stat-change">Records currently stored</div></div><div class="stat-icon">Rx</div></div>
          <div class="card stat"><div><div class="stat-label">Total Patients</div><div class="stat-value">0</div><div class="stat-change">Records currently stored</div></div><div class="stat-icon">PT</div></div>
          <div class="card stat"><div><div class="stat-label">Total Medicines</div><div class="stat-value">0</div><div class="stat-change">Records currently stored</div></div><div class="stat-icon">MD</div></div>
          <div class="card stat"><div><div class="stat-label">Activity Logs</div><div class="stat-value">0</div><div class="stat-change">Actions recorded</div></div><div class="stat-icon">AC</div></div>
        </div>
        <div class="grid two-col">
          <div class="card">
            <div class="card-head"><h3>Recent Prescriptions</h3><a onclick="openPage('history')">View All</a></div>
            <div class="card-body"><table><thead><tr><th>ID</th><th>Patient</th><th>Medicine</th><th>Date</th><th>Status</th></tr></thead>
            <tbody id="recentPrescriptionTable">
              <tr><td>RX-0001</td><td>Juan Dela Cruz</td><td>Amoxicillin 500mg</td><td>2025-09-17</td><td><span class="badge green">Dispensed</span></td></tr>
              <tr><td>RX-0002</td><td>Maria Santos</td><td>Paracetamol 500mg</td><td>2025-09-16</td><td><span class="badge yellow">For Review</span></td></tr>
              <tr><td>RX-0003</td><td>Pedro Reyes</td><td>Ibuprofen 400mg</td><td>2025-09-15</td><td><span class="badge yellow">Pending</span></td></tr>
              <tr><td>RX-0004</td><td>Ana Lopez</td><td>Cetirizine 10mg</td><td>2025-09-14</td><td><span class="badge green">Dispensed</span></td></tr>
            </tbody></table></div>
          </div>
          <div class="card">
            <div class="card-head"><h3>Quick Actions</h3></div>
            <div class="card-body quick">
              <button onclick="openPage('prescriptions')"><span class="qicon">Rx</span>Add Prescription <b>›</b></button>
              <button onclick="openPatientModal()"><span class="qicon">PT</span>Add Patient <b>›</b></button>
              <button onclick="openMedicineModal()"><span class="qicon">MD</span>Add Medicine <b>›</b></button>
              <button onclick="openPage('history')"><span class="qicon">MH</span>View Medication History <b>›</b></button>
            </div>
          </div>
        </div>
      </section>

      <!-- PATIENTS -->
      <section id="patients" class="section">
        <div class="page-head"><div><h1>Patient Records</h1><p>Manage patient information and records</p></div><button class="btn" onclick="openPatientModal()">+ Add Patient</button></div>
        <div class="card"><div class="card-body">
          <div class="toolbar"><input id="patientSearch" placeholder="Search patient..." oninput="applyPatientFilters()"><select id="patientGenderFilter" onchange="applyPatientFilters()"><option value="All">All</option><option>Male</option><option>Female</option><option>Other</option></select></div>
          <table id="patientTable"><thead><tr><th>ID</th><th>Name</th><th>Age</th><th>Gender</th><th>Contact</th><th>Allergies</th><th>Prescriptions</th><th>Action</th></tr></thead>
          <tbody>
            <tr><td>PT-0001</td><td>Juan Dela Cruz</td><td>25</td><td>Male</td><td>09123456789</td><td>None</td><td class="patient-rx-count">0</td><td><button class="btn light" onclick="openPatientEditor(this)">View/Edit</button> <button class="btn light" onclick="openPatientMedicationProfileByRow(this)">Medicines</button></td></tr>
            <tr><td>PT-0002</td><td>Maria Santos</td><td>32</td><td>Female</td><td>09129876543</td><td>Penicillin</td><td class="patient-rx-count">0</td><td><button class="btn light" onclick="openPatientEditor(this)">View/Edit</button> <button class="btn light" onclick="openPatientMedicationProfileByRow(this)">Medicines</button></td></tr>
            <tr><td>PT-0003</td><td>Pedro Reyes</td><td>41</td><td>Male</td><td>09124567190</td><td>None</td><td class="patient-rx-count">0</td><td><button class="btn light" onclick="openPatientEditor(this)">View/Edit</button> <button class="btn light" onclick="openPatientMedicationProfileByRow(this)">Medicines</button></td></tr>
            <tr><td>PT-0004</td><td>Ana Lopez</td><td>28</td><td>Female</td><td>09137654321</td><td>Dust</td><td class="patient-rx-count">0</td><td><button class="btn light" onclick="openPatientEditor(this)">View/Edit</button> <button class="btn light" onclick="openPatientMedicationProfileByRow(this)">Medicines</button></td></tr>
            <tr><td>PT-0005</td><td>Carlo Mendoza</td><td>36</td><td>Male</td><td>09124321098</td><td>None</td><td class="patient-rx-count">0</td><td><button class="btn light" onclick="openPatientEditor(this)">View/Edit</button> <button class="btn light" onclick="openPatientMedicationProfileByRow(this)">Medicines</button></td></tr>
          </tbody></table>
        </div></div>
      </section>

      <!-- PRESCRIPTION -->
      <section id="prescriptions" class="section">
        <div class="page-head"><div><h1>Add Prescription</h1><p>Create a new prescription record</p></div></div>
        <div class="card"><div class="card-body">
          <form id="prescriptionForm" onsubmit="savePrescription(event)">
            <div class="form-grid">
              <div class="form-group"><label>Patient</label><select class="form-control" id="rxCustomer" required><option value="">Select patient</option></select></div>
              <div class="form-group"><label>Medicine</label><select class="form-control" id="rxMedicine" required><option value="">Select medicine</option></select></div>
              <div class="form-group"><label>Doctor</label><select class="form-control" id="rxDoctor" required><option value="">Select doctor</option></select></div>
              <div class="form-group"><label>Dosage</label><input class="form-control" id="rxDosage" placeholder="e.g. 500mg" required></div>
              <div class="form-group"><label>Quantity</label><input class="form-control" id="rxQuantity" type="number" min="1" placeholder="e.g. 10" required></div>
              <div class="form-group"><label>Status</label><select class="form-control" id="rxStatus"><option value="pending">Pending</option><option value="flagged">For Review</option><option value="dispensed">Dispensed</option><option value="validated">Validated</option></select></div>
              <div class="form-group"><label>Date</label><input class="form-control" id="rxDate" type="date" required></div>
              <div class="form-group full"><label>Instructions</label><textarea class="form-control" id="rxInstructions" placeholder="Enter prescription instructions..."></textarea></div>
            </div>
            <div class="form-actions"><button type="button" class="btn light" onclick="document.getElementById('prescriptionForm').reset()">Cancel</button><button class="btn">Save Prescription</button></div>
          </form>
        </div></div>
      </section>

      <!-- MEDICINES -->
      <section id="medicines" class="section">
        <div class="page-head"><div><h1>Drug / Medicine Records</h1><p>Manage available medicines and inventory</p></div><button class="btn" onclick="openMedicineModal()">+ Add Medicine</button></div>
        <div class="card"><div class="card-body">
          <div class="toolbar"><input id="medicineSearch" placeholder="Search medicine..." oninput="applyMedicineFilters()"><select id="medicineCategoryFilter" onchange="applyMedicineFilters()"><option value="All Categories">All Categories</option><option>Antibiotic</option><option>Analgesic</option><option>Antihistamine</option><option>Antacid</option><option>Other</option></select></div>
          <table id="medicineTable"><thead><tr><th>ID</th><th>Name</th><th>Category</th><th>Dosage</th><th>Stock</th><th>Expiry</th><th>Supplier</th><th>Action</th></tr></thead>
          <tbody>
            <tr><td>MED-0001</td><td>Amoxicillin</td><td>Antibiotic</td><td>500mg</td><td>120</td><td>2026-06-12</td><td>PharmaCo</td><td><button class="btn light" onclick="openMedicineEditor(this)">View / Edit</button></td></tr>
            <tr><td>MED-0002</td><td>Paracetamol</td><td>Analgesic</td><td>500mg</td><td>200</td><td>2027-11-20</td><td>HealthPlus</td><td><button class="btn light" onclick="openMedicineEditor(this)">View / Edit</button></td></tr>
            <tr><td>MED-0003</td><td>Cetirizine</td><td>Antihistamine</td><td>10mg</td><td>80</td><td>2026-08-15</td><td>MedSupply</td><td><button class="btn light" onclick="openMedicineEditor(this)">View / Edit</button></td></tr>
            <tr><td>MED-0004</td><td>Omeprazole</td><td>Antacid</td><td>20mg</td><td>60</td><td>2026-12-10</td><td>CarePharma</td><td><button class="btn light" onclick="openMedicineEditor(this)">View / Edit</button></td></tr>
          </tbody></table>
        </div></div>
      </section>

      <!-- HISTORY -->
      <section id="history" class="section">
        <div class="page-head"><div><h1>Medication History</h1><p>View patient medication and prescription history</p></div></div>
        <div class="card"><div class="card-body">
          <div class="toolbar history-toolbar">
            <input id="historySearch" type="search" placeholder="Search patient, medicine, or instructions..." aria-label="Search patient, medicine, or instructions" oninput="applyHistoryFilters()">
            <select id="historyPatientFilter" aria-label="Filter by patient" onchange="applyHistoryFilters()"><option value="All Patients">All Patients</option></select>
            <input id="historyDateFilter" type="date" aria-label="History date" title="History Date" onchange="applyHistoryFilters()">
            <select id="historyStatusFilter" aria-label="Filter by status" onchange="applyHistoryFilters()"><option value="All Status">All Status</option><option>Dispensed</option><option>Pending</option><option>For Review</option></select>
          </div>
          <table id="historyTable"><thead><tr><th>Date</th><th>Patient</th><th>Medicine</th><th>Dosage</th><th>Quantity</th><th>Status</th><th>Instructions</th></tr></thead>
          <tbody>
            <tr><td>2025-09-17</td><td>Juan Dela Cruz</td><td>Amoxicillin 500mg</td><td>500mg</td><td>1</td><td><span class="badge green">Dispensed</span></td></tr>
            <tr><td>2025-09-16</td><td>Maria Santos</td><td>Paracetamol 500mg</td><td>500mg</td><td>1</td><td><span class="badge yellow">For Review</span></td></tr>
            <tr><td>2025-09-15</td><td>Pedro Reyes</td><td>Ibuprofen 400mg</td><td>400mg</td><td>1</td><td><span class="badge yellow">Pending</span></td></tr>
            <tr><td>2025-09-14</td><td>Ana Lopez</td><td>Cetirizine 10mg</td><td>10mg</td><td>1</td><td><span class="badge green">Dispensed</span></td></tr>
            <tr><td>2025-09-13</td><td>Carlo Mendoza</td><td>Omeprazole 20mg</td><td>20mg</td><td>1</td><td><span class="badge yellow">Pending</span></td></tr>
          </tbody></table>
        </div></div>
      </section>

      <!-- LOGS -->
      <section id="logs" class="section">
        <div class="page-head"><div><h1>Activity Logs</h1><p>Monitor system activities and user actions</p></div></div>
        <div class="card"><div class="card-body">
          <div class="toolbar"><input id="logsSearch" placeholder="Search logs..." oninput="applyLogFilters()"><select id="logsActionFilter" onchange="applyLogFilters()"><option value="All Actions">All Actions</option><option>Added Prescription</option><option>Added Patient</option><option>Updated Patient</option><option>Added Medicine</option><option>Updated Medicine</option><option>Created Account</option><option>Updated Account</option><option>Updated Admin Profile</option><option>Viewed History</option><option>Logged In</option></select></div>
          <table id="logsTable"><thead><tr><th>Date & Time</th><th>User</th><th>Action</th><th>Details</th></tr></thead>
          <tbody>
            <tr><td>2025-09-17 10:32</td><td>admin</td><td>Added Prescription</td><td>RX-0001 for Juan Dela Cruz</td></tr>
            <tr><td>2025-09-17 09:14</td><td>admin</td><td>Added Patient</td><td>Maria Santos</td></tr>
            <tr><td>2025-09-16 16:45</td><td>admin</td><td>Updated Medicine</td><td>Paracetamol stock</td></tr>
            <tr><td>2025-09-16 14:30</td><td>admin</td><td>Viewed History</td><td>Juan Dela Cruz</td></tr>
            <tr><td>2025-09-15 11:20</td><td>admin</td><td>Logged In</td><td>Admin account</td></tr>
          </tbody></table>
        </div></div>
      </section>

      <!-- ACCOUNTS -->
      <section id="accounts" class="section">
        <div class="page-head"><div><h1>Manage Customer Accounts</h1><p>View and manage registered customer accounts</p></div><button class="btn" onclick="openAccountModal()">+ Add Account</button></div>
        <div class="card"><div class="card-body">
          <div class="toolbar"><input id="accountSearch" placeholder="Search user..." oninput="applyAccountFilters()"><select id="accountRoleFilter" onchange="applyAccountFilters()"><option value="All Roles">All Roles</option><option>Customer</option><option>Admin</option></select></div>
          <table id="accountsTable"><thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Status</th><th>Action</th></tr></thead>
          <tbody>
            <tr><td>CUS-0001</td><td>Juan Dela Cruz</td><td>juan@email.com</td><td>Customer</td><td><span class="badge green">Active</span></td><td><button class="btn light" onclick="openAccountEditor(this)">View / Edit</button></td></tr>
            <tr><td>CUS-0002</td><td>Maria Santos</td><td>maria@email.com</td><td>Customer</td><td><span class="badge green">Active</span></td><td><button class="btn light" onclick="openAccountEditor(this)">View / Edit</button></td></tr>
            <tr><td>CUS-0003</td><td>Pedro Reyes</td><td>pedro@email.com</td><td>Customer</td><td><span class="badge green">Active</span></td><td><button class="btn light" onclick="openAccountEditor(this)">View / Edit</button></td></tr>
            <tr><td>CUS-0004</td><td>Ana Lopez</td><td>ana@email.com</td><td>Customer</td><td><span class="badge red">Inactive</span></td><td><button class="btn light" onclick="openAccountEditor(this)">View / Edit</button></td></tr>
          </tbody></table>
        </div></div>
      </section>

      <!-- ADMIN PROFILE: opened by clicking the avatar in the header or sidebar -->
      <section id="profile" class="section">
        <div class="page-head">
          <div><h1>Admin Profile</h1><p>View and update your administrator account information.</p></div>
          <button class="btn" type="button" onclick="openAdminProfileEditor()">Edit Profile</button>
        </div>
        <div class="profile-grid admin-profile-grid">
          <div class="profile-card card">
            <div class="profile-avatar admin-profile-avatar" id="adminProfileAvatar">AD</div>
            <h2 id="adminProfileDisplayName">Admin</h2>
            <p id="adminProfileDisplayPosition">System Administrator</p>
            <div class="admin-profile-pill">Administrator Account</div>
            <button class="btn light" type="button" onclick="openAdminProfileEditor()">Edit Profile Details</button>
          </div>
          <div class="profile-details card">
            <h3>Profile Information</h3>
            <div class="profile-info">
              <div class="info-box"><label>Full Name</label><strong id="adminProfileInfoName">Admin</strong></div>
              <div class="info-box"><label>Username</label><strong id="adminProfileInfoUsername">admin</strong></div>
              <div class="info-box"><label>Email Address</label><strong id="adminProfileInfoEmail">Not provided</strong></div>
              <div class="info-box"><label>Contact Number</label><strong id="adminProfileInfoPhone">Not provided</strong></div>
              <div class="info-box"><label>Position</label><strong id="adminProfileInfoPosition">System Administrator</strong></div>
              <div class="info-box"><label>Account Type</label><strong>Administrator</strong></div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>
</div>

<!-- Patient Modal -->
<div id="patientModal" class="modal-wrap">
  <div class="modal"><h2>Add Patient</h2><p>Create a new patient record.</p>
    <form id="patientForm" onsubmit="savePatient(event)">
      <div class="form-grid">
        <div class="form-group"><label>Full Name</label><input class="form-control" required></div>
        <div class="form-group"><label>Age</label><input class="form-control" type="number" required></div>
        <div class="form-group"><label>Gender</label><select class="form-control"><option>Male</option><option>Female</option></select></div>
        <div class="form-group"><label>Contact</label><input class="form-control" required></div>
        <div class="form-group full"><label>Allergies</label><input class="form-control" placeholder="None if no known allergies"></div>
      </div>
      <div class="form-actions"><button type="button" class="btn light" onclick="closeModal('patientModal')">Cancel</button><button class="btn">Save Patient</button></div>
    </form>
  </div>
</div>


<!-- View / Edit Patient Modal -->
<div id="patientEditModal" class="modal-wrap" aria-hidden="true">
  <div class="modal record-editor" role="dialog" aria-modal="true" aria-labelledby="patientEditTitle">
    <h2 id="patientEditTitle">Patient Details</h2>
    <p>Review this patient record. Select Edit Details to make changes.</p>
    <form id="patientEditForm" onsubmit="savePatientEdit(event)">
      <div class="form-grid">
        <div class="form-group"><label for="editPatientId">Patient ID</label><input id="editPatientId" class="form-control" readonly></div>
        <div class="form-group"><label for="editPatientName">Full Name</label><input id="editPatientName" class="form-control" required disabled></div>
        <div class="form-group"><label for="editPatientAge">Age</label><input id="editPatientAge" class="form-control" type="number" min="1" max="120" required disabled></div>
        <div class="form-group"><label for="editPatientGender">Gender</label><select id="editPatientGender" class="form-control" disabled><option>Male</option><option>Female</option><option>Other</option></select></div>
        <div class="form-group"><label for="editPatientContact">Contact</label><input id="editPatientContact" class="form-control" required disabled></div>
        <div class="form-group"><label for="editPatientAllergies">Allergies</label><input id="editPatientAllergies" class="form-control" disabled></div>
      </div>
      <div class="form-actions">
        <button type="button" class="btn light" onclick="closeModal('patientEditModal')">Close</button>
        <button type="button" class="btn" id="patientEditToggle" onclick="enablePatientEditing()">Edit Details</button>
        <button type="submit" class="btn" id="patientSaveChanges" hidden>Save Changes</button>
      </div>
    </form>
  </div>
</div>

<!-- Medicine Modal -->
<div id="medicineModal" class="modal-wrap">
  <div class="modal"><h2>Add Medicine</h2><p>Add a medicine to the drug inventory.</p>
    <form id="medicineForm" onsubmit="saveMedicine(event)">
      <div class="form-grid">
        <div class="form-group"><label>Medicine Name</label><input class="form-control" required></div>
        <div class="form-group"><label>Category</label><select class="form-control"><option>Antibiotic</option><option>Analgesic</option><option>Antihistamine</option><option>Antacid</option></select></div>
        <div class="form-group"><label>Dosage</label><input class="form-control" placeholder="e.g. 500mg" required></div>
        <div class="form-group"><label>Stock</label><input class="form-control" type="number" min="0" required></div>
        <div class="form-group"><label>Expiry Date</label><input class="form-control" type="date"></div>
        <div class="form-group"><label>Supplier</label><input class="form-control"></div>
      </div>
      <div class="form-actions"><button type="button" class="btn light" onclick="closeModal('medicineModal')">Cancel</button><button class="btn">Save Medicine</button></div>
    </form>
  </div>
</div>

<!-- View / Edit Medicine Modal -->
<div id="medicineEditModal" class="modal-wrap" aria-hidden="true">
  <div class="modal record-editor" role="dialog" aria-modal="true" aria-labelledby="medicineEditTitle">
    <h2 id="medicineEditTitle">Medicine Details</h2>
    <p>Review the medicine record. Select Edit Details to make changes.</p>
    <form id="medicineEditForm" onsubmit="saveMedicineEdit(event)">
      <div class="form-grid">
        <div class="form-group"><label for="editMedicineId">Medicine ID</label><input id="editMedicineId" class="form-control" readonly></div>
        <div class="form-group"><label for="editMedicineName">Medicine Name</label><input id="editMedicineName" class="form-control" required disabled></div>
        <div class="form-group"><label for="editMedicineCategory">Category</label><select id="editMedicineCategory" class="form-control" disabled><option>Antibiotic</option><option>Analgesic</option><option>Antihistamine</option><option>Antacid</option><option>Other</option></select></div>
        <div class="form-group"><label for="editMedicineDosage">Dosage</label><input id="editMedicineDosage" class="form-control" required disabled></div>
        <div class="form-group"><label for="editMedicineStock">Stock</label><input id="editMedicineStock" class="form-control" type="number" min="0" required disabled></div>
        <div class="form-group"><label for="editMedicineExpiry">Expiry Date</label><input id="editMedicineExpiry" class="form-control" type="date" disabled></div>
        <div class="form-group full"><label for="editMedicineSupplier">Supplier</label><input id="editMedicineSupplier" class="form-control" disabled></div>
      </div>
      <div class="form-actions">
        <button type="button" class="btn light" onclick="closeModal('medicineEditModal')">Close</button>
        <button type="button" class="btn" id="medicineEditToggle" onclick="enableMedicineEditing()">Edit Details</button>
        <button type="submit" class="btn" id="medicineSaveChanges" hidden>Save Changes</button>
      </div>
    </form>
  </div>
</div>

<!-- View / Edit Customer Account Modal -->
<div id="accountEditModal" class="modal-wrap" aria-hidden="true">
  <div class="modal record-editor" role="dialog" aria-modal="true" aria-labelledby="accountEditTitle">
    <h2 id="accountEditTitle">Customer Account Details</h2>
    <p>Review this account and select Edit Details to update its information.</p>
    <form id="accountEditForm" onsubmit="saveAccountEdit(event)">
      <div class="form-grid">
        <div class="form-group"><label for="editAccountId">Account ID</label><input id="editAccountId" class="form-control" readonly></div>
        <div class="form-group"><label for="editAccountName">Full Name</label><input id="editAccountName" class="form-control" required disabled></div>
        <div class="form-group"><label for="editAccountEmail">Email Address</label><input id="editAccountEmail" class="form-control" type="email" required disabled></div>
        <div class="form-group"><label for="editAccountRole">Role</label><select id="editAccountRole" class="form-control" disabled><option>Customer</option><option>Admin</option></select></div>
        <div class="form-group"><label for="editAccountStatus">Account Status</label><select id="editAccountStatus" class="form-control" disabled><option>Active</option><option>Inactive</option></select></div>
      </div>
      <div class="form-actions">
        <button type="button" class="btn light" onclick="closeModal('accountEditModal')">Close</button>
        <button type="button" class="btn" id="accountEditToggle" onclick="enableAccountEditing()">Edit Details</button>
        <button type="submit" class="btn" id="accountSaveChanges" hidden>Save Changes</button>
      </div>
    </form>
  </div>
</div>

<!-- Account Modal -->
<div id="accountModal" class="modal-wrap">
  <div class="modal"><h2>Add Account</h2><p>Create a customer account.</p>
    <form id="accountForm" onsubmit="saveAccount(event)">
      <div class="form-grid">
        <div class="form-group"><label>Full Name</label><input class="form-control" required></div>
        <div class="form-group"><label>Email</label><input class="form-control" type="email" required></div>
        <div class="form-group"><label>Role</label><select class="form-control"><option>Customer</option><option>Admin</option></select></div>
        <div class="form-group"><label>Status</label><select class="form-control"><option>Active</option><option>Inactive</option></select></div>
      </div>
      <div class="form-actions"><button type="button" class="btn light" onclick="closeModal('accountModal')">Cancel</button><button class="btn">Create Account</button></div>
    </form>
  </div>
</div>


<!-- Edit Admin Profile Modal -->
<div id="adminProfileEditModal" class="modal-wrap" aria-hidden="true">
  <div class="modal" role="dialog" aria-modal="true" aria-labelledby="adminProfileEditTitle">
    <h2 id="adminProfileEditTitle">Edit Admin Profile</h2>
    <p>Update the administrator information shown on your dashboard.</p>
    <form id="adminProfileEditForm" onsubmit="saveAdminProfile(event)">
      <div class="form-grid">
        <div class="form-group"><label for="adminProfileEditName">Full Name</label><input id="adminProfileEditName" class="form-control" autocomplete="name" required maxlength="100"></div>
        <div class="form-group"><label for="adminProfileEditUsername">Username</label><input id="adminProfileEditUsername" class="form-control" autocomplete="username" required maxlength="60"></div>
        <div class="form-group"><label for="adminProfileEditEmail">Email Address</label><input id="adminProfileEditEmail" class="form-control" type="email" autocomplete="email" maxlength="150" placeholder="admin@example.com"></div>
        <div class="form-group"><label for="adminProfileEditPhone">Contact Number</label><input id="adminProfileEditPhone" class="form-control" type="tel" autocomplete="tel" maxlength="30" placeholder="Enter contact number"></div>
        <div class="form-group full"><label for="adminProfileEditPosition">Position</label><input id="adminProfileEditPosition" class="form-control" maxlength="100" placeholder="System Administrator" required></div>
      </div>
      <div class="form-actions">
        <button type="button" class="btn light" onclick="closeModal('adminProfileEditModal')">Cancel</button>
        <button type="submit" class="btn">Save Profile</button>
      </div>
    </form>
  </div>
</div>

<div id="toast" class="toast"></div>

<script>
const navButtons = document.querySelectorAll('.nav button');
const sections = document.querySelectorAll('.section');
const TABLE_STORAGE_KEY = 'medicalArchivesDashboardTables_v1';
const STATS_STORAGE_KEY = 'medicalArchivesDashboardStats_v1';
const ADMIN_PROFILE_STORAGE_KEY = 'medicalArchivesAdminProfile_v1';
let activePatientRow = null;
let activeMedicineRow = null;
let activeAccountRow = null;

function openPage(page) {
  sections.forEach(section => section.classList.remove('active'));
  const target = document.getElementById(page);
  if (target) target.classList.add('active');
  navButtons.forEach(button => button.classList.toggle('active', button.dataset.page === page));
  window.scrollTo({ top: 0, behavior: 'smooth' });
}
navButtons.forEach(button => button.addEventListener('click', () => openPage(button.dataset.page)));

function showToast(message) {
  const toast = document.getElementById('toast');
  toast.textContent = message;
  toast.classList.add('show');
  clearTimeout(window.toastTimer);
  window.toastTimer = setTimeout(() => toast.classList.remove('show'), 2800);
}
function openModal(id) {
  const modal = document.getElementById(id);
  if (!modal) return;
  modal.classList.add('show');
  modal.setAttribute('aria-hidden', 'false');
}
function closeModal(id) {
  const modal = document.getElementById(id);
  if (!modal) return;
  modal.classList.remove('show');
  modal.setAttribute('aria-hidden', 'true');
}
// Logout clears only the current session; saved demo records remain in this browser.
const ADMIN_LOGIN_PAGE = 'login.php';
function logoutAdmin() {
  if (!window.confirm('Are you sure you want to log out?')) return;
  ['currentAdmin', 'ma_admin_session', 'adminSession', 'adminLoggedIn'].forEach(key => {
    localStorage.removeItem(key);
    sessionStorage.removeItem(key);
  });
  window.location.href = ADMIN_LOGIN_PAGE;
}
function openPatientModal() { document.getElementById('patientForm').reset(); openModal('patientModal'); }
function openMedicineModal() { document.getElementById('medicineForm').reset(); openModal('medicineModal'); }
function openAccountModal() { document.getElementById('accountForm').reset(); openModal('accountModal'); }

function safeParseJSON(value, fallback = null) {
  try { return value ? JSON.parse(value) : fallback; } catch (_) { return fallback; }
}
function getCurrentAdminObject() {
  const value = safeParseJSON(localStorage.getItem('currentAdmin'), {});
  return value && typeof value === 'object' ? value : {};
}
function getAdminProfileData() {
  const current = getCurrentAdminObject();
  const stored = safeParseJSON(localStorage.getItem(ADMIN_PROFILE_STORAGE_KEY), {});
  const sameUser = !stored.username || !current.username || String(stored.username).toLowerCase() === String(current.username).toLowerCase();
  const saved = sameUser ? stored : {};
  const rawName = saved.fullName || current.fullName || current.name || current.displayName || current.username || 'Admin';
  const fallbackName = String(rawName).toLowerCase() === 'admin' ? 'Admin' : String(rawName);
  return {
    fullName: fallbackName,
    username: saved.username || current.username || current.userName || 'admin',
    email: saved.email || current.email || current.emailAddress || '',
    phone: saved.phone || current.phone || current.contactNumber || current.contact || '',
    position: saved.position || current.position || 'System Administrator'
  };
}
function initialsFromName(name) {
  const parts = String(name || 'Admin').trim().split(/\s+/).filter(Boolean);
  if (!parts.length) return 'AD';
  return parts.length === 1 ? parts[0].slice(0, 2).toUpperCase() : (parts[0][0] + parts[parts.length - 1][0]).toUpperCase();
}
function renderAdminProfile() {
  const profile = getAdminProfileData();
  const initials = initialsFromName(profile.fullName);
  const name = profile.fullName || 'Admin';
  const setText = (id, value) => { const element = document.getElementById(id); if (element) element.textContent = value || 'Not provided'; };
  setText('topbarAdminName', name);
  setText('sidebarAdminName', name);
  setText('sidebarAdminPosition', profile.position || 'System Administrator');
  setText('adminProfileDisplayName', name);
  setText('adminProfileDisplayPosition', profile.position || 'System Administrator');
  setText('adminProfileInfoName', name);
  setText('adminProfileInfoUsername', profile.username || 'admin');
  setText('adminProfileInfoEmail', profile.email || 'Not provided');
  setText('adminProfileInfoPhone', profile.phone || 'Not provided');
  setText('adminProfileInfoPosition', profile.position || 'System Administrator');
  ['topbarAdminAvatar', 'sidebarAdminAvatar', 'adminProfileAvatar'].forEach(id => {
    const element = document.getElementById(id);
    if (element) element.textContent = initials;
  });
  return profile;
}
function initializeAdminProfile() {
  renderAdminProfile();
}
function openAdminProfile() {
  renderAdminProfile();
  openPage('profile');
}
function openAdminProfileEditor() {
  const profile = renderAdminProfile();
  document.getElementById('adminProfileEditName').value = profile.fullName || '';
  document.getElementById('adminProfileEditUsername').value = profile.username || '';
  document.getElementById('adminProfileEditEmail').value = profile.email || '';
  document.getElementById('adminProfileEditPhone').value = profile.phone || '';
  document.getElementById('adminProfileEditPosition').value = profile.position || 'System Administrator';
  openModal('adminProfileEditModal');
}
function saveAdminProfile(event) {
  event.preventDefault();
  const oldProfile = getAdminProfileData();
  const profile = {
    fullName: document.getElementById('adminProfileEditName').value.trim(),
    username: document.getElementById('adminProfileEditUsername').value.trim(),
    email: document.getElementById('adminProfileEditEmail').value.trim(),
    phone: document.getElementById('adminProfileEditPhone').value.trim(),
    position: document.getElementById('adminProfileEditPosition').value.trim()
  };
  if (!profile.fullName || !profile.username || !profile.position) {
    showToast('Full name, username, and position are required.');
    return;
  }
  if (profile.email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(profile.email)) {
    showToast('Please enter a valid email address.');
    return;
  }

  const current = getCurrentAdminObject();
  current.fullName = profile.fullName;
  current.name = profile.fullName;
  current.username = profile.username;
  current.email = profile.email;
  current.phone = profile.phone;
  current.contactNumber = profile.phone;
  current.position = profile.position;
  if (!current.role) current.role = 'Admin';
  try {
    localStorage.setItem('currentAdmin', JSON.stringify(current));
    localStorage.setItem(ADMIN_PROFILE_STORAGE_KEY, JSON.stringify(profile));
    syncAdminProfileWithAccountList(oldProfile, profile);
  } catch (error) {
    console.warn('Could not save admin profile in browser storage.', error);
    showToast('Profile could not be saved. Browser storage may be unavailable.');
    return;
  }
  renderAdminProfile();
  closeModal('adminProfileEditModal');
  logActivity('Updated Admin Profile', `${oldProfile.fullName || 'Admin'} updated administrator profile details.`);
  showToast('Admin profile updated successfully.');
}
function syncAdminProfileWithAccountList(oldProfile, profile) {
  const accounts = safeParseJSON(localStorage.getItem('adminAccounts'), null);
  if (!Array.isArray(accounts)) return;
  let changed = false;
  const oldUsername = String(oldProfile.username || '').toLowerCase();
  const oldEmail = String(oldProfile.email || '').toLowerCase();
  accounts.forEach(account => {
    if (!account || typeof account !== 'object') return;
    const username = String(account.username || account.userName || '').toLowerCase();
    const email = String(account.email || account.emailAddress || '').toLowerCase();
    const matches = (oldUsername && username === oldUsername) || (oldEmail && email === oldEmail);
    if (!matches) return;
    account.fullName = profile.fullName;
    account.name = profile.fullName;
    account.username = profile.username;
    account.email = profile.email;
    account.phone = profile.phone;
    account.contactNumber = profile.phone;
    account.position = profile.position;
    changed = true;
  });
  if (changed) localStorage.setItem('adminAccounts', JSON.stringify(accounts));
}

document.querySelectorAll('.modal-wrap').forEach(modal => modal.addEventListener('click', event => {
  if (event.target === modal) closeModal(modal.id);
}));
document.addEventListener('keydown', event => {
  if (event.key === 'Escape') document.querySelectorAll('.modal-wrap.show').forEach(modal => closeModal(modal.id));
});

function escapeHTML(value) {
  return String(value ?? '').replace(/[&<>"']/g, char => ({ '&':'&amp;', '<':'&lt;', '>':'&gt;', '"':'&quot;', "'":'&#39;' }[char]));
}
function cellText(row, index) { return row?.cells?.[index]?.innerText.trim() || ''; }
function getTableBody(tableId) {
  const element = document.getElementById(tableId);
  if (!element) return null;
  return element.tagName === 'TBODY' ? element : element.querySelector('tbody');
}
function nextRecordId(tableId, prefix) {
  let max = 0;
  const body = getTableBody(tableId);
  body?.querySelectorAll('tr').forEach(row => {
    const match = cellText(row, 0).match(/(\d+)$/);
    if (match) max = Math.max(max, Number(match[1]));
  });
  return prefix + String(max + 1).padStart(4, '0');
}
function countTableRecords(tableId) {
  const body = getTableBody(tableId);
  return body ? body.querySelectorAll('tr').length : 0;
}

// Dashboard totals always reflect the current records displayed in their tables.
// This also refreshes totals after restoring saved records from localStorage.
function updateStatsStorage() {
  const stats = {
    prescriptions: countTableRecords('recentPrescriptionTable'),
    patients: countTableRecords('patientTable'),
    medicines: countTableRecords('medicineTable'),
    logs: countTableRecords('logsTable')
  };
  const elements = document.querySelectorAll('#dashboard .stats .stat-value');
  const values = [stats.prescriptions, stats.patients, stats.medicines, stats.logs];
  elements.forEach((element, index) => {
    if (values[index] !== undefined) element.textContent = values[index].toLocaleString();
  });
  try { localStorage.setItem(STATS_STORAGE_KEY, JSON.stringify(stats)); } catch (_) {}
  return stats;
}

// Kept for existing save handlers; recompute from records instead of incrementing
// a separate counter that could drift out of sync with the actual tables.
function changeStat(_name, _delta = 1) {
  return updateStatsStorage();
}

/* Persist every visible table, including sample records and newly added records. */
function persistDashboardTables() {
  const ids = ['patientTable', 'medicineTable', 'accountsTable', 'historyTable', 'logsTable', 'recentPrescriptionTable'];
  const saved = {};
  ids.forEach(id => {
    const body = getTableBody(id);
    if (body) saved[id] = body.innerHTML;
  });
  try { localStorage.setItem(TABLE_STORAGE_KEY, JSON.stringify(saved)); }
  catch (error) { console.warn('Dashboard records could not be saved in this browser.', error); showToast('Could not save all records. Browser storage may be full.'); }
  updateStatsStorage();
}
function restoreDashboardTables() {
  try {
    const saved = JSON.parse(localStorage.getItem(TABLE_STORAGE_KEY) || 'null');
    if (saved && typeof saved === 'object') {
      Object.entries(saved).forEach(([id, markup]) => {
        const body = getTableBody(id);
        if (body && typeof markup === 'string') body.innerHTML = markup;
      });
    } else {
      persistDashboardTables();
    }
    // Migrate records saved by older versions that did not have an Instructions cell.
    let historySchemaMigrated = false;
    document.querySelectorAll('#historyTable tbody tr').forEach(row => {
      if (row.cells.length < 7) {
        const instructionsCell = row.insertCell(-1);
        instructionsCell.textContent = '—';
        historySchemaMigrated = true;
      }
    });
    if (historySchemaMigrated) persistDashboardTables();
    updateStatsStorage();
  } catch (error) { console.warn('Saved dashboard records could not be restored.', error); }
}
function logActivity(action, details) {
  const body = document.querySelector('#logsTable tbody');
  if (!body) return;
  const currentAdmin = (() => { try { return JSON.parse(localStorage.getItem('currentAdmin') || 'null') || {}; } catch (_) { return {}; } })();
  const user = currentAdmin.username || currentAdmin.fullName || 'admin';
  const date = new Date();
  const timestamp = `${date.getFullYear()}-${String(date.getMonth()+1).padStart(2,'0')}-${String(date.getDate()).padStart(2,'0')} ${String(date.getHours()).padStart(2,'0')}:${String(date.getMinutes()).padStart(2,'0')}`;
  body.insertAdjacentHTML('afterbegin', `<tr><td>${timestamp}</td><td>${escapeHTML(user)}</td><td>${escapeHTML(action)}</td><td>${escapeHTML(details)}</td></tr>`);
  changeStat('logs', 1);
  persistDashboardTables();
}
function makeBadge(status) {
  const cls = status === 'Active' || status === 'Dispensed' ? 'green' : (status === 'Inactive' ? 'red' : (status === 'Pending' || status === 'For Review' ? 'yellow' : 'gray'));
  return `<span class="badge ${cls}">${escapeHTML(status)}</span>`;
}

function filterTable(tableId, term) {
  const query = String(term || '').toLowerCase();
  document.querySelectorAll(`#${tableId} tbody tr`).forEach(row => {
    row.style.display = row.innerText.toLowerCase().includes(query) ? '' : 'none';
  });
}

function applyPatientFilters() {
  const query = document.getElementById('patientSearch')?.value.trim().toLowerCase() || '';
  const gender = document.getElementById('patientGenderFilter')?.value || 'All';
  document.querySelectorAll('#patientTable tbody tr').forEach(row => {
    row.style.display = row.innerText.toLowerCase().includes(query) && (gender === 'All' || cellText(row,3) === gender) ? '' : 'none';
  });
}
function applyMedicineFilters() {
  const query = document.getElementById('medicineSearch')?.value.trim().toLowerCase() || '';
  const category = document.getElementById('medicineCategoryFilter')?.value || 'All Categories';
  document.querySelectorAll('#medicineTable tbody tr').forEach(row => {
    row.style.display = row.innerText.toLowerCase().includes(query) && (category === 'All Categories' || cellText(row,2) === category) ? '' : 'none';
  });
}
function applyAccountFilters() {
  const query = document.getElementById('accountSearch')?.value.trim().toLowerCase() || '';
  const role = document.getElementById('accountRoleFilter')?.value || 'All Roles';
  document.querySelectorAll('#accountsTable tbody tr').forEach(row => {
    row.style.display = row.innerText.toLowerCase().includes(query) && (role === 'All Roles' || cellText(row,3) === role) ? '' : 'none';
  });
}
function applyLogFilters() {
  const query = document.getElementById('logsSearch')?.value.trim().toLowerCase() || '';
  const action = document.getElementById('logsActionFilter')?.value || 'All Actions';
  document.querySelectorAll('#logsTable tbody tr').forEach(row => {
    row.style.display = row.innerText.toLowerCase().includes(query) && (action === 'All Actions' || cellText(row,2) === action) ? '' : 'none';
  });
}

function renderPatientPrescriptionCounts() {
  const patientRows = document.querySelectorAll('#patientTable tbody tr');
  patientRows.forEach(row => {
    const name = cellText(row, 1).trim();
    let countCell = row.querySelector('.patient-rx-count');
    // Migrate saved rows created before the prescription-count column existed.
    if (!countCell) {
      const actionCell = row.cells[row.cells.length - 1];
      if (actionCell) {
        countCell = document.createElement('td');
        countCell.className = 'patient-rx-count';
        row.insertBefore(countCell, actionCell);
        if (!actionCell.querySelector('[onclick*="openPatientMedicationProfileByRow"]')) {
          actionCell.insertAdjacentHTML('beforeend', ' <button class="btn light" onclick="openPatientMedicationProfileByRow(this)">Medicines</button>');
        }
      }
    }
    if (countCell) {
      const count = Array.from(document.querySelectorAll('#historyTable tbody tr')).filter(historyRow => cellText(historyRow,1).trim().toLowerCase() === name.toLowerCase()).length;
      countCell.textContent = String(count);
    }
  });
}
function makePatientNameClickable() {
  document.querySelectorAll('#historyTable tbody tr').forEach(row => {
    const cell = row.cells[1];
    if (!cell) return;
    const name = cellText(row,1).trim();
    if (!name || cell.querySelector('.patient-name-link')) return;
    cell.innerHTML = `<button type="button" class="patient-name-link" data-patient="${escapeHTML(name)}" onclick="openPatientMedicationProfile(this.dataset.patient)" title="View ${escapeHTML(name)} profile and medicine records">${escapeHTML(name)}</button>`;
  });
}
function openPatientMedicationProfileByRow(button) {
  const row = button?.closest('tr');
  if (row) openPatientMedicationProfile(cellText(row,1).trim());
}
let activeProfilePatientName = '';
function openPatientMedicationProfile(patientName) {
  const name = String(patientName || '').trim();
  if (!name) return;
  activeProfilePatientName = name;
  const patientRow = Array.from(document.querySelectorAll('#patientTable tbody tr')).find(row => cellText(row,1).trim().toLowerCase() === name.toLowerCase());
  const patient = patientRow ? {
    id: cellText(patientRow,0), name: cellText(patientRow,1), age: cellText(patientRow,2),
    gender: cellText(patientRow,3), contact: cellText(patientRow,4), allergies: cellText(patientRow,5)
  } : {id:'Not registered',name,age:'—',gender:'—',contact:'—',allergies:'—'};
  const initials = name.split(/\s+/).filter(Boolean).slice(0,2).map(part => part[0].toUpperCase()).join('') || 'PT';
  document.getElementById('patientMedicationProfileTitle').textContent = patient.name;
  document.getElementById('patientProfileSubtitle').textContent = 'Patient profile and complete medication history';
  document.getElementById('patientProfileInitials').textContent = initials;
  document.getElementById('profilePatientId').textContent = patient.id;
  document.getElementById('profilePatientAge').textContent = patient.age ? `${patient.age} years` : '—';
  document.getElementById('profilePatientGender').textContent = patient.gender || '—';
  document.getElementById('profilePatientContact').textContent = patient.contact || '—';
  document.getElementById('profilePatientAllergies').textContent = patient.allergies || '—';
  const records = Array.from(document.querySelectorAll('#historyTable tbody tr')).filter(row => cellText(row,1).trim().toLowerCase() === name.toLowerCase());
  document.getElementById('profilePatientMedicineCount').textContent = String(records.length);
  const tbody = document.querySelector('#patientProfileMedicineTable tbody');
  tbody.innerHTML = '';
  if (!records.length) {
    tbody.innerHTML = '<tr><td colspan="6" style="text-align:center;padding:22px;color:#71837d">No medicine records yet. Add a prescription to connect it to this patient.</td></tr>';
  } else {
    records.forEach(row => {
      const values = [cellText(row,0),cellText(row,2),cellText(row,3),cellText(row,4),cellText(row,5),cellText(row,6) || '—'];
      const tr = document.createElement('tr');
      values.forEach((value,index) => { const td=document.createElement('td'); td.textContent=value; if(index===4) td.innerHTML=makeBadge(value); tr.appendChild(td); });
      tbody.appendChild(tr);
    });
  }
  openModal('patientMedicationProfileModal');
  logActivity('Viewed History', name + ' patient profile and medicine records');
}
function openPrescriptionForProfilePatient() {
  const patientName = activeProfilePatientName;
  closeModal('patientMedicationProfileModal');
  openPage('prescriptions');
  const patientSelect = document.querySelector('#prescriptionForm select');
  if (patientSelect && [...patientSelect.options].some(option => option.value === patientName)) patientSelect.value = patientName;
}

function updateHistoryPatientOptions() {
  const select = document.getElementById('historyPatientFilter');
  if (!select) return;
  const previousValue = select.value || 'All Patients';
  const patients = new Set();
  document.querySelectorAll('#historyTable tbody tr').forEach(row => {
    const patient = cellText(row, 1).trim();
    if (patient) patients.add(patient);
  });
  select.innerHTML = '<option value="All Patients">All Patients</option>';
  [...patients].sort((a, b) => a.localeCompare(b)).forEach(patient => {
    select.add(new Option(patient, patient));
  });
  if ([...select.options].some(option => option.value === previousValue)) {
    select.value = previousValue;
  } else {
    select.value = 'All Patients';
  }
}

function applyHistoryFilters() {
  const query = document.getElementById('historySearch')?.value.trim().toLowerCase() || '';
  const patient = document.getElementById('historyPatientFilter')?.value || 'All Patients';
  const selectedDate = document.getElementById('historyDateFilter')?.value || '';
  const status = document.getElementById('historyStatusFilter')?.value || 'All Status';
  document.querySelectorAll('#historyTable tbody tr').forEach(row => {
    const date = cellText(row, 0).trim();
    const rowPatient = cellText(row, 1).trim();
    const medicine = cellText(row, 2).trim();
    const instructions = cellText(row, 6).trim();
    const rowStatus = cellText(row, 5).trim();
    const matchesQuery = !query || rowPatient.toLowerCase().includes(query) || medicine.toLowerCase().includes(query) || instructions.toLowerCase().includes(query);
    const matchesPatient = patient === 'All Patients' || rowPatient === patient;
    const matchesDate = !selectedDate || date === selectedDate;
    const matchesStatus = status === 'All Status' || rowStatus === status;
    row.style.display = matchesQuery && matchesPatient && matchesDate && matchesStatus ? '' : 'none';
  });
}
function globalSearch() {
  const query = document.getElementById('globalSearch').value.trim().toLowerCase();
  if (!query) return;
  const searchable = [
    ['patients', 'patientTable'], ['medicines', 'medicineTable'], ['history', 'historyTable'],
    ['logs', 'logsTable'], ['accounts', 'accountsTable']
  ];
  for (const [page, tableId] of searchable) {
    const section = document.getElementById(page);
    if (section && section.innerText.toLowerCase().includes(query)) {
      openPage(page);
      const table = document.getElementById(tableId);
      if (table) filterTable(tableId, query);
      return;
    }
  }
}

function savePatient(event) {
  event.preventDefault();
  const form = event.currentTarget;
  const fields = form.querySelectorAll('input, select');
  const [nameField, ageField, genderField, contactField, allergyField] = fields;
  const name = nameField.value.trim();
  const age = ageField.value.trim();
  const gender = genderField.value;
  const contact = contactField.value.trim();
  const allergies = allergyField.value.trim() || 'None';
  if (!name || !age || Number(age) < 1 || Number(age) > 120 || !contact) { showToast('Enter a valid name, age, and contact number.'); return; }
  const id = nextRecordId('patientTable', 'PT-');
  document.querySelector('#patientTable tbody').insertAdjacentHTML('beforeend', `<tr><td>${id}</td><td>${escapeHTML(name)}</td><td>${escapeHTML(age)}</td><td>${escapeHTML(gender)}</td><td>${escapeHTML(contact)}</td><td>${escapeHTML(allergies)}</td><td><button class="btn light" onclick="openPatientEditor(this)">View/Edit</button></td></tr>`);
  form.reset(); closeModal('patientModal'); updatePrescriptionOptions(); renderPatientPrescriptionCounts(); changeStat('patients', 1); persistDashboardTables(); logActivity('Added Patient', `${id} — ${name}`); showToast('Patient record saved.');
}
function openPatientEditor(button) {
  activePatientRow = button.closest('tr'); if (!activePatientRow) return;
  const c = activePatientRow.cells;
  document.getElementById('editPatientId').value = cellText(activePatientRow,0);
  document.getElementById('editPatientName').value = cellText(activePatientRow,1);
  document.getElementById('editPatientAge').value = cellText(activePatientRow,2);
  document.getElementById('editPatientGender').value = cellText(activePatientRow,3);
  document.getElementById('editPatientContact').value = cellText(activePatientRow,4);
  document.getElementById('editPatientAllergies').value = cellText(activePatientRow,5);
  setPatientEditorMode(false); openModal('patientEditModal');
}
function setPatientEditorMode(editing) {
  document.querySelectorAll('#patientEditForm input:not([readonly]), #patientEditForm select').forEach(field => field.disabled = !editing);
  document.getElementById('patientEditToggle').hidden = editing;
  document.getElementById('patientSaveChanges').hidden = !editing;
  document.getElementById('patientEditTitle').textContent = editing ? 'Edit Patient Details' : 'Patient Details';
}
function enablePatientEditing() { setPatientEditorMode(true); document.getElementById('editPatientName').focus(); }
function savePatientEdit(event) {
  event.preventDefault(); if (!activePatientRow) return;
  const name = document.getElementById('editPatientName').value.trim();
  const age = document.getElementById('editPatientAge').value.trim();
  const contact = document.getElementById('editPatientContact').value.trim();
  if (!name || !age || Number(age) < 1 || Number(age) > 120 || !contact) { showToast('Please check the patient name, age, and contact.'); return; }
  const c = activePatientRow.cells;
  c[1].textContent = name; c[2].textContent = age; c[3].textContent = document.getElementById('editPatientGender').value;
  c[4].textContent = contact; c[5].textContent = document.getElementById('editPatientAllergies').value.trim() || 'None';
  setPatientEditorMode(false); closeModal('patientEditModal'); updatePrescriptionOptions(); persistDashboardTables(); logActivity('Updated Patient', `${cellText(activePatientRow,0)} — ${name}`); showToast('Patient record updated.');
}

function saveMedicine(event) {
  event.preventDefault();
  const form = event.currentTarget; const fields = form.querySelectorAll('input, select');
  const [nameField, categoryField, dosageField, stockField, expiryField, supplierField] = fields;
  const name = nameField.value.trim(), dosage = dosageField.value.trim(), stock = stockField.value;
  if (!name || !dosage || stock === '' || Number(stock) < 0) { showToast('Enter a medicine name, dosage, and valid stock.'); return; }
  const id = nextRecordId('medicineTable','MED-');
  document.querySelector('#medicineTable tbody').insertAdjacentHTML('beforeend', `<tr><td>${id}</td><td>${escapeHTML(name)}</td><td>${escapeHTML(categoryField.value)}</td><td>${escapeHTML(dosage)}</td><td>${escapeHTML(stock)}</td><td>${escapeHTML(expiryField.value)}</td><td>${escapeHTML(supplierField.value.trim())}</td><td><button class="btn light" onclick="openMedicineEditor(this)">View / Edit</button></td></tr>`);
  form.reset(); closeModal('medicineModal'); updatePrescriptionOptions(); changeStat('medicines',1); persistDashboardTables(); logActivity('Added Medicine', `${id} — ${name}`); showToast('Medicine record saved.');
}
function openMedicineEditor(button) {
  activeMedicineRow = button.closest('tr'); if (!activeMedicineRow) return;
  const c = activeMedicineRow.cells;
  document.getElementById('editMedicineId').value = cellText(activeMedicineRow,0);
  document.getElementById('editMedicineName').value = cellText(activeMedicineRow,1);
  document.getElementById('editMedicineCategory').value = cellText(activeMedicineRow,2);
  document.getElementById('editMedicineDosage').value = cellText(activeMedicineRow,3);
  document.getElementById('editMedicineStock').value = cellText(activeMedicineRow,4);
  document.getElementById('editMedicineExpiry').value = cellText(activeMedicineRow,5);
  document.getElementById('editMedicineSupplier').value = cellText(activeMedicineRow,6);
  setRecordEditorMode('medicine',false); openModal('medicineEditModal');
}
function enableMedicineEditing() { setRecordEditorMode('medicine',true); document.getElementById('editMedicineName').focus(); }
function saveMedicineEdit(event) {
  event.preventDefault(); if (!activeMedicineRow) return;
  const name = document.getElementById('editMedicineName').value.trim();
  const dosage = document.getElementById('editMedicineDosage').value.trim();
  const stock = document.getElementById('editMedicineStock').value;
  if (!name || !dosage || stock === '' || Number(stock) < 0) { showToast('Enter a medicine name, dosage, and valid stock.'); return; }
  const c = activeMedicineRow.cells;
  c[1].textContent = name; c[2].textContent = document.getElementById('editMedicineCategory').value;
  c[3].textContent = dosage; c[4].textContent = stock; c[5].textContent = document.getElementById('editMedicineExpiry').value;
  c[6].textContent = document.getElementById('editMedicineSupplier').value.trim();
  setRecordEditorMode('medicine',false); closeModal('medicineEditModal'); updatePrescriptionOptions(); persistDashboardTables();
  logActivity('Updated Medicine', `${cellText(activeMedicineRow,0)} — ${name}`); showToast('Medicine record updated.');
}

function saveAccount(event) {
  event.preventDefault();
  const form = event.currentTarget; const fields = form.querySelectorAll('input, select');
  const [nameField, emailField, roleField, statusField] = fields;
  const name = nameField.value.trim(), email = emailField.value.trim();
  if (!name || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) { showToast('Enter a valid name and email address.'); return; }
  const emailExists = Array.from(document.querySelectorAll('#accountsTable tbody tr')).some(row => cellText(row,2).toLowerCase() === email.toLowerCase());
  if (emailExists) { showToast('An account with that email already exists.'); return; }
  const id = nextRecordId('accountsTable','CUS-'); const status = statusField.value;
  document.querySelector('#accountsTable tbody').insertAdjacentHTML('beforeend', `<tr><td>${id}</td><td>${escapeHTML(name)}</td><td>${escapeHTML(email)}</td><td>${escapeHTML(roleField.value)}</td><td>${makeBadge(status)}</td><td><button class="btn light" onclick="openAccountEditor(this)">View / Edit</button></td></tr>`);
  form.reset(); closeModal('accountModal'); persistDashboardTables(); logActivity('Created Account', `${id} — ${name} (${roleField.value})`); showToast('Account record saved.');
}
function openAccountEditor(button) {
  activeAccountRow = button.closest('tr'); if (!activeAccountRow) return;
  document.getElementById('editAccountId').value = cellText(activeAccountRow,0);
  document.getElementById('editAccountName').value = cellText(activeAccountRow,1);
  document.getElementById('editAccountEmail').value = cellText(activeAccountRow,2);
  document.getElementById('editAccountRole').value = cellText(activeAccountRow,3);
  document.getElementById('editAccountStatus').value = cellText(activeAccountRow,4);
  setRecordEditorMode('account',false); openModal('accountEditModal');
}
function enableAccountEditing() { setRecordEditorMode('account',true); document.getElementById('editAccountName').focus(); }
function saveAccountEdit(event) {
  event.preventDefault(); if (!activeAccountRow) return;
  const name = document.getElementById('editAccountName').value.trim();
  const email = document.getElementById('editAccountEmail').value.trim();
  if (!name || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) { showToast('Enter a valid name and email.'); return; }
  const duplicate = Array.from(document.querySelectorAll('#accountsTable tbody tr')).some(row => row !== activeAccountRow && cellText(row,2).toLowerCase() === email.toLowerCase());
  if (duplicate) { showToast('Another account already uses that email.'); return; }
  const c = activeAccountRow.cells; c[1].textContent = name; c[2].textContent = email; c[3].textContent = document.getElementById('editAccountRole').value;
  c[4].innerHTML = makeBadge(document.getElementById('editAccountStatus').value);
  setRecordEditorMode('account',false); closeModal('accountEditModal'); persistDashboardTables();
  logActivity('Updated Account', `${cellText(activeAccountRow,0)} — ${name}`); showToast('Customer account updated.');
}
function setRecordEditorMode(type, editing) {
  const isMedicine = type === 'medicine';
  const modalId = isMedicine ? 'medicineEditModal' : 'accountEditModal';
  const toggleId = isMedicine ? 'medicineEditToggle' : 'accountEditToggle';
  const saveId = isMedicine ? 'medicineSaveChanges' : 'accountSaveChanges';
  const form = document.querySelector('#' + modalId + ' form');
  form.querySelectorAll('input:not([readonly]), select').forEach(field => field.disabled = !editing);
  document.getElementById(toggleId).hidden = editing;
  document.getElementById(saveId).hidden = !editing;
  document.getElementById(isMedicine ? 'medicineEditTitle' : 'accountEditTitle').textContent = editing ? (isMedicine ? 'Edit Medicine Details' : 'Edit Customer Account') : (isMedicine ? 'Medicine Details' : 'Customer Account Details');
}

function updatePrescriptionOptions() {
  const form = document.getElementById('prescriptionForm'); if (!form) return;
  const selects = form.querySelectorAll('select'); const patientSelect = selects[0], medicineSelect = selects[1];
  if (!patientSelect || !medicineSelect) return;
  const patientSelected = patientSelect.value, medicineSelected = medicineSelect.value;
  patientSelect.innerHTML = '<option value="">Select patient</option>';
  document.querySelectorAll('#patientTable tbody tr').forEach(row => {
    const name = cellText(row,1); patientSelect.add(new Option(name,name));
  });
  medicineSelect.innerHTML = '<option value="">Select medicine</option>';
  document.querySelectorAll('#medicineTable tbody tr').forEach(row => {
    const label = `${cellText(row,1)} ${cellText(row,3)}`.trim(); medicineSelect.add(new Option(label,label));
  });
  if ([...patientSelect.options].some(option => option.value === patientSelected)) patientSelect.value = patientSelected;
  if ([...medicineSelect.options].some(option => option.value === medicineSelected)) medicineSelect.value = medicineSelected;
}
function savePrescription(event) {
  event.preventDefault();
  const form = event.currentTarget; const fields = form.querySelectorAll('select,input,textarea');
  const [patientSelect, medicineSelect, dosageField, quantityField, statusSelect, dateField, instructionsField] = fields;
  const patient = patientSelect.value, medicine = medicineSelect.value, dosage = dosageField.value.trim(), quantity = quantityField.value, status = statusSelect.value, date = dateField.value;
  if (!patient || !medicine || !dosage || !quantity || Number(quantity) < 1 || !date) { showToast('Complete all required prescription fields.'); return; }
  const selectedMedicineRow = Array.from(document.querySelectorAll('#medicineTable tbody tr')).find(row => `${cellText(row,1)} ${cellText(row,3)}`.trim() === medicine);
  if (status === 'Dispensed' && selectedMedicineRow && Number(cellText(selectedMedicineRow,4)) < Number(quantity)) {
    showToast(`Insufficient stock for ${medicine}. Available stock: ${cellText(selectedMedicineRow,4)}.`);
    return;
  }
  const id = nextRecordId('recentPrescriptionTable','RX-');
  const recent = document.querySelector('#recentPrescriptionTable');
  if (recent) recent.insertAdjacentHTML('afterbegin', `<tr><td>${id}</td><td>${escapeHTML(patient)}</td><td>${escapeHTML(medicine)}</td><td>${escapeHTML(date)}</td><td>${makeBadge(status)}</td></tr>`);
  const history = document.querySelector('#historyTable tbody');
  const instructions = instructionsField.value.trim() || '—';
  history?.insertAdjacentHTML('afterbegin', `<tr><td>${escapeHTML(date)}</td><td>${escapeHTML(patient)}</td><td>${escapeHTML(medicine)}</td><td>${escapeHTML(dosage)}</td><td>${escapeHTML(quantity)}</td><td>${makeBadge(status)}</td><td>${escapeHTML(instructions)}</td></tr>`);
  updateHistoryPatientOptions();
  makePatientNameClickable();
  renderPatientPrescriptionCounts();
  applyHistoryFilters();
  // Reduce displayed stock when the prescription is marked dispensed.
  if (status === 'Dispensed' && selectedMedicineRow) {
    selectedMedicineRow.cells[4].textContent = String(Number(cellText(selectedMedicineRow,4)) - Number(quantity));
  }
  const details = `${id} for ${patient}: ${medicine}, ${dosage}, quantity ${quantity}, status ${status}${instructions !== '—' ? `; instructions: ${instructions}` : ''}`;
  form.reset(); updatePrescriptionOptions(); changeStat('prescriptions',1); persistDashboardTables(); logActivity('Added Prescription', details); showToast('Prescription saved to recent records and medication history.');
}

// Existing editable-record save helper retained for compatibility with this dashboard version.
function persistEditableRecords() { persistDashboardTables(); }
function restoreEditableRecords() { /* Full table snapshots are restored below. */ }

// Restore records and counters when the page opens or is refreshed.
restoreEditableRecords();
restoreDashboardTables();
updateStatsStorage();
updatePrescriptionOptions();
updateHistoryPatientOptions();
makePatientNameClickable();
renderPatientPrescriptionCounts();
applyHistoryFilters();
initializeAdminProfile();
</script>

<script>
/* Glass UI interaction helpers */
document.addEventListener('keydown', function(event){
  if(event.key === 'Escape'){
    document.querySelectorAll('.modal-wrap.show').forEach(function(modal){modal.classList.remove('show');});
  }
});
document.querySelectorAll('.quick-item').forEach(function(item){
  const text = (item.innerText || '').toLowerCase();
  if(text.includes('prescription')) {
    item.tabIndex = 0; item.role = 'button'; item.style.cursor = 'pointer';
    item.addEventListener('click', function(){ if(typeof openPage === 'function') openPage('prescriptions'); });
    item.addEventListener('keydown', function(e){ if(e.key === 'Enter' || e.key === ' '){e.preventDefault();item.click();} });
  } else if(text.includes('medication history')) {
    item.tabIndex = 0; item.role = 'button'; item.style.cursor = 'pointer';
    item.addEventListener('click', function(){ if(typeof openPage === 'function') openPage('history'); });
    item.addEventListener('keydown', function(e){ if(e.key === 'Enter' || e.key === ' '){e.preventDefault();item.click();} });
  } else if(text.includes('my profile')) {
    item.tabIndex = 0; item.role = 'button'; item.style.cursor = 'pointer';
    item.addEventListener('click', function(){ if(typeof openPage === 'function') openPage('profile'); });
    item.addEventListener('keydown', function(e){ if(e.key === 'Enter' || e.key === ' '){e.preventDefault();item.click();} });
  }
});
</script>


<script id="hamburger-navbar-functions">
function toggleSidebar() {
  const app = document.querySelector('.app');
  const button = document.getElementById('sidebarToggle');
  if (!app || !button) return;
  const shouldOpen = !app.classList.contains('sidebar-open');
  app.classList.toggle('sidebar-open', shouldOpen);
  document.body.classList.toggle('sidebar-menu-open', shouldOpen);
  button.setAttribute('aria-expanded', String(shouldOpen));
  button.setAttribute('aria-label', shouldOpen ? 'Close navigation menu' : 'Open navigation menu');
}
function closeSidebar() {
  const app = document.querySelector('.app');
  const button = document.getElementById('sidebarToggle');
  if (app) app.classList.remove('sidebar-open');
  document.body.classList.remove('sidebar-menu-open');
  if (button) {
    button.setAttribute('aria-expanded', 'false');
    button.setAttribute('aria-label', 'Open navigation menu');
  }
}
// Close the drawer after choosing a destination, including on desktop screens.
document.querySelectorAll('.nav button').forEach(function(button) {
  button.addEventListener('click', closeSidebar);
});
// Escape closes the navigation drawer as well as any open modal.
document.addEventListener('keydown', function(event) {
  if (event.key === 'Escape') closeSidebar();
});
</script>


<!-- Patient profile and complete medication record view -->
<div id="patientMedicationProfileModal" class="modal-wrap" aria-hidden="true">
  <div class="modal patient-profile-modal" role="dialog" aria-modal="true" aria-labelledby="patientMedicationProfileTitle">
    <div class="patient-profile-heading">
      <div class="patient-profile-avatar" id="patientProfileInitials">PT</div>
      <div><h2 id="patientMedicationProfileTitle">Patient Profile</h2><p id="patientProfileSubtitle">Patient details and medication records</p></div>
    </div>
    <div class="patient-profile-grid">
      <div class="info-box"><label>Patient ID</label><strong id="profilePatientId">—</strong></div>
      <div class="info-box"><label>Age</label><strong id="profilePatientAge">—</strong></div>
      <div class="info-box"><label>Gender</label><strong id="profilePatientGender">—</strong></div>
      <div class="info-box"><label>Contact Number</label><strong id="profilePatientContact">—</strong></div>
      <div class="info-box"><label>Allergies</label><strong id="profilePatientAllergies">—</strong></div>
      <div class="info-box"><label>Total Medicine Records</label><strong id="profilePatientMedicineCount">0</strong></div>
    </div>
    <div class="patient-profile-history-head"><h3>All Medicine Records</h3><span class="profile-record-note">Linked from Add Prescription</span></div>
    <div class="table-responsive profile-history-table-wrap">
      <table id="patientProfileMedicineTable"><thead><tr><th>Date</th><th>Medicine</th><th>Dosage</th><th>Quantity</th><th>Status</th><th>Instructions</th></tr></thead><tbody></tbody></table>
    </div>
    <div class="form-actions"><button type="button" class="btn light" onclick="closeModal('patientMedicationProfileModal')">Close Profile</button><button type="button" class="btn" onclick="openPrescriptionForProfilePatient()">+ Add Prescription</button></div>
  </div>
</div>
<style>
.patient-profile-modal{width:min(1000px,96vw)!important;max-width:1000px!important}
.patient-profile-heading{display:flex;align-items:center;gap:16px;margin-bottom:22px;padding-bottom:18px;border-bottom:1px solid #e0ebe6}
.patient-profile-heading h2{margin:0 0 5px;color:#123f3b}.patient-profile-heading p{margin:0;color:#647871}
.patient-profile-avatar{width:64px;height:64px;flex:0 0 64px;border-radius:50%;display:grid;place-items:center;background:linear-gradient(135deg,#08756e,#123f3b);color:#fff;font-weight:800;font-size:20px;box-shadow:0 8px 20px #08756e30}
.patient-profile-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:12px;margin-bottom:24px}
.patient-profile-grid .info-box{min-width:0;background:#f5faf7;border:1px solid #e0ebe6;border-radius:12px;padding:13px 15px}
.patient-profile-grid .info-box label{display:block;font-size:12px;color:#71837d;margin-bottom:6px}.patient-profile-grid .info-box strong{display:block;color:#173f38;overflow-wrap:anywhere}
.patient-profile-history-head{display:flex;align-items:center;justify-content:space-between;gap:10px;margin:4px 0 12px}.patient-profile-history-head h3{margin:0;color:#173f38;font-size:17px}.profile-record-note{font-size:12px;color:#647871}
.profile-history-table-wrap{max-height:320px;overflow:auto;border:1px solid #e2ebe6;border-radius:10px}.profile-history-table-wrap table{width:100%;border-collapse:collapse}.profile-history-table-wrap th,.profile-history-table-wrap td{padding:11px 12px;text-align:left;border-bottom:1px solid #e9f0ec;vertical-align:top}.profile-history-table-wrap th{background:#f2f8f5;color:#34564d;position:sticky;top:0;z-index:1}.patient-name-link{border:0;background:none;color:#08756e;font:inherit;font-weight:700;text-align:left;cursor:pointer;padding:2px 0;text-decoration:underline;text-underline-offset:3px}.patient-name-link:hover{color:#064e48}.patient-rx-count{font-weight:700;color:#08756e}
@media(max-width:700px){.patient-profile-grid{grid-template-columns:repeat(2,minmax(0,1fr))}.patient-profile-heading{align-items:flex-start}.patient-profile-modal{padding:18px!important}.patient-profile-history-head{align-items:flex-start;flex-direction:column}}
@media(max-width:420px){.patient-profile-grid{grid-template-columns:1fr}}
</style>


<style id="patient-profile-wide-design-fix">
/* Wide patient profile: match the spacious prescription form layout */
#patientMedicationProfileModal.modal-wrap{padding:clamp(12px,2.5vw,32px);align-items:center;justify-content:center;}
#patientMedicationProfileModal .modal.patient-profile-modal{
  width:min(1240px,96vw)!important;max-width:1240px!important;min-width:0!important;
  max-height:92vh!important;overflow-y:auto!important;overflow-x:hidden!important;
  padding:clamp(20px,2.6vw,36px)!important;margin:0!important;
  border-radius:24px!important;background:linear-gradient(145deg,rgba(255,255,255,.98),rgba(244,251,247,.98))!important;
  border:1px solid #dcebe3!important;box-shadow:0 28px 80px rgba(14,62,48,.22)!important;
}
#patientMedicationProfileModal .patient-profile-heading{
  display:flex;align-items:center;gap:18px;margin:0 0 24px;padding:0 0 22px;
  border-bottom:1px solid #dcebe4;position:relative;
}
#patientMedicationProfileModal .patient-profile-heading:after{content:"PATIENT RECORD";margin-left:auto;align-self:flex-start;padding:8px 12px;border-radius:999px;background:#e8f5ee;color:#17644f;font-size:11px;font-weight:800;letter-spacing:.08em;white-space:nowrap}
#patientMedicationProfileModal .patient-profile-avatar{width:76px;height:76px;flex:0 0 76px;font-size:24px;border:4px solid #e3f3eb;box-shadow:0 8px 22px rgba(8,117,110,.18)}
#patientMedicationProfileModal .patient-profile-heading h2{font-size:clamp(22px,2.4vw,30px);font-weight:800;letter-spacing:-.025em;line-height:1.2}
#patientMedicationProfileModal .patient-profile-heading p{font-size:14px;line-height:1.5;margin-top:6px}
#patientMedicationProfileModal .patient-profile-grid{grid-template-columns:repeat(3,minmax(0,1fr));gap:14px;margin-bottom:28px}
#patientMedicationProfileModal .patient-profile-grid .info-box{background:#fff;border:1px solid #e0ebe5;border-radius:15px;padding:17px 19px;min-height:86px;box-shadow:0 3px 12px rgba(24,75,55,.035)}
#patientMedicationProfileModal .patient-profile-grid .info-box label{font-size:11px;font-weight:800;text-transform:uppercase;letter-spacing:.055em;color:#73877d;margin-bottom:9px}
#patientMedicationProfileModal .patient-profile-grid .info-box strong{font-size:16px;line-height:1.45;color:#173f38}
#patientMedicationProfileModal .patient-profile-history-head{padding:18px 20px;margin:0;background:#f0f8f3;border:1px solid #e0ece4;border-bottom:0;border-radius:16px 16px 0 0}
#patientMedicationProfileModal .patient-profile-history-head h3{font-size:19px;font-weight:800;color:#174a3c}
#patientMedicationProfileModal .profile-record-note{padding:7px 10px;border-radius:999px;background:#fff;border:1px solid #dcebe2;color:#507064;font-weight:600}
#patientMedicationProfileModal .profile-history-table-wrap{max-height:360px;overflow:auto;border:1px solid #dfeae4;border-radius:0 0 16px 16px;background:#fff}
#patientMedicationProfileModal .profile-history-table-wrap table{min-width:780px;width:100%;border-collapse:separate;border-spacing:0}
#patientMedicationProfileModal .profile-history-table-wrap th{background:#eaf5ee;color:#285747;font-size:12px;text-transform:uppercase;letter-spacing:.045em;font-weight:800;padding:15px 16px}
#patientMedicationProfileModal .profile-history-table-wrap td{padding:15px 16px;font-size:13px;line-height:1.55;color:#314b41;border-bottom:1px solid #edf2ee}
#patientMedicationProfileModal .profile-history-table-wrap tbody tr:nth-child(even){background:#fbfdfb}
#patientMedicationProfileModal .profile-history-table-wrap tbody tr:hover{background:#f0f8f3}
#patientMedicationProfileModal .form-actions{display:flex;justify-content:flex-end;gap:12px;margin-top:24px;padding-top:20px;border-top:1px solid #e3ece6}
#patientMedicationProfileModal .form-actions .btn{min-height:44px;padding:11px 18px;border-radius:11px;font-weight:750}
#patientMedicationProfileModal .form-actions .btn.light{background:#fff;border:1px solid #d8e5dd;color:#35574a}
@media(max-width:760px){
 #patientMedicationProfileModal.modal-wrap{padding:10px;align-items:center}
 #patientMedicationProfileModal .modal.patient-profile-modal{width:100%!important;max-width:none!important;max-height:94vh!important;padding:18px!important;border-radius:18px!important}
 #patientMedicationProfileModal .patient-profile-grid{grid-template-columns:repeat(2,minmax(0,1fr));gap:10px}
 #patientMedicationProfileModal .patient-profile-grid .info-box{padding:13px;min-height:76px}
 #patientMedicationProfileModal .patient-profile-heading:after{display:none}
 #patientMedicationProfileModal .patient-profile-avatar{width:60px;height:60px;flex-basis:60px}
 #patientMedicationProfileModal .form-actions{flex-wrap:wrap}
}
@media(max-width:440px){
 #patientMedicationProfileModal .patient-profile-grid{grid-template-columns:1fr}
 #patientMedicationProfileModal .patient-profile-heading{gap:12px}
 #patientMedicationProfileModal .patient-profile-heading h2{font-size:21px}
 #patientMedicationProfileModal .form-actions{flex-direction:column-reverse}
 #patientMedicationProfileModal .form-actions .btn{width:100%}
}
</style>

<script id="medicalArchivesApiConnection">
const MA_API='../api/';
async function maRequest(path,options={}){const r=await fetch(MA_API+path,{credentials:'same-origin',headers:{'Content-Type':'application/json',...(options.headers||{})},...options});const j=await r.json();if(!r.ok||!j.success)throw new Error(j.data?.message||'API request failed');return j.data;}
async function loadPrescriptionLookups(){try{const [customers,doctors,medicines]=await Promise.all([maRequest('customers'),maRequest('doctors'),maRequest('medicines')]);const fill=(id,items,val,label)=>{const el=document.getElementById(id);if(!el)return;el.innerHTML='<option value="">Select '+label+'</option>'+items.map(x=>`<option value="${x[val]}">${String(x.full_name||x.name).replace(/[&<>"']/g,c=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]))}</option>`).join('');};fill('rxCustomer',customers,'customer_id','patient');fill('rxDoctor',doctors,'doctor_id','doctor');fill('rxMedicine',medicines,'medicine_id','medicine');}catch(e){console.error(e);if(typeof showToast==='function')showToast('Unable to load dropdown records: '+e.message);}}
async function savePrescription(event){event.preventDefault();const payload={customer_id:Number(document.getElementById('rxCustomer').value),doctor_id:Number(document.getElementById('rxDoctor').value),medicine_id:Number(document.getElementById('rxMedicine').value),dosage:document.getElementById('rxDosage').value.trim(),quantity:Number(document.getElementById('rxQuantity').value),status:document.getElementById('rxStatus').value,date_issued:document.getElementById('rxDate').value,instructions:document.getElementById('rxInstructions').value.trim()};try{const result=await maRequest('prescriptions',{method:'POST',body:JSON.stringify(payload)});document.getElementById('prescriptionForm').reset();if(typeof showToast==='function')showToast('Prescription saved to MySQL. ID: '+result.prescription_id);await loadServerPrescriptionTables();}catch(e){alert(e.message);}}
async function loadServerPrescriptionTables(){try{const [rx,history]=await Promise.all([maRequest('prescriptions'),maRequest('medication-history')]);const tbody=document.querySelector('#historyTable tbody');if(tbody)tbody.innerHTML=history.map(x=>`<tr><td>${x.date_taken||''}</td><td>${x.patient||''}</td><td>${x.medicine||''}</td><td>${x.dosage||''}</td><td>${x.quantity||''}</td><td>${x.status||''}</td><td>${x.notes||''}</td></tr>`).join('');const recent=document.querySelector('#recentPrescriptionTable tbody');if(recent)recent.innerHTML=rx.slice(0,8).map(x=>`<tr><td>RX-${x.prescription_id}</td><td>${x.patient}</td><td>${x.medicine}</td><td>${x.date_issued}</td><td>${x.status}</td></tr>`).join('');}catch(e){console.warn('Could not refresh database tables:',e.message);}}
document.addEventListener('DOMContentLoaded',()=>{loadPrescriptionLookups();loadServerPrescriptionTables();});
</script>
</body>
</html>