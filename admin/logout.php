<?php
require_once('connection/conn.php');

session_destroy();
header("Location:login.php");
