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
        $username = $_POST["username"];
        $appealtitle = $_POST["appealtitle"];
        $totaldonation = $_POST["totalDonation"];
        $_SESSION["username"] = $username;
        $fromDate = $_POST["fromdate"];
        $toDate = $_POST["todate"];
        $appealid = $_POST["appealid"];
        $description = $_POST["description"];
        $host = "34.142.167.192";
        $user = "HelpAidAccess";
        $password ="";
        $database = "projectboolean";
        $connection = mysqli_connect($host,$user,$password,$database);
        if ( mysqli_connect_errno() ) {
            die( mysqli_connect_error() );
        }
        $searchuser = "SELECT * FROM `usertable` WHERE username = '$username'";
        $result = $connection->query($searchuser);
        if($result===FALSE){
            echo "<script>
                alert('User not Founded!');
                window.location.href='orgRepDashboard.php';
            </script>";
        }else{
            $array = $result->fetch_assoc();
            $orgid = $array["ORGID"];
            $_SESSION["orgID"] = $orgid;
            $_SESSION["fullname"] = $array["FULLNAME"];
            $searchorg= "SELECT * FROM `orgtable` WHERE orgid = $orgid";
            $result = $connection->query($searchorg);
            if($result===FALSE){
                echo "<script>
                    alert('Organization not Founded!');
                    window.location.href='orgRepDashboard.php';
                </script>";
            }else{
                $array = $result->fetch_assoc();
                $_SESSION["orgName"] = $array["ORGNAME"];
            }
        }
        $addAppeal = "INSERT INTO `appealtable`(`APPEALID`,`APPEALTITLE`, `TARGETAMOUNT`,`FROMDATE`,`TODATE`,`DESCRIPTION`,`ORGID`) VALUES ('$appealid','$appealtitle',$totaldonation,'$fromDate','$toDate','$description','$orgid')";
        $result = $connection->query($addAppeal);
        if($result===FALSE){
            echo "<script>
            alert('Failed to Add!');
                window.location.href='orgRepDashboard.php';
            </script>";
        }else{
            echo "<script>
            alert('Appeal Creation Success!');
                window.location.href='orgRepDashboard.php';
            </script>";
        }
    
    ?>
</body>
</html>