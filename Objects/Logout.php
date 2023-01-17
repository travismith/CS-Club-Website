<?php
    include '../Resources/SessionResources.php';

    if (isset($_SESSION["SessionID"]))
    {
        echo "Session ID: " . $_SESSION["SessionID"] . "<br>";
        echo "Session Pass attempt: " . $_SESSION["SessionPasswordAttempt"];
        
        UnauthenticateSession();

        echo "Session ID: " . $_SESSION["SessionID"] . "<br>";
        echo "Session Pass attempt: " . $_SESSION["SessionPasswordAttempt"];    
    }

    Header('Location: ../index.php');
    exit();
?>