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
        $orgName = $_POST["orgName"];
        $orgAddress = $_POST["orgAddress"];
        $host = "34.142.167.192";
        $user = "HelpAidAccess";
        $password ="";
        $database = "projectboolean";
        $connection = mysqli_connect($host,$user,$password,$database);
        if ( mysqli_connect_errno() ) {
            die( mysqli_connect_error() );
        }
        $addOrg = "INSERT INTO `orgtable`(`ORGNAME`, `ORGADDRESS`) VALUES ('$orgName','$orgAddress')";
        $result = $connection->query($addOrg);
        echo "<script>
            alert('Organization Added!');
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