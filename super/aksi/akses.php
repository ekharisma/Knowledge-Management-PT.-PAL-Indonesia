<?php

session_start();

if (!isset($_SESSION['super'])) {
	echo "<script language='javascript'> document.location='../page/login.php';</script>";
}
