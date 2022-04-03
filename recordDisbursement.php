<?php
header('Cache-Control: no-store, no-cache, must-revalidate');
session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Organization Record Disbursement</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/checkout/">

    
    <script src="Contribution.js"></script>
    <script src="Disbursement.js"></script>
    <script src="Document.js"></script>
    <script src="recordDisbursement.js"></script>
    <!-- <script src="Appeal.js"></script> -->


    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
        .navbar{
            border-bottom: 3px solid #2CE8A4;
        }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
    <link href="form-validation.css" rel="stylesheet">

    <?php
        // Return current date from the remote server
        $date = date('Y-m-d');
        $connection_handler = new mysqli("34.142.167.192","root","","projectboolean");
        $getAllContri = "SELECT * FROM contributiontable";
        $getContriList = $connection_handler->query($getAllContri);
        $array2D = $getContriList->fetch_all(MYSQLI_ASSOC);
        echo "<script>var Contributions = [];</script>";
        for($i=0;$i<count($array2D);$i++){
            $array2D[$i]['DESCRIPTION'] = str_replace("\r", '\n', $array2D[$i]['DESCRIPTION']);
            $array2D[$i]['DESCRIPTION'] = str_replace("\n", '', $array2D[$i]['DESCRIPTION']);
            echo "<script>
            var contri = new Contribution('{$array2D[$i]['CONTRIBUTIONID']}','{$array2D[$i]['RECEIVEDDATE']}','{$array2D[$i]['AMOUNT']}',
            '{$array2D[$i]['PAYMENTCHANNEL']}','{$array2D[$i]['REFERENCENO']}','{$array2D[$i]['DESCRIPTION']}','{$array2D[$i]['ESTIMATEDVALUE']}',
            '{$array2D[$i]['APPEALID']}');
            Contributions.push(contri);
            </script>";
        }
    ?>

    <script>
        var documents = [];
        var documentsindex;
        documentsindex=0;
        var donationleft = 0;
    </script>
  </head>
  <body class="bg-white">
    <div class="container">
    <main>
        <div class="py-5 text-center">
        <h2>Record Disbursement</h2>
        </div>

        <div class="row g-5" >
            <div class="col-md-5 col-lg-4 order-md-last" id="contriAndAppealDetails" hidden>
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span>Appeal Details</span>
                </h4>
                <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                    <h6 class="my-0">From date:</h6>
                    <small class="text-muted">The start date of the appeal</small>
                    </div>
                    <span class="text-muted" id="fromDate"></span>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                    <h6 class="my-0">To date:</h6>
                    <small class="text-muted">The end date of the appeal</small>
                    </div>
                    <span class="text-muted" id="toDate"></span>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div style="width:100%">
                    <textarea  id="description" disabled style="width:100%"></textarea>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                    <h6 class="my-0">Target :</h6>
                    <small class="text-muted" id="appealTarget"></small>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                    <h6 class="my-0">Disbursed :</h6>
                    <small class="text-muted" id="disbursedAmount"></small>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                    <h6 class="my-0">Total Donation Left :</h6>
                    <small class="text-muted" id="amountleft"></small>
                    </div>
                </li>
                </ul>

                <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span>Contribution List</span>
                </h4>
                <div class="list-group mb-3">
                    <div class="table-responsive" style="height:218px; overflow-y:scroll;">
                        <table class="table table-striped table-sm" id="contributionTable">
                            <thead>
                                <th>Contribution ID</th>
                                <th>Received Date</th>
                                <th>Details</th>
                            </thead>
                        </table>
                    </div>
                </div>

                
                <div class="list-group mb-3">
                    <button type="button" class="btn btn-secondary" id="viewApplicantList" onclick="showApplicant();">View Applicant</button>
                </div>

                <div id="applicantList" hidden>
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span>Applicant List</span>
                    </h4>
                    <div class="list-group mb-3">
                        <div class="table-responsive" style="height:100px; overflow-y:scroll;">
                            <table class="table table-striped table-sm" id="contributionTable">
                                <thead style="position: sticky;top:0;background-color:white">
                                    <th>Applicant ID No</th>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql = "SELECT * FROM usertable";
                                        $result = $connection_handler->query($sql);
                                        $applicantIDNo = "";
                                        if($result -> num_rows > 0){
                                            $i=0;
                                            while($row = $result -> fetch_assoc()){
                                                if ($row['ORGID'] == $_SESSION['orgID']){
                                                    if ($row['USERTYPE'] == "APPLICANT"){
                                                        $applicantIDNo = $applicantIDNo . $row["IDNO"] . "<br>";
                                                    }
                                                    $i++;
                                                }
                                            }
                                            if ($i==0){
                                                $applicantIDNo = "No Applicant Available";
                                                echo "<td>".$applicantIDNo."</td>";
                                            }
                                            else {
                                                echo "<td>".$applicantIDNo."</td>";

                                            }
                                            
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="applicantDetails" hidden>
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span>Applicant Details</span>
                    </h4>
                    <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                        <h6 class="my-0">Name:</h6>
                        <small class="text-muted">Name of the applicant</small>
                        </div>
                        <span class="text-muted" id="applicantName">Michael Wijaya</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                        <h6 class="my-0">Address:</h6>
                        <small class="text-muted">Address of the applicant</small>
                        </div>
                        <span class="text-muted" id="applicantAddress">Jalan something</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                        <h6 class="my-0">Household Income:</h6>
                        <small class="text-muted">Household income of the applicant</small>
                        </div>
                        <span class="text-muted" id="householdIncome">10000000</span>
                    </li>
                    </ul>
                </div>
                
                
            </div>
            

            <div class="col-md-7 col-lg-8">
                <h4 class="mb-3">Record Disbursement Form</h4>
                
                <form action="addDisbursement.php" id="recordDisburseForm" method="post">
                <input type="text" id="username" name="username" hidden value="<?php echo $_SESSION['username'] ?>">
                <div class="row g-3">
                    <div class="col-sm-6">
                    <label for="appealID" class="form-label">Appeal ID</label>
                    <input type="text" hidden name="donationleft" id="donationleft">
                    <select class="form-control" onchange="getAppealDetails(this)" name="appealID" id="appealIDSelect" required>
                        <option value="" disable selected hidden>Select the Appeal ID</option>
                        <?php
                            //checking connection
                            if ($connection_handler->connect_error) {
                                die("Connection failed: " . $connection_handler->connect_error);
                            }
                            $sql = "SELECT * FROM appealtable";
                            $result = $connection_handler->query($sql);
                            
                            if($result -> num_rows > 0){
                                $i=0;
                                while($row = $result -> fetch_assoc()){
                                    if ($row['ORGID'] == $_SESSION['orgID']){
                                        if ($row['TODATE'] < $date){
                                            $row['DESCRIPTION'] = str_replace("\r", '\n', $row['DESCRIPTION']);
                                            $row['DESCRIPTION'] = str_replace("\n", '', $row['DESCRIPTION']);
                                            echo "<option value=\"${row['APPEALID']}\" data-from-date=\"${row['FROMDATE']}\" data-to-date=\"${row['TODATE']}\" data-desc=\"${row['DESCRIPTION']}\" data-target-amount=\"${row['TARGETAMOUNT']}\">${row['APPEALID']}</option>";
                                        }
                                        $i++;
                                    }
                                }
                                if ($i==0){
                                    echo "<option selected hidden disabled>No appeal available for now</option>";
                                }
                                
                            }
                        ?>
                        
                    </select>
                    </div>

                    <div class="col-sm-6">
                    <label for="lastName" class="form-label">Applicant ID No</label>
                    <select class="form-control"disabled onchange="getApplicantDetails(this)" name="applicantID" id="applicantIDSelect" required>
                        <option value="" disable selected hidden>Select Applicant ID</option>
                        <?php
                            //checking connection
                            if ($connection_handler->connect_error) {
                                die("Connection failed: " . $connection_handler->connect_error);
                            }
                            $sql = "SELECT * FROM usertable";
                            $result = $connection_handler->query($sql);
                            
                            if($result -> num_rows > 0){
                                $i=0;
                                while($row = $result -> fetch_assoc()){
                                    if ($row['ORGID'] == $_SESSION['orgID']){
                                        if ($row['USERTYPE'] == "APPLICANT"){
                                            echo "<option value=\"${row['USERNAME']}\" data-name=\"${row['FULLNAME']}\" data-address=\"${row['ADDRESS']}\" data-income=\"${row['HOUSEHOLDINCOME']}\">${row['IDNO']}</option>";
                                        }
                                        $i++;
                                    }
                                }
                                if ($i==0){
                                    echo "<option>No applicant available for now</option>";
                                }
                                
                            }
                        ?>
                    </select>
                    </div>

                    <div class="col-12">
                    <label for="username" class="form-label">Disbursement Date</label>
                    <div class="input-group has-validation">
                        <input type="date" name="disbursementDate" class="form-control" id="disbursementDate" required>
                        <script>
                            var today = new Date();
                            var date = today.toISOString().split('T')[0];
                            document.getElementById("disbursementDate").min = date;
                        </script>
                    </div>

                    <div class="col-12">
                    <label for="cashAmount" class="form-label">Cash Amount</label>
                    <input type="number" disabled min="1" oninput="allowDistribute(document.getElementById('appealIDSelect'),this,document.getElementById('submitButton'))" name="cashAmount" class="form-control" id="cashAmount" required min=0>
                    </div>

                    <div class="col-12">
                    <label for="goods" class="form-label">Goods</label>
                    <textarea type="text"onblur="this.value=this.value.trim()" name="goods" class="form-control" id="goods" required></textarea>
                    </div>

                    

                <hr class="my-4">

                <button type="submit"id="submitButton" disabled class="w-100 btn btn-secondary btn-lg" onclick="return validate()">Record Disbursement</button>
                </form>
            </div>
            
            <textarea id="documentDescription"class="form-control" hidden readonly></textarea>
            <embed id="seeDocument" width="auto" style="min-height:500px;" style="border: black  5px solid;" hidden>
        </div>
        <div class="row mt-3">
            <div class="col">
                <button id="prevButton"disabled onclick="prevDoc(this,document.getElementById('nextButton'))"hidden class="w-100 btn btn-secondary btn-lg">Prev</button>
            </div>
            <div class="col">
                <button id="nextButton" onclick="nextDoc(this,document.getElementById('prevButton'))"hidden class="w-100 btn btn-primary btn-lg">Next</button>
            </div>
        </div>
        
        <br>
    </main>

    <footer class="my-5 pt-5 text-muted text-center text-small">
        
    </footer>
    </div>


        <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
