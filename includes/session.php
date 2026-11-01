<?php
declare(strict_types=1);
if (session_status() !== PHP_SESSION_ACTIVE) {
  $secure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
  session_set_cookie_params(['lifetime'=>0,'path'=>'/','secure'=>$secure,'httponly'=>true,'samesite'=>'Lax']);
  session_start();
}
function require_role(string $role): void {
  if (empty($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== $role) {
    $base = strpos($_SERVER['SCRIPT_NAME'] ?? '', '/admin/') !== false ? 'login.php' : 'login.php';
    header('Location: '.$base); exit;
  }
}
function csrf_token(): string { if (empty($_SESSION['csrf'])) $_SESSION['csrf']=bin2hex(random_bytes(32)); return $_SESSION['csrf']; }
