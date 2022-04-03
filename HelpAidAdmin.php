<?php header('Cache-Control: no-store, no-cache, must-revalidate');?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Hugo 0.88.1">
        <link rel="stylesheet" href="dashboard.css">
        <link rel="stylesheet" href="HelpAidAdmin.css">
        <title>HELPAID Admin Dashboard</title>
        <script src="OrganizationRepFunctions.js"></script>
        <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">

        

        <!-- Bootstrap core CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <style>
            .sidebar{
                border-right: 3px solid #2CE8A4;
                z-index: 1;
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

        <script>
            function keepLogin(){
                var form = document.createElement("form");
                form.setAttribute('method',"post");
                form.setAttribute('action',"HelpAidAdmin.php");  
                var passwordText = document.createElement("input"); //input element, text
                passwordText.hidden = true;
                passwordText.setAttribute('type',"text");
                passwordText.setAttribute('name',"password");
                passwordText.value = "<?php 
                if(!empty($_POST["password"])){
                    echo $_POST["password"];
                }else{
                    echo "";
                } 
                ?>";
                form.appendChild(passwordText);
                document.body.appendChild(form);
                console.log(passwordText.value);
                form.submit();
            }
        </script>
        <script src="HelpAidAdmin.js"></script>
    </head>
    <body>
    <script>
        var password = "<?php 
            if(!empty($_POST["password"])){
                echo $_POST["password"];
            }else{
                echo "";
            } 
            ?>";
        if(password!="admin1234"){
            var form = document.createElement("form");
            form.setAttribute('method',"post");
            form.setAttribute('action',"HelpAidAdmin.php");  
            var passwordText = document.createElement("input");
            passwordText.hidden = true;
            passwordText.setAttribute('type',"text");
            passwordText.setAttribute('name',"password");
            passwordText.value = prompt("Input Password!", "");
            form.appendChild(passwordText);
            document.body.appendChild(form);
            console.log(passwordText.value);
            form.submit();
        }
    </script>
    <header class="navbar navbar-dark bg-light sticky-top flex-md-nowrap p-0">
        <a class="navbar-brand bg-light col-md-3 col-lg-2 me-0 px-3" onclick="keepLogin()" style="color:#2CE8A4; box-shadow:none;cursor:pointer;">HELP AID</a>
        <button class="custom-toggler navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="custom-toggler navbar-toggler-icon"></span>
        </button>
        <p class="w-100" style="margin-bottom:0px; margin-left:0px; padding-left:16px; color:#2ce8a4;">
                Welcome Admin!
        </p>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <div class="px-3"></div>
            </div>
        </div>
    </header>
    <button id="openModalOrg" data-bs-toggle="modal" data-bs-target="#addOrgModal" hidden></button>
    <button id="openModalOrgRep" data-bs-toggle="modal" data-bs-target="#addOrgRepModal" hidden></button>
    <div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" id="organizationNav" style="cursor:pointer;" onclick="ChangeMain('ManageOrganization.php',this,document.getElementById('orgrepNav'))">
                    <span data-feather="home"></span>
                    Organization
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="orgrepNav" style="cursor:pointer;"onclick="ChangeMain('ManageOrganizationRep.php',this,document.getElementById('organizationNav'))">
                    <span data-feather="user"></span>
                    Organization Representatives
                    </a>
                </li>
            </ul>
        </div>
        </nav>

        <div class="col-md-3 col-lg-2 d-md-block"></div>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" >
            <iframe id="mainpage" src="ManageOrganization.php"  frameborder="0" style="width:100%;min-height:670px;border:none;"></iframe>

            <!-- Add Organization Modal -->
            <!-- Vertically centered scrollable modal -->
            <div class="modal fade" id="addOrgModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="addOrgModal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add Organization Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="addOrg.php" method="post">
                        <input type="text" id="adminpass" name="password" hidden on>
                        <script>document.getElementById("adminpass").value = password</script>
                        <div class="modal-body">
                            <div id="registerForm">
                                <div class='row'>
                                    <label for="orgID" class="col-sm-3 col-form-label">Organization Name: </label>
                                    <div class="col-sm-9">
                                        <input type="text"oninput="autoCapital(this)" onblur="this.value=this.value.trim()" name="orgName" class="form-control" required placeholder="Please enter your full name">
                                    </div>
                                </div>

                                <div class='row pt-3'>
                                    <label for="idno" class="col-sm-3 col-form-label">Organization Address: </label>
                                    <div class="col-sm-9">
                                        <input type="text"onblur="this.value=this.value.trim()" name="orgAddress" class="form-control" required placeholder="Please enter your ID number">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" value="Submit Application" >
                           
                            
                        </div>
                    </form>
                </div>
            </div>
            </div>

            <!-- Add Organization Representative Modal -->
            <!-- Vertically centered scrollable modal -->
            <div class="modal fade" id="addOrgRepModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="addOrgRepModal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add Organization Representative Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="addOrgRep.php" method="post">
                        <input type='password' id='orgRepPassword' name='orgRepPassword' placeholder='Password' hidden required>
                        <input type='password' id="password"name='password' hidden>
                        <script>document.getElementById("orgRepPassword").value = passwordGenerator();</script>
                        <script>document.getElementById("password").value =password ;</script>
                        <div class="modal-body">
                            <div id="registerForm">
                                <div class="row">
                                    <label for="orgSelect" class="col-sm-5 col-form-label"> Organization Name: </label>
                                    <div class="col-sm-7">
                                        <select class="form-control" name='orgID' id="orgSelect"></select>
                                    </div>
                                    
                                </div>
                                <div class='row pt-3'>
                                    <label for="username" class="col-sm-5 col-form-label"> Username: </label>
                                    <div class="col-sm-7">
                                        <input type="text" name="username" oninput="noSpaceAndNoCapital(this)" class="form-control" required placeholder="Username">
                                    </div>
                                </div>

                                <div class='row pt-3'>
                                    <label for="fullName" class="col-sm-5 col-form-label">Full Name: </label>
                                    <div class="col-sm-7">
                                        <input type="text"onblur="this.value=this.value.trim()" name="fullName" oninput="autoCapital(this)" class="form-control" required placeholder='Full Name'>
                                    </div>
                                </div>
                                
                                <div class='row pt-3'>
                                    <label for="email" class="col-sm-5 col-form-label">Email: </label>
                                    <div class="col-sm-7">
                                        <input type="text"onblur="this.value=this.value.trim()" name="email" class="form-control" required placeholder='example@example.com'>
                                    </div>
                                </div>

                                <div class='row pt-3'>
                                    <label for="mobileNo" class="col-sm-5 col-form-label">Mobile Number: </label>
                                    <div class="col-sm-7">
                                        <input type='tel'onblur="this.value=this.value.trim()" pattern='^0[1-9][0-9]{6,10}$' name='mobileNo' placeholder='xxx-xxxxxxxx' class="form-control" required>
                                    </div>
                                </div>
                                
                                <div class='row pt-3'>
                                    <label for="idno" class="col-sm-5 col-form-label">Job Title: </label>
                                    <div class="col-sm-7">
                                        <input type="text"onblur="this.value=this.value.trim()" name='jobTitle' placeholder='Job' class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" value="Submit Application" >
                           
                            
                        </div>
                    </form>
                </div>
            </div>
            </div>
            
        </main>
    </div>
    </div>

        <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>

    
</html>