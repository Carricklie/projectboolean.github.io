<?php
    $username = $_POST["username"];
    $_SESSION["username"] = $username;
    $appealID = $_POST["appealID"];
    $applicantID = $_POST["applicantID"];
    $disbursementDate = $_POST["disbursementDate"];
    $cashAmount = $_POST["cashAmount"];
    $goods = $_POST["goods"];
    $donationleft = $_POST["donationleft"];

    $connection_handler = new mysqli("34.142.167.192","root","","projectboolean");

    //checking connection
    if ($connection_handler->connect_error) {
        die("Connection failed: " . $connection_handler->connect_error);
    }

    $addDisbursement = "INSERT INTO `disbursementtable` (`DISBURSEMENTDATE`, `CASHAMOUNT`, `GOODDISBURSED`, `APPEALID`, `USERNAME`) 
        VALUES('$disbursementDate', '$cashAmount', '$goods', '$appealID', '$applicantID')"; 
    $addDisbursementResult = $connection_handler->query($addDisbursement);
    if($addDisbursementResult===FALSE){
        echo "<script>parent.alert('Disbursement Error!')</script>";
    }else{
        if((float)$donationleft-(float)$cashAmount==0){
            $updateAppeal = "UPDATE `appealtable` SET OUTCOME='Appeal Closed' WHERE APPEALID='{$appealID}'";
            $updateOutcome = $connection_handler->query($updateAppeal);
        }else{
            $updateAppeal = "UPDATE `appealtable` SET OUTCOME='On Disbursement' WHERE APPEALID='{$appealID}'";
            $updateoutcome = $connection_handler->query($updateAppeal);
        }
        echo "<script>parent.alert('Disbursement Added!')</script>";
    }
   
    echo "<script>parent.window.location.href = 'orgRepDashboard.php'</script>";
    $connection_handler->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Disbursement</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script>
        function clickModal(){
            document.getElementById("modalButton").click();
        }
    </script>
</head>
<body>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

    
</html>