<?php
require_once '../includes/init.php';
session_destroy();
header("Location: ../index.php");
exit();
