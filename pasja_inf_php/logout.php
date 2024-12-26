<?php
session_start();

unset($_SESSION['logged_adm_id']);
session_unset();
session_destroy();

header('Location: index.php');