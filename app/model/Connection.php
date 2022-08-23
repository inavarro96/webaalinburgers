<?php

class Connection {
    
    public function connect() {
        $con = new PDO("mysql:host=localhost;dbname=royalprestige",'root','');
        return $con;
    }
}