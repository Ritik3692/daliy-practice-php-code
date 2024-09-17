<?php
session_start(); 

if (!isset($_SESSION['counter'])) {
     echo "nikhil";
    $_SESSION['counter'] = 10;
} else {
     
    //    11%11 = 0
    $_SESSION['counter'] = ($_SESSION['counter'] -1+11)%11;   
}
echo $_SESSION['counter'];

?>
