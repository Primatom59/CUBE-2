<?php
session_start();
session_destroy();
header('Location: ' . $router->url('login_sans'));
session_start();
$_SESSION['flash']['success'] = 'Déconnecté';
exit();