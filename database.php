<?php

$host = 'localhost';
$usr = 'root';
$pass = 'toor';
$db = 'ajax';

$link = mysqli_connect($host, $usr, $pass, $db) or die(mysqli_error());