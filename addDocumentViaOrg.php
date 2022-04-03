<?php header('Cache-Control: no-store, no-cache, must-revalidate');
session_start();?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>HELP Aid Add Document</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap core CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        
        <script>
            function generateDocID(){
                document.getElementById("documentID").value = docidExisted+1;
            }

            function submitForm(){
                document.getElementById("docForm").submit();
            }

            function submitFormNo(){
                document.getElementById("docForm").setAttribute('action', "addLastDocViaOrg.php");
                document.getElementById("docForm").submit();
                
            }
            function puttitle(fileInput,titleInput){
                var splittedPath = fileInput.value.split("\\");
                titleInput.value = splittedPath[splittedPath.length-1];  
            }
        </script>
    </head>
    <body>
        <main>
        
            <?php
                $target_dir = "uploadedPdf/";
                $thefile = $_FILES["fileupload"]["name"];
                $targetfile = $target_dir . basename($thefile);
                $username = $_POST["username"];
                $password = $_POST["password"];
                $orgID = $_SESSION["orgID"];
                $fullname = $_POST["fullname"];
                $idno = $_POST["idno"];
                $address = $_POST["address"];
                $income = $_POST["income"];
                $docID = $_POST["documentID"];
                $filename = $_POST["filename"];
                $description = $_POST["description"];
                $connection_handler = new mysqli("34.142.167.192","root","","projectboolean");

                //checking connection
                if ($connection_handler->connect_error) {
                    die("Connection failed: " . $connection_handler->connect_error);
                }

                if ($password == "null"){
                    $addDoc = "INSERT INTO `doctable` (`DOCUMENTID`, `FILENAME`, `DOCUMENTDESCRIPTION`, `USERNAME`) 
                    VALUES('$docID', '$filename', '$description', '$username')"; 
                    $addnewdoc = $connection_handler->query($addDoc);
                    $addnewdoc = $connection_handler->query($addDoc);
                    if (move_uploaded_file($_FILES["fileupload"]["tmp_name"], $targetfile)) {
                        echo"<script>alert('The file ". htmlspecialchars( basename( $thefile)). " has been uploaded.')</script>";
                    } else {
                        echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
                    }
                }
                else {
                    $_SESSION["username"] = $_POST["username"];
                    $addDoc = "INSERT INTO `doctable` (`DOCUMENTID`, `FILENAME`, `DOCUMENTDESCRIPTION`, `USERNAME`)
                    VALUES('$docID', '$filename', '$description', '$username')";
                    $findDuplicate = "SELECT * FROM `usertable` WHERE IDNO = '$idno'";
                    $result = $connection_handler->query($findDuplicate);
                    $array2D = $result->fetch_all(MYSQLI_ASSOC);
                    if(count($array2D)==0){
                        $sql = "INSERT INTO `usertable`(`USERNAME`, `PASSWORD`, `FULLNAME`, `USERTYPE`, `IDNO`, `ADDRESS`, `HOUSEHOLDINCOME`,`ORGID`) 
                        VALUES ('$username','$password','$fullname','APPLICANT','$idno','$address', '$income','$orgID')";
                        $result = $connection_handler->query($sql);
                        $addnewdoc = $connection_handler->query($addDoc);
                        if (move_uploaded_file($_FILES["fileupload"]["tmp_name"], $targetfile)) {
                            echo"<script>alert('The file ". htmlspecialchars( basename( $thefile)). " has been uploaded.')</script>";
                          } else {
                            echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
                          }
                    }else{
                        echo "<script>alert('ID Number Duplicated');window.location.href='homePage.php';</script>";
                    }
                    
                }

                $connection_handler->close();
            ?>
            <?php 
                $connection = new mysqli("34.142.167.192","root","","projectboolean");
                $getalldocument = "SELECT * FROM doctable";
                $result = $connection->query($getalldocument);
                $array2D = $result->fetch_all(MYSQLI_ASSOC);
                echo "<script>var docidExisted = ".count($array2D)."</script>"
            ?>
            <div class="container-fluid mt-50">
                <form action="addDocumentViaOrg.php" method="post" id="docForm" enctype="multipart/form-data">
                    <div hidden>
                        <input type="text" id="username" name="username">
                        <script>
                            document.getElementById("username").value="<?php 
                            if(!empty($_SESSION["username"])){
                                echo $_SESSION["username"];
                            }else{
                                echo "";
                            } 
                            ?>";
                        </script>
                        <input type="text" name="password" value="null">
                        <input type="text" name="fullname">
                        <input type="text" name="idno">
                        <input type="text" name="address">
                        <input type="text" name="income">
                        <input type="text" id="documentID" name="documentID">
                        <script>generateDocID();</script>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            Add More Document
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Add Document Form</h5>
                            <div class="card-text">
                                <div class="row pt-3">
                                    <label for="filename" class="col-sm-3 col-form-label">File name: </label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly id="filename" class="form-control" name="filename">
                                    </div>
                                </div>
                                    
                                <div class='row pt-3'>
                                    <label for="description" class="col-sm-3 col-form-label">Description: </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="description">
                                    </div>
                                </div>
                                <div class="row pt-3">
                                    <label for="formFile" class="col-sm-3 col-form-label">Upload file:</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="fileupload" onchange="puttitle(this,document.getElementById('filename'))" accept="application/pdf,application" required class="form-control">
                                    </div>
                                    
                                </div>
                                <div class="pt-3">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Upload
                                    </button>
                                    <a href="orgRepDashboard.php" class="btn btn-secondary">Skip</a>
                                </div>

                                <!-- Alert Box Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Notifications</h5>
                                    </div>
                                    <div class="modal-body">
                                        Do you want to add more document?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" onclick="submitFormNo()">No</a>
                                        <button type="button" class="btn btn-primary" onclick="submitForm()">Yes</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            
            
        </main>

         <!-- Bootstrap JS -->
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>