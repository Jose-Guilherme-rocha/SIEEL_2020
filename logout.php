<?php
    session_start();
    unset($_SESSION["user"]);
    header("location: ../public_html/index.php");
?>