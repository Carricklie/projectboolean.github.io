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
        <title>HELP Aid View Appeal</title>

        <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">
        
        <script src="Appeal.js"></script>
        <script src="Contribution.js"></script>
        

        <!-- Bootstrap core CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <style>
            .sidebar{
                border-right: 3px solid #2CE8A4;
            }
            .navbar-dark{
                background: none;
            }
            .navbar{
                background-color: #2CE8A4;
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

        <?php
            $host = "34.142.167.192";
            $user = "root";
            $password ="";
            $database = "projectboolean";
            $connection = mysqli_connect($host,$user,$password,$database);
            if ( mysqli_connect_errno() ) {
                die( mysqli_connect_error() );
            }
            $date = date('Y-m-d');
            $getActiveAppeal = "SELECT * FROM `appealtable` WHERE ('{$date}'>=FROMDATE AND '{$date}'<=TODATE)";
            $currentActiveAppeal = $connection->query($getActiveAppeal);
            $array2D = $currentActiveAppeal->fetch_all(MYSQLI_ASSOC);
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
            $getPastAppeal = "SELECT * FROM `appealtable` WHERE '{$date}'>TODATE";
            $currentPastAppeal = $connection->query($getPastAppeal);
            $array2D = $currentPastAppeal->fetch_all(MYSQLI_ASSOC);
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
        ?>
        <!-- Custom styles for this template -->
        <link href="dashboard.css" rel="stylesheet">
        
        <script>
            function changeAppeal(myself,other,target){
                document.getElementById("viewAppealFrame").src = target;
                myself.setAttribute("class","nav-link active");
                other.setAttribute("class","nav-link");
            }
            function generateContributionID(contributionIDContainer,appealidText){
                var counter =0;
                Contributions.forEach(contribution=>{
                    counter++;
                });
                contributionIDContainer.value="CON"+(counter+1);
                appealidText.value=appealToDonate;
            }
        </script>
    </head>
    <body>
        
    <header class="navbar navbar-dark sticky-top flex-md-nowrap p-0">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="homepage.php" style="background: none; box-shadow:none;">HELP AID</a>
        <button class="custom-toggler navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="custom-toggler navbar-toggler-icon"></span>
        </button>
        <p class="w-100" style="margin-bottom:0px; margin-left:0px; padding-left:16px; color:#2ce8a4;">
        </p>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <a class="nav-link-active px-3" href="signOut.php" style="color: white;">Go to Home</a>
            </div>
        </div>
    </header>

    <div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active"id="li1" href="#" aria-current="page" onclick="changeAppeal(this,document.getElementById('li2'),'currentAppeal.php')">
                    <span data-feather="list"></span>
                    Current Appeal
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"id="li2" href="#" onclick ="changeAppeal(this,document.getElementById('li1'),'pastAppeal.php')">
                    <span data-feather="list"></span>
                    Past Appeal
                    </a>
                </li>
            
            </ul>

            
        </div>
        </nav>

        <div class="col-md-3 col-lg-2 d-md-block"></div>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="ratio ratio-1x1">
                <iframe src="currentAppeal.php" id="viewAppealFrame" style="min-height:670px;overflow:hidden;height:100%;width:100%;"></iframe>
            </div>
            <button id="contributionModal" hidden data-bs-toggle="modal"data-bs-target="#createContribution"></button>
            <!--Modal for Contribution-->
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
                            </div>
                            <div id="appealForm">
                                <form action="addContribution.php" id="form" method="post">
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
                                    <div id="footer2" class="modal-footer">
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

