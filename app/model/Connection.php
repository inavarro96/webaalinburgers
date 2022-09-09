<?php

class Connection {
    
    public function connect() {
        $con = new PDO("mysql:host=localhost;dbname=db_amburgesas",'root','root');
        return $con;
    }
}