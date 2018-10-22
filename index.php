<?php

if (isset($_GET['task']) && $_GET['task'] == 'login') {
	include 'controller/login.php';
    // Na podstawie zmiennej $_GET[‚task’] tworzony jest odpowiedni obiekt kontrolera (w tym wypadku LoginController).
    $ob = new LoginController();
    // Zmienna $_GET[‚action’] określa z kolei akcję kontrolera.
    $action = $_GET['action'];
    $ob->$action();
} 
// else if(isset($_GET['task']) && $_GET['task'] == 'register'){
//	   include 'controller/register.php';
// 	// Na podstawie zmiennej $_GET[‚task’] tworzony jest odpowiedni obiekt kontrolera (w tym wypadku LoginController).
//     $ob = new RegisterController();
//     // Zmienna $_GET[‚action’] określa z kolei akcję kontrolera.
//     $action = $_GET['action'];
//     $ob->$action();
// }
else {
	require "templates/indexMain.html.php";
}