<?php require_once __DIR__.'/../includes/session.php'; require_role('customer'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Medical Archives | Customer Dashboard</title>

<style>
:root{
    --green:#075c4d;
    --green2:#0a745f;
    --green3:#dff3ed;
    --mint:#f1faf7;
    --line:#dcebe6;
    --text:#16332d;
    --muted:#78908a;
    --white:#ffffff;
    --shadow:0 8px 25px rgba(7,92,77,.08);

    --success:#25a56a;
    --warning:#eea62a;
    --danger:#d94d57;
}

*{
    box-sizing:border-box;
}

body{
    margin:0;
    font-family:Inter,Segoe UI,Arial,sans-serif;
    background:#f6fbf9;
    color:var(--text);
}

button,
input,
select{
    font:inherit;
}

button{
    cursor:pointer;
}

/* =========================================
   APP
========================================= */

.app{
    display:flex;
    min-height:100vh;
}

/* =========================================
   SIDEBAR
========================================= */

.sidebar{
    width:245px;
    background:linear-gradient(180deg,#075c4d,#06483d);
    color:white;

    padding:18px 14px;

    position:fixed;
    left:0;
    top:0;
    bottom:0;

    display:flex;
    flex-direction:column;

    z-index:10;
}

.brand{
    display:flex;
    align-items:center;
    gap:10px;
    padding:5px 9px 25px;
}

.brand-mark{
    width:38px;
    height:38px;

    border-radius:10px;

    background:white;
    color:var(--green);

    display:grid;
    place-items:center;

    font-weight:900;
    font-size:21px;
}


/* Static brand logo: change the image path in the HTML to use your own logo. */
.brand-logo-static{
    flex:0 0 43px;
    width:43px;
    height:43px;
    padding:3px;
    overflow:hidden;
    background:#fff;
    border:1px solid rgba(255,255,255,.7);
}
.brand-logo-static img{width:100%;height:100%;object-fit:contain;display:block}

.brand h2{
    font-size:17px;
    margin:0;
}

.brand small{
    font-size:9px;
    opacity:.75;
}

.nav-title{
    font-size:10px;
    text-transform:uppercase;
    letter-spacing:1.2px;
    opacity:.55;

    margin:3px 10px 8px;
}

.nav{
    display:flex;
    flex-direction:column;
    gap:5px;
}

.nav button{
    border:0;
    background:transparent;
    color:#dceee9;

    text-align:left;

    padding:11px 12px;

    border-radius:9px;

    display:flex;
    align-items:center;
    gap:11px;

    font-size:13px;
}

.nav button:hover,
.nav button.active{
    background:rgba(255,255,255,.14);
    color:white;
}

.nav-icon{
    width:20px;
    text-align:center;
    font-size:13px;
}

.sidebar-bottom{
    margin-top:auto;

    border-top:1px solid rgba(255,255,255,.12);

    padding-top:14px;
}

.customer-mini{
    display:flex;
    align-items:center;
    gap:9px;

    margin-bottom:13px;
}

.avatar{
    width:34px;
    height:34px;

    border-radius:50%;

    background:#dff3ed;
    color:var(--green);

    display:grid;
    place-items:center;

    font-weight:700;
    font-size:12px;
}

.customer-mini strong{
    display:block;
    font-size:12px;
}

.customer-mini span{
    font-size:10px;
    opacity:.65;
}

.logout{
    width:100%;

    border:0;

    background:rgba(255,255,255,.1);
    color:white;

    padding:10px;

    border-radius:8px;
}

.logout:hover{
    background:rgba(255,255,255,.18);
}

/* =========================================
   MAIN
========================================= */

.main{
    margin-left:245px;
    width:calc(100% - 245px);
}

/* =========================================
   TOPBAR
========================================= */

.topbar{
    height:64px;

    background:white;

    border-bottom:1px solid var(--line);

    display:flex;
    align-items:center;
    justify-content:space-between;

    padding:0 30px;

    position:sticky;
    top:0;

    z-index:5;
}

.search{
    width:min(390px,42vw);

    position:relative;
}

.search input{
    width:100%;

    border:1px solid var(--line);

    border-radius:9px;

    padding:10px 13px 10px 36px;

    outline:none;

    background:#fbfefd;
}

.search input:focus{
    border-color:#83c7b5;
}

.search:before{
    content:"⌕";

    position:absolute;

    left:13px;
    top:8px;

    color:#72918a;

    font-size:17px;
}

.top-actions{
    display:flex;
    align-items:center;
    gap:15px;
}

.icon-btn{
    border:0;
    background:transparent;

    color:#58766e;

    font-size:17px;
}

.user-chip{
    display:flex;
    align-items:center;
    gap:8px;

    font-size:12px;
}

/* =========================================
   PAGE
========================================= */

.page{
    padding:27px 30px 40px;
}

.page-head{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;

    margin-bottom:22px;
}

.page-head h1{
    font-size:23px;

    margin:0 0 5px;
}

.page-head p{
    margin:0;

    color:var(--muted);

    font-size:12px;
}

/* =========================================
   BUTTONS
========================================= */

.btn{
    border:0;

    border-radius:8px;

    padding:10px 15px;

    background:var(--green);

    color:white;

    font-size:12px;
    font-weight:600;
}

.btn:hover{
    background:var(--green2);
}

.btn.light{
    background:white;

    color:var(--green);

    border:1px solid var(--line);
}

/* =========================================
   CARDS
========================================= */

.card{
    background:white;

    border:1px solid var(--line);

    border-radius:12px;

    box-shadow:var(--shadow);
}

.card-head{
    padding:16px 18px;

    border-bottom:1px solid var(--line);

    display:flex;

    justify-content:space-between;
    align-items:center;
}

.card-head h3{
    margin:0;

    font-size:13px;
}

.card-head a{
    font-size:11px;

    color:var(--green);

    cursor:pointer;
}

.card-body{
    padding:15px 18px;
}

/* =========================================
   WELCOME CARD
========================================= */

.welcome-card{
    background:linear-gradient(
        135deg,
        #075c4d,
        #0a806b
    );

    color:white;

    border-radius:14px;

    padding:25px;

    margin-bottom:18px;

    display:flex;

    justify-content:space-between;
    align-items:center;
}

.welcome-card h2{
    margin:0 0 6px;

    font-size:22px;
}

.welcome-card p{
    margin:0;

    font-size:12px;

    opacity:.82;
}

.welcome-avatar{
    width:58px;
    height:58px;

    border-radius:50%;

    background:white;

    color:var(--green);

    display:grid;
    place-items:center;

    font-size:18px;
    font-weight:bold;
}

/* =========================================
   STATISTICS
========================================= */

.grid{
    display:grid;
    gap:16px;
}

.stats{
    grid-template-columns:repeat(3,1fr);

    margin-bottom:17px;
}

.stat{
    padding:18px;

    display:flex;

    justify-content:space-between;
    align-items:center;
}

.stat-label{
    font-size:11px;

    color:var(--muted);

    margin-bottom:5px;
}

.stat-value{
    font-size:25px;

    font-weight:700;
}

.stat-info{
    font-size:10px;

    color:var(--muted);

    margin-top:4px;
}

.stat-icon{
    width:42px;
    height:42px;

    border-radius:11px;

    background:var(--green3);

    display:grid;
    place-items:center;

    color:var(--green);

    font-weight:800;
}

/* =========================================
   TWO COLUMN
========================================= */

.two-col{
    grid-template-columns:1.55fr 1fr;

    margin-top:17px;
}

/* =========================================
   TABLE
========================================= */

table{
    width:100%;

    border-collapse:collapse;

    font-size:11px;
}

th{
    color:#7b918b;

    font-weight:600;

    text-align:left;

    padding:9px 8px;

    background:#f8fcfa;
}

td{
    padding:11px 8px;

    border-bottom:1px solid #edf4f1;
}

tr:last-child td{
    border-bottom:0;
}

/* =========================================
   BADGES
========================================= */

.badge{
    display:inline-block;

    padding:4px 8px;

    border-radius:20px;

    font-size:9px;

    font-weight:700;
}

.badge.green{
    background:#e4f7ee;

    color:#20895b;
}

.badge.yellow{
    background:#fff4dc;

    color:#b67816;
}

.badge.red{
    background:#ffeaec;

    color:#c53d49;
}

.badge.gray{
    background:#eef4f2;

    color:#6f8780;
}

/* =========================================
   QUICK INFORMATION
========================================= */

.quick-list{
    display:grid;

    gap:10px;
}

.quick-item{
    border:1px solid var(--line);

    border-radius:9px;

    padding:12px;

    display:flex;

    align-items:center;

    gap:10px;

    background:white;
}

.quick-icon{
    width:32px;
    height:32px;

    border-radius:8px;

    background:var(--green3);

    color:var(--green);

    display:grid;

    place-items:center;

    font-weight:700;
}

.quick-item strong{
    display:block;

    font-size:11px;
}

.quick-item span{
    font-size:10px;

    color:var(--muted);
}

/* =========================================
   TOOLBAR
========================================= */

.toolbar{
    display:flex;

    gap:9px;

    flex-wrap:wrap;

    margin-bottom:14px;
}

.toolbar input,
.toolbar select{
    border:1px solid var(--line);

    background:white;

    border-radius:8px;

    padding:10px 11px;

    outline:none;

    color:var(--text);
}

.toolbar input{
    min-width:230px;

    flex:1;
}

/* =========================================
   PROFILE
========================================= */

.profile-grid{
    display:grid;

    grid-template-columns:280px 1fr;

    gap:18px;
}

.profile-card{
    background:white;

    border:1px solid var(--line);

    border-radius:12px;

    box-shadow:var(--shadow);

    padding:25px;

    text-align:center;
}

.profile-avatar{
    width:80px;
    height:80px;

    margin:0 auto 12px;

    border-radius:50%;

    background:var(--green);

    color:white;

    display:grid;

    place-items:center;

    font-size:25px;

    font-weight:bold;
}

.profile-card h2{
    margin:0 0 4px;

    font-size:17px;
}

.profile-card p{
    margin:0;

    color:var(--muted);

    font-size:11px;
}

.profile-details{
    background:white;

    border:1px solid var(--line);

    border-radius:12px;

    box-shadow:var(--shadow);

    padding:22px;
}

.profile-details h3{
    margin:0 0 18px;

    font-size:14px;
}

.profile-info{
    display:grid;

    grid-template-columns:repeat(2,1fr);

    gap:15px;
}

.info-box{
    border:1px solid var(--line);

    border-radius:8px;

    padding:12px;
}

.info-box label{
    display:block;

    font-size:10px;

    color:var(--muted);

    margin-bottom:5px;
}

.info-box strong{
    font-size:12px;
}

/* =========================================
   SECTIONS
========================================= */

.section{
    display:none;
}

.section.active{
    display:block;
}

/* =========================================
   TOAST
========================================= */

.toast{
    position:fixed;

    right:25px;
    bottom:25px;

    background:#075c4d;

    color:white;

    padding:12px 16px;

    border-radius:9px;

    font-size:12px;

    box-shadow:var(--shadow);

    display:none;

    z-index:50;
}

.toast.show{
    display:block;
}

/* =========================================
   RESPONSIVE
========================================= */

@media(max-width:1000px){

    .sidebar{
        width:210px;
    }

    .main{
        margin-left:210px;

        width:calc(100% - 210px);
    }

    .stats{
        grid-template-columns:repeat(2,1fr);
    }

    .two-col{
        grid-template-columns:1fr;
    }

    .profile-grid{
        grid-template-columns:1fr;
    }
}

@media(max-width:720px){

    .sidebar{
        position:fixed;

        width:70px;

        padding:12px 8px;
    }

    .brand h2,
    .brand small,
    .nav-title,
    .nav button span,
    .customer-mini div,
    .logout{
        display:none;
    }

    .brand{
        justify-content:center;

        padding-bottom:20px;
    }

    .nav button{
        justify-content:center;
    }

    .nav-icon{
        width:auto;
    }

    .main{
        margin-left:70px;

        width:calc(100% - 70px);
    }

    .topbar{
        padding:0 15px;
    }

    .page{
        padding:20px 15px;
    }

    .search{
        width:45vw;
    }

    .stats{
        grid-template-columns:1fr;
    }

    .profile-info{
        grid-template-columns:1fr;
    }
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


<style id="customer-enhancements">
/* Banner image controls and profile editor */
.welcome-card{position:relative;overflow:hidden;min-height:190px;isolation:isolate}
.welcome-card .banner-preview{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;display:none;z-index:-2}
.welcome-card.has-banner:before{content:"";position:absolute;inset:0;background:linear-gradient(100deg,rgba(3,56,47,.94),rgba(5,93,77,.73) 62%,rgba(5,93,77,.32));z-index:-1}
.welcome-card.has-banner .banner-preview{display:block}
.welcome-card.has-banner:before{content:"";position:absolute;inset:0;background:linear-gradient(100deg,rgba(3,56,47,.94),rgba(5,93,77,.78) 62%,rgba(5,93,77,.30));z-index:-1}
.welcome-content{position:relative;z-index:1;max-width:78%}
.profile-avatar{overflow:hidden}
.profile-avatar img,.avatar img{width:100%;height:100%;object-fit:cover;display:block}
.profile-photo-controls{display:flex;justify-content:center;gap:7px;flex-wrap:wrap;margin-top:12px}
.profile-photo-controls label{cursor:pointer}
.profile-photo-controls input{display:none}
.modal-wrap{display:none;position:fixed;inset:0;background:rgba(3,39,32,.48);backdrop-filter:blur(6px);z-index:100;align-items:center;justify-content:center;padding:18px}
.modal-wrap.show{display:flex}
.profile-modal{width:min(620px,100%);max-height:90vh;overflow:auto;background:#fbfffd;border:1px solid #ffffffd9;border-radius:20px;padding:26px;box-shadow:0 25px 80px rgba(0,0,0,.25)}
.profile-modal h2{font-size:22px;margin:0 0 6px;color:#123f3b}
.profile-modal .modal-subtitle{font-size:12px;color:#78908a;margin:0 0 22px}
.profile-modal-grid{display:grid;grid-template-columns:1fr 1fr;gap:14px}
.profile-modal-field{display:flex;flex-direction:column;gap:7px}
.profile-modal-field.full{grid-column:1/-1}
.profile-modal-field label{font-size:12px;font-weight:700;color:#164d49}
.profile-modal-field input,.profile-modal-field select{width:100%;height:44px;border:1px solid #d6e5df;border-radius:10px;padding:10px 12px;background:white;color:#16332d;outline:none;font-size:13px}
.profile-modal-field input:focus,.profile-modal-field select:focus{border-color:#55b69b;box-shadow:0 0 0 3px rgba(8,123,115,.10)}
.profile-modal-actions{display:flex;justify-content:flex-end;gap:9px;margin-top:22px}
.profile-modal-error{font-size:11px;color:#c94350;min-height:16px;margin-top:11px}
@media(max-width:600px){.welcome-content{max-width:100%;padding-bottom:62px}.profile-modal-grid{grid-template-columns:1fr}.profile-modal-field.full{grid-column:auto}.profile-modal{padding:21px}}
</style>


<style id="final-layout-fixes">
/* Keep sidebar/main alignment correct after the original font overrides. */
.main{padding:0!important;margin-left:245px!important;width:calc(100% - 245px)!important;min-width:0!important}
.sidebar{width:245px!important}
.card:not(.profile-card):not(.profile-details){padding:0!important}
.welcome-card{padding:24px!important}
.welcome-card .welcome-content{padding:0!important}
@media(max-width:1000px){.sidebar{width:210px!important}.main{margin-left:210px!important;width:calc(100% - 210px)!important}}
@media(max-width:720px){.sidebar{width:70px!important;padding:12px 8px!important}.main{margin-left:70px!important;width:calc(100% - 70px)!important}.welcome-card{padding:22px!important}.welcome-content{max-width:100%!important;padding-bottom:56px!important}.topbar{padding:0 12px!important}.page{padding:20px 13px 30px!important}}
</style>


<style id="compact-dashboard-layout">
/* Compact customer dashboard layout */
html { font-size: 16px !important; }
.main { min-width: 0 !important; }
.page {
  width: 100% !important;
  max-width: 1480px !important;
  margin: 0 auto !important;
  padding: 22px 28px 34px !important;
}
.page-head { margin-bottom: 18px !important; }
.page-head h1 { font-size: clamp(24px, 2vw, 30px) !important; }
.page-head p { font-size: 13px !important; }

/* Shorter banner with restrained text and image height */
.section#dashboard .welcome-card {
  min-height: 0 !important;
  height: 172px !important;
  padding: 22px 26px !important;
  margin-bottom: 16px !important;
  border-radius: 17px !important;
  gap: 18px !important;
  box-shadow: 0 12px 28px rgba(5, 92, 77, .13) !important;
}
.section#dashboard .welcome-card .banner-preview {
  width: 100% !important;
  height: 100% !important;
  object-fit: cover !important;
  object-position: center 45% !important;
}
.section#dashboard .welcome-card:after {
  width: 180px !important;
  height: 180px !important;
  top: -100px !important;
  right: 7% !important;
}
.section#dashboard .welcome-content {
  max-width: min(800px, 82%) !important;
  padding: 0 !important;
}
.section#dashboard .welcome-card .system-label {
  padding: 4px 9px !important;
  margin-bottom: 7px !important;
  font-size: 9px !important;
}
.section#dashboard .welcome-card h2 {
  margin: 0 0 5px !important;
  font-size: clamp(21px, 1.8vw, 27px) !important;
  line-height: 1.2 !important;
}
.section#dashboard .welcome-card p {
  max-width: 680px !important;
  font-size: 12px !important;
  line-height: 1.45 !important;
}
.section#dashboard .welcome-card .btn {
  min-height: 0 !important;
  margin-top: 10px !important;
  padding: 8px 12px !important;
  border-radius: 9px !important;
  font-size: 11px !important;
  box-shadow: none !important;
}
.section#dashboard .welcome-avatar {
  flex: 0 0 48px !important;
  width: 48px !important;
  height: 48px !important;
  font-size: 16px !important;
  box-shadow: 0 6px 16px rgba(0,0,0,.10) !important;
}

/* Three summary cards: consistent height and less padding */
.section#dashboard .grid.stats {
  grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
  gap: 14px !important;
  margin-bottom: 16px !important;
}
.section#dashboard .grid.stats > .stat {
  min-width: 0 !important;
  min-height: 104px !important;
  padding: 16px 18px !important;
  gap: 10px !important;
  border-radius: 15px !important;
  align-items: center !important;
  box-shadow: 0 8px 20px rgba(7, 92, 77, .07) !important;
}
.section#dashboard .stat-label {
  font-size: 12px !important;
  line-height: 1.3 !important;
  margin-bottom: 5px !important;
  color: #67847c !important;
}
.section#dashboard .stat-value {
  font-size: clamp(24px, 2vw, 30px) !important;
  line-height: 1.12 !important;
  letter-spacing: -.5px !important;
  overflow-wrap: anywhere !important;
}
.section#dashboard .stat-info {
  font-size: 10px !important;
  line-height: 1.35 !important;
  margin-top: 5px !important;
  color: #78908a !important;
}
.section#dashboard .stat-icon {
  flex: 0 0 40px !important;
  width: 40px !important;
  height: 40px !important;
  border-radius: 12px !important;
  font-size: 12px !important;
}
.section#dashboard .grid.stats > .stat:nth-child(3) .stat-value {
  font-size: clamp(18px, 1.5vw, 22px) !important;
  letter-spacing: -.2px !important;
  white-space: nowrap !important;
}

