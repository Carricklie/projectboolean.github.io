<?php header('Cache-Control: no-store, no-cache, must-revalidate');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="Attributes.css"> -->
    <script src="User.js"></script>
    <script src="Organization.js"></script>
    <script src="OrganizationRepFunctions.js"></script>
    <link rel="stylesheet" href="dashboard.css">
    <title>Manage Organization Representatives</title>
    <?php
        $host = "34.142.167.192";
        $user = "HelpAidAccess";
        $password ="";
        $database = "projectboolean";
        $connection = mysqli_connect($host,$user,$password,$database);
        if ( mysqli_connect_errno() ) {
            die( mysqli_connect_error() );
        }
        $getAllOrg = "SELECT * FROM `orgtable`";
        $result = $connection->query($getAllOrg);
        $array2D = $result->fetch_all(MYSQLI_ASSOC);
        echo "<script>var Organizations = [];</script>";
        for($i=0;$i<count($array2D);$i++){
            echo "<script>
            var theOrg = new Organization('{$array2D[$i]['ORGID']}','{$array2D[$i]['ORGNAME']}','{$array2D[$i]['ORGADDRESS']}');
            Organizations.push(theOrg);
            </script>";
        }
        $getOrgRep = "SELECT * FROM `usertable` JOIN orgtable ON usertable.ORGID = orgtable.ORGID WHERE USERTYPE = 'ORGREP';";
        $result = $connection->query($getOrgRep);
        $array2D = $result->fetch_all(MYSQLI_ASSOC);
        echo "<script>var OrgReps = [];</script>";
        for($i=0;$i<count($array2D);$i++){
            echo "<script>
            var theOrg = new Organization('{$array2D[$i]['ORGID']}','{$array2D[$i]['ORGNAME']}','{$array2D[$i]['ORGADDRESS']}');
            var theOrgRep = new User(theOrg,'{$array2D[$i]['USERNAME']}','{$array2D[$i]['PASSWORD']}','{$array2D[$i]['FULLNAME']}',
            '{$array2D[$i]['EMAIL']}','{$array2D[$i]['MOBILENO']}','{$array2D[$i]['USERTYPE']}','{$array2D[$i]['JOBTITLE']}',
            '{$array2D[$i]['IDNO']}','{$array2D[$i]['ADDRESS']}','{$array2D[$i]['HOUSEHOLDINCOME']}');
            OrgReps.push(theOrgRep);
            </script>";
        }
    ?>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">

            

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

    </main>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom bg-light" style="position: sticky;top:0;">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary" style="background: #2CE8A4; color: #ffffff"
                onclick = "openModal()">Add Organization Representative</button>
            </div>
        </div>
    </div>

    <h2>List of Organization Representative</h2>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">Full Name</th>
                <th scope="col">Mobile Number</th>
                <th scope="col">Job Title</th>
                <th scope="col">Organization</th>
            </tr>
        </thead>
        <tbody id="theTable">
            <script>
                var thetable = document.getElementById("theTable");
                OrgReps.forEach(orgRep=>{
                    var tr = thetable.insertRow(-1);
                    var tdFullName = tr.insertCell();
                    var tdMobileNo = tr.insertCell();
                    var tdJobTitle = tr.insertCell();
                    var tdOrgName = tr.insertCell();
                    tdFullName.innerHTML = orgRep.fullName;
                    tdMobileNo.innerHTML = orgRep.mobileNo;
                    tdJobTitle.innerHTML = orgRep.jobTitle;
                    tdOrgName.innerHTML = orgRep.theOrg.orgName;
                });
            </script>
        </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>