<?php
declare(strict_types=1);
require_once __DIR__.'/../includes/session.php';
require_once __DIR__.'/../includes/db.php';
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');
function out($data=[], int $status=200): never { http_response_code($status); echo json_encode(['success'=>$status<400,'data'=>$data], JSON_UNESCAPED_UNICODE); exit; }
function fail(string $message,int $status=400): never { out(['message'=>$message],$status); }
function input(): array { $v=json_decode(file_get_contents('php://input'),true); return is_array($v)?$v:$_POST; }
function need(string ...$roles): void { if(empty($_SESSION['user_id']) || !in_array($_SESSION['role']??'', $roles,true)) fail('Please sign in with an authorized account.',401); }
function log_action(PDO $pdo,string $action,string $details=''): void { if(($_SESSION['role']??'')==='admin'){ $s=$pdo->prepare('INSERT INTO activity_log(admin_id,action,details) VALUES(?,?,?)'); $s->execute([$_SESSION['user_id'],$action,$details]); } }
$method=$_SERVER['REQUEST_METHOD']; $path=parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH); $path=preg_replace('#^.*/api/?#','',$path); $b=input();
try {
 if($method==='GET' && $path==='health') out(['status'=>'ok','database'=>'connected']);
 if($method==='POST' && $path==='auth/register/customer') {
   $name=trim($b['full_name']??''); $username=trim($b['username']??''); $email=strtolower(trim($b['email']??'')); $pw=$b['password']??'';
   if(!$name||strlen($username)<3||!filter_var($email,FILTER_VALIDATE_EMAIL)||strlen($pw)<8) fail('Enter a name, username (3+ characters), valid email, and password (8+ characters).');
   $s=$pdo->prepare('INSERT INTO customer(full_name,username,email,password,contact_number) VALUES(?,?,?,?,NULL)');
   try{$s->execute([$name,$username,$email,password_hash($pw,PASSWORD_DEFAULT)]);}catch(PDOException $e){if($e->getCode()==='23000')fail('Username or email already exists.',409);throw $e;}
   out(['customer_id'=>(int)$pdo->lastInsertId()],201);
 }
 if($method==='POST' && $path==='auth/register/admin') {
   $name=trim($b['full_name']??''); $username=trim($b['username']??''); $email=strtolower(trim($b['email']??'')); $pw=$b['password']??'';
   if(!$name||strlen($username)<3||!filter_var($email,FILTER_VALIDATE_EMAIL)||strlen($pw)<8) fail('Enter a name, username (3+ characters), valid email, and password (8+ characters).');
   $s=$pdo->prepare("INSERT INTO admin(name,username,email,password,role) VALUES(?,?,?,?, 'Admin')");
   try{$s->execute([$name,$username,$email,password_hash($pw,PASSWORD_DEFAULT)]);}catch(PDOException $e){if($e->getCode()==='23000')fail('Username or email already exists.',409);throw $e;}
   out(['admin_id'=>(int)$pdo->lastInsertId()],201);
 }
 if($method==='POST' && $path==='auth/login/customer') $role='customer';
 elseif($method==='POST' && $path==='auth/login/admin') $role='admin'; else $role=null;
 if($role){$login=strtolower(trim($b['username']??$b['email']??''));$pw=$b['password']??'';if(!$login||!$pw)fail('Username/email and password are required.');
   $table=$role==='admin'?'admin':'customer';$idcol=$role==='admin'?'admin_id':'customer_id';$namecol=$role==='admin'?'name':'full_name';
   $s=$pdo->prepare("SELECT {$idcol} id, {$namecol} full_name, username, email, password FROM {$table} WHERE LOWER(email)=? OR LOWER(username)=? LIMIT 1");$s->execute([$login,$login]);$u=$s->fetch();
   if(!$u||!password_verify($pw,$u['password']))fail('Invalid username/email or password.',401);
   session_regenerate_id(true);$_SESSION['user_id']=(int)$u['id'];$_SESSION['role']=$role;$_SESSION['name']=$u['full_name'];$_SESSION['email']=$u['email'];$_SESSION['username']=$u['username'];
   out(['id'=>(int)$u['id'],'role'=>$role,'full_name'=>$u['full_name'],'username'=>$u['username'],'email'=>$u['email']]);
 }
 if($method==='POST' && $path==='auth/logout'){$_SESSION=[];session_regenerate_id(true);session_destroy();out(['message'=>'Signed out.']);}
 if($method==='GET' && $path==='auth/me'){need('admin','customer');out(['id'=>$_SESSION['user_id'],'role'=>$_SESSION['role'],'full_name'=>$_SESSION['name'],'email'=>$_SESSION['email']]);}
 if($method==='GET' && $path==='doctors'){need('admin','customer');$q=$pdo->query('SELECT doctor_id,name,specialization,contact_number,email FROM doctor ORDER BY name');out($q->fetchAll());}
 if($method==='POST' && $path==='doctors'){need('admin');$name=trim($b['name']??'');if(!$name)fail("Doctor's name is required.");$s=$pdo->prepare('INSERT INTO doctor(name,specialization,contact_number,email) VALUES(?,?,?,?)');$s->execute([$name,$b['specialization']??null,$b['contact_number']??null,$b['email']??null]);log_action($pdo,'Added Doctor',$name);out(['doctor_id'=>(int)$pdo->lastInsertId()],201);}
 if($method==='GET' && $path==='customers'){need('admin');$s=$pdo->query('SELECT customer_id,full_name,username,email,contact_number,age,gender,allergies,address FROM customer ORDER BY full_name');out($s->fetchAll());}
 if($method==='GET' && $path==='medicines'){need('admin','customer');$s=$pdo->query('SELECT medicine_id,name,category,dossage_form,strength,stock_quantity,expiry_date,supplier,description FROM medicine ORDER BY name');out($s->fetchAll());}
 if($method==='POST' && $path==='medicines'){need('admin');$name=trim($b['name']??'');if(!$name)fail('Medicine name is required.');$s=$pdo->prepare('INSERT INTO medicine(name,category,dossage_form,strength,stock_quantity,expiry_date,supplier,description) VALUES(?,?,?,?,?,?,?,?)');$s->execute([$name,$b['category']??null,$b['dossage_form']??null,$b['strength']??null,(int)($b['stock_quantity']??0),$b['expiry_date']?:null,$b['supplier']??null,$b['description']??null]);log_action($pdo,'Added Medicine',$name);out(['medicine_id'=>(int)$pdo->lastInsertId()],201);}
 if($method==='GET' && $path==='prescriptions'){
   need('admin','customer');$sql="SELECT p.prescription_id,p.customer_id,c.full_name patient,d.doctor_id,d.name doctor,m.medicine_id,m.name medicine,p.date_issued,p.dossage dosage,p.quantity,p.status,p.instructions FROM prescription p JOIN customer c ON c.customer_id=p.customer_id JOIN doctor d ON d.doctor_id=p.doctor_id JOIN medicine m ON m.medicine_id=p.medecine_id";
   if($_SESSION['role']==='customer'){$sql.=' WHERE p.customer_id=?';$s=$pdo->prepare($sql.' ORDER BY p.date_issued DESC,p.prescription_id DESC');$s->execute([$_SESSION['user_id']]);}else{$s=$pdo->query($sql.' ORDER BY p.date_issued DESC,p.prescription_id DESC');}out($s->fetchAll());
 }
 if($method==='POST' && $path==='prescriptions'){
   need('admin');$customer=(int)($b['customer_id']??0);$doctor=(int)($b['doctor_id']??0);$medicine=(int)($b['medicine_id']??0);$date=$b['date_issued']??'';$dosage=trim($b['dosage']??'');$qty=(int)($b['quantity']??0);$status=strtolower($b['status']??'pending');$allowed=['pending','flagged','validated','dispensed'];
   if(!$customer||!$doctor||!$medicine||!$date||!$dosage||$qty<1||!in_array($status,$allowed,true))fail('Complete all required prescription fields.');
   $pdo->beginTransaction();$s=$pdo->prepare('SELECT customer_id FROM customer WHERE customer_id=?');$s->execute([$customer]);if(!$s->fetch())fail('Selected customer does not exist.',404);
   $s=$pdo->prepare('SELECT doctor_id FROM doctor WHERE doctor_id=?');$s->execute([$doctor]);if(!$s->fetch())fail('Selected doctor does not exist.',404);
   $s=$pdo->prepare('SELECT medicine_id,stock_quantity FROM medicine WHERE medicine_id=? FOR UPDATE');$s->execute([$medicine]);$med=$s->fetch();if(!$med)fail('Selected medicine does not exist.',404);
   $s=$pdo->prepare('INSERT INTO prescription(customer_id,doctor_id,medecine_id,admin_id,date_issued,dossage,quantity,status,instructions) VALUES(?,?,?,?,?,?,?,?,?)');$s->execute([$customer,$doctor,$medicine,$_SESSION['user_id'],$date,$dosage,$qty,$status,$b['instructions']??'']);$pid=(int)$pdo->lastInsertId();
   $s=$pdo->prepare('INSERT INTO medication_history(customer_id,medecine_id,prescription_id,date_taken,dosage,quantity,status,notes) VALUES(?,?,?,?,?,?,?,?)');$s->execute([$customer,$medicine,$pid,$date,$dosage,$qty,$status,$b['instructions']??'']);
   if(!empty($b['instructions'])){$s=$pdo->prepare('INSERT INTO instructions(prescription_id,instruction_text) VALUES(?,?)');$s->execute([$pid,$b['instructions']]);}
   if($status==='dispensed'){$s=$pdo->prepare('UPDATE medicine SET stock_quantity=GREATEST(stock_quantity-?,0) WHERE medicine_id=?');$s->execute([$qty,$medicine]);}
   $pdo->commit();log_action($pdo,'Added Prescription','RX-'.$pid.' patient '.$customer.' doctor '.$doctor);out(['prescription_id'=>$pid],201);
 }
 if($method==='GET' && $path==='medication-history'){need('admin','customer');$sql="SELECT h.history_id,h.date_taken,h.dosage,h.quantity,h.status,h.notes,c.full_name patient,m.name medicine,d.name doctor FROM medication_history h JOIN customer c ON c.customer_id=h.customer_id JOIN medicine m ON m.medicine_id=h.medecine_id JOIN prescription p ON p.prescription_id=h.prescription_id JOIN doctor d ON d.doctor_id=p.doctor_id";if($_SESSION['role']==='customer'){$s=$pdo->prepare($sql.' WHERE h.customer_id=? ORDER BY h.date_taken DESC');$s->execute([$_SESSION['user_id']]);}else{$s=$pdo->query($sql.' ORDER BY h.date_taken DESC');}out($s->fetchAll());}
 if($method==='GET' && $path==='activity-logs'){need('admin');$s=$pdo->query('SELECT l.log_id,l.action,l.details,l.date_time,a.name admin FROM activity_log l JOIN admin a ON a.admin_id=l.admin_id ORDER BY l.date_time DESC LIMIT 500');out($s->fetchAll());}
 fail('API endpoint not found.',404);
} catch(Throwable $e){if($pdo->inTransaction())$pdo->rollBack();error_log((string)$e);fail('A server error occurred. Check the PHP error log.',500);}
