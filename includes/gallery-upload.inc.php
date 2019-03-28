<?php

if (isset($_POST['submit'])) {

    $newFileName = $_POST['filename'];
    if (empty($newFileName)) {
        $newFileName = "gallery";
    } else {
        // replace spaces with dashes on the file name
        $newFileName = strtolower(str_replace(" ", "-", $newFileName));
    }
    $imageTitle = $_POST['filetitle'];
    $imageDesc = $_POST['filedesc'];
    
    $file = $_FILES['file'];

    $fileName = $file["name"];
    $fileType = $file["type"];
    $fileTempName = $file["tmp_name"];
    $fileError = $file["error"];
    $fileSize = $file["size"];
    // explode file name
    $fileExt = explode(".", $fileName);
    // get the extension
    $fileActualExt = strtolower(end($fileExt));
    // allowed extensions
    $allowed = array("jpg", "jpeg", "png");

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 4194304) {
                // 4*1024*1024 = 4194304b == 4mb
                // make a unique file name 
                $imageFullName = $newFileName . "." . uniqid("", true) . "." . $fileActualExt;
                $fileDestination = "../img/gallery/" . $imageFullName;

                include_once "dbh.inc.php";

                if (empty($imageTitle) || empty($imageDesc)) {
                    header("Location: ../gallery.php?upload=empty");
                    exit();
                } else {
                    $sql = "SELECT * FROM gallery;";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: ../gallery.php?error=sqlerror");
                        exit();
                    } else {
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $rowCount = mysqli_num_rows($result);
                        $setImageOrder = $rowCount + 1;
                        
                        $sql = "INSERT INTO gallery (titleGallery, descGallery, imgFullNameGallery, orderGallery) VALUES (?, ?, ?, ?);";
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            header("Location: ../gallery.php?error=sqlerror");
                            exit();
                        } else {
                            mysqli_stmt_bind_param($stmt, "ssss", $imageTitle, $imageDesc, $imageFullName, $setImageOrder);
                            mysqli_stmt_execute($stmt);
                            move_uploaded_file($fileTempName, $fileDestination);
                            header("Location: ../gallery.php?upload=success");
                        }
                    }
                }
            } else {
                header("Location: ../gallery.php?error=oversizedfile");
                exit();
            }
        } else {
            header("Location: ../gallery.php?error=error");
            exit();
        }
    } else {
        header("Location: ../gallery.php?error=filetype");
        exit();
    }

}





















