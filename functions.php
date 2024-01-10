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

/*  

    Create MySQL users data table  

*/

function CreateUserTable() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "usersDB";

    try {
        // Create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Read the header of CSV for column names
        if (($handle = fopen("users.csv", "r")) !== FALSE) {
            $data = fgetcsv($handle, 1000, ",");
            fclose($handle);
        }

        // SQL to create table
        $sql = "CREATE TABLE IF NOT EXISTS users (
            {$data[0]} VARCHAR(50) NOT NULL,
            {$data[1]} VARCHAR(50) NOT NULL,
            {$data[2]} VARCHAR(50) NOT NULL,
            UNIQUE KEY {$data[2]} ({$data[2]})
        )";

        $conn->exec($sql);
        echo "Table USERS created successfully\n";
    } catch (PDOException $e) {
        die("Error creating table: " . $e->getMessage());
    }
}

CreateUserTable();

/*    

    show, checking and insert file content into DataBase  

*/


function PrintUserFile() {
    $row = 0;
    $filename = "users.csv";

    try {
        $file = new SplFileObject($filename, 'r');
        $file->setFlags(SplFileObject::READ_CSV);

        foreach ($file as $data) {
            if ($row && !empty($data[0]) && $data[0] !== 'name') {
                echo "\n";
                // Make the first character uppercase
                $data[0] = ucfirst(strtolower($data[0]));
                $data[1] = ucfirst(strtolower($data[1]));
                // Validate email
                validemailaddress($data[2]);
                // Insert data into DB
                insertusertableRow($data[0], $data[1], $data[2]);
            }
            $row++;
            echo implode(' ', $data) . " ";
        }
    } catch (Exception $e) {
        die("Error reading file: " . $e->getMessage());
    }
}

/*  

    insert file content into DataBase  

*/


function insertusertableRow($name, $surname, $email) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "usersDB";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $name = $conn->quote($name);
        $surname = $conn->quote($surname);
        $email = $conn->quote($email);

        $sql = "INSERT INTO users (name, surname, email) VALUES ($name, $surname, $email)";
        $conn->exec($sql);
    } catch (PDOException $e) {
        die("Error inserting row: " . $e->getMessage());
    }
}


/*   

    showing file content 

*/

function showuserFile() {
    echo "USERS.CSV \n\n";
    $filename = "users.csv";

    try {
        $file = new SplFileObject($filename, 'r');
        $file->setFlags(SplFileObject::READ_CSV);

        foreach ($file as $data) {
            echo implode(' ', $data) . "\n";
        }
    } catch (Exception $e) {
        die("Error reading file: " . $e->getMessage());
    }
}


/*  

    output list of directives with details 

*/

function userfunHelp() {
    echo <<<HELP
 Command line options: 
  --file [csv file name] – show content of the CSV file to be parsed into Data Base. 
  --insert [csv file name] - show content of the CSV file and insert content of CSV file into Data Base. 
  --create_table – build the MySQL users table. 
  --dry_run (use with --file directive) run the script but not insert into the DB. All other functions will be executed, but the
  database won't be altered. Example: --dry_run users.csv 
  -u – MySQL username.
  -p – MySQL password.
  -h – MySQL host.
  --help – show list of directives with details.
HELP;
}

/* 

    show MySQL hostname 

*/

function showmysqlhostname() {
    $servername = "localhost";
    $username = "root";
    $password = "";

    try {
        $conn = new PDO("mysql:host=$servername", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->query("SELECT @@hostname AS host_info");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        printf("MySQL host info: %s\n", $result['host_info']);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}


/* 
    
    function for check email is valid or not 

*/

function validemailaddress($email) {
    $lowercaseEmail = strtolower($email);

    if (filter_var($lowercaseEmail, FILTER_VALIDATE_EMAIL)) {
        return $lowercaseEmail;
    }

    echo "\nWARNING! -> Email address '$email' is considered invalid.\n";
    return "Invalid EMAIL";
}


/* 

    show MySQL username 

*/

function Mysqlusername() {
    echo <<<MYSQL_USER
MySQL username - root 
MYSQL_USER;
}

/* 

    show MySQL password 

*/

function Mysqlpassword() {
    echo <<<MYSQL_PASSWORD
MySQL password is blank 
MYSQL_PASSWORD;
}

?>
