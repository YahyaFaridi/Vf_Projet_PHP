<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


header('Location: index.php?page=success');
exit;
?>
