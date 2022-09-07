<?php

session_start();

if(isset($_SESSION['user'])) {
    include "admin.php";
} else {
    include "pagina.html";
}