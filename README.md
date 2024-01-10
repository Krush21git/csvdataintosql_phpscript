
# Task1

Created a PHP script, that is executed from the command line, which accepts a CSV file as input (see command
line directives below) and processes the CSV file. The parsed file data is to be inserted into a MySQL database.

A CSV filename is "users.csv".

The PHP script handle the following criteria:


• CSV file will contain user data and have three columns: name, surname, email (see table definition
below)
• CSV file will have an arbitrary list of users
• Script will iterate through the CSV rows and insert each record into a dedicated MySQL database into
the table “users”
• The users database table will need to be created/rebuilt as part of the PHP script. This will be defined
as a Command Line directive below
• Name and surname field should be set to be capitalised e.g. from “john” to “John” before being
inserted into DB
• Emails need to be set to be lower case before being inserted into DB
• The script should validate the email address before inserting, to make sure that it is valid (valid means
that it is a legal email format, e.g. “xxxx@asdf@asdf” is not a legal format). In case that an email is
invalid, no insert should be made to database and an error message should be reported to STDOUT.

# User Table

The MySQL table should contain at least these fields:
• name
• surname
• email (email should be set to a UNIQUE index).


# Script Command Line Directives

The PHP script should include these command line options (directives):

• --file [csv file name] –	this is the name of the CSV to be parsed
• --create_table 		 – 	this will cause the MySQL users table to be built (and no further action will be taken)
• --dry_run 			 – 	this will be used with the --file directive in case we want to run the script but not insert into the DB. All 								other functions will be executed, but the database won't be altered
• -u 					 –  MySQL username
• -p 					 –  MySQL password
• -h 					 –  MySQL host
• --help 				 –  which will output the above list of directives with details.


# Default connection details
user : root
password : blank ( not set )
host : localhost or 127.0.0.1
Your connection details may difer depending of your server configuration.

# How to change default connection details?
Edit from functions.php 


# The deliverable will be a running PHP script – it will be executed on an Ubuntu 22.04 instance

Installing XAMPP on Ubuntu 22.04

Step 1: Download the installation package
https://www.apachefriends.org/index.html

Step 2: Make the installation package executable
$ cd /home/[username]/Downloads

The installation package you downloaded needs to be made executable before it can be used further. Run the following command for this purpose:
$ chmod 755 [package name]

Step 3: Confirm execute permission
$ ls -l [package name]

Step 4: Launch the Setup Wizard
$ sudo ./[package name]

Step 5: Work through the graphical setup wizard

Step 6: Launch XAMPP through the Terminal
$ sudo /opt/lampp/lampp start

Step 7: Verify Installation
http://localhost

You can also verify the installation of phpMyAdmin in a similar manner by entering the following URL in your browser:
http://localhost/phpmyadmin


Once xampp server installation done then follow the below steps:

1.  Download the git file and extract that file into xampp server  > htdocs folder.
2.  open command prompt
3.  Run command for file location:
    example:-
    e:
    cd xampp
    cd htdocs
    cd task1 ( task 1 is folder name)
   
    now its looking like
    E:\xampp\htdocs\task1>

5.  Now run the command for insert csv file data into table:-
    E:\xampp\htdocs\task1>php user_upload.php --insert users.csv

    After run this command, Go to the phpmyadmin database page database created and also user table created with users.csv file. 

6.  Next run the another command which show the users.csv file data.
    E:\xampp\htdocs\task1>php user_upload.php --file users.csv

7.  Next run the another command which create user table in database.
    E:\xampp\htdocs\task1>php user_upload.php --create_table

8.  Next run the another command which only display the user file data but not insert the data into table
    E:\xampp\htdocs\task1>php user_upload.php --dry_run users.csv

9.  Next run the another command which only display the username
    E:\xampp\htdocs\task1>php user_upload.php -u

10. Next run the another command which only display the password
    E:\xampp\htdocs\task1>php user_upload.php -p

11. Next run the another command which only display the hostname
    E:\xampp\htdocs\task1>php user_upload.php -h

12. Next run the another command which will output the above list of directives with details.
    E:\xampp\htdocs\task1>php user_upload.php --help
