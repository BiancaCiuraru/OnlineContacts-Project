<?php   
    class Database extends PDO{
        function __construct(){
            parent::__construct('mysql:host=localhost;dbname=test', 'root','');
            if(mysqli_connect_errno()){
                die('Nu s-a putut realiza conexiunea!');
            }            
        }
    }