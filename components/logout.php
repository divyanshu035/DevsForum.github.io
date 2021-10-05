<?php
    session_start();
    session_destroy();
    header ("location: /forums/index.php");

?>