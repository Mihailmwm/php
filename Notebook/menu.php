<?php
require 'menu.php'; // главное меню

// модули с контентом страницы

if( $_GET['p'] == 'viewer' ) { include 'viewer.php'; } else if( $_GET['p'] == 'add' ) { include 'add.php'; } else

if( $_GET['p'] == 'edit' ) { include 'edit.php'; } else

if( $_GET['p'] == 'delete' ) { include 'delete.php'; }
?>