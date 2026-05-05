<?php
session_start();
session_unset();
session_destroy();
echo "Sessions Cleared! Now go back to login.html";
?>