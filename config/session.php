<?php 
if (!isset($_SESSION)) {
	session_start();
}
if(!isset($_SESSION['id_login'])){
    header('location: ./login.php');
}