<?php header('Cache-Control: no-store, no-cache, must-revalidate');
    session_start();
    include_once "flash.php";
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Hugo 0.88.1">
        <title>HELPAid Homepage</title>
        <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/carousel/">

        <!-- <script src="registerApplicantJS.js"></script> -->
        <?php
            $host = "34.142.167.192";
            $user = "root";
            $password ="";
            $database = "projectboolean";
            $connection = mysqli_connect($host,$user,$password,$database);
            if ( mysqli_connect_errno() ) {
                die( mysqli_connect_error() );
            }
            $getAllUser = "SELECT * FROM usertable WHERE usertype = 'APPLICANT'";
            $result = $connection->query($getAllUser);
            $numOfApplicant = mysqli_num_rows($result);
            echo "<script>var rowsOfApplicant = {$numOfApplicant};</script>";
            $getalldocument = "SELECT * FROM doctable";
            $result = $connection->query($getalldocument);
            $array2D = $result->fetch_all(MYSQLI_ASSOC);
            echo "<script>var docidExisted = ".count($array2D)."</script>"
        ?>
        <script src="homepage.js"></script>

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
            .navbar-dark {
                background: #2CE8A4;
            }
            .bg-danger{
                color: #ffffff;
            }
        </style>

        
        <!-- Custom styles for this template -->
        <link href="carousel.css" rel="stylesheet">
    </head>
    <body>
    
        <header>
            <nav class="navbar navbar-expand-md navbar-dark fixed-top">
                <div class="container-fluid">
                <a class="navbar-brand" href="homePage.php">HELP AID</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    </ul>
                    <ul class="navbar-nav my-2 my-lg-0" >
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="viewAppeal.php">VIEW APPEALS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#logIn">LOG IN</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#selfRegister"
                            onclick="generateDocID()">
                            SIGN UP</a>
                        </li>
                    </ul>
                </div>
                </div>
            </nav>
        </header>

        <main>
            <?php display_flash_message("loginFailed");?>
            <!-- Log In Modal -->
            <div class="modal fade" id="logIn" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="logIn">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Log In</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="logIn.php" method="post">
                        <div class="modal-body">
                            <div class="row">
                                <label for="organization" class="col-sm-3 col-form-label">Username: </label>
                                <div class="col-sm-9">
                                    <input type="text"onblur="this.value=this.value.trim()" id="logInUsername" name="logInUsername" class="form-control" required>
                                </div>
                            </div>

                            <div class='row pt-3'>
                                <label for="fullname" class="col-sm-3 col-form-label">Password: </label>
                                <div class="col-sm-9">
                                    <input type="password"onblur="this.value=this.value.trim()" id="logInPassword" name="logInPassword" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" value="Log In">
                        </div>
                    </form>
                </div>
            </div>
            </div>

            <!-- Register Applicant Modal -->
            <!-- Vertically centered scrollable modal -->
            <div class="modal fade" id="selfRegister" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="selfRegister">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Self Registration</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="addDocument.php" method="post" onsubmit="generateUsernameAndPass()" enctype="multipart/form-data">
                        <input type="text" id="username" name="username" hidden>
                        <input type="text" id="password" name="password" hidden>
                        <div class="modal-body">
                            <div id="registerForm">
                                <div class="row">
                                    <label for="organization" class="col-sm-3 col-form-label">Organization: </label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="orgID" id="" required>
                                            <option value="" selected disabled hidden>Select your organization</option>
                                            <?php
                                                $connection_handler = new mysqli("34.142.167.192","root","","projectboolean");

                                                //checking connection
                                                if ($connection_handler->connect_error) {
                                                    die("Connection failed: " . $connection_handler->connect_error);
                                                }

                                                $sql = "SELECT orgName, orgAddress, orgID FROM orgtable";
                                                $result = $connection_handler->query($sql);
                                                if($result -> num_rows > 0){
                                                    //display centre name in the select option
                                                    while($row = $result -> fetch_assoc()){
                                                        echo "<option value=\"${row['orgID']}\" data-address=\"${row['orgAddress']}\">${row['orgName']}</option>";
                                                    }
                                                }

                                                $connection_handler->close();
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class='row pt-3'>
                                    <label for="fullname" class="col-sm-3 col-form-label">Fullname: </label>
                                    <div class="col-sm-9">
                                        <input type="text"onblur="this.value=this.value.trim()" oninput="autoCapital(this)" name="fullname" class="form-control" required placeholder="Please enter your full name">
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
                                    <label for="income" class="col-sm-3 col-form-label">Income: RM</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="income" class="form-control" required placeholder="Please enter your household income" step=".01">
                                    </div>
                                </div>
                            </div>
                            

                            <div id="docForm" hidden>
                                <input type="text" id="docID" name="documentID" hidden>
                                <div class="row" hidden>
                                    <label for="income" class="col-sm-3 col-form-label">File name:</label>
                                    <div class="col-sm-9">
                                        <input type="text"id="filename" name="filename" readonly class="form-control" required placeholder="Please enter the file name">
                                    </div>
                                </div>

                                <div class="row" >
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

            <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="./img/parcel.png" class="d-block w-100" alt="parcel">

                    <div class="container">
                    <div class="carousel-caption text-start">
                        <h1>HELP Aid</h1>
                        <p>We will help you based on what you need. Register now!</p>
                        <p><a class="btn btn-lg btn-primary" href="" data-bs-toggle="modal" data-bs-target="#selfRegister"
                            onclick="generateDocID()">Sign up today</a></p>
                    </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="./img/theotherparcel.png" class="d-block w-100" alt="viewAppeal">

                    <div class="container">
                    <div class="carousel-caption">
                        <h1>Donation Are Welcome</h1>
                        <p>We would like to have some helping hands from the outsiders to reach our target in every appeal.</p>
                        <p><a class="btn btn-lg btn-primary" href="viewAppeal.php">Donate now</a></p>
                    </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="./img/anotherparcel.png" class="d-block w-100" alt="organization">

                    <div class="container">
                    <div class="carousel-caption text-end">
                        <h1>Organization Are Welcome</h1>
                        <p>Organziation representative are welcome to use our system in recording disbursement, appeal, contribution and register applicant</p>
                        <p><a class="btn btn-lg btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#logIn">Log in now</a></p>
                    </div>
                    </div>
                </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
                </button>
            </div>


            <!-- Marketing messaging and featurettes
            ================================================== -->
            <!-- Wrap the rest of the page in another container to center all the content. -->

            <div class="container marketing">

                <!-- Three columns of text below the carousel -->
                <div class="row">
                    <h1 style="text-align:center;">
                        Collaborating Organization
                    </h1>
                </div><!-- /.row -->


                <!-- START THE FEATURETTES -->

                <hr class="featurette-divider">

                <?php
                    $connection_handler = new mysqli("34.142.167.192","root","","projectboolean");

                    //checking connection
                    if ($connection_handler->connect_error) {
                        die("Connection failed: " . $connection_handler->connect_error);
                    }

                    $sql = "SELECT * FROM orgtable";
                    $result = $connection_handler->query($sql);
                    if($result -> num_rows > 0){
                        //display centre name in the select option
                        $i=0;
                        while($row = $result -> fetch_assoc()){
                            $i++;
                            if ($i%2 == 0){
                                echo '<div class="row featurette">
                                <div class="col-md-7 order-md-2">
                                    <h2 class="featurette-heading">'.$row["ORGNAME"].'</h2>
                                    <p class="lead">Address: '.$row["ORGADDRESS"].'</p>
                                    <p class="lead"> This is the organization that collaborate with us.</p>
                                </div>
                                <div class="col-md-5">
                                    <img src="./img/org.jpg" class="d-block w-100" alt="organization">
                                </div>
                                </div>
                                <hr class="featurette-divider">';
                            }
                            else {
                                echo '<div class="row featurette">
                                <div class="col-md-7">
                                    <h2 class="featurette-heading">'.$row["ORGNAME"].'</h2>
                                    <p class="lead">Address: '.$row["ORGADDRESS"].'</p>
                                    <p class="lead"> This is the organization that collaborate with us.</p>
                                </div>
                                <div class="col-md-5">
                                    <img src="./img/org.jpg" class="d-block w-100" alt="organization">
                                </div>
                                </div>
                                <hr class="featurette-divider">';
                            }
                        }
                    }

                    $connection_handler->close();
                ?>

                <!-- /END THE FEATURETTES -->

            </div><!-- /.container -->


            <!-- FOOTER -->
            <footer class="container">
                <p class="float-end"><a href="#">Back to top</a></p>
                <p>&copy; 2017–2021 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
            </footer>
        </main>


        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

      
    </body>
</html>