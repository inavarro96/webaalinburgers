<?php

session_start();

if(isset($_SESSION['user'])) {
    // include "web/dashboardAdmin.php";
    header('Location: ./web/dashboardAdmin.php#!/productos');
} else {
    header ("Location: ./web/index.html");
}