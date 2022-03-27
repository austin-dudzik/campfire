<?php
// Include the init file
include ("functions/init.php");

// Destroy the session
session_destroy();

// Redirect to login page
redirect("login");
