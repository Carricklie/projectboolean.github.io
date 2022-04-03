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
        <title>Organization Representative Dashboard</title>

        <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">

        

        <!-- Bootstrap core CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <script src="Contribution.js"></script>
        <script src="Appeal.js"></script>
        <script src="Disbursement.js"></script>
        <script src="Document.js"></script>
        <style>
            .sidebar{
                border-right: 3px solid #2CE8A4;
            }
            .navbar-dark{
                background: none;
            }
            .navbar{
                border-bottom: 3px solid #2CE8A4;
            }
            .navbar-nav{
                text-align: right;
            }
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

            .custom-toggler.navbar-toggler {
                background: #2ce8a4;
                border-color: #2ce8a4;
                
            }
        </style>

        
        <!-- Custom styles for this template -->
        <link href="dashboard.css" rel="stylesheet">
        
        <?php
            $host = "34.142.167.192";
            $user = "root";
            $password ="";
            $database = "projectboolean";
            $connection = mysqli_connect($host,$user,$password,$database);
            if ( mysqli_connect_errno() ) {
                die( mysqli_connect_error() );
            }
            $getAllUser = "SELECT * FROM usertable WHERE USERTYPE = 'APPLICANT'";
            $result = $connection->query($getAllUser);
            $numOfApplicant = mysqli_num_rows($result);
            echo "<script>var rowsOfApplicant = {$numOfApplicant};</script>";
            $date = date('Y-m-d');
            $getPastAppeal = "SELECT * FROM `appealtable` WHERE '{$date}'>TODATE";
            $currentPastAppeal = $connection->query($getPastAppeal);
            $array2D = $currentPastAppeal->fetch_all(MYSQLI_ASSOC);
            for($i=0;$i<count($array2D);$i++){
                if($array2D[$i]['OUTCOME']==null||$array2D[$i]['OUTCOME']=="Donation Open"){
                    $updateAppeal = "UPDATE `appealtable` SET OUTCOME='Donation Expired' WHERE APPEALID='{$array2D[$i]['APPEALID']}'";
                    $updateOutcome = $connection->query($updateAppeal);
                }
            }
            echo "<script>var PastAppeals = [];</script>";
            for($i=0;$i<count($array2D);$i++){
                $array2D[$i]['DESCRIPTION'] = str_replace("\r", '\n', $array2D[$i]['DESCRIPTION']);
                $array2D[$i]['DESCRIPTION'] = str_replace("\n", '', $array2D[$i]['DESCRIPTION']);
                echo "<script>
                var newAppeal = new Appeal('{$array2D[$i]['APPEALID']}','{$array2D[$i]['APPEALTITLE']}','{$array2D[$i]['TARGETAMOUNT']}','{$array2D[$i]['FROMDATE']}','{$array2D[$i]['TODATE']}',
                '{$array2D[$i]['DESCRIPTION']}','{$array2D[$i]['OUTCOME']}','{$array2D[$i]['ORGID']}');
                PastAppeals.push(newAppeal);
                </script>";
            }
            $getAllAppeal = "SELECT * FROM `appealtable`";
            $allAppeal = $connection->query($getAllAppeal);
            $array2D = $allAppeal->fetch_all(MYSQLI_ASSOC);
            echo "<script>var AllAppeals = [];</script>";
            for($i=0;$i<count($array2D);$i++){
                $array2D[$i]['DESCRIPTION'] = str_replace("\r", '\n', $array2D[$i]['DESCRIPTION']);
                $array2D[$i]['DESCRIPTION'] = str_replace("\n", '', $array2D[$i]['DESCRIPTION']);
                echo "<script>
                var newAppeal = new Appeal('{$array2D[$i]['APPEALID']}','{$array2D[$i]['APPEALTITLE']}','{$array2D[$i]['TARGETAMOUNT']}','{$array2D[$i]['FROMDATE']}','{$array2D[$i]['TODATE']}',
                '{$array2D[$i]['DESCRIPTION']}','{$array2D[$i]['OUTCOME']}','{$array2D[$i]['ORGID']}');
                AllAppeals.push(newAppeal);
                </script>";
            }
            $date = date('Y-m-d');
            $getActiveAppeal = "SELECT * FROM `appealtable` WHERE ('{$date}'>=FROMDATE AND '{$date}'<=TODATE) AND ORGID={$_SESSION['orgID']}";
            $currentActiveAppeal = $connection->query($getActiveAppeal);
            $array2D = $currentActiveAppeal->fetch_all(MYSQLI_ASSOC);
            for($i=0;$i<count($array2D);$i++){
                if($array2D[$i]['OUTCOME']==null||$array2D[$i]['OUTCOME']=="Waiting to Start"){
                    $updateAppeal = "UPDATE `appealtable` SET OUTCOME='Donation Open' WHERE APPEALID='{$array2D[$i]['APPEALID']}'";
                    $updateOutcome = $connection->query($updateAppeal);
                }
            }
            echo "<script>var ActiveAppeals = [];</script>";
            for($i=0;$i<count($array2D);$i++){
                $array2D[$i]['DESCRIPTION'] = str_replace("\r", '\n', $array2D[$i]['DESCRIPTION']);
                $array2D[$i]['DESCRIPTION'] = str_replace("\n", '', $array2D[$i]['DESCRIPTION']);
                echo "<script>
                var newAppeal = new Appeal('{$array2D[$i]['APPEALID']}','{$array2D[$i]['APPEALTITLE']}','{$array2D[$i]['TARGETAMOUNT']}','{$array2D[$i]['FROMDATE']}','{$array2D[$i]['TODATE']}',
                '{$array2D[$i]['DESCRIPTION']}','{$array2D[$i]['OUTCOME']}','{$array2D[$i]['ORGID']}');
                ActiveAppeals.push(newAppeal);
                </script>";
            }
            $date = date('Y-m-d');
            $getFutureAppeal = "SELECT * FROM `appealtable` WHERE '{$date}'<FROMDATE  AND ORGID={$_SESSION['orgID']}";
            $futureAppeal = $connection->query($getFutureAppeal);
            $array2D = $futureAppeal->fetch_all(MYSQLI_ASSOC);
            for($i=0;$i<count($array2D);$i++){
                if($array2D[$i]['OUTCOME']==null){
                    $updateAppeal = "UPDATE `appealtable` SET OUTCOME='Waiting to Start' WHERE APPEALID='{$array2D[$i]['APPEALID']}'";
                    $updateOutcome = $connection->query($updateAppeal);
                }
            }
            echo "<script>var FutureAppeals = [];</script>";
            for($i=0;$i<count($array2D);$i++){
                $array2D[$i]['DESCRIPTION'] = str_replace("\r", '\n', $array2D[$i]['DESCRIPTION']);
                $array2D[$i]['DESCRIPTION'] = str_replace("\n", '', $array2D[$i]['DESCRIPTION']);
                echo "<script>
                var newAppeal = new Appeal('{$array2D[$i]['APPEALID']}','{$array2D[$i]['APPEALTITLE']}','{$array2D[$i]['TARGETAMOUNT']}','{$array2D[$i]['FROMDATE']}','{$array2D[$i]['TODATE']}',
                '{$array2D[$i]['DESCRIPTION']}','{$array2D[$i]['OUTCOME']}','{$array2D[$i]['ORGID']}');
                FutureAppeals.push(newAppeal);
                </script>";
            }
            
            $getAllContri = "SELECT * FROM contributiontable";
            $getContriList = $connection->query($getAllContri);
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
            echo "<script>var currentorgID = '{$_SESSION["orgID"]}'</script>";
            $getalldocument = "SELECT * FROM doctable";
            $result = $connection->query($getalldocument);
            $array2D = $result->fetch_all(MYSQLI_ASSOC);
            echo "<script>var docidExisted = ".count($array2D)."</script>";
            echo "<script>var Documents = [];</script>";
            for($i=0;$i<count($array2D);$i++){
                $array2D[$i]['documentDescription'] = str_replace("\n", '\n', $array2D[$i]['documentDescription']);
                $array2D[$i]['documentDescription'] = str_replace("\r", '', $array2D[$i]['documentDescription']);
                echo "<script>
                var newDocument = new Document('{$array2D[$i]['documentID']}','{$array2D[$i]['filename']}',
                '{$array2D[$i]['documentDescription']}','{$array2D[$i]['username']}');
                Documents.push(newDocument);
                </script>";
            }
            $getAllDisbursement = "SELECT * FROM disbursementtable";
            $getDisbursementList= $connection->query($getAllDisbursement);
            $array2D = $getDisbursementList->fetch_all(MYSQLI_ASSOC);
            echo "<script>var Disbursements = [];</script>";
            for($i=0;$i<count($array2D);$i++){
                $array2D[$i]['GOODDISBURSED'] = str_replace("\n", '\n', $array2D[$i]['GOODDISBURSED']);
                $array2D[$i]['GOODDISBURSED'] = str_replace("\r", '', $array2D[$i]['GOODDISBURSED']);
                echo "<script>
                var newDisburse = new Disbursement('{$array2D[$i]['DISBURSEMENTDATE']}','{$array2D[$i]['CASHAMOUNT']}',
                '{$array2D[$i]['GOODDISBURSED']}','{$array2D[$i]['APPEALID']}','{$array2D[$i]['USERNAME']}');
                Disbursements.push(newDisburse);
                </script>";
            }
        ?>
        <script src="orgRepDashboardScript.js"></script>
        <script>var appealToDonate;</script>
    </head>
    <body>
        
    <header class="navbar navbar-dark bg-light sticky-top flex-md-nowrap p-0">
        <a class="navbar-brand bg-light col-md-3 col-lg-2 me-0 px-3" href="orgRepDashboard.php" style="color:#2CE8A4; box-shadow:none;">HELP AID</a>
        <button class="custom-toggler navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="custom-toggler navbar-toggler-icon"></span>
        </button>
        <p class="w-100" style="margin-bottom:0px; margin-left:0px; padding-left:16px; color:#2ce8a4;">
                Welcome <?php echo $_SESSION["fullname"]?> from <?php echo $_SESSION['orgName']?> !
        </p>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <a class="nav-link-active px-3" href="signOut.php" style="color: #2CE8A4;">Sign out</a>
            </div>
        </div>
    </header>

    <div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" id="dashboardicon" aria-current="page" href="orgRepDashboard.php">
                    <span data-feather="home"></span>
                    Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#registerApplicant" onclick="generateDocID()">
                    <span data-feather="users"></span>
                    Register Applicant
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="modal" href="#" data-bs-target="#createAppeal">
                    <span data-feather="plus-square"></span>
                    Organize Aid Appeal
                    </a>
                </li>
                <li class="nav-item" >
                    <a class="nav-link" id="recordcontribution" href="#" onclick="openiFrame(this,document.getElementById('recordaiddisbursement'),document.getElementById('dashboardicon'),'currentAppeal.php')">
                    <span data-feather="file"></span>
                    Record Contribution
                    </a>
                </li>
                <li class="nav-item" >
                    <a class="nav-link" id="recordaiddisbursement"href="#" onclick="openiFrame(this,document.getElementById('recordcontribution'),document.getElementById('dashboardicon'),'recordDisbursement.php')">
                    <span data-feather="package"></span>
                    Record Disbursement
                    </a>
                </li>
            
            </ul>

            
        </div>
        </nav>

        <div class="col-md-3 col-lg-2 d-md-block"></div>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <!-- Register Applicant Modal -->
            <!-- Vertically centered scrollable modal -->
            <div class="modal fade" id="registerApplicant" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="selfRegister">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Register Applicant Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="addDocumentViaOrg.php" method="post" onsubmit="generateUsernameAndPass()" enctype="multipart/form-data">
                        <input type="text" id="username" name="username" hidden>
                        <input type="text" id="password" name="password" hidden>
                        <div class="modal-body">
                            <div id="registerForm">
                                <div class='row'>
                                    <label for="fullname" class="col-sm-3 col-form-label">Fullname: </label>
                                    <div class="col-sm-9">
                                        <input type="text"onblur="this.value=this.value.trim()" name="fullname" oninput="autoCapital(this)" class="form-control" required placeholder="Please enter your full name">
                                    </div>
                                </div>

                                <div class='row pt-3'>
                                    <label for="idno" class="col-sm-3 col-form-label">ID No: </label>
                                    <div class="col-sm-9">
                                        <input type="text" oninput="noSpacesAndSpecials(this)" name="idno" class="form-control" required placeholder="Please enter your ID number">
                                    </div>
                                </div>

                                <div class='row pt-3'>
                                    <label for="address" class="col-sm-3 col-form-label">Address: </label>
                                    <div class="col-sm-9">
                                        <input type="text"onblur="this.value=this.value.trim()" name="address" class="form-control" required placeholder="Please put your address">
                                    </div>
                                </div>

                                <div class='row pt-3'>
                                    <label for="income" class="col-sm-3 col-form-label">Income:</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="income" class="form-control" required placeholder="Please enter your household income" step=".01">
                                    </div>
                                </div>
                            </div>
                            

                            <div id="docForm" hidden>
                                <input type="text" id="docID" name="documentID" hidden>
                                <div class="row"hidden >
                                    <label for="income" class="col-sm-3 col-form-label">File name:</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly id="filename" name="filename" class="form-control" required placeholder="File Name Auto ">
                                    </div>
                                </div>

                                <div class="row " >
                                    <label for="income" class="col-sm-3 col-form-label">Description:</label>
                                    <div class="col-sm-9">
                                        <textarea type="text"onblur="this.value=this.value.trim()" name="description" class="form-control" required placeholder="Please enter the file description"></textarea>
                                    </div>
                                </div>

                                <div class="row pt-3" >
                                    <label for="formFile" class="col-sm-3 col-form-label">Upload file:</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="fileupload" onchange="puttitle(this,document.getElementById('filename'))" accept="application/pdf,application" required class="form-control">
                                    </div>
                                    
                                </div>
                            </div>

                            
                        </div>
                        
                        <div class="modal-footer">
                            <div id="registerbutton">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="showDocInput()">Next</button>
                            </div>
                            
                            <div id="docbutton" hidden>
                                <button type="button" class="btn btn-secondary" onclick="showRegistrationInput()">Back</button>
                                <input type="submit" class="btn btn-primary" value="Submit Application" >
                            </div>
                            
                        </div>
                    </form>
                </div>
            </div>
            </div>
            <iframe id="mainpage" src="currentAppeal.php" hidden  frameborder="0" style="width:100%;min-height:700px;border:none;"></iframe>
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <div class="btn-toolbar mb-2 mb-md-0" id="headerContent">
                <h1 class="h2">Dashboard</h1>
                    
                </div>
                
            </div>
            <p id="noappeal" class="h2" hidden>No Current Active Appeal</p>
            <div class="table-responsive" id="appealTable">
            <h2>List of Appeals</h2>
                <table class="table table-striped table-sm">
                <thead>
                    <tr>
                    <th scope="col">Status</th>
                    <th scope="col">Appeal ID</th>
                    <th scope="col">Appeal Title</th>
                    <th scope="col">Target</th>
                    <th scope="col">From Date</th>
                    <th scope="col">To Date</th>
                    <th scope="col">Outcome</th>
                    </tr>
                </thead>
                <tbody id="appealTablebody">
                <script>loadTable(document.getElementById('appealTablebody'))</script>
                </tbody>
                </table>
            </div>
            <!-- Modal for Appeal-->
            <div class="modal fade" id="createAppeal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Appeal Creation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form action="addAppeal.php" method="post">
                        <input type="text" id="username" name="username" hidden value="<?php echo $_SESSION['username'] ?>">
                        <input type="text" id="appealinputtext" name="appealid" hidden>
                            <div id="appealForm">
                            <div class='row'>
                                    <label for="appealTitle" class="col-sm-3 col-form-label">Appeal Title : </label>
                                    <div class="col-sm-9">
                                        <input type="text"onblur="this.value=this.value.trim()" oninput="autoCapital(this)" name="appealtitle" class="form-control" required placeholder="Title...">
                                    </div>
                                </div>
                                <div class='row pt-3'>
                                    <label for="totalDonation" class="col-sm-3 col-form-label">Target :  RM</label>
                                    <div class="col-sm-9">
                                        <input type="number" step=".01" name="totalDonation" class="form-control" required placeholder="Donation Target...">
                                    </div>
                                </div>
                                <div class='row pt-3'>
                                    <label for="fromdate" class="col-sm-3 col-form-label">From Date : </label>
                                    <div class="col-sm-9">
                                        <input type="date" onchange="minDate(this)" name="fromdate" class="form-control" required placeholder="Enter From Date!">
                                    </div>
                                </div>

                                <div class='row pt-3'>
                                    <label for="todate" class="col-sm-3 col-form-label">To Date : </label>
                                    <div class="col-sm-9">
                                        <input type="date" id="todate" disabled name="todate" class="form-control" required placeholder="Enter To Date!">
                                    </div>
                                </div>

                                <div class='row pt-3'>
                                    <label for="description" class="col-sm-3 col-form-label">Description : </label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" onblur="this.value=this.value.trim()" name="description" placeholder="Enter Description...." style="width:100%;height:100%"></textarea>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="modal-footer">
                            <div id="registerbutton">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" onclick="generateAppealID()">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>
            <button id="contributionModal"hidden data-bs-toggle="modal" data-bs-target="#createContribution"></button>
            <!--Modal for Contribution-->
            <div class="modal fade" id="createContribution" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Donation Making</h5><br>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div style="text-align:center;">
                                <button id='Goods' class="btn btn-secondary" onclick="goodsMode(this)" disabled>Goods</button>
                                <button id="Cash"class="btn btn-success" onclick="cashMode(this)">Cash</button>
                            </div><br>
                            <div id="appealForm">
                                <form action="addContribution.php" id="form1" method="post">
                                    <input type="text" id="username" name="username" hidden value="<?php echo $_SESSION['username'] ?>">
                                    <input type="text"id="contributionID1" name="contributionID"hidden>
                                    <input type="text"id="appealidtext1" name="appealID" hidden>
                                    <div class='row'>
                                        <label for="description" class="col-sm-3 col-form-label">Description : </label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control"onblur="this.value=this.value.trim()" name="description" placeholder="Enter Description...." style="width:100%;height:100%"></textarea>
                                        </div>
                                    </div>
                                    <div class='row pt-2'>
                                        <label for="estimatedValue" class="col-sm-3 col-form-label">Est Value :  RM</label>
                                        <div class="col-sm-9">
                                            <input type="number"  step=".01" name="estimatedValue" class="form-control" required placeholder="Value...">
                                        </div>
                                    </div><br>
                                    <div id="footer1" class="modal-footer">
                                        <div id="registerbutton">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary"onclick="generateContributionID(document.getElementById('contributionID1'),document.getElementById('appealidtext1'))" >Submit</button>
                                        </div>
                                    </div>
                                </form>
                                <form action="addContribution.php" id="form2" method="post"hidden>
                                    <input type="text" id="username" name="username" hidden value="<?php echo $_SESSION['username'] ?>">
                                    <input type="text"id="contributionID2" name="contributionID"hidden>
                                    <input type="text"id="appealidtext2" name="appealID" hidden>
                                    <div class='row'>
                                        <label for="cashAmount" class="col-sm-3 col-form-label">Cash:  RM</label>
                                        <div class="col-sm-9">
                                            <input type="number" step=".01" name="cashAmount" class="form-control" required placeholder="Value...">
                                        </div>
                                    </div>
                                    <div class='row pt-3'>
                                        <label for="paymentChannel" class="col-sm-3 col-form-label">Payment : </label>
                                            <div class="col-sm-9">
                                                <input type="text"onblur="this.value=this.value.trim()" class="form-control" name="paymentChannel" placeholder="Enter Payment Channel...">
                                            </div>
                                    </div>
                                    <div class='row pt-3'>
                                        <label for="referenceNo" class="col-sm-3 col-form-label">Ref No : </label>
                                        <div class="col-sm-9">
                                            <input type="text"onblur="this.value=this.value.trim()" class="form-control" name="referenceNo" placeholder="Enter Payment Reference Num..">
                                        </div>
                                    </div>
                                    </div><br>
                                    <div id="footer2" class="modal-footer"hidden>
                                        <div id="registerbutton">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" onclick="generateContributionID(document.getElementById('contributionID2'),document.getElementById('appealidtext2'))">Submit</button>
                                        </div>
                                    </div>
                        
                                </form>
                            </div>
                        </div>
                    </div>
                <div>
            </div>
        </main>
    </div>
    </div>
    
        <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>

    
</html>

