<?php
    session_start();
    include_once "flash.php";
    $connection_handler = new mysqli("34.142.167.192","root","","projectboolean");

    //checking connection
    if ($connection_handler->connect_error) {
        die("Connection failed: " . $connection_handler->connect_error);
    }

    if (isset($_POST["logInUsername"], $_POST["logInPassword"])){
        $username = $_POST['logInUsername'];
        $password = $_POST['logInPassword'];

        $sql = "SELECT * FROM usertable WHERE (username = '$username' AND password = '$password')";
        $result = $connection_handler -> query($sql);
        //fetch once only pls
        $selectedUser = $result -> fetch_assoc();

        if(is_null($selectedUser)){
            header('Location: homePage.php');
            create_flash_message("loginFailed", "Username and password didn't match. Please log in again. Thank you!", FLASH_ERROR);
        }
        else {
            $_SESSION["username"] = $selectedUser['USERNAME'];
            $_SESSION["fullname"] = $selectedUser['FULLNAME'];
            $orgID = $selectedUser['ORGID'];
            if ($selectedUser['USERTYPE'] === "APPLICANT"){
                header('Location: homePage.php');
            }
            else{
                $selectOrgSQL = "SELECT * FROM orgtable WHERE orgID = '$orgID'";
                $selectOrgResult = $connection_handler -> query($selectOrgSQL);
                //fetch once only pls
                $selectedOrg = $selectOrgResult -> fetch_assoc();
                $_SESSION["orgName"] = $selectedOrg["ORGNAME"];
                $_SESSION["orgID"] = $selectedOrg["ORGID"];
                header('Location: orgRepDashboard.php');
                
            }
        }
        
    }
    $connection_handler->close();
?>
    