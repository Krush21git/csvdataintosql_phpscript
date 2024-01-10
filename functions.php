<?php 

/*    

    Create Database connection to MySQL 

*/


function ConnectDataBase()
{
    $servername = "localhost";
    $username = "root";
    $password = "";

    try {
        $conn = new PDO("mysql:host=$servername", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully\n";
        return $conn;
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}

$pdoConnection = ConnectDataBase();

/*  

    Create MySQL DataBase 

*/

function CreateDataBase() {
    $servername = "localhost";
    $username = "root";
    $password = "";

    try {
        $conn = new PDO("mysql:host=$servername", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Create database
        $sql = "CREATE DATABASE IF NOT EXISTS usersDB";
        $conn->exec($sql);
        echo "Database created successfully\n";
    } catch (PDOException $e) {
        die("Error creating database: " . $e->getMessage());
    }
}

CreateDataBase();
