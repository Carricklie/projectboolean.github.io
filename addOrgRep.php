<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
        $adminpass = $_POST["password"];
        $orgID = $_POST["orgID"];
        $username = $_POST["username"];
        $password = $_POST["orgRepPassword"];
        $fullName = $_POST["fullName"];
        $email = $_POST["email"];
        $mobileNo =  $_POST["mobileNo"];
        $jobTitle =  $_POST["jobTitle"];
        $host = "34.142.167.192";
        $user = "HelpAidAccess";
        $dbpassword ="";
        $database = "projectboolean";
        $connection = mysqli_connect($host,$user,$dbpassword,$database);
        if ( mysqli_connect_errno() ) {
            die( mysqli_connect_error() );
        }
        $addOrgRep = "INSERT INTO `usertable`(`USERNAME`, `PASSWORD`, `FULLNAME`, `EMAIL`, `MOBILENO`, `USERTYPE`, `JOBTITLE`,`ORGID`) 
        VALUES ('$username','$password','$fullName','$email','$mobileNo','ORGREP','$jobTitle','$orgID')";
        $result = $connection->query($addOrgRep);
        echo "<script>";
        if($result === TRUE){
            $subject = "User Account, Type : Organization Representative Created!";
            $body = "Your Organization Representative Account For the HelpAidOrganization is Created!\nGenerated Password : $password\nPhone Number : $mobileNo";
            $sender = "From:HelpAidSystem@pBoolean.com";
            if(mail($email, $subject, $body, $sender)){
                echo"alert('Organization Representative Added! Email sent successfully to $email');";
            }
        }else{
            echo"alert('Username Existed !!!');";
        }
        echo "
            var form = document.createElement('form');
            form.setAttribute('method','post');
            form.setAttribute('action','HelpAidAdmin.php');  
            var passwordText = document.createElement('input');
            passwordText.hidden = true;
            passwordText.setAttribute('type','text');
            passwordText.setAttribute('name','password');
            passwordText.value = '$adminpass';
            form.appendChild(passwordText);
            document.body.appendChild(form);
            form.submit();
        </script>"
    ?>
</body>
</html>