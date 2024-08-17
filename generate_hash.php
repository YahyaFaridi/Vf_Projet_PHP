<?php
$password = 'Admin1234';
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
echo $hashed_password;
?>
