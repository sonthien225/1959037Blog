<?php

// start the session
session_start();
// unset array
$_SESSION = [];
//destroy session
session_destroy();
//redirect user to home
header("Location: index.php?logout=true");


?>
