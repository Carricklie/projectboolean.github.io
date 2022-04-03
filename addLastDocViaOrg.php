<?php
    session_start();
    $username = $_SESSION["username"];
    $target_dir = "uploadedPdf/";
    $thefile = $_FILES["fileupload"]["name"];
    $targetfile = $target_dir . basename($thefile);
    $docID = $_POST["documentID"];
    $filename = $_POST["filename"];
    $description = $_POST["description"];
    $connection_handler = new mysqli("34.142.167.192","root","","projectboolean");

    //checking connection
    if ($connection_handler->connect_error) {
        die("Connection failed: " . $connection_handler->connect_error);
    }

    $addDoc = "INSERT INTO `doctable` (`DOCUMENTID`, `FILENAME`, `DOCUMENTDESCRIPTION`, `USERNAME`) 
        VALUES('$docID', '$filename', '$description', '$username')"; 
    $addnewdoc = $connection_handler->query($addDoc);
    if (move_uploaded_file($_FILES["fileupload"]["tmp_name"], $targetfile)) {
        echo"<script>alert('The file ". htmlspecialchars( basename( $thefile)). " has been uploaded.')</script>";
    } else {
        echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
    }

    $connection_handler->close();
    header("Location: orgRepDashboard.php");
    exit();
?>