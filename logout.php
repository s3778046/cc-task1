<?php 
session_start();

session_destroy();

?><script>window.location.replace("login.php");</script><?php

?>