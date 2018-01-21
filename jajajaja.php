<?php

require_once 'classes/Database.php';
require_once 'classes/User.php';
require_once 'classes/Group.php';
require_once 'classes/Category.php';
require_once 'classes/Student.php';
require_once  'classes/Group_Tag.php';
require_once  'classes/Tag.php';
require_once  'classes/Student.php';

session_start();


if(isset($_SESSION)){
    echo "true";
}else {
echo "false";
}
?>