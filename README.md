sudo apt-get update
sudo apt-get upgrade
sudo apt-get install lamp-server^
sudo apt-get install php-curl php-mail php-pear php5-gd php5-intl php5-xmlrpc





Untar the compressed file to its destination ---> " sudo untar -xvf mooodle.tar.gz "
Give executable permissions to the folder ---> " sudo chmod 700 -R moodle/ "
Creating moodledata ddirectory ---> "sudo mkdir ../moodledata"
Configure the software ---> " vi config.php "
Change the following values to meet the server requirements ---> " 
$CFG->dbtype    = 'mysqli'; //Database Type
$CFG->dblibrary = 'native'; //Database Library
$CFG->dbhost    = 'localhost'; //Database Hostname
$CFG->dbname    = 'onb'; //Database Name
$CFG->dbuser    = 'dbuser'; //Database User
$CFG->dbpass    = 'dbpass'; //Database Password
$CFG->prefix    = 'onb_'; //Database Prefix for the tablenames
$CFG->wwwroot   = 'http://localhost/moodle'; //Path to the moodle directory
$CFG->dataroot  = '/var/moodledata'; //Path to the moodledata directory (where the temporary and cached files get stored)
$CFG->admin     = 'admin'; //Name of the admin
$CFG->directorypermissions = 0700; // Directory permissions to the moodle directory
$CFG->passwordsaltmain = 'U]EU@Q?r5 ,EuQ/n3`*+{/UYk'; //Salt for the password storage in the database  
"

Txtweb app ---> " Create an account in the txtweb website as a developer. Create a basic app and give the link to the php program present in the server"
