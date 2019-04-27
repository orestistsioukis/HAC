<?php

if (isset($_POST['submit'])) {
    $name = htmlspecialchars($_POST['fullname']);
    $mailFrom = htmlspecialchars($_POST['mail']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    if (empty($name) || empty($mailFrom) || empty($subject) || empty($message)) {
        header("Location: ../contact.php?error=emptyfields&fullname=".$name."&mail=".$mailFrom."&subject=".$subject."&message=".$message);
        exit();
    }
    else if (!filter_var($mailFrom, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../contact.php?error=invalidmail&fullname=".$name."&subject=".$subject."&message=".$message);
        exit();
    }  
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $name) && !preg_match("/^[a-zA-Z0-9]*$/", $subject) && !preg_match("/^[a-zA-Z0-9]*$/", $message)) {
        header("Location: ../contact.php?error=invalidchar&mail=".$mailFrom);
        exit();
    }  
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $name)) {
        header("Location: ../contact.php?error=invalidname&mail=".$mailFrom."&subject=".$subject."&message=".$message);
        exit();
    }  
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $subject)) {
        header("Location: ../contact.php?error=invalidsubject&fullname=".$name."&mail=".$mailFrom."&message=".$message);
        exit();
    }  
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $message)) {
        header("Location: ../contact.php?error=invalidmessage&fullname=".$name."&mail=".$mailFrom."&subject=".$subject);
        exit();
    }  
    else {
        $mailTo = "hac@mail.com";
        $headers = "From: ".$mailFrom;
        $txt = "You have received an e-mail from ".$name.".\n\n".$message;
    
        if (mail($mailTo, $subject, $txt, $headers)){
            header("Location: ../contact.php?success=mailsent");
            exit();
        } else {
            header("Location: ../contact.php?error=mailnotsent");
            exit();
        }
    }
} else {
    header("Location: ../contact.php");
    exit();
}