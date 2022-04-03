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
    $host = "34.142.167.192";
    $user = "HelpAidAccess";
    $password ="";
    $database = "projectboolean";
    $connection = mysqli_connect($host,$user,$password,$database);
    if ( mysqli_connect_errno() ) {
        die( mysqli_connect_error() );
    }
    if(isset( $_POST["username"])){
        $username = $_POST["username"];
        $_SESSION["username"] = $username;
    }
    $contributionID = $_POST["contributionID"];
    $appealID = $_POST["appealID"];
    $today = date('Y-m-d');

    if(isset($_POST["referenceNo"])){
        $reference = $_POST["referenceNo"];
        $paymentChannel = $_POST["paymentChannel"];
        $cashAmount = $_POST["cashAmount"];
        $addCashDonation = "INSERT INTO `contributiontable`(`CONTRIBUTIONID`,`RECEIVEDDATE`, `AMOUNT`,`PAYMENTCHANNEL`,`REFERENCENO`,`APPEALID`) 
        VALUES ('$contributionID','$today',$cashAmount,'$paymentChannel','$reference','$appealID');";
        $result = $connection->query($addCashDonation);
    }else{
        $estvalue = (float)$_POST["estimatedValue"];
        $description = $_POST["description"];
        $addGoodsDonation = "INSERT INTO `contributiontable`(`CONTRIBUTIONID`,`RECEIVEDDATE`, `DESCRIPTION`,`ESTIMATEDVALUE`,`APPEALID`) 
        VALUES ('$contributionID','$today','$description',$estvalue,'$appealID');";
        $result = $connection->query($addGoodsDonation);
    }

    if(!isset( $_POST["username"]) && $result===true){
        echo "<script>
        alert('Contribution Added! Thanks For Donation!');
            window.location.href='viewAppeal.php';
        </script>";
    }
    else if($result===FALSE){
        echo "<script>
        alert('Failed to Add!');
            window.location.href='orgRepDashboard.php';
        </script>";
    }else{
        echo "<script>
        alert('Contribution Added! Thanks For Donation!');
            window.location.href='orgRepDashboard.php';
        </script>";
    }
    ?>
</body>
</html>