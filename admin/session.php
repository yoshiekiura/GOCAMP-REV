<?php 
if (!isset($_SESSION)) {
	session_start();
}
if(!isset($_SESSION['logged-admin'])){
    header('location: ./login.php');
}