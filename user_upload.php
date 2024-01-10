<?php include "functions.php";

if ($argc == 2) {
    $temp = $argv[1];
} elseif ($argc == 3) {
    $temp = $argv[1] . " " . $argv[2];
} else {
    $temp = '--help';
}

/*

    case: '--insert users.csv'   :     Create user table and print userfile
    case: '--file users.csv'     :     Show user file data
    case '--create_table'        :     Create user table 
    case '--dry_run users.csv'   :     Create user table and show user file data
    case '-u'                    :     Show Username
    case '-p'                    :     Show Password
    case '-h'                    :     Show Hostname
    case '--help'                :     Give the instruction of commands
        
*/

ConnectDataBase();
CreateDataBase();

switch ($temp) {
    case '--insert users.csv':
        CreateUserTable();
        PrintUserFile();
        break;

    case '--file users.csv':
        showuserFile();
        break;

    case '--create_table':
        CreateUserTable();
        break;

    case '--dry_run users.csv':
        CreateUserTable();
        showuserFile();
        break;

    case '-u':
        Mysqlusername();
        break;

    case '-p':
        Mysqlpassword();
        break;

    case '-h':
        showmysqlhostname();
        break;

    case '--help':
        userfunHelp();
        break;

    default:
        echo "Please enter --help for instructions";
        break;
}
?>