/* Keep the rest of the dashboard comfortable without oversized sections */
.section#dashboard .two-col { gap: 16px !important; margin-top: 16px !important; }
.section#dashboard .card-head { padding: 15px 18px !important; }
.section#dashboard .card-head h3 { font-size: 14px !important; }
.section#dashboard .card-body { padding: 17px 18px !important; }
.section#dashboard table { font-size: 12px !important; }
.section#dashboard th { font-size: 11px !important; padding: 11px 10px !important; }
.section#dashboard td { font-size: 12px !important; padding: 12px 10px !important; }

@media (max-width: 1050px) {
  .page { padding: 20px 20px 30px !important; }
  .section#dashboard .welcome-card { height: 166px !important; }
  .section#dashboard .grid.stats > .stat { padding: 14px !important; }
  .section#dashboard .stat-icon { flex-basis: 36px !important; width: 36px !important; height: 36px !important; }
}
@media (max-width: 720px) {
  .page { padding: 17px 13px 26px !important; }
  .page-head h1 { font-size: 24px !important; }
  .section#dashboard .welcome-card {
    height: auto !important;
    min-height: 160px !important;
    padding: 18px !important;
    align-items: flex-start !important;
  }
  .section#dashboard .welcome-content { max-width: 100% !important; }
  .section#dashboard .welcome-card h2 { font-size: 22px !important; }
  .section#dashboard .welcome-card p { font-size: 11px !important; max-width: 100% !important; }
  .section#dashboard .welcome-avatar { display: none !important; }
  .section#dashboard .grid.stats { grid-template-columns: 1fr !important; gap: 10px !important; }
  .section#dashboard .grid.stats > .stat { min-height: 88px !important; padding: 14px 16px !important; }
  .section#dashboard .stat-value { font-size: 25px !important; }
  .section#dashboard .grid.stats > .stat:nth-child(3) .stat-value { font-size: 20px !important; }
}
</style>

