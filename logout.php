<?php
include_once('dbfunction.php');
session_start();
session_destroy();

header("Location:index.php");
?>