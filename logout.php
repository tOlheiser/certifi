<?php 
session_start();

//Destroy all data contained in the session variable
session_destroy();

//relocate the user to index.php
header("Location: index.php");