<style id="readability-design-refresh">
/* High-contrast, readable redesign. These rules intentionally override the older compact sizing rules. */
:root {
  --green: #075c4d !important;
  --green2: #087765 !important;
  --green3: #e1f4ed !important;
  --line: #d5e4de !important;
  --text: #173b33 !important;
  --muted: #526d65 !important;
  --shadow: 0 10px 28px rgba(9, 69, 57, .09) !important;
}
html { font-size: 16px !important; scroll-behavior: smooth; }
body {
  font-family: Inter, "Segoe UI", Arial, sans-serif !important;
  font-size: 17px !important;
  line-height: 1.65 !important;
  color: #173b33 !important;
  background: linear-gradient(135deg, #eef7f3 0%, #f8fbf9 52%, #eaf5f0 100%) !important;
}
button, input, select, textarea { font-family: inherit !important; }

/* Navigation and header */
body .sidebar {
  width: 250px !important;
  padding: 24px 16px !important;
  background: linear-gradient(165deg, #075c4d 0%, #06463c 100%) !important;
  box-shadow: 8px 0 28px rgba(3, 54, 48, .14) !important;
}
body .brand { gap: 12px !important; padding: 5px 8px 28px !important; }
body .brand-logo-static { flex: 0 0 46px !important; width: 46px !important; height: 46px !important; border-radius: 13px !important; }
body .brand h2 { color: #fff !important; font-size: 20px !important; line-height: 1.25 !important; letter-spacing: -.35px !important; }
body .brand small { display: block !important; margin-top: 3px !important; font-size: 12px !important; line-height: 1.4 !important; color: #d7eee7 !important; opacity: 1 !important; }
body .nav-title { font-size: 12px !important; color: #d8eee6 !important; opacity: .82 !important; letter-spacing: 1.25px !important; margin: 5px 10px 12px !important; }
body .nav { gap: 8px !important; }
body .nav button {
  min-height: 48px !important;
  padding: 12px 13px !important;
  border-radius: 12px !important;
  gap: 12px !important;
  color: #e7f6f1 !important;
  font-size: 15.5px !important;
  line-height: 1.35 !important;
  font-weight: 600 !important;
}
body .nav-icon { flex: 0 0 22px !important; width: 22px !important; font-size: 18px !important; }
body .nav button.active { background: rgba(255,255,255,.2) !important; box-shadow: inset 4px 0 #b9f3df !important; }
body .customer-mini strong { font-size: 15px !important; line-height: 1.4 !important; }
body .customer-mini span { font-size: 12px !important; line-height: 1.4 !important; color: #e1f2ec !important; opacity: 1 !important; }
body .avatar { font-size: 14px !important; }
body .logout { min-height: 46px !important; padding: 12px !important; font-size: 15px !important; font-weight: 700 !important; }
body .main { margin-left: 250px !important; width: calc(100% - 250px) !important; min-width: 0 !important; padding: 0 !important; }
body .topbar {
  min-height: 78px !important; height: auto !important;
  padding: 13px 30px !important;
  background: rgba(255,255,255,.94) !important;
  border-bottom: 1px solid #dce9e3 !important;
  box-shadow: 0 4px 18px rgba(11, 72, 59, .045) !important;
  backdrop-filter: blur(14px) !important;
}
body .search { width: min(500px, 52vw) !important; }
body .search input {
  min-height: 48px !important; width: 100% !important;
  padding: 12px 16px 12px 44px !important;
  border: 1px solid #cddfd7 !important; border-radius: 12px !important;
  background: #fff !important; color: #173b33 !important;
  font-size: 16px !important; line-height: 1.45 !important;
}
body .search input::placeholder, body input::placeholder, body textarea::placeholder { color: #687f77 !important; opacity: 1 !important; }
body .search:before { top: 10px !important; font-size: 22px !important; color: #436d60 !important; }
body .icon-btn { font-size: 23px !important; color: #315d51 !important; }
body .user-chip { gap: 10px !important; font-size: 15px !important; color: #173b33 !important; }

/* Main content and headings */
body .page { width: 100% !important; max-width: 1500px !important; margin: 0 auto !important; padding: 28px 32px 42px !important; }
body .page-head { margin-bottom: 22px !important; gap: 16px !important; }
body .page-head h1 { color: #143d34 !important; font-size: clamp(29px, 2.25vw, 36px) !important; line-height: 1.2 !important; letter-spacing: -.65px !important; font-weight: 800 !important; }
body .page-head p { color: #526d65 !important; font-size: 16px !important; line-height: 1.55 !important; margin-top: 7px !important; }
body .page p, body .page label, body .page li { color: inherit; }
body .btn {
  min-height: 46px !important; padding: 11px 18px !important;
  border-radius: 11px !important; font-size: 15px !important;
  font-weight: 700 !important; line-height: 1.35 !important;
  box-shadow: 0 5px 14px rgba(7,92,77,.12) !important;
}
body .btn.light { background: #fff !important; color: #075c4d !important; border: 1px solid #c6ded4 !important; }
body .btn:focus-visible, body button:focus-visible, body a:focus-visible, body input:focus-visible, body select:focus-visible, body textarea:focus-visible {
  outline: 3px solid rgba(13, 143, 113, .36) !important; outline-offset: 2px !important;
}

/* Solid cards with stronger contrast */
body .card, body .profile-card, body .profile-details {
  background: #fff !important;
  border: 1px solid #d8e7e1 !important;
  border-radius: 18px !important;
  box-shadow: 0 9px 26px rgba(8, 73, 59, .075) !important;
  backdrop-filter: none !important; -webkit-backdrop-filter: none !important;
}
body .card:hover { box-shadow: 0 13px 30px rgba(8,73,59,.11) !important; }
body .section#dashboard .grid.stats { grid-template-columns: repeat(3, minmax(0, 1fr)) !important; gap: 16px !important; margin-bottom: 20px !important; }
body .page .card.stat, body .section#dashboard .grid.stats > .stat {
  min-width: 0 !important; min-height: 122px !important;
  padding: 20px !important; gap: 12px !important;
  display: flex !important; align-items: center !important; justify-content: space-between !important;
}
body .stat-label { color: #385d52 !important; font-size: 16px !important; line-height: 1.35 !important; font-weight: 700 !important; margin-bottom: 7px !important; }
body .stat-value { color: #123e33 !important; font-size: clamp(30px, 2.4vw, 38px) !important; line-height: 1.12 !important; letter-spacing: -.6px !important; font-weight: 800 !important; }
body .stat-info { color: #526d65 !important; font-size: 14px !important; line-height: 1.4 !important; margin-top: 7px !important; }
body .stat-icon { flex: 0 0 48px !important; width: 48px !important; height: 48px !important; border-radius: 14px !important; font-size: 14px !important; background: #e1f4ed !important; color: #075c4d !important; }
body .section#dashboard .grid.stats > .stat:nth-child(3) .stat-value { font-size: clamp(22px, 1.7vw, 27px) !important; white-space: nowrap !important; }
/* Override compact-layout selectors that previously forced dashboard copy too small. */
body .section#dashboard .stat-label { color: #385d52 !important; font-size: 16px !important; line-height: 1.4 !important; font-weight: 800 !important; }
body .section#dashboard .stat-value { color: #123e33 !important; font-size: clamp(30px, 2.4vw, 38px) !important; line-height: 1.12 !important; letter-spacing: -.6px !important; }
body .section#dashboard .stat-info { color: #526d65 !important; font-size: 14px !important; line-height: 1.45 !important; }
body .section#dashboard .stat-icon { font-size: 14px !important; }
body .section#dashboard .card-head { padding: 18px 22px !important; }
body .section#dashboard .card-head h3 { color: #173e34 !important; font-size: 19px !important; line-height: 1.35 !important; font-weight: 800 !important; }
body .section#dashboard .card-body { padding: 20px 22px !important; }
body .section#dashboard table { font-size: 15px !important; }
body .section#dashboard th { color: #36594f !important; font-size: 14px !important; padding: 14px 13px !important; }
body .section#dashboard td { color: #24473d !important; font-size: 15px !important; padding: 14px 13px !important; }
body .two-col { gap: 20px !important; margin-top: 20px !important; }
body .card-head { padding: 18px 22px !important; background: #f8fcfa !important; border-bottom: 1px solid #dce9e3 !important; }
body .card-head h3 { color: #173e34 !important; font-size: 19px !important; line-height: 1.35 !important; font-weight: 800 !important; }
body .card-head a { color: #075c4d !important; font-size: 15px !important; font-weight: 700 !important; }
body .card-body { padding: 20px 22px !important; }
body .quick-list { gap: 12px !important; }
body .quick-item { padding: 15px !important; gap: 13px !important; background: #fff !important; border: 1px solid #d9e8e1 !important; border-radius: 13px !important; }
body .quick-icon { flex: 0 0 42px !important; width: 42px !important; height: 42px !important; border-radius: 12px !important; font-size: 14px !important; }
body .quick-item strong { color: #173e34 !important; font-size: 16px !important; line-height: 1.4 !important; font-weight: 800 !important; }
body .quick-item span { display: block !important; color: #526d65 !important; font-size: 14px !important; line-height: 1.5 !important; margin-top: 3px !important; }

/* Readable tables throughout prescription and history sections */
body .page .card-body:has(table) { overflow-x: auto !important; }
body .page table { width: 100% !important; border-collapse: separate !important; border-spacing: 0 !important; font-size: 15px !important; line-height: 1.5 !important; white-space: nowrap !important; }
body .page th { color: #36594f !important; font-size: 14px !important; font-weight: 800 !important; padding: 14px 13px !important; background: #edf7f2 !important; }
body .page td { color: #24473d !important; font-size: 15px !important; line-height: 1.5 !important; padding: 14px 13px !important; border-bottom: 1px solid #e4eee9 !important; }
body .page tbody tr:hover { background: #f4fbf7 !important; }
body .badge { display: inline-block !important; padding: 6px 10px !important; border-radius: 20px !important; font-size: 13px !important; line-height: 1.2 !important; font-weight: 800 !important; }

/* Inputs, profiles, modal labels and content */
body .toolbar { gap: 12px !important; margin-bottom: 18px !important; }
body .toolbar input, body .toolbar select, body .form-control, body .profile-modal-field input, body .profile-modal-field select {
  min-height: 48px !important; padding: 12px 14px !important;
  border: 1px solid #cbded6 !important; border-radius: 11px !important;
  background: #fff !important; color: #173b33 !important;
  font-size: 16px !important; line-height: 1.45 !important;
}
body .form-group label, body .profile-modal-field label { color: #274e42 !important; font-size: 15px !important; line-height: 1.4 !important; font-weight: 800 !important; }
body .profile-grid { grid-template-columns: minmax(250px, 330px) minmax(0, 1fr) !important; gap: 22px !important; }
body .profile-card, body .profile-details { padding: 28px !important; }
body .profile-avatar { width: 100px !important; height: 100px !important; font-size: 30px !important; }
body .profile-card h2 { color: #143d34 !important; font-size: 23px !important; line-height: 1.3 !important; }
body .profile-card p { color: #526d65 !important; font-size: 15px !important; line-height: 1.5 !important; }
body .profile-details h3 { font-size: 20px !important; line-height: 1.35 !important; color: #173e34 !important; }
body .info-box { border: 1px solid #d9e8e1 !important; background: #f8fcfa !important; padding: 16px !important; border-radius: 12px !important; }
body .info-box label { color: #526d65 !important; font-size: 14px !important; line-height: 1.4 !important; }
body .info-box strong { color: #173b33 !important; font-size: 16px !important; line-height: 1.5 !important; overflow-wrap: anywhere !important; }
body .profile-modal { width: min(760px, 94vw) !important; padding: 30px !important; background: #fff !important; border: 1px solid #d6e6de !important; border-radius: 20px !important; box-shadow: 0 24px 65px rgba(4,45,37,.22) !important; }
body .profile-modal h2 { color: #143d34 !important; font-size: 26px !important; line-height: 1.25 !important; }
body .profile-modal p, body .modal-subtitle { color: #526d65 !important; font-size: 15px !important; line-height: 1.55 !important; }
body .profile-modal-error { font-size: 14px !important; line-height: 1.4 !important; }
body .toast { font-size: 15px !important; line-height: 1.45 !important; padding: 15px 19px !important; border-radius: 12px !important; }

/* Keep the banner compact enough for the dashboard but make all copy readable. */
body .section#dashboard .welcome-card {
  height: 205px !important; min-height: 205px !important;
  padding: 24px 28px !important; margin-bottom: 20px !important;
  border-radius: 18px !important; gap: 20px !important;
  box-shadow: 0 12px 28px rgba(5,92,77,.16) !important;
}
body .section#dashboard .welcome-card .banner-preview { object-fit: cover !important; object-position: center 45% !important; }
body .section#dashboard .welcome-card:before { background: linear-gradient(100deg, rgba(3,45,39,.96) 0%, rgba(4,76,63,.88) 58%, rgba(5,80,68,.58) 100%) !important; }
body .section#dashboard .welcome-content { max-width: min(850px, 82%) !important; padding: 0 !important; }
body .section#dashboard .welcome-card .system-label { padding: 5px 11px !important; margin-bottom: 9px !important; font-size: 12px !important; line-height: 1.4 !important; font-weight: 800 !important; }
body .section#dashboard .welcome-card h2 { margin: 0 0 7px !important; color: #fff !important; font-size: clamp(27px, 2vw, 34px) !important; line-height: 1.2 !important; font-weight: 800 !important; }
body .section#dashboard .welcome-card p { color: #fff !important; max-width: 760px !important; font-size: 15px !important; line-height: 1.5 !important; opacity: 1 !important; }
body .section#dashboard .welcome-card .btn { margin-top: 11px !important; min-height: 42px !important; padding: 9px 15px !important; font-size: 14px !important; box-shadow: none !important; }
body .section#dashboard .welcome-avatar { flex: 0 0 54px !important; width: 54px !important; height: 54px !important; font-size: 18px !important; }

@media (max-width: 1100px) {
  body .sidebar { width: 220px !important; }
  body .main { margin-left: 220px !important; width: calc(100% - 220px) !important; }
  body .page { padding: 22px 22px 32px !important; }
  body .section#dashboard .grid.stats { grid-template-columns: repeat(2, minmax(0, 1fr)) !important; }
  body .section#dashboard .welcome-card { height: 215px !important; min-height: 215px !important; }
  body .section#dashboard .welcome-content { max-width: 82% !important; }
  body .two-col { grid-template-columns: 1fr !important; }
}
@media (max-width: 720px) {
  body .sidebar { width: 70px !important; padding: 12px 8px !important; }
  body .brand { justify-content: center !important; padding: 5px 0 22px !important; }
  body .brand h2, body .brand small, body .nav-title, body .nav button span:not(.nav-icon), body .customer-mini div, body .logout { display: none !important; }
  body .brand-logo-static { width: 44px !important; height: 44px !important; flex-basis: 44px !important; }
  body .nav button { justify-content: center !important; padding: 13px 7px !important; min-height: 48px !important; }
  body .nav-icon { font-size: 19px !important; }
  body .main { margin-left: 70px !important; width: calc(100% - 70px) !important; }
  body .topbar { min-height: 66px !important; padding: 10px 11px !important; gap: 8px !important; }
  body .search { width: min(53vw, 320px) !important; }
  body .search input { min-height: 43px !important; font-size: 14px !important; padding: 10px 8px 10px 30px !important; }
  body .search:before { left: 9px !important; top: 8px !important; font-size: 18px !important; }
  body .top-actions { gap: 7px !important; }
  body .user-chip { gap: 5px !important; font-size: 12px !important; }
  body .user-chip strong { display: none !important; }
  body .user-chip .avatar { width: 32px !important; height: 32px !important; }
  body .page { padding: 18px 13px 28px !important; }
  body .page-head { align-items: flex-start !important; flex-direction: column !important; margin-bottom: 18px !important; }
  body .page-head h1 { font-size: 27px !important; }
  body .page-head p { font-size: 15px !important; }
  body .section#dashboard .welcome-card { height: auto !important; min-height: 225px !important; padding: 20px !important; align-items: flex-start !important; }
  body .section#dashboard .welcome-content { max-width: 100% !important; padding-bottom: 0 !important; }
  body .section#dashboard .welcome-card .system-label { font-size: 11px !important; }
  body .section#dashboard .welcome-card h2 { font-size: 25px !important; }
  body .section#dashboard .welcome-card p { font-size: 14px !important; line-height: 1.55 !important; max-width: 100% !important; }
  body .section#dashboard .welcome-avatar { display: none !important; }
  body .section#dashboard .grid.stats { grid-template-columns: 1fr !important; gap: 12px !important; }
  body .section#dashboard .grid.stats > .stat { min-height: 100px !important; padding: 17px !important; }
  body .section#dashboard .stat-label { font-size: 15px !important; }
  body .section#dashboard .stat-value { font-size: 31px !important; }
  body .section#dashboard .grid.stats > .stat:nth-child(3) .stat-value { font-size: 24px !important; }
  body .section#dashboard .card-head h3 { font-size: 17px !important; }
  body .section#dashboard th { font-size: 13px !important; padding: 12px 10px !important; }
  body .section#dashboard td { font-size: 14px !important; padding: 12px 10px !important; }
  body .card-head { padding: 16px !important; }
  body .card-head h3 { font-size: 17px !important; }
  body .card-body { padding: 16px !important; }
  body .page .card-body:has(table) { overflow-x: auto !important; }
  body .page th { font-size: 13px !important; padding: 12px 10px !important; }
  body .page td { font-size: 14px !important; padding: 12px 10px !important; }
  body .quick-item strong { font-size: 15px !important; }
  body .quick-item span { font-size: 13px !important; }
  body .profile-grid, body .profile-info { grid-template-columns: 1fr !important; }
  body .profile-card, body .profile-details { padding: 20px !important; }
  body .profile-modal { padding: 21px !important; max-height: 90vh !important; overflow-y: auto !important; }
  body .profile-modal-grid { grid-template-columns: 1fr !important; }
  body .profile-modal-field.full { grid-column: auto !important; }
}
@media (prefers-reduced-motion: reduce) {
  *, *::before, *::after { scroll-behavior: auto !important; transition-duration: .01ms !important; animation-duration: .01ms !important; }
}
</style>



<style id="extra-large-readable-fonts">
/* EXTRA-LARGE TYPE UPDATE: set after all existing styles so these sizes win. */
html { font-size: 18px !important; }
body {
  font-size: 18px !important;
  line-height: 1.7 !important;
  color: #153b32 !important;
  -webkit-font-smoothing: antialiased;
  text-rendering: optimizeLegibility;
}
body .brand h2 { font-size: 22px !important; line-height: 1.25 !important; }
body .brand small { font-size: 13px !important; line-height: 1.45 !important; }
body .nav-title { font-size: 13px !important; }
body .nav button { font-size: 17px !important; line-height: 1.45 !important; min-height: 54px !important; }
body .nav-icon { font-size: 20px !important; }
body .customer-mini strong { font-size: 17px !important; }
body .customer-mini span { font-size: 14px !important; }
body .logout { font-size: 17px !important; min-height: 50px !important; }
body .user-chip { font-size: 17px !important; }
body .search input { font-size: 17px !important; min-height: 54px !important; }
body .page { padding: 32px 36px 46px !important; }
body .page-head { margin-bottom: 26px !important; }
body .page-head h1, body h1 { font-size: clamp(34px, 2.7vw, 42px) !important; line-height: 1.2 !important; font-weight: 850 !important; }
body .page-head p { font-size: 18px !important; line-height: 1.6 !important; }
body .page p, body .page label, body .page li { font-size: 17px !important; line-height: 1.65 !important; }
body .btn, body button.btn { font-size: 17px !important; line-height: 1.35 !important; min-height: 52px !important; padding: 13px 20px !important; }
body .section#dashboard .welcome-card {
  height: 225px !important;
  min-height: 225px !important;
  padding: 30px 34px !important;
  margin-bottom: 24px !important;
}
body .section#dashboard .welcome-card .system-label { font-size: 14px !important; line-height: 1.45 !important; padding: 7px 13px !important; }
body .section#dashboard .welcome-card h2 { font-size: clamp(32px, 2.8vw, 40px) !important; line-height: 1.2 !important; margin-bottom: 10px !important; }
body .section#dashboard .welcome-card p { font-size: 18px !important; line-height: 1.6 !important; max-width: 820px !important; }
body .section#dashboard .welcome-card .btn { font-size: 16px !important; min-height: 48px !important; padding: 11px 18px !important; }
body .section#dashboard .welcome-avatar { width: 62px !important; height: 62px !important; flex-basis: 62px !important; font-size: 21px !important; }
body .section#dashboard .grid.stats { gap: 18px !important; margin-bottom: 24px !important; }
body .section#dashboard .grid.stats > .stat, body .page .card.stat {
  min-height: 142px !important;
  padding: 24px !important;
  gap: 16px !important;
  border-radius: 18px !important;
}
body .section#dashboard .stat-label, body .stat-label {
  font-size: 19px !important;
  line-height: 1.4 !important;
  font-weight: 800 !important;
  margin-bottom: 9px !important;
  color: #345b4f !important;
}
body .section#dashboard .stat-value, body .stat-value {
  font-size: clamp(36px, 2.7vw, 46px) !important;
  line-height: 1.12 !important;
  font-weight: 850 !important;
  letter-spacing: -.6px !important;
}
body .section#dashboard .stat-info, body .stat-info { font-size: 16px !important; line-height: 1.5 !important; margin-top: 8px !important; }
body .section#dashboard .grid.stats > .stat:nth-child(3) .stat-value { font-size: clamp(26px, 2vw, 32px) !important; white-space: normal !important; overflow-wrap: anywhere !important; }
body .stat-icon { width: 54px !important; height: 54px !important; flex-basis: 54px !important; font-size: 16px !important; }
body .two-col { gap: 24px !important; margin-top: 24px !important; }
body .card-head { padding: 21px 24px !important; }
body .card-head h3, body .section#dashboard .card-head h3 { font-size: 22px !important; line-height: 1.4 !important; font-weight: 800 !important; }
body .card-head a { font-size: 17px !important; }
body .card-body, body .section#dashboard .card-body { padding: 23px 24px !important; }
body .quick-item { padding: 18px !important; gap: 15px !important; }
body .quick-item strong { font-size: 18px !important; line-height: 1.45 !important; }
body .quick-item span { font-size: 16px !important; line-height: 1.55 !important; }
body .quick-icon { width: 46px !important; height: 46px !important; flex-basis: 46px !important; font-size: 16px !important; }
body .page table, body .section#dashboard table { font-size: 17px !important; line-height: 1.6 !important; }
body .page th, body .section#dashboard th { font-size: 16px !important; line-height: 1.45 !important; padding: 16px 15px !important; font-weight: 850 !important; }
body .page td, body .section#dashboard td { font-size: 17px !important; line-height: 1.55 !important; padding: 16px 15px !important; }
body .badge { font-size: 15px !important; line-height: 1.35 !important; padding: 7px 12px !important; }
body .toolbar input, body .toolbar select, body .form-control,
body .profile-modal-field input, body .profile-modal-field select,
body .profile-modal-field textarea {
  font-size: 18px !important;
  line-height: 1.5 !important;
  min-height: 54px !important;
  padding: 14px 16px !important;
}
body .form-group label, body .profile-modal-field label { font-size: 17px !important; line-height: 1.5 !important; }
body .profile-card h2 { font-size: 27px !important; line-height: 1.35 !important; }
body .profile-card p { font-size: 17px !important; line-height: 1.65 !important; }
body .profile-details h3 { font-size: 23px !important; line-height: 1.4 !important; }
body .info-box label { font-size: 16px !important; line-height: 1.5 !important; }
body .info-box strong { font-size: 18px !important; line-height: 1.55 !important; }
body .profile-modal h2 { font-size: 30px !important; line-height: 1.3 !important; }
body .profile-modal p, body .profile-modal .modal-subtitle { font-size: 17px !important; line-height: 1.6 !important; }
body .profile-modal-error { font-size: 16px !important; }
body .toast { font-size: 17px !important; line-height: 1.5 !important; padding: 17px 22px !important; }

@media (max-width: 1100px) {
  body .page { padding: 26px 24px 36px !important; }
  body .section#dashboard .grid.stats { grid-template-columns: repeat(2, minmax(0, 1fr)) !important; }
  body .section#dashboard .welcome-card { height: 230px !important; min-height: 230px !important; }
  body .page-head h1, body h1 { font-size: 36px !important; }
  body .section#dashboard .stat-label { font-size: 18px !important; }
}
@media (max-width: 720px) {
  html { font-size: 16px !important; }
  body { font-size: 16px !important; }
  body .page { padding: 20px 15px 30px !important; }
  body .page-head h1, body h1 { font-size: 30px !important; }
  body .page-head p, body .page p { font-size: 16px !important; }
  body .btn, body button.btn { font-size: 16px !important; min-height: 48px !important; }
  body .section#dashboard .welcome-card { height: auto !important; min-height: 230px !important; padding: 23px !important; }
  body .section#dashboard .welcome-card h2 { font-size: 29px !important; }
  body .section#dashboard .welcome-card p { font-size: 16px !important; line-height: 1.6 !important; }
  body .section#dashboard .welcome-card .system-label { font-size: 12px !important; }
  body .section#dashboard .grid.stats { grid-template-columns: 1fr !important; }
  body .section#dashboard .grid.stats > .stat { min-height: 115px !important; padding: 20px !important; }
  body .section#dashboard .stat-label { font-size: 17px !important; }
  body .section#dashboard .stat-value { font-size: 36px !important; }
  body .section#dashboard .grid.stats > .stat:nth-child(3) .stat-value { font-size: 27px !important; }
  body .card-head h3, body .section#dashboard .card-head h3 { font-size: 19px !important; }
  body .page th, body .section#dashboard th { font-size: 14px !important; padding: 13px 11px !important; }
  body .page td, body .section#dashboard td { font-size: 15px !important; padding: 13px 11px !important; }
  body .toolbar input, body .toolbar select, body .form-control, body .profile-modal-field input, body .profile-modal-field select { font-size: 16px !important; }
  body .form-group label, body .profile-modal-field label { font-size: 16px !important; }
  body .profile-modal { padding: 23px !important; }
}
</style>

<style id="customer-dashboard-interface-redesign">
/* Visual redesign: stronger contrast, more polished surfaces, and clear hierarchy. */
:root {
  --ui-forest: #074d40;
  --ui-green: #08745e;
  --ui-mint: #e7f7f0;
  --ui-ink: #173b32;
  --ui-muted: #526d64;
  --ui-line: #dcebe5;
  --ui-shadow: 0 14px 34px rgba(14, 68, 55, .09);
}
html { scroll-behavior: smooth; }
body {
  background:
    radial-gradient(ellipse at 10% 0%, rgba(176, 235, 216, .62), transparent 33%),
    radial-gradient(ellipse at 92% 12%, rgba(190, 226, 219, .52), transparent 30%),
    linear-gradient(140deg, #eef8f4 0%, #f8fbfa 52%, #e8f4ef 100%) !important;
  background-attachment: fixed;
  color: var(--ui-ink) !important;
}
.app { min-height: 100vh; }
.sidebar {
  width: 282px !important;
  padding: 25px 17px 18px !important;
  background: linear-gradient(155deg, #08604f 0%, #064a3e 52%, #04392f 100%) !important;
  border-right: 1px solid rgba(255,255,255,.16) !important;
  box-shadow: 12px 0 38px rgba(3, 55, 45, .13) !important;
}
.brand {
  gap: 13px !important;
  padding: 5px 7px 31px !important;
  align-items: center !important;
}
body .brand-logo-static {
  width: 54px !important; height: 54px !important; flex: 0 0 54px !important;
  padding: 4px !important; border-radius: 16px !important;
  background: #fff !important; box-shadow: 0 10px 24px rgba(0,0,0,.17) !important;
}
body .brand h2 { color: #fff !important; font-size: 22px !important; line-height: 1.2 !important; letter-spacing: -.45px !important; }
body .brand small { display: block; color: #dcf6ec !important; font-size: 12px !important; line-height: 1.45 !important; margin-top: 4px; }
body .nav-title { color: #c4e6db !important; font-size: 12px !important; letter-spacing: 1.5px !important; font-weight: 800 !important; margin: 0 11px 12px !important; opacity: .83 !important; }
body .nav { gap: 8px !important; }
body .nav button {
  color: #e3f5ef !important; min-height: 55px !important; padding: 13px 14px !important;
  border: 1px solid transparent !important; border-radius: 14px !important;
  gap: 13px !important; font-size: 16px !important; font-weight: 650 !important;
  transition: background .2s ease, transform .2s ease, border-color .2s ease, box-shadow .2s ease !important;
}
body .nav button:hover { background: rgba(255,255,255,.12) !important; border-color: rgba(255,255,255,.13) !important; transform: translateX(3px); }
body .nav button.active { color: #fff !important; background: linear-gradient(100deg, rgba(255,255,255,.20), rgba(255,255,255,.10)) !important; border-color: rgba(255,255,255,.18) !important; box-shadow: inset 4px 0 #a8f0d5, 0 8px 18px rgba(0,0,0,.08) !important; }
body .nav-icon { width: 24px !important; font-size: 21px !important; }
.sidebar-bottom { border-top: 1px solid rgba(255,255,255,.19) !important; padding-top: 19px !important; }
.customer-mini { padding: 8px 9px !important; margin-bottom: 12px !important; box-shadow: none !important; }
.customer-mini .avatar { width: 43px !important; height: 43px !important; background: #d9f4e9 !important; font-size: 15px !important; }
body .customer-mini strong { color: white !important; font-size: 15px !important; }
body .customer-mini span { color: #cfece2 !important; font-size: 12px !important; }
body .logout { min-height: 48px !important; border: 1px solid rgba(255,255,255,.13) !important; border-radius: 12px !important; font-size: 15px !important; font-weight: 700 !important; background: rgba(255,255,255,.10) !important; }
body .logout:hover { background: rgba(255,255,255,.18) !important; }
.main { margin-left: 282px !important; width: calc(100% - 282px) !important; min-width: 0 !important; padding: 0 !important; }
.topbar {
  height: 86px !important; padding: 0 clamp(22px, 3vw, 46px) !important;
  background: rgba(255,255,255,.88) !important; border-bottom: 1px solid #dfede7 !important;
  box-shadow: 0 8px 26px rgba(12,70,55,.045) !important;
  backdrop-filter: blur(20px) !important; -webkit-backdrop-filter: blur(20px) !important;
}
body .search { width: min(480px, 46vw) !important; }
body .search input {
  min-height: 54px !important; width: 100%; padding: 13px 16px 13px 45px !important;
  border: 1px solid #d4e8df !important; border-radius: 15px !important;
  background: #f9fdfb !important; color: #183e33 !important; font-size: 16px !important;
  box-shadow: inset 0 1px 2px rgba(15,75,58,.025) !important;
}
body .search input:focus { background: white !important; border-color: #62b99c !important; box-shadow: 0 0 0 4px rgba(68,176,142,.14) !important; }
body .search:before { left: 16px !important; top: 12px !important; font-size: 23px !important; color: #4e8271 !important; }
.top-actions { gap: 15px !important; }
body .icon-btn { width: 46px !important; height: 46px !important; border-radius: 13px !important; background: #eef8f3 !important; font-size: 22px !important; color: #176b55 !important; }
body .icon-btn:hover { background: #dff2e9 !important; }
body .user-chip { gap: 11px !important; font-size: 16px !important; color: #254b40 !important; }
body .user-chip .avatar { width: 44px !important; height: 44px !important; border: 3px solid #d8f0e5 !important; font-size: 14px !important; }
.page { max-width: 1900px !important; width: 100% !important; margin: 0 auto !important; padding: 34px clamp(22px, 3vw, 48px) 54px !important; }
.page-head { margin-bottom: 28px !important; gap: 18px !important; }
body .page-head h1, body h1 { color: #123d32 !important; font-size: clamp(34px, 2.45vw, 44px) !important; line-height: 1.18 !important; letter-spacing: -.9px !important; font-weight: 850 !important; }
body .page-head p { color: #58766b !important; font-size: 18px !important; line-height: 1.55 !important; }
body .btn { border-radius: 13px !important; font-weight: 750 !important; letter-spacing: .05px; }
body .btn:not(.light):not(.danger) { background: linear-gradient(135deg, #08765f, #08604f) !important; box-shadow: 0 8px 18px rgba(8,105,81,.16) !important; }
body .btn:not(.light):not(.danger):hover { background: linear-gradient(135deg, #0a856b, #076550) !important; transform: translateY(-1px); }
body .btn.light { color: #075b49 !important; border: 1px solid #cfe7dc !important; background: #fff !important; box-shadow: 0 4px 12px rgba(12,70,55,.05) !important; }
body .card, body .profile-card, body .profile-details {
  background: #fff !important; border: 1px solid #dfede6 !important; border-radius: 22px !important;
  box-shadow: 0 12px 34px rgba(12,70,55,.075) !important; overflow: hidden;
  transition: box-shadow .22s ease, transform .22s ease, border-color .22s ease !important;
}
body .card:hover { border-color: #c9e5d9 !important; box-shadow: 0 17px 40px rgba(12,70,55,.105) !important; }
/* Elevated welcome/banner area */
body .section#dashboard .welcome-card {
  min-height: 258px !important; height: auto !important; padding: 35px 39px !important;
  margin-bottom: 26px !important; border: 1px solid rgba(255,255,255,.28) !important;
  border-radius: 28px !important; background: linear-gradient(125deg, #075c4d, #0a8069 63%, #42a78a) !important;
  box-shadow: 0 20px 46px rgba(5,92,77,.21) !important; display: flex !important; align-items: center !important;
}
body .section#dashboard .welcome-card .banner-preview { position: absolute !important; inset: 0 !important; width: 100% !important; height: 100% !important; object-fit: cover !important; object-position: center 44% !important; z-index: 0 !important; }
body .section#dashboard .welcome-card:before { content: "" !important; position: absolute !important; inset: 0 !important; border-radius: inherit !important; background: linear-gradient(100deg, rgba(3,48,40,.95) 0%, rgba(4,80,65,.85) 54%, rgba(5,83,70,.53) 100%) !important; z-index: 1 !important; }
body .section#dashboard .welcome-card:after { content: "" !important; position: absolute !important; width: 320px !important; height: 320px !important; border: 1px solid rgba(255,255,255,.17) !important; border-radius: 50% !important; right: 5% !important; top: -155px !important; box-shadow: 0 0 0 34px rgba(255,255,255,.035), 0 0 0 68px rgba(255,255,255,.025) !important; pointer-events: none !important; z-index: 1 !important; }
body .section#dashboard .welcome-content { position: relative !important; z-index: 2 !important; max-width: min(850px, 82%) !important; }
body .section#dashboard .welcome-card .system-label { display: inline-block !important; padding: 8px 14px !important; margin-bottom: 13px !important; border-radius: 999px !important; border: 1px solid rgba(255,255,255,.44) !important; background: rgba(255,255,255,.13) !important; color: #fff !important; font-size: 13px !important; line-height: 1.45 !important; letter-spacing: .85px !important; font-weight: 800 !important; backdrop-filter: blur(8px); }
body .section#dashboard .welcome-card h2 { color: #fff !important; font-size: clamp(34px, 2.9vw, 44px) !important; font-weight: 850 !important; line-height: 1.15 !important; letter-spacing: -.9px !important; margin: 0 0 13px !important; }
body .section#dashboard .welcome-card p { color: #f3fffa !important; font-size: 18px !important; line-height: 1.6 !important; max-width: 800px !important; opacity: 1 !important; margin: 0 !important; }
body .section#dashboard .welcome-card .btn { margin-top: 19px !important; min-height: 52px !important; padding: 12px 19px !important; color: #075847 !important; background: #fff !important; border: 0 !important; border-radius: 13px !important; font-size: 16px !important; box-shadow: 0 8px 20px rgba(0,0,0,.13) !important; }
body .section#dashboard .welcome-avatar { position: relative !important; z-index: 2 !important; width: 72px !important; height: 72px !important; flex: 0 0 72px !important; font-size: 23px !important; border: 4px solid rgba(255,255,255,.55) !important; background: rgba(255,255,255,.95) !important; box-shadow: 0 12px 30px rgba(0,0,0,.16) !important; }
/* Large dashboard summary tiles with clear separation */
body .section#dashboard .grid.stats { grid-template-columns: repeat(3, minmax(0, 1fr)) !important; gap: 20px !important; margin-bottom: 27px !important; }
body .section#dashboard .grid.stats > .stat, body .page .card.stat {
  position: relative !important; min-width: 0 !important; min-height: 158px !important; padding: 25px 25px 24px !important;
  display: flex !important; align-items: center !important; justify-content: space-between !important; gap: 16px !important;
  border-radius: 22px !important; border: 1px solid #deeee6 !important; background: #fff !important;
  box-shadow: 0 12px 30px rgba(12,70,55,.07) !important; overflow: hidden !important;
}
body .section#dashboard .grid.stats > .stat:before { content: ""; position: absolute; left: 0; top: 0; width: 100%; height: 5px; background: linear-gradient(90deg, #08765f, #69c8a5); }
body .section#dashboard .grid.stats > .stat:nth-child(2):before { background: linear-gradient(90deg, #178f9b, #7dd9d0); }
body .section#dashboard .grid.stats > .stat:nth-child(3):before { background: linear-gradient(90deg, #c18b2b, #f0d391); }
body .section#dashboard .grid.stats > .stat:hover { transform: translateY(-4px) !important; box-shadow: 0 20px 42px rgba(12,70,55,.12) !important; }
body .section#dashboard .stat-label { color: #42675a !important; font-size: 18px !important; line-height: 1.35 !important; font-weight: 800 !important; margin-bottom: 10px !important; }
body .section#dashboard .stat-value { color: #103e32 !important; font-size: clamp(38px, 3vw, 49px) !important; line-height: 1.08 !important; font-weight: 900 !important; letter-spacing: -1.1px !important; overflow-wrap: anywhere !important; }
body .section#dashboard .stat-info { color: #61796f !important; font-size: 15px !important; line-height: 1.45 !important; margin-top: 9px !important; }
body .section#dashboard .stat-icon { display: grid !important; place-items: center !important; width: 61px !important; height: 61px !important; flex: 0 0 61px !important; border-radius: 18px !important; background: #e4f6ee !important; color: #087158 !important; font-size: 17px !important; font-weight: 900 !important; }
body .section#dashboard .grid.stats > .stat:nth-child(2) .stat-icon { background: #e5f6f5 !important; color: #147c82 !important; }
body .section#dashboard .grid.stats > .stat:nth-child(3) .stat-icon { background: #fff4de !important; color: #a87417 !important; }
body .section#dashboard .grid.stats > .stat:nth-child(3) .stat-value { font-size: clamp(28px, 2.4vw, 37px) !important; line-height: 1.18 !important; white-space: normal !important; }
/* Content cards and tables */
body .section#dashboard .two-col { grid-template-columns: minmax(0, 1.55fr) minmax(300px, .95fr) !important; gap: 24px !important; margin-top: 0 !important; }
body .section#dashboard .card-head, body .card-head { padding: 22px 25px !important; min-height: 72px; background: linear-gradient(180deg, #fff, #fbfefc) !important; border-bottom: 1px solid #e5f0eb !important; }
body .section#dashboard .card-head h3, body .card-head h3 { color: #173f33 !important; font-size: 22px !important; line-height: 1.35 !important; font-weight: 850 !important; }
body .section#dashboard .card-head a, body .card-head a { color: #08745d !important; font-size: 16px !important; font-weight: 800 !important; text-decoration: none !important; }
body .section#dashboard .card-head a:hover, body .card-head a:hover { text-decoration: underline !important; }
body .section#dashboard .card-body, body .card-body { padding: 23px 25px !important; }
body .section#dashboard .card-body:has(table), body .card-body:has(table) { overflow-x: auto !important; }
body .section#dashboard table, body .page table { width: 100% !important; border-collapse: separate !important; border-spacing: 0 !important; font-size: 16px !important; }
body .section#dashboard th, body .page th { color: #3b6053 !important; font-size: 15px !important; font-weight: 850 !important; line-height: 1.45 !important; text-align: left !important; padding: 16px 14px !important; background: #edf8f3 !important; border-bottom: 1px solid #dcebe4 !important; }
body .section#dashboard th:first-child, body .page th:first-child { border-radius: 9px 0 0 9px; }
body .section#dashboard th:last-child, body .page th:last-child { border-radius: 0 9px 9px 0; }
body .section#dashboard td, body .page td { color: #24483c !important; font-size: 16px !important; line-height: 1.5 !important; padding: 16px 14px !important; border-bottom: 1px solid #edf3f0 !important; vertical-align: middle; }
body .section#dashboard tbody tr:hover td, body .page tbody tr:hover td { background: #f5fbf8 !important; }
body .section#dashboard tbody tr:last-child td, body .page tbody tr:last-child td { border-bottom: 0 !important; }
body .badge { border-radius: 999px !important; font-size: 14px !important; font-weight: 800 !important; padding: 7px 11px !important; white-space: nowrap; }
body .quick-list { gap: 13px !important; }
body .quick-item { padding: 16px !important; gap: 14px !important; border: 1px solid #e0eee7 !important; border-radius: 16px !important; background: #fbfefc !important; transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease !important; }
body .quick-item:hover { transform: translateY(-2px) !important; border-color: #b9dfcf !important; box-shadow: 0 9px 20px rgba(12,70,55,.07) !important; }
body .quick-icon { width: 48px !important; height: 48px !important; flex: 0 0 48px !important; border-radius: 14px !important; background: linear-gradient(145deg, #e0f5eb, #f0fbf6) !important; color: #08745d !important; font-size: 16px !important; font-weight: 900 !important; }
body .quick-item strong { display: block !important; color: #21483b !important; font-size: 17px !important; font-weight: 850 !important; line-height: 1.4 !important; margin-bottom: 3px !important; }
body .quick-item span { display: block !important; color: #61796f !important; font-size: 15px !important; line-height: 1.45 !important; }
/* All non-dashboard pages inherit the cleaner, high contrast presentation too. */
body .section:not(#dashboard) .card { border-radius: 22px !important; }
body .section:not(#dashboard) .toolbar { gap: 12px !important; margin-bottom: 19px !important; }
body .toolbar input, body .toolbar select, body .form-control { border: 1px solid #d7e8e0 !important; border-radius: 12px !important; background: #fcfefd !important; color: #173f33 !important; }
body .toolbar input:focus, body .toolbar select:focus, body .form-control:focus { border-color: #58b895 !important; box-shadow: 0 0 0 4px rgba(70,177,139,.13) !important; outline: none !important; }
body .form-group label { color: #2a5143 !important; font-weight: 800 !important; }
body .profile-card, body .profile-details { border-radius: 22px !important; }
body .modal-wrap { background: rgba(4,40,32,.5) !important; backdrop-filter: blur(8px) !important; }
body .profile-modal { border: 1px solid rgba(255,255,255,.85) !important; border-radius: 24px !important; box-shadow: 0 25px 75px rgba(0,0,0,.24) !important; }
body .toast { border-radius: 14px !important; box-shadow: 0 15px 38px rgba(0,0,0,.2) !important; }

@media (max-width: 1250px) {
  .sidebar { width: 250px !important; }
  .main { margin-left: 250px !important; width: calc(100% - 250px) !important; }
  body .brand h2 { font-size: 20px !important; }
  body .nav button { font-size: 15px !important; padding: 12px !important; }
  body .section#dashboard .grid.stats > .stat { padding: 22px 20px !important; }
  body .section#dashboard .stat-icon { width: 54px !important; height: 54px !important; flex-basis: 54px !important; }
}
@media (max-width: 1050px) {
  body .section#dashboard .grid.stats { grid-template-columns: repeat(2, minmax(0, 1fr)) !important; }
  body .section#dashboard .two-col { grid-template-columns: 1fr !important; }
  body .section#dashboard .welcome-card { min-height: 245px !important; }
}
@media (max-width: 720px) {
  .sidebar { width: 76px !important; padding: 14px 8px !important; }
  .brand { justify-content: center !important; padding: 5px 0 25px !important; }
  body .brand-logo-static { width: 48px !important; height: 48px !important; flex-basis: 48px !important; }
  body .brand h2, body .brand small, body .nav-title, body .nav button span:not(.nav-icon), body .customer-mini div, body .logout { display: none !important; }
  body .nav button { justify-content: center !important; padding: 13px 7px !important; min-height: 54px !important; }
  body .nav-icon { width: auto !important; font-size: 21px !important; }
  .main { margin-left: 76px !important; width: calc(100% - 76px) !important; }
  .topbar { height: 72px !important; padding: 0 12px !important; gap: 8px !important; }
  body .search { width: min(55vw, 350px) !important; }
  body .search input { min-height: 47px !important; padding: 10px 9px 10px 33px !important; font-size: 14px !important; }
  body .search:before { left: 10px !important; top: 10px !important; font-size: 19px !important; }
  .top-actions { gap: 7px !important; }
  body .icon-btn { width: 39px !important; height: 39px !important; font-size: 18px !important; }
  body .user-chip { gap: 5px !important; font-size: 13px !important; }
  body .user-chip .avatar { width: 34px !important; height: 34px !important; font-size: 12px !important; }
  .page { padding: 22px 14px 34px !important; }
  body .page-head h1, body h1 { font-size: 30px !important; }
  body .page-head p { font-size: 16px !important; }
  body .section#dashboard .welcome-card { min-height: 0 !important; height: auto !important; padding: 24px 21px !important; border-radius: 22px !important; margin-bottom: 17px !important; }
  body .section#dashboard .welcome-content { max-width: 100% !important; }
  body .section#dashboard .welcome-card .system-label { font-size: 11px !important; line-height: 1.5 !important; }
  body .section#dashboard .welcome-card h2 { font-size: 28px !important; line-height: 1.2 !important; }
  body .section#dashboard .welcome-card p { font-size: 15px !important; line-height: 1.55 !important; }
  body .section#dashboard .welcome-card .btn { font-size: 14px !important; min-height: 45px !important; padding: 10px 13px !important; }
  body .section#dashboard .welcome-avatar { display: none !important; }
  body .section#dashboard .grid.stats { grid-template-columns: 1fr !important; gap: 13px !important; margin-bottom: 18px !important; }
  body .section#dashboard .grid.stats > .stat, body .page .card.stat { min-height: 119px !important; padding: 20px 18px !important; border-radius: 18px !important; }
  body .section#dashboard .stat-label { font-size: 16px !important; }
  body .section#dashboard .stat-value { font-size: 37px !important; }
  body .section#dashboard .stat-info { font-size: 14px !important; }
  body .section#dashboard .grid.stats > .stat:nth-child(3) .stat-value { font-size: 29px !important; }
  body .section#dashboard .stat-icon { width: 48px !important; height: 48px !important; flex-basis: 48px !important; border-radius: 14px !important; }
  body .section#dashboard .card-head, body .card-head { padding: 17px 18px !important; min-height: 62px !important; }
  body .section#dashboard .card-head h3, body .card-head h3 { font-size: 18px !important; }
  body .section#dashboard .card-body, body .card-body { padding: 17px 18px !important; }
  body .section#dashboard th, body .page th { font-size: 13px !important; padding: 12px 10px !important; }
  body .section#dashboard td, body .page td { font-size: 14px !important; padding: 12px 10px !important; }
}
@media (prefers-reduced-motion: reduce) {
  *, *::before, *::after { animation-duration: .01ms !important; transition-duration: .01ms !important; scroll-behavior: auto !important; }
}
</style>



<style id="circular-avatar-photo-fix">
/* Keep every customer photo neatly clipped inside its circular avatar. */
body .avatar,
body .profile-avatar,
body .welcome-avatar {
  border-radius: 50% !important;
  overflow: hidden !important;
  padding: 0 !important;
  position: relative !important;
  isolation: isolate;
  flex-shrink: 0;
}

body .avatar img,
body .profile-avatar img,
body .welcome-avatar img {
  display: block !important;
  width: 100% !important;
  height: 100% !important;
  max-width: none !important;
  max-height: none !important;
  min-width: 0 !important;
  min-height: 0 !important;
  object-fit: cover !important;
  object-position: center center !important;
  border-radius: 50% !important;
  margin: 0 !important;
  padding: 0 !important;
}

/* Preserve circular framing at all of the dashboard's responsive sizes. */
#sideAvatar, #topAvatar, #profileAvatar, #welcomeAvatar {
  border-radius: 50% !important;
  overflow: hidden !important;
}
#sideAvatar img, #topAvatar img, #profileAvatar img, #welcomeAvatar img {
  width: 100% !important;
  height: 100% !important;
  object-fit: cover !important;
  object-position: center !important;
  border-radius: 50% !important;
}
</style>


<style id="customer-history-search-fix">
  /* Medication History: one date filter and a search that works with it. */
  .history-toolbar { align-items: center; }
  .history-toolbar #historySearch { flex: 1 1 300px; min-width: 220px; }
  .history-date-control {
    display: inline-flex; align-items: center; gap: 10px; flex: 0 0 auto;
    color: var(--text); font-size: 13px; font-weight: 700; white-space: nowrap;
  }
  .history-date-control input {
    min-width: 165px; min-height: 44px; border: 1px solid var(--line);
    border-radius: 8px; padding: 10px 11px; background: #fff; color: var(--text);
  }
  @media (max-width: 720px) {
    .history-toolbar { align-items: stretch; }
    .history-toolbar #historySearch { flex-basis: 100%; min-width: 0; }
    .history-date-control { width: 100%; justify-content: space-between; }
    .history-date-control input { flex: 1; min-width: 0; }
  }
</style>


<style id="profile-avatar-navigation-style">
  #topAvatar.profile-avatar-trigger { cursor: pointer !important; transition: transform .18s ease, box-shadow .18s ease !important; }
  #topAvatar.profile-avatar-trigger:hover { transform: translateY(-1px) scale(1.04); box-shadow: 0 0 0 4px rgba(8, 119, 101, .13) !important; }
  #topAvatar.profile-avatar-trigger:focus-visible { outline: 3px solid #37a789 !important; outline-offset: 3px; }
</style>

<style id="comfortable-100-percent-layout">
/* Balanced customer dashboard sizing for a normal 100% browser zoom. */
:root {
  --green: #075c4d;
  --green2: #0a745f;
  --green3: #e1f4ed;
  --line: #d9e9e2;
  --text: #173b33;
  --muted: #5d786e;
  --shadow: 0 10px 28px rgba(7, 77, 62, .075);
}
html { font-size: 16px !important; scroll-behavior: smooth; }
body {
  font-size: 14px !important;
  line-height: 1.5 !important;
  color: #173b33 !important;
  background:
    radial-gradient(ellipse at 8% 0%, rgba(179, 232, 213, .42), transparent 32%),
    radial-gradient(ellipse at 95% 12%, rgba(192, 227, 219, .34), transparent 28%),
    linear-gradient(135deg, #eef7f3 0%, #f8fbf9 54%, #eaf5f0 100%) !important;
  background-attachment: fixed;
}
button, input, select, textarea { font: inherit; }

/* Sidebar and brand */
body .sidebar {
  width: 248px !important;
  padding: 22px 14px 16px !important;
  background: linear-gradient(160deg, rgba(7, 92, 77, .97), rgba(4, 60, 50, .98)) !important;
  border-right: 1px solid rgba(255,255,255,.18) !important;
  box-shadow: 8px 0 28px rgba(3,54,45,.12) !important;
  backdrop-filter: blur(18px);
  -webkit-backdrop-filter: blur(18px);
}
body .brand { gap: 11px !important; padding: 4px 7px 25px !important; }
body .brand-logo-static {
  width: 44px !important; height: 44px !important; flex: 0 0 44px !important;
  padding: 3px !important; border-radius: 12px !important;
  background: #fff !important; box-shadow: 0 6px 16px rgba(0,0,0,.13) !important;
}
body .brand-logo-static img { width: 100% !important; height: 100% !important; object-fit: contain !important; }
body .brand h2 { font-size: 17px !important; line-height: 1.2 !important; letter-spacing: -.25px !important; }
body .brand small { font-size: 10px !important; line-height: 1.4 !important; }
body .nav-title { margin: 2px 9px 10px !important; font-size: 10px !important; letter-spacing: 1.2px !important; }
body .nav { gap: 6px !important; }
body .nav button {
  min-height: 43px !important; padding: 10px 11px !important; gap: 10px !important;
  font-size: 13px !important; line-height: 1.35 !important; font-weight: 600 !important;
  border: 1px solid transparent !important; border-radius: 10px !important;
}
body .nav button:hover { transform: translateX(2px); background: rgba(255,255,255,.12) !important; }
body .nav button.active { background: rgba(255,255,255,.16) !important; box-shadow: inset 3px 0 #b6ead5 !important; }
body .nav-icon { flex: 0 0 21px !important; width: 21px !important; font-size: 16px !important; }
body .sidebar-bottom { padding-top: 14px !important; }
body .customer-mini { gap: 9px !important; margin-bottom: 11px !important; }
body .customer-mini strong { font-size: 12px !important; line-height: 1.35 !important; }
body .customer-mini span { font-size: 10px !important; line-height: 1.4 !important; }

/* Force avatars/photos to remain square and circular at every size. */
body .avatar, body .profile-avatar, body .welcome-avatar {
  box-sizing: border-box !important;
  aspect-ratio: 1 / 1 !important;
  flex: 0 0 auto !important;
  border-radius: 50% !important;
  overflow: hidden !important;
  padding: 0 !important;
}
body .customer-mini .avatar { width: 38px !important; height: 38px !important; min-width: 38px !important; min-height: 38px !important; }
body .user-chip .avatar { width: 40px !important; height: 40px !important; min-width: 40px !important; min-height: 40px !important; }
body .profile-avatar { width: 88px !important; height: 88px !important; min-width: 88px !important; min-height: 88px !important; margin: 0 auto 12px !important; }
body .welcome-avatar { width: 56px !important; height: 56px !important; min-width: 56px !important; min-height: 56px !important; flex: 0 0 56px !important; }
body .avatar img, body .profile-avatar img, body .welcome-avatar img {
  display: block !important; width: 100% !important; height: 100% !important;
  min-width: 100% !important; min-height: 100% !important; max-width: 100% !important; max-height: 100% !important;
  object-fit: cover !important; object-position: center !important; border-radius: 50% !important;
}
body #sideAvatar, body #topAvatar, body #profileAvatar, body #welcomeAvatar { aspect-ratio: 1 / 1 !important; border-radius: 50% !important; }

/* Header and search */
body .main { margin-left: 248px !important; width: calc(100% - 248px) !important; min-width: 0 !important; padding: 0 !important; }
body .topbar {
  position: sticky !important; top: 0 !important; z-index: 5 !important;
  min-height: 68px !important; height: 68px !important; padding: 0 26px !important; gap: 16px !important;
  background: rgba(255,255,255,.82) !important; border-bottom: 1px solid rgba(211,231,222,.9) !important;
  box-shadow: 0 5px 18px rgba(8,70,55,.045) !important;
  backdrop-filter: blur(16px) !important; -webkit-backdrop-filter: blur(16px) !important;
}
body .search { width: min(420px, 48vw) !important; }
body .search input {
  width: 100% !important; min-height: 42px !important; height: 42px !important;
  padding: 9px 13px 9px 38px !important; border: 1px solid #d3e5dc !important;
  border-radius: 11px !important; background: rgba(255,255,255,.84) !important;
  font-size: 13px !important; line-height: 1.4 !important;
}
body .search:before { left: 12px !important; top: 7px !important; font-size: 19px !important; }
body .top-actions { gap: 10px !important; }
body .user-chip { gap: 9px !important; font-size: 13px !important; }
body .user-chip strong { font-size: 13px !important; font-weight: 700 !important; }

/* Main page and headings */
body .page { width: 100% !important; max-width: 1600px !important; margin: 0 auto !important; padding: 25px 28px 38px !important; }
body .page-head { margin-bottom: 19px !important; gap: 14px !important; }
body .page-head h1, body h1 { font-size: clamp(24px, 2vw, 30px) !important; line-height: 1.2 !important; letter-spacing: -.45px !important; font-weight: 800 !important; }
body .page-head p { margin-top: 5px !important; font-size: 13px !important; line-height: 1.5 !important; color: #5d786e !important; }
body .page p, body .page label, body .page li { font-size: 14px !important; line-height: 1.5 !important; }
body .btn, body button.btn {
  min-height: 40px !important; padding: 9px 14px !important; border-radius: 10px !important;
  font-size: 13px !important; line-height: 1.35 !important; font-weight: 700 !important;
  box-shadow: 0 5px 12px rgba(7,92,77,.10) !important;
}
body .btn.light { background: rgba(255,255,255,.9) !important; border: 1px solid #d2e5db !important; }

/* Glass surfaces: translucent, readable, and not oversized */
body .card, body .profile-card, body .profile-details {
  background: rgba(255,255,255,.80) !important;
  border: 1px solid rgba(255,255,255,.92) !important;
  border-radius: 16px !important;
  box-shadow: 0 10px 26px rgba(9,70,55,.075), inset 0 1px 0 rgba(255,255,255,.88) !important;
  backdrop-filter: blur(14px) saturate(125%) !important;
  -webkit-backdrop-filter: blur(14px) saturate(125%) !important;
  overflow: hidden;
  transition: box-shadow .2s ease, transform .2s ease, border-color .2s ease !important;
}
body .card:hover { box-shadow: 0 14px 30px rgba(9,70,55,.10), inset 0 1px 0 rgba(255,255,255,.95) !important; border-color: #d4e9df !important; }
body .card-head { min-height: 0 !important; padding: 15px 17px !important; background: rgba(245,251,248,.72) !important; border-bottom: 1px solid rgba(215,233,224,.85) !important; }
body .card-head h3 { font-size: 15px !important; line-height: 1.35 !important; font-weight: 750 !important; }
body .card-head a { font-size: 12px !important; font-weight: 700 !important; }
body .card-body { padding: 16px 17px !important; }
body .grid { gap: 15px !important; }
body .stats { gap: 15px !important; margin-bottom: 16px !important; }
body .section#dashboard .grid.stats { grid-template-columns: repeat(3, minmax(0, 1fr)) !important; gap: 15px !important; margin-bottom: 18px !important; }
body .section#dashboard .grid.stats > .stat, body .page .card.stat {
  min-width: 0 !important; min-height: 112px !important; padding: 18px !important;
  gap: 12px !important; border-radius: 16px !important; background: rgba(255,255,255,.88) !important;
  border: 1px solid rgba(219,236,227,.95) !important; box-shadow: 0 9px 23px rgba(12,70,55,.06) !important;
}
body .section#dashboard .grid.stats > .stat:before { height: 3px !important; }
body .section#dashboard .stat-label, body .stat-label { font-size: 13px !important; line-height: 1.35 !important; font-weight: 700 !important; color: #42675a !important; margin-bottom: 6px !important; }
body .section#dashboard .stat-value, body .stat-value { font-size: clamp(25px, 2vw, 32px) !important; line-height: 1.1 !important; font-weight: 800 !important; letter-spacing: -.5px !important; }
body .section#dashboard .stat-info, body .stat-info { font-size: 11px !important; line-height: 1.4 !important; color: #61796f !important; margin-top: 6px !important; }
body .section#dashboard .stat-icon { width: 42px !important; height: 42px !important; min-width: 42px !important; flex: 0 0 42px !important; border-radius: 12px !important; font-size: 13px !important; }
body .section#dashboard .grid.stats > .stat:nth-child(3) .stat-value { font-size: clamp(21px, 1.7vw, 27px) !important; white-space: normal !important; overflow-wrap: anywhere !important; }
body .two-col { grid-template-columns: minmax(0, 1.5fr) minmax(260px, 1fr) !important; gap: 15px !important; margin-top: 15px !important; }

/* Welcome banner */
body .section#dashboard .welcome-card {
  height: auto !important; min-height: 178px !important; padding: 23px 25px !important;
  margin-bottom: 18px !important; gap: 18px !important; border-radius: 18px !important;
  background: linear-gradient(120deg, rgba(5,83,69,.97), rgba(7,119,96,.88)) !important;
  box-shadow: 0 13px 30px rgba(5,92,77,.15) !important;
}
body .section#dashboard .welcome-card .banner-preview { position: absolute !important; inset: 0 !important; width: 100% !important; height: 100% !important; object-fit: cover !important; object-position: center 44% !important; z-index: 0 !important; }
body .section#dashboard .welcome-card:before { content: "" !important; position: absolute !important; inset: 0 !important; background: linear-gradient(100deg, rgba(3,48,40,.93), rgba(4,80,65,.80) 57%, rgba(5,83,70,.48)) !important; z-index: 1 !important; border-radius: inherit !important; }
body .section#dashboard .welcome-card:after { width: 210px !important; height: 210px !important; top: -110px !important; right: 6% !important; z-index: 1 !important; }
body .section#dashboard .welcome-content { position: relative !important; z-index: 2 !important; max-width: min(700px, 84%) !important; padding: 0 !important; }
body .section#dashboard .welcome-card .system-label { padding: 5px 9px !important; margin-bottom: 8px !important; font-size: 10px !important; line-height: 1.4 !important; font-weight: 800 !important; border-radius: 999px !important; }
body .section#dashboard .welcome-card h2 { margin: 0 0 7px !important; color: white !important; font-size: clamp(24px, 2vw, 31px) !important; line-height: 1.2 !important; font-weight: 800 !important; letter-spacing: -.4px !important; }
body .section#dashboard .welcome-card p { max-width: 690px !important; color: #effbf6 !important; font-size: 13px !important; line-height: 1.55 !important; margin: 0 !important; }
body .section#dashboard .welcome-card .btn { margin-top: 11px !important; min-height: 38px !important; padding: 8px 13px !important; font-size: 12px !important; }
body .section#dashboard .welcome-avatar { position: relative !important; z-index: 2 !important; border: 3px solid rgba(255,255,255,.56) !important; box-shadow: 0 8px 20px rgba(0,0,0,.14) !important; }

/* Recent tables and quick information */
body .page .card-body:has(table) { overflow-x: auto !important; }
body .page table { width: 100% !important; border-collapse: separate !important; border-spacing: 0 !important; font-size: 12px !important; line-height: 1.4 !important; white-space: nowrap !important; }
body .page th { color: #416358 !important; font-size: 11px !important; font-weight: 750 !important; padding: 11px 10px !important; background: rgba(235,247,241,.9) !important; }
body .page td { color: #24483c !important; font-size: 12px !important; line-height: 1.4 !important; padding: 11px 10px !important; border-bottom: 1px solid #e9f1ed !important; }
body .page tbody tr:hover td { background: rgba(242,250,246,.9) !important; }
body .badge { font-size: 10px !important; padding: 5px 8px !important; line-height: 1.2 !important; font-weight: 750 !important; }
body .quick-list { gap: 9px !important; }
body .quick-item { padding: 12px !important; gap: 11px !important; border: 1px solid rgba(216,234,225,.92) !important; border-radius: 12px !important; background: rgba(255,255,255,.67) !important; }
body .quick-icon { width: 36px !important; height: 36px !important; flex: 0 0 36px !important; border-radius: 10px !important; font-size: 12px !important; }
body .quick-item strong { font-size: 13px !important; line-height: 1.35 !important; margin-bottom: 2px !important; }
body .quick-item span { font-size: 11px !important; line-height: 1.4 !important; }

/* Search/filter controls, profile details and modal */
body .toolbar { gap: 9px !important; margin-bottom: 14px !important; }
body .toolbar input, body .toolbar select, body .form-control, body .profile-modal-field input, body .profile-modal-field select {
  min-height: 41px !important; height: auto !important; padding: 9px 11px !important;
  border: 1px solid #d3e5dc !important; border-radius: 9px !important; background: rgba(255,255,255,.88) !important;
  color: #173b33 !important; font-size: 13px !important; line-height: 1.4 !important;
}
body .toolbar input { min-width: 180px; }
body .form-group label, body .profile-modal-field label { font-size: 12px !important; line-height: 1.4 !important; }
body .profile-grid { grid-template-columns: minmax(220px, 285px) minmax(0, 1fr) !important; gap: 16px !important; }
body .profile-card, body .profile-details { padding: 22px !important; }
body .profile-card h2 { font-size: 19px !important; line-height: 1.3 !important; }
body .profile-card p { font-size: 12px !important; }
body .profile-details h3 { font-size: 16px !important; line-height: 1.35 !important; margin-bottom: 14px !important; }
body .profile-info { gap: 10px !important; }
body .info-box { padding: 12px !important; border: 1px solid #deebe5 !important; border-radius: 10px !important; background: rgba(248,252,250,.85) !important; }
body .info-box label { font-size: 11px !important; margin-bottom: 4px !important; }
body .info-box strong { font-size: 13px !important; line-height: 1.45 !important; overflow-wrap: anywhere !important; }
body .profile-modal { width: min(620px, 94vw) !important; max-height: 88vh !important; overflow-y: auto !important; padding: 24px !important; border-radius: 18px !important; background: rgba(250,255,253,.96) !important; }
body .profile-modal h2 { font-size: 21px !important; line-height: 1.25 !important; }
body .profile-modal p, body .profile-modal .modal-subtitle { font-size: 12px !important; line-height: 1.5 !important; }
body .profile-modal-error { font-size: 12px !important; }
body .toast { font-size: 13px !important; line-height: 1.4 !important; padding: 12px 16px !important; border-radius: 11px !important; }

@media (max-width: 1120px) {
  body .sidebar { width: 220px !important; }
  body .main { margin-left: 220px !important; width: calc(100% - 220px) !important; }
  body .page { padding: 22px 20px 32px !important; }
  body .section#dashboard .grid.stats { grid-template-columns: repeat(2, minmax(0,1fr)) !important; }
  body .section#dashboard .two-col { grid-template-columns: minmax(0,1fr) !important; }
}
@media (max-width: 760px) {
  body .sidebar { width: 68px !important; padding: 12px 7px !important; }
  body .brand { justify-content: center !important; padding: 4px 0 21px !important; gap: 0 !important; }
  body .brand-logo-static { width: 43px !important; height: 43px !important; flex-basis: 43px !important; }
  body .brand h2, body .brand small, body .nav-title, body .nav button span:not(.nav-icon), body .customer-mini > div:not(.avatar), body .logout { display: none !important; }
  body .nav button { justify-content: center !important; padding: 11px 5px !important; min-height: 43px !important; }
  body .nav-icon { width: auto !important; font-size: 18px !important; }
  body .main { margin-left: 68px !important; width: calc(100% - 68px) !important; }
  body .topbar { min-height: 60px !important; height: 60px !important; padding: 8px 10px !important; gap: 8px !important; }
  body .search { width: min(56vw, 330px) !important; }
  body .search input { min-height: 39px !important; height: 39px !important; padding: 8px 7px 8px 29px !important; font-size: 12px !important; }
  body .search:before { left: 9px !important; top: 7px !important; font-size: 17px !important; }
  body .user-chip { gap: 4px !important; }
  body .user-chip strong { display: none !important; }
  body .user-chip .avatar { width: 34px !important; height: 34px !important; min-width: 34px !important; min-height: 34px !important; }
  body .page { padding: 18px 13px 26px !important; }
  body .page-head { align-items: flex-start !important; flex-direction: column !important; margin-bottom: 16px !important; }
  body .page-head h1, body h1 { font-size: 25px !important; }
  body .page-head p { font-size: 12px !important; }
  body .section#dashboard .welcome-card { min-height: 0 !important; height: auto !important; padding: 19px !important; align-items: flex-start !important; }
  body .section#dashboard .welcome-content { max-width: 100% !important; }
  body .section#dashboard .welcome-card h2 { font-size: 24px !important; }
  body .section#dashboard .welcome-card p { font-size: 12px !important; }
  body .section#dashboard .welcome-avatar { display: none !important; }
  body .section#dashboard .grid.stats { grid-template-columns: 1fr !important; gap: 10px !important; }
  body .section#dashboard .grid.stats > .stat { min-height: 92px !important; padding: 15px !important; }
  body .section#dashboard .stat-label { font-size: 12px !important; }
  body .section#dashboard .stat-value { font-size: 28px !important; }
  body .section#dashboard .grid.stats > .stat:nth-child(3) .stat-value { font-size: 23px !important; }
  body .card-head { padding: 14px !important; }
  body .card-head h3 { font-size: 15px !important; }
  body .card-body { padding: 14px !important; }
  body .profile-grid, body .profile-info { grid-template-columns: 1fr !important; }
  body .profile-card, body .profile-details { padding: 18px !important; }
  body .profile-modal { padding: 19px !important; max-height: 88vh !important; }
  body .profile-modal-grid { grid-template-columns: 1fr !important; }
  body .profile-modal-field.full { grid-column: auto !important; }
  body .toolbar input { min-width: 0 !important; width: 100% !important; }
  body .history-toolbar { grid-template-columns: 1fr !important; }
}
@media (prefers-reduced-motion: reduce) {
  *, *::before, *::after { animation-duration: .01ms !important; transition-duration: .01ms !important; scroll-behavior: auto !important; }
}
</style>


<style id="hamburger-navbar-update">
/* Customer dashboard: use an off-canvas hamburger navigation at every screen size. */
:root { --customer-nav-width: 285px; }
html { scroll-behavior: smooth; }
body.nav-open { overflow: hidden; }
body .sidebar#customerSidebar {
  position: fixed !important;
  left: 0 !important; top: 0 !important; bottom: 0 !important;
  width: min(var(--customer-nav-width), 88vw) !important;
  height: 100vh !important; height: 100dvh !important;
  padding: 22px 16px !important;
  display: flex !important;
  flex-direction: column !important;
  overflow-y: auto !important;
  overscroll-behavior: contain;
  z-index: 1200 !important;
  transform: translateX(-105%) !important;
  visibility: hidden !important;
  transition: transform .26s ease, visibility .26s ease !important;
  box-shadow: 14px 0 38px rgba(2, 43, 36, .22) !important;
}
body .sidebar#customerSidebar.is-open {
  transform: translateX(0) !important;
  visibility: visible !important;
}
body .sidebar#customerSidebar .brand {
  display: flex !important; justify-content: flex-start !important;
  gap: 12px !important; padding: 5px 8px 26px !important;
}
body .sidebar#customerSidebar .brand-mark,
body .sidebar#customerSidebar .brand-logo-static {
  display: grid !important; flex: 0 0 46px !important;
  width: 46px !important; height: 46px !important;
}
body .sidebar#customerSidebar .brand h2 {
  display: block !important; color: #fff !important;
  font-size: 19px !important; line-height: 1.25 !important;
}
body .sidebar#customerSidebar .brand small {
  display: block !important; font-size: 11px !important;
  line-height: 1.4 !important; opacity: .82 !important;
}
body .sidebar#customerSidebar .nav-title {
  display: block !important; margin: 4px 10px 11px !important;
  font-size: 11px !important; letter-spacing: 1.2px !important;
}
body .sidebar#customerSidebar .nav { display: flex !important; flex-direction: column !important; gap: 7px !important; }
body .sidebar#customerSidebar .nav button {
  display: flex !important; justify-content: flex-start !important;
  width: 100% !important; min-height: 46px !important;
  padding: 12px 13px !important; gap: 12px !important;
  border-radius: 11px !important; font-size: 14px !important;
  line-height: 1.4 !important; text-align: left !important;
}
body .sidebar#customerSidebar .nav button span {
  display: inline !important; visibility: visible !important;
}
body .sidebar#customerSidebar .nav button .nav-icon {
  display: inline-block !important; flex: 0 0 22px !important;
  width: 22px !important; font-size: 17px !important;
}
body .sidebar#customerSidebar .sidebar-bottom {
  display: block !important; margin-top: auto !important;
  padding-top: 15px !important;
}
body .sidebar#customerSidebar .customer-mini {
  display: flex !important; align-items: center !important;
  gap: 10px !important; margin-bottom: 13px !important;
}
body .sidebar#customerSidebar .customer-mini .avatar {
  display: grid !important; flex: 0 0 40px !important;
  width: 40px !important; height: 40px !important;
}
body .sidebar#customerSidebar .customer-mini > div:not(.avatar) { display: block !important; min-width: 0; }
body .sidebar#customerSidebar .customer-mini strong { display: block !important; font-size: 13px !important; line-height: 1.35 !important; }
body .sidebar#customerSidebar .customer-mini span { display: block !important; font-size: 11px !important; line-height: 1.4 !important; }
body .sidebar#customerSidebar .logout {
  display: block !important; width: 100% !important; min-height: 43px !important;
  padding: 11px 12px !important; border-radius: 10px !important;
  font-size: 13px !important; text-align: center !important;
}
.nav-backdrop {
  position: fixed; inset: 0; z-index: 1100;
  background: rgba(4, 35, 30, .48);
  opacity: 0; visibility: hidden; pointer-events: none;
  transition: opacity .24s ease, visibility .24s ease;
  backdrop-filter: blur(3px); -webkit-backdrop-filter: blur(3px);
}
.nav-backdrop.show { opacity: 1; visibility: visible; pointer-events: auto; }
body .main {
  margin-left: 0 !important; width: 100% !important;
  min-width: 0 !important; padding: 0 !important;
}
body .topbar {
  position: sticky !important; top: 0 !important; z-index: 100 !important;
  display: flex !important; align-items: center !important; gap: 14px !important;
  min-height: 72px !important; height: auto !important;
  padding: 12px clamp(14px, 2.5vw, 32px) !important;
}
.hamburger-toggle {
  appearance: none; -webkit-appearance: none;
  flex: 0 0 44px; width: 44px !important; height: 44px !important;
  min-width: 44px !important; min-height: 44px !important;
  display: inline-flex !important; flex-direction: column !important;
  align-items: center !important; justify-content: center !important;
  gap: 5px !important; padding: 0 !important; margin: 0 !important;
  border: 1px solid #d6e8e0 !important; border-radius: 12px !important;
  background: #fff !important; color: #075c4d !important;
  box-shadow: 0 3px 10px rgba(7, 92, 77, .06) !important;
  cursor: pointer; transition: background .18s, border-color .18s, transform .18s;
}
.hamburger-toggle:hover { background: #eef8f3 !important; border-color: #a9d8c7 !important; }
.hamburger-toggle:active { transform: scale(.97); }
.hamburger-toggle span {
  display: block !important; width: 20px !important; height: 2px !important;
  border-radius: 3px; background: currentColor !important;
  transition: transform .2s ease, opacity .2s ease;
}
.hamburger-toggle[aria-expanded="true"] span:first-child { transform: translateY(7px) rotate(45deg); }
.hamburger-toggle[aria-expanded="true"] span:nth-child(2) { opacity: 0; }
.hamburger-toggle[aria-expanded="true"] span:last-child { transform: translateY(-7px) rotate(-45deg); }
body .topbar .search {
  flex: 1 1 320px !important; width: auto !important;
  max-width: 500px !important; min-width: 0 !important;
}
body .topbar .top-actions { margin-left: auto; flex: 0 0 auto; }
body .topbar .search input { width: 100% !important; min-width: 0 !important; }
@media (max-width: 720px) {
  body .topbar { gap: 9px !important; min-height: 65px !important; padding: 10px 12px !important; }
  .hamburger-toggle { flex-basis: 40px; width: 40px !important; height: 40px !important; min-width: 40px !important; min-height: 40px !important; }
  body .topbar .search { flex: 1 1 100px !important; width: auto !important; max-width: none !important; }
  body .topbar .search input { min-height: 42px !important; padding: 9px 9px 9px 32px !important; font-size: 13px !important; }
  body .topbar .search:before { left: 10px !important; top: 7px !important; font-size: 18px !important; }
  body .topbar .user-chip { gap: 6px !important; }
  body .topbar .user-chip .avatar { width: 34px !important; height: 34px !important; flex: 0 0 34px !important; }
}
@media (prefers-reduced-motion: reduce) {
  .sidebar#customerSidebar, .nav-backdrop, .hamburger-toggle span { transition: none !important; }
}
</style>

</head>

<body>

<div class="app">

<!-- =========================================
     SIDEBAR
========================================= -->

<aside class="sidebar" id="customerSidebar" aria-label="Customer navigation">

    <div class="brand">

        <!-- Set your logo filename/path here. Example: images/medical-archives-logo.png -->
        <div class="brand-mark brand-logo-static" aria-label="Medical Archives logo">
            <img src="LOGO- Medical ARCHIEVES.png" alt="Medical Archives logo">
        </div>

        <div>
            <h2>Medical Archives</h2>
            <small>Digital Prescription Records</small>
        </div>

    </div>


    <div class="nav-title">
        Customer Menu
    </div>


    <nav class="nav">

        <button
            class="active"
            data-page="dashboard"
        >
            <span class="nav-icon">▦</span>
            <span>Dashboard</span>
        </button>


        <button
            data-page="prescriptions"
        >
            <span class="nav-icon">▤</span>
            <span>My Prescriptions</span>
        </button>


        <button
            data-page="history"
        >
            <span class="nav-icon">◷</span>
            <span>Medication History</span>
        </button>


        <button
            data-page="profile"
        >
            <span class="nav-icon">♙</span>
            <span>My Profile</span>
        </button>

    </nav>


    <div class="sidebar-bottom">

        <div class="customer-mini">

            <div
                class="avatar"
                id="sideAvatar"
            >
                JD
            </div>

            <div>

                <strong id="sideName">
                    Juan Dela Cruz
                </strong>

                <span>
                    Customer
                </span>

            </div>

        </div>


        <button
            class="logout"
            onclick="window.location.href='../logout.php'"
        >
            Logout
        </button>

    </div>

</aside>

<div class="nav-backdrop" id="navBackdrop" aria-hidden="true"></div>

<!-- =========================================
     MAIN
========================================= -->

<main class="main">

<header class="topbar">

    <button
        type="button"
        class="hamburger-toggle"
        id="hamburgerToggle"
        aria-label="Open navigation menu"
        aria-controls="customerSidebar"
        aria-expanded="false"
        title="Toggle navigation menu"
    >
        <span></span><span></span><span></span>
    </button>

    <div class="search">

        <input
            id="globalSearch"
            placeholder="Search records..."
            oninput="globalSearch()"
        >

    </div>


    <div class="top-actions">

        <div class="user-chip">

            <div
                class="avatar profile-avatar-trigger"
                id="topAvatar"
                role="button"
                tabindex="0"
                title="View My Profile"
                aria-label="Open My Profile"
                onclick="openPage('profile')"
                onkeydown="if(event.key === 'Enter' || event.key === ' '){ event.preventDefault(); openPage('profile'); }"
            >
                JD
            </div>

            <strong id="topName">
                Juan Dela Cruz
            </strong>

        </div>

    </div>

</header>


<div class="page">


<!-- =========================================
     CUSTOMER DASHBOARD
========================================= -->

<section
    id="dashboard"
    class="section active"
>

    <div class="welcome-card has-banner" id="welcomeCard">
        <!-- Set your banner filename/path here. Example: images/medical-archives-banner.jpg -->
        <img id="bannerPreview" class="banner-preview" src="Banner.jpg" alt="Medical Archives system banner">
        <div class="welcome-content">
            <div class="system-label" style="display:inline-block;border:1px solid #ffffff70;border-radius:20px;padding:7px 12px;font-size:10px;margin-bottom:12px;color:white;letter-spacing:.4px;">DIGITAL PRESCRIPTION RECORDS FOR DRUGSTORE</div>
            <h2>Welcome, <span id="welcomeName">Juan Dela Cruz</span>!</h2>
            <p>Smarter records. Safer medication. View your prescriptions and medication history in one convenient place, and keep your customer profile up to date.</p>
            <button class="btn light" onclick="openPage('prescriptions')">View My Prescriptions &nbsp; →</button>
        </div>
        <div class="welcome-avatar" id="welcomeAvatar">JD</div>
    </div>


    <div class="grid stats">

        <div class="card stat">

            <div>

                <div class="stat-label">
                    Total Prescriptions
                </div>

                <div
                    class="stat-value"
                    id="totalPrescriptions"
                >
                    5
                </div>

                <div class="stat-info">
                    Your recorded prescriptions
                </div>

            </div>

            <div class="stat-icon">
                Rx
            </div>

        </div>


        <div class="card stat">

            <div>

                <div class="stat-label">
                    Active Medications
                </div>

                <div
                    class="stat-value"
                    id="activeMedications"
                >
                    2
                </div>

                <div class="stat-info">
                    Currently recorded
                </div>

            </div>

            <div class="stat-icon">
                MD
            </div>

        </div>


        <div class="card stat">

            <div>

                <div class="stat-label">
                    Next Medication
                </div>

                <div
                    class="stat-value"
                    id="nextMedicationValue"
                    style="font-size:18px; overflow-wrap:anywhere;"
                >
                    No medication
                </div>

                <div class="stat-info" id="nextMedicationInfo">
                    Your latest active prescription
                </div>

            </div>

            <div class="stat-icon">
                ◷
            </div>

        </div>

    </div>


    <div class="grid two-col">

        <!-- RECENT PRESCRIPTIONS -->

        <div class="card">

            <div class="card-head">

                <h3>
                    Recent Prescriptions
                </h3>

                <a
                    onclick="openPage('prescriptions')"
                >
                    View All
                </a>

            </div>


            <div class="card-body">

                <table>

                    <thead>

                        <tr>
                            <th>ID</th>
                            <th>Medicine</th>
                            <th>Dosage</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>

                    </thead>


                    <tbody id="recentPrescriptionTable">

                        <tr>
                            <td>RX-0001</td>
                            <td>Amoxicillin</td>
                            <td>500mg</td>
                            <td>2025-09-17</td>
                            <td>
                                <span class="badge green">
                                    Dispensed
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td>RX-0002</td>
                            <td>Paracetamol</td>
                            <td>500mg</td>
                            <td>2025-09-16</td>
                            <td>
                                <span class="badge yellow">
                                    For Review
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td>RX-0003</td>
                            <td>Ibuprofen</td>
                            <td>400mg</td>
                            <td>2025-09-15</td>
                            <td>
                                <span class="badge green">
                                    Dispensed
                                </span>
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </div>


        <!-- QUICK INFORMATION -->

        <div class="card">

            <div class="card-head">

                <h3>
                    Quick Information
                </h3>

            </div>


            <div class="card-body">

                <div class="quick-list">

                    <div class="quick-item">

                        <div class="quick-icon">
                            Rx
                        </div>

                        <div>

                            <strong>
                                My Prescriptions
                            </strong>

                            <span>
                                View your prescription records
                            </span>

                        </div>

                    </div>


                    <div class="quick-item">

                        <div class="quick-icon">
                            MH
                        </div>

                        <div>

                            <strong>
                                Medication History
                            </strong>

                            <span>
                                View your previous medications
                            </span>

                        </div>

                    </div>


                    <div class="quick-item">

                        <div class="quick-icon">
                            PR
                        </div>

                        <div>

                            <strong>
                                My Profile
                            </strong>

                            <span>
                                Manage your personal information
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- =========================================
     MY PRESCRIPTIONS
========================================= -->

<section
    id="prescriptions"
    class="section"
>

    <div class="page-head">

        <div>

            <h1>
                My Prescriptions
            </h1>

            <p>
                View your prescription records
            </p>

        </div>

    </div>


    <div class="card">

        <div class="card-body">

            <div class="toolbar">

                <input
                    id="prescriptionSearch"
                    type="search"
                    placeholder="Search ID, medicine, dosage, or instructions..."
                    aria-label="Search my prescriptions"
                    oninput="filterCustomerPrescriptions()"
                >


                <select id="prescriptionStatusFilter" aria-label="Filter prescriptions by status" onchange="filterCustomerPrescriptions()">

                    <option value="">
                        All Status
                    </option>

                    <option>
                        Dispensed
                    </option>

                    <option>
                        Pending
                    </option>

                    <option>
                        For Review
                    </option>

                </select>

            </div>


            <table id="prescriptionTable">

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Medicine</th>
                        <th>Doctor</th>
                        <th>Dosage</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Instructions</th>

                    </tr>

                </thead>


                <tbody>

                    <tr>

                        <td>RX-0001</td>
                        <td>Amoxicillin 500mg</td>
                        <td>500mg</td>
                        <td>1</td>

                        <td>
                            <span class="badge green">
                                Dispensed
                            </span>
                        </td>

                        <td>2025-09-17</td>
                        <td>Take as directed by your pharmacist.</td>

                    </tr>


                    <tr>

                        <td>RX-0002</td>
                        <td>Paracetamol 500mg</td>
                        <td>500mg</td>
                        <td>1</td>

                        <td>
                            <span class="badge yellow">
                                For Review
                            </span>
                        </td>

                        <td>2025-09-16</td>
                        <td>Follow pharmacist instructions.</td>

                    </tr>


                    <tr>

                        <td>RX-0003</td>
                        <td>Ibuprofen 400mg</td>
                        <td>400mg</td>
                        <td>1</td>

                        <td>
                            <span class="badge yellow">
                                Pending
                            </span>
                        </td>

                        <td>2025-09-15</td>
                        <td>Use only as directed.</td>

                    </tr>


                    <tr>

                        <td>RX-0004</td>
                        <td>Cetirizine 10mg</td>
                        <td>10mg</td>
                        <td>1</td>

                        <td>
                            <span class="badge green">
                                Dispensed
                            </span>
                        </td>

                        <td>2025-09-14</td>
                        <td>Take as directed by your pharmacist.</td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</section>


<!-- =========================================
     MEDICATION HISTORY
========================================= -->

<section
    id="history"
    class="section"
>

    <div class="page-head">

        <div>

            <h1>
                Medication History
            </h1>

            <p>
                View your previous medication records
            </p>

        </div>

    </div>


    <div class="card">

        <div class="card-body">

            <div class="toolbar history-toolbar">

                <input
                    id="historySearch"
                    type="search"
                    placeholder="Search medicine, category, dosage, status, or instructions..."
                    aria-label="Search medication history"
                    oninput="filterCustomerHistory()"
                >

                <label class="history-date-control">
                    <span>History Date</span>
                    <input
                        id="historyDateFilter"
                        type="date"
                        aria-label="Filter medication history by date"
                        onchange="filterCustomerHistory()"
                    >
                </label>

            </div>


            <table id="historyTable">

                <thead>

                    <tr>

                        <th>Date</th>
                        <th>Medicine</th>
                        <th>Doctor</th>
                        <th>Dosage</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Instructions</th>

                    </tr>

                </thead>


                <tbody>

                    <tr>

                        <td>2025-09-17</td>
                        <td>Amoxicillin</td>
                        <td>Antibiotic</td>
                        <td>500mg</td>
                        <td>1</td>

                        <td>
                            <span class="badge green">
                                Available
                            </span>
                        </td>

                    <td>Take as directed by your pharmacist.</td>
                    </tr>


                    <tr>

                        <td>2025-09-16</td>
                        <td>Paracetamol</td>
                        <td>Analgesic</td>
                        <td>500mg</td>
                        <td>1</td>

                        <td>
                            <span class="badge yellow">
                                For Review
                            </span>
                        </td>

                    <td>Follow pharmacist instructions.</td>
                    </tr>


                    <tr>

                        <td>2025-09-15</td>
                        <td>Ibuprofen</td>
                        <td>Analgesic</td>
                        <td>400mg</td>
                        <td>1</td>

                        <td>
                            <span class="badge green">
                                Available
                            </span>
                        </td>

                    <td>Use only as directed.</td>
                    </tr>


                    <tr>

                        <td>2025-09-14</td>
                        <td>Cetirizine</td>
                        <td>Antihistamine</td>
                        <td>10mg</td>
                        <td>1</td>

                        <td>
                            <span class="badge green">
                                Available
                            </span>
                        </td>

                    <td>Take as directed by your pharmacist.</td>
                    </tr>


                    <tr>

                        <td>2025-09-13</td>
                        <td>Omeprazole</td>
                        <td>Antacid</td>
                        <td>20mg</td>
                        <td>1</td>

                        <td>
                            <span class="badge yellow">
                                For Review
                            </span>
                        </td>

                    <td>Follow the instructions provided by your pharmacist.</td>
                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</section>


<!-- =========================================
     MY PROFILE
========================================= -->

<section
    id="profile"
    class="section"
>

    <div class="page-head">

        <div>

            <h1>
                My Profile
            </h1>

            <p>
                View your personal account information
            </p>

        </div>

    </div>


    <div class="profile-grid">


        <!-- PROFILE CARD -->

        <div class="profile-card">

            <div
                class="profile-avatar"
                id="profileAvatar"
            >
                JD
            </div>


            <h2 id="profileName">
                Juan Dela Cruz
            </h2>


            <p>
                Customer
            </p>


            <br>


            <button class="btn light" type="button" onclick="openProfileEditor()">✎ &nbsp; Edit Profile</button>
            <div class="profile-photo-controls">
                <label class="btn light" for="profilePhotoInput">Change Photo</label>
                <input id="profilePhotoInput" type="file" accept="image/*" onchange="uploadProfilePhoto(event)">
                <button class="btn light" type="button" onclick="removeProfilePhoto()">Remove Photo</button>
            </div>

        </div>


        <!-- INFORMATION -->

        <div class="profile-details">

            <h3>
                Personal Information
            </h3>


            <div class="profile-info">


                <div class="info-box">

                    <label>
                        Full Name
                    </label>

                    <strong id="profileFullName">
                        Juan Dela Cruz
                    </strong>

                </div>


                <div class="info-box">

                    <label>
                        Username
                    </label>

                    <strong id="profileUsername">
                        juandela
                    </strong>

                </div>


                <div class="info-box">

                    <label>
                        Email
                    </label>

                    <strong id="profileEmail">
                        juan@email.com
                    </strong>

                </div>


                <div class="info-box">

                    <label>
                        Contact Number
                    </label>

                    <strong id="profileContact">
                        09123456789
                    </strong>

                </div>


                <div class="info-box">

                    <label>
                        Age
                    </label>

                    <strong id="profileAge">25</strong>

                </div>


                <div class="info-box">

                    <label>
                        Gender
                    </label>

                    <strong id="profileGender">Male</strong>

                </div>


                <div class="info-box">

                    <label>
                        Allergies
                    </label>

                    <strong id="profileAllergies">None</strong>

                </div>


                <div class="info-box">

                    <label>
                        Account Status
                    </label>

                    <strong>
                        <span class="badge green">
                            Active
                        </span>
                    </strong>

                </div>

            </div>

        </div>

    </div>

</section>

</div>

</main>

</div>


<!-- =========================================
     TOAST
========================================= -->

<div id="profileEditorModal" class="modal-wrap" role="dialog" aria-modal="true" aria-labelledby="profileEditorTitle">
  <div class="profile-modal">
    <h2 id="profileEditorTitle">Edit Your Profile</h2>
    <p class="modal-subtitle">Update your personal information. Your changes will be saved in this browser.</p>
    <form id="profileEditorForm" onsubmit="saveEditedProfile(event)">
      <div class="profile-modal-grid">
        <div class="profile-modal-field"><label for="editFullName">Full Name *</label><input id="editFullName" maxlength="100" required></div>
        <div class="profile-modal-field"><label for="editUsername">Username *</label><input id="editUsername" maxlength="50" required></div>
        <div class="profile-modal-field"><label for="editEmail">Email Address *</label><input id="editEmail" type="email" required></div>
        <div class="profile-modal-field"><label for="editContact">Contact Number</label><input id="editContact" type="tel" maxlength="30"></div>
        <div class="profile-modal-field"><label for="editAge">Age</label><input id="editAge" type="number" min="1" max="120"></div>
        <div class="profile-modal-field"><label for="editGender">Gender</label><select id="editGender"><option value="">Prefer not to say</option><option>Female</option><option>Male</option><option>Other</option></select></div>
        <div class="profile-modal-field full"><label for="editAllergies">Allergies (optional)</label><input id="editAllergies" maxlength="250" placeholder="Enter allergies or None"></div>
      </div>
      <div id="profileEditorError" class="profile-modal-error" aria-live="polite"></div>
      <div class="profile-modal-actions"><button type="button" class="btn light" onclick="closeProfileEditor()">Cancel</button><button type="submit" class="btn">Save Changes</button></div>
    </form>
  </div>
</div>

<div
    id="toast"
    class="toast"
></div>


<script>

/* =========================================
   NAVIGATION
========================================= */

const navButtons =
    document.querySelectorAll(".nav button");

const sections =
    document.querySelectorAll(".section");


function openPage(page){

    sections.forEach(section => {

        section.classList.remove("active");

    });


    const target =
        document.getElementById(page);

    if(target){

        target.classList.add("active");

    }


    navButtons.forEach(button => {

        button.classList.toggle(
            "active",
            button.dataset.page === page
        );

    });


    window.scrollTo({
        top:0,
        behavior:"smooth"
    });

}


navButtons.forEach(button => {

    button.addEventListener(
        "click",
        () => openPage(button.dataset.page)
    );

});


/* =========================================
   CUSTOMER ACCOUNT
========================================= */


function loadCustomer(){
    const current = JSON.parse(localStorage.getItem("currentCustomer") || "null") || {};
    const savedProfile = JSON.parse(localStorage.getItem("medicalCustomerProfile") || "null") || {};
    const customer = {...current, ...savedProfile};

    const name = customer.fullName || customer.name || customer.username || "Customer";
    const username = customer.username || "customer";
    const email = customer.email || "No email";
    const contact = customer.contact || customer.phone || "Not provided";
    const age = customer.age || "Not provided";
    const gender = customer.gender || "Not provided";
    const allergies = customer.allergies || "None";
    const initials = name.split(" ").filter(Boolean).map(word => word.charAt(0)).join("").substring(0,2).toUpperCase() || "CU";

    document.getElementById("sideName").textContent = name;
    document.getElementById("sideAvatar").textContent = initials;
    document.getElementById("topName").textContent = name;
    document.getElementById("topAvatar").textContent = initials;
    document.getElementById("welcomeName").textContent = name;
    document.getElementById("welcomeAvatar").textContent = initials;
    document.getElementById("profileAvatar").textContent = initials;
    document.getElementById("profileName").textContent = name;
    document.getElementById("profileFullName").textContent = name;
    document.getElementById("profileUsername").textContent = username;
    document.getElementById("profileEmail").textContent = email;
    document.getElementById("profileContact").textContent = contact;
    document.getElementById("profileAge").textContent = age;
    document.getElementById("profileGender").textContent = gender;
    document.getElementById("profileAllergies").textContent = allergies;

    const photo = localStorage.getItem("medicalCustomerProfilePhoto");
    if(photo){
        ["sideAvatar","topAvatar","profileAvatar","welcomeAvatar"].forEach(id => {
            const el = document.getElementById(id);
            el.innerHTML = '<img alt="Customer profile photo" src="' + photo + '">';
        });
    }

}

function openProfileEditor(){
    const current = JSON.parse(localStorage.getItem("currentCustomer") || "null") || {};
    const saved = JSON.parse(localStorage.getItem("medicalCustomerProfile") || "null") || {};
    const data = {...current, ...saved};
    document.getElementById("editFullName").value = data.fullName || data.name || data.username || "";
    document.getElementById("editUsername").value = data.username || "";
    document.getElementById("editEmail").value = data.email || "";
    document.getElementById("editContact").value = data.contact || data.phone || "";
    document.getElementById("editAge").value = data.age || "";
    document.getElementById("editGender").value = data.gender || "";
    document.getElementById("editAllergies").value = data.allergies || "";
    document.getElementById("profileEditorError").textContent = "";
    document.getElementById("profileEditorModal").classList.add("show");
}

function closeProfileEditor(){
    document.getElementById("profileEditorModal").classList.remove("show");
}

function saveEditedProfile(event){
    event.preventDefault();
    const current = JSON.parse(localStorage.getItem("currentCustomer") || "null") || {};
    const saved = JSON.parse(localStorage.getItem("medicalCustomerProfile") || "null") || {};
    const updated = {
        ...current, ...saved,
        fullName: document.getElementById("editFullName").value.trim(),
        name: document.getElementById("editFullName").value.trim(),
        username: document.getElementById("editUsername").value.trim(),
        email: document.getElementById("editEmail").value.trim(),
        contact: document.getElementById("editContact").value.trim(),
        phone: document.getElementById("editContact").value.trim(),
        age: document.getElementById("editAge").value,
        gender: document.getElementById("editGender").value,
        allergies: document.getElementById("editAllergies").value.trim() || "None"
    };
    const error = document.getElementById("profileEditorError");
    if(!updated.fullName || !updated.username || !updated.email){
        error.textContent = "Please complete the name, username, and email fields.";
        return;
    }
    if(updated.age && (Number(updated.age) < 1 || Number(updated.age) > 120)){
        error.textContent = "Enter an age between 1 and 120.";
        return;
    }
    try{
        localStorage.setItem("medicalCustomerProfile", JSON.stringify(updated));
        const accountKey = "customerAccounts";
        const accounts = JSON.parse(localStorage.getItem(accountKey) || "[]");
        if(Array.isArray(accounts)){
            const index = accounts.findIndex(a =>
                (a.username && current.username && a.username.toLowerCase() === current.username.toLowerCase()) ||
                (a.email && current.email && a.email.toLowerCase() === current.email.toLowerCase())
            );
            if(index >= 0) {
                accounts[index] = {...accounts[index], fullName:updated.fullName, username:updated.username, email:updated.email, contact:updated.contact, phone:updated.phone, age:updated.age, gender:updated.gender, allergies:updated.allergies};
                localStorage.setItem(accountKey, JSON.stringify(accounts));
            }
        }
        if(current && Object.keys(current).length){
            localStorage.setItem("currentCustomer", JSON.stringify({...current, ...updated}));
        }
        closeProfileEditor();
        loadCustomer();
        showToast("Your profile was updated successfully.");
    }catch(err){
        error.textContent = "Unable to save. Browser storage may be full.";
    }
}

/* Banner image is set directly in the HTML above. Change the src on #bannerPreview to use another image. */

function uploadProfilePhoto(event){
    const file = event.target.files && event.target.files[0];
    if(!file) return;
    if(!file.type.startsWith("image/")){showToast("Please select an image file.");event.target.value="";return;}
    if(file.size > 1000000){showToast("Please use a photo smaller than 1 MB.");event.target.value="";return;}
    const reader = new FileReader();
    reader.onload = function(){
        try{
            localStorage.setItem("medicalCustomerProfilePhoto", reader.result);
            loadCustomer();
            showToast("Profile photo updated.");
        }catch(err){showToast("Could not save photo. Try a smaller file.");}
        event.target.value="";
    };
    reader.readAsDataURL(file);
}

function removeProfilePhoto(){
    localStorage.removeItem("medicalCustomerProfilePhoto");
    loadCustomer();
    showToast("Profile photo removed.");
}


/* =========================================
   CUSTOMER MEDICATION HISTORY FILTERS
========================================= */

function filterCustomerHistory(){
    const query = (document.getElementById("historySearch")?.value || "")
        .trim()
        .toLowerCase();
    const selectedDate = document.getElementById("historyDateFilter")?.value || "";
    const rows = document.querySelectorAll("#historyTable tbody tr");

    rows.forEach(row => {
        const cells = row.cells;
        const rowDate = (cells[0]?.textContent || "").trim();
        const matchesSearch = (row.textContent || "").toLowerCase().includes(query);
        const matchesDate = !selectedDate || rowDate === selectedDate;
        row.style.display = matchesSearch && matchesDate ? "" : "none";
    });
}

/* =========================================
   TABLE SEARCH
========================================= */

function filterTable(tableId, term){

    const query =
        term.toLowerCase();


    const rows =
        document.querySelectorAll(
            "#" + tableId + " tbody tr"
        );


    rows.forEach(row => {

        row.style.display =
            row.innerText
            .toLowerCase()
            .includes(query)
                ? ""
                : "none";

    });

}


/* =========================================
   STATUS FILTER
========================================= */

function filterStatus(tableId,status){

    const rows =
        document.querySelectorAll(
            "#" + tableId + " tbody tr"
        );


    rows.forEach(row => {

        if(!status){

            row.style.display = "";

            return;

        }


        row.style.display =
            row.innerText
            .toLowerCase()
            .includes(status.toLowerCase())
                ? ""
                : "none";

    });

}


/* =========================================
   GLOBAL SEARCH
========================================= */

function globalSearch(){

    const query =
        document
        .getElementById("globalSearch")
        .value
        .trim()
        .toLowerCase();


    if(!query){

        return;

    }


    const searchablePages = [
        "prescriptions",
        "history",
        "profile"
    ];


    for(const page of searchablePages){

        const section =
            document.getElementById(page);


        if(
            section &&
            section.innerText
            .toLowerCase()
            .includes(query)
        ){

            openPage(page);

            break;

        }

    }

}


/* =========================================
   TOAST
========================================= */

function showToast(message){

    const toast =
        document.getElementById("toast");


    toast.textContent =
        message;


    toast.classList.add("show");


    clearTimeout(
        window.toastTimer
    );


    window.toastTimer =
        setTimeout(() => {

            toast.classList.remove("show");

        },2200);

}


/* =========================================
   CUSTOMER LOGOUT
========================================= */

function customerLogout(){

    localStorage.removeItem(
        "currentCustomer"
    );


    alert(
        "You have been logged out."
    );


    /*
       Change customer.html to the
       actual filename of your
       Customer Login page.
    */

    window.location.href =
        "login.php";

}


/* =========================================
   LOAD CUSTOMER
========================================= */


/* =========================================
   CUSTOMER PRESCRIPTION + HISTORY SYNC
   Reads the admin dashboard's saved table records in this browser.
========================================= */
const MEDICAL_ARCHIVES_TABLE_STORAGE_KEY = 'medicalArchivesDashboardTables_v1';
function customerSafeText(value) {
    return String(value ?? '').replace(/[&<>"']/g, ch => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[ch]));
}
function customerBadge(status) {
    const val = String(status || 'Pending').trim();
    const low = val.toLowerCase();
    const cls = low.includes('dispens') || low.includes('available') ? 'green' : (low.includes('pending') || low.includes('review') ? 'yellow' : 'green');
    return `<span class="badge ${cls}">${customerSafeText(val)}</span>`;
}
function getCurrentCustomerLabels() {
    let current = {}, saved = {};
    try { current = JSON.parse(localStorage.getItem('currentCustomer') || '{}') || {}; } catch(e) {}
    try { saved = JSON.parse(localStorage.getItem('medicalCustomerProfile') || '{}') || {}; } catch(e) {}
    const vals = [current.fullName,current.name,current.username,current.email,saved.fullName,saved.name,saved.username,saved.email]
        .map(v => String(v || '').trim().toLowerCase()).filter(Boolean);
    return { labels: [...new Set(vals)], raw: {...current,...saved} };
}
function readAdminDashboardTables() {
    try { return JSON.parse(localStorage.getItem(MEDICAL_ARCHIVES_TABLE_STORAGE_KEY) || 'null') || null; }
    catch(e) { return null; }
}
function cellTextFromHTMLRow(row, index) {
    const cells = row.querySelectorAll('td');
    return (cells[index]?.textContent || '').trim();
}
function tableRowsFromMarkup(markup) {
    if (!markup) return [];
    const temp = document.createElement('tbody');
    temp.innerHTML = markup;
    return [...temp.querySelectorAll('tr')];
}
function normalizeCustomerStatus(value) {
    return String(value || '').replace(/\s+/g,' ').trim();
}
function updateCustomerDashboardStats(records) {
    const totalEl = document.getElementById('totalPrescriptions');
    const activeEl = document.getElementById('activeMedications');
    const nextEl = document.getElementById('nextMedicationValue');
    const nextInfoEl = document.getElementById('nextMedicationInfo');
    const list = Array.isArray(records) ? records : [];

    if (totalEl) totalEl.textContent = String(list.length);

    // A dispensed medicine is treated as active because it has been supplied to the customer;
    // pending, for-review, cancelled, and expired records are not counted as active.
    const active = list.filter(r => {
        const status = String(r.status || '').toLowerCase();
        return status.includes('active') || status.includes('dispens');
    });
    if (activeEl) activeEl.textContent = String(active.length);

    // Prescription dates are not dose schedules, so show the most recently recorded active
    // medicine instead of inventing a countdown or a medication time.
    const next = active.slice().sort((a, b) => {
        const da = Date.parse(a.date) || 0;
        const db = Date.parse(b.date) || 0;
        return db - da;
    })[0];
    if (nextEl) nextEl.textContent = next ? (next.medicine || 'Medication recorded') : 'None';
    if (nextInfoEl) {
        nextInfoEl.textContent = next
            ? [next.dosage, next.instructions].filter(v => v && v !== '—').join(' · ') || 'Latest active prescription'
            : 'No active or dispensed medication found';
    }
}
function renderCustomerAdminRecords() {
    const saved = readAdminDashboardTables();
    if (!saved) {
        const rows = [...document.querySelectorAll('#prescriptionTable tbody tr')]
            .filter(row => row.cells.length >= 6 && !/no prescription records/i.test(row.textContent || ''))
            .map(row => ({
                id: (row.cells[0]?.textContent || '').trim(),
                medicine: (row.cells[1]?.textContent || '').trim(),
                dosage: (row.cells[2]?.textContent || '').trim(),
                status: (row.cells[4]?.textContent || '').trim(),
                date: (row.cells[5]?.textContent || '').trim(),
                instructions: (row.cells[6]?.textContent || '').trim()
            }));
        updateCustomerDashboardStats(rows);
        return false;
    }
    const customer = getCurrentCustomerLabels();
    const allHistory = tableRowsFromMarkup(saved.historyTable);
    const allRecent = tableRowsFromMarkup(saved.recentPrescriptionTable);
    const isForCustomer = name => {
        const n = String(name || '').trim().toLowerCase();
        return !customer.labels.length || customer.labels.includes(n) || customer.labels.some(v => n && (n.includes(v) || v.includes(n)));
    };
    const histories = allHistory.map(row => ({
        date: cellTextFromHTMLRow(row,0), patient: cellTextFromHTMLRow(row,1), medicine: cellTextFromHTMLRow(row,2),
        dosage: cellTextFromHTMLRow(row,3), quantity: cellTextFromHTMLRow(row,4),
        status: normalizeCustomerStatus(cellTextFromHTMLRow(row,5)), instructions: cellTextFromHTMLRow(row,6) || '—'
    })).filter(r => isForCustomer(r.patient));
    const prescriptions = histories.map((r, index) => {
        const match = allRecent.find(row => cellTextFromHTMLRow(row,1).trim().toLowerCase() === r.patient.trim().toLowerCase()
            && cellTextFromHTMLRow(row,2).trim().toLowerCase() === r.medicine.trim().toLowerCase()
            && cellTextFromHTMLRow(row,3).trim() === r.date);
        return {...r, id: match ? cellTextFromHTMLRow(match,0) : `RX-${String(index+1).padStart(4,'0')}`};
    });
    updateCustomerDashboardStats(prescriptions);
    const pBody = document.querySelector('#prescriptionTable tbody');
    const hBody = document.querySelector('#historyTable tbody');
    if (pBody && histories.length) {
        pBody.innerHTML = prescriptions.slice().reverse().map(r => `<tr><td>${customerSafeText(r.id)}</td><td>${customerSafeText(r.medicine)}</td><td>${customerSafeText(r.dosage || '—')}</td><td>${customerSafeText(r.quantity || '—')}</td><td>${customerBadge(r.status)}</td><td>${customerSafeText(r.date)}</td><td>${customerSafeText(r.instructions)}</td></tr>`).join('');
    } else if (pBody && !histories.length && customer.labels.length) {
        pBody.innerHTML = '<tr><td colspan="7" class="empty-state">No prescription records found for your account yet.</td></tr>';
    }
    if (hBody && histories.length) {
        hBody.innerHTML = histories.slice().reverse().map(r => `<tr><td>${customerSafeText(r.date)}</td><td>${customerSafeText(r.medicine)}</td><td>—</td><td>${customerSafeText(r.dosage || '—')}</td><td>${customerSafeText(r.quantity || '—')}</td><td>${customerBadge(r.status)}</td><td>${customerSafeText(r.instructions)}</td></tr>`).join('');
    } else if (hBody && !histories.length && customer.labels.length) {
        hBody.innerHTML = '<tr><td colspan="7" class="empty-state">No medication history found for your account yet.</td></tr>';
    }
    filterCustomerPrescriptions();
    filterCustomerHistory();
    return true;
}
function filterCustomerPrescriptions() {
    const query = (document.getElementById('prescriptionSearch')?.value || '').trim().toLowerCase();
    const status = (document.getElementById('prescriptionStatusFilter')?.value || '').trim().toLowerCase();
    document.querySelectorAll('#prescriptionTable tbody tr').forEach(row => {
        const text = (row.textContent || '').toLowerCase();
        const rowStatus = (row.cells[4]?.textContent || '').trim().toLowerCase();
        row.style.display = (!query || text.includes(query)) && (!status || rowStatus === status) ? '' : 'none';
    });
}
window.addEventListener('storage', event => {
    if (!event.key || event.key === MEDICAL_ARCHIVES_TABLE_STORAGE_KEY || event.key === 'currentCustomer') renderCustomerAdminRecords();
});
window.addEventListener('focus', renderCustomerAdminRecords);


loadCustomer();
renderCustomerAdminRecords();

</script>


<script>
/* Glass UI interaction helpers */
document.addEventListener('keydown', function(event){
  if(event.key === 'Escape'){
    document.querySelectorAll('.modal-wrap.show').forEach(function(modal){modal.classList.remove('show');});
  }
});
document.getElementById('profileEditorModal').addEventListener('click', function(event){
  if(event.target === this) closeProfileEditor();
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


<script id="customer-hamburger-navbar-script">
(function () {
  const sidebar = document.getElementById('customerSidebar');
  const toggle = document.getElementById('hamburgerToggle');
  const backdrop = document.getElementById('navBackdrop');
  if (!sidebar || !toggle || !backdrop) return;

  function setMenuOpen(open) {
    sidebar.classList.toggle('is-open', open);
    backdrop.classList.toggle('show', open);
    document.body.classList.toggle('nav-open', open);
    toggle.setAttribute('aria-expanded', String(open));
    toggle.setAttribute('aria-label', open ? 'Close navigation menu' : 'Open navigation menu');
    backdrop.setAttribute('aria-hidden', String(!open));
  }

  toggle.addEventListener('click', function () {
    setMenuOpen(toggle.getAttribute('aria-expanded') !== 'true');
  });
  backdrop.addEventListener('click', function () { setMenuOpen(false); });
  sidebar.querySelectorAll('.nav button').forEach(function (button) {
    button.addEventListener('click', function () { setMenuOpen(false); });
  });
  document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape' && toggle.getAttribute('aria-expanded') === 'true') {
      setMenuOpen(false);
      toggle.focus();
    }
  });
  // Start with the drawer closed, regardless of viewport width.
  setMenuOpen(false);
})();
</script>

<script id="medicalArchivesCustomerApiConnection">
async function maCustomerLoad(){try{const r=await fetch('../api/auth/me',{credentials:'same-origin'});if(!r.ok){location.href='login.php';return;}const me=(await r.json()).data;const [rx,hist]=await Promise.all(['prescriptions','medication-history'].map(async p=>{const x=await fetch('../api/'+p,{credentials:'same-origin'});const j=await x.json();if(!x.ok||!j.success)throw Error(j.data?.message||'Unable to load records');return j.data;}));
const rxBody=document.querySelector('#prescriptionTable tbody');if(rxBody)rxBody.innerHTML=rx.map(x=>`<tr><td>RX-${x.prescription_id}</td><td>${x.medicine||''}</td><td>${x.doctor||''}</td><td>${x.dosage||''}</td><td>${x.quantity||''}</td><td>${x.status||''}</td><td>${x.date_issued||''}</td><td>${x.instructions||''}</td></tr>`).join('');
const hBody=document.querySelector('#historyTable tbody');if(hBody)hBody.innerHTML=hist.map(x=>`<tr><td>${x.date_taken||''}</td><td>${x.medicine||''}</td><td>${x.doctor||''}</td><td>${x.dosage||''}</td><td>${x.quantity||''}</td><td>${x.status||''}</td><td>${x.notes||''}</td></tr>`).join('');
}catch(e){console.warn('Medical Archives API:',e.message);}}
document.addEventListener('DOMContentLoaded',maCustomerLoad);
</script>
</body>
</html>