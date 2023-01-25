<?php

    function connect() {
        $hostname = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "projeto_crud";
        $port = 3306;

        $dsn = "mysql:host=$hostname;port=$port;dbname=$dbname";

        try {
            $conn = new PDO($dsn, $username, $password);
            return $conn;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
