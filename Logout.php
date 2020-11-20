<?php
session_start();
unset($_SESSION['loggedin']);
session_destroy();
header("Location: npage.php?page=index.php&success=Logout Successfully");
