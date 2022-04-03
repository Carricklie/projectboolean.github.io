<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Features · Bootstrap v5.1</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/features/">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    

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

      .border-bottom{
        border-bottom: 3px solid #dee2e6 !important;
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="features.css" rel="stylesheet">
    <script>
      function addContribution(appealID){
        parent.appealToDonate = appealID;
        parent.document.getElementById('contributionModal').click();
      }
    </script>
  </head>
  <body>
    
    <main>
      <div style="margin:3%" id="featured-3" >
        <h2 class="pb-2 border-bottom"style="position:sticky;top:0;background-color:white">[Double Click]Select Active Appeal</h2>
        <div class="row g-4 py-5 row-cols-3 row-cols-lg-4" id="appealscontainer">
          <script>
            var thecontainer = document.getElementById("appealscontainer");
            if(parent.ActiveAppeals.length<=0){
              thecontainer.innerHTML = "<h2>There is no appeal for now</h2>";
            }else{
              parent.ActiveAppeals.forEach(appeal=>{
                var totalContribution = 0;
                parent.Contributions.forEach(contribution=>{
                  if(contribution.appealID==appeal.appealID){
                    if(contribution.referenceNo==""){
                      totalContribution+=parseFloat(contribution.estimatedValue);
                    }else{
                      totalContribution+=parseFloat(contribution.amount);
                    }
                  }
                });
                var percentage = (totalContribution/appeal.appealTarget)*100;
                if(percentage>100){
                  percentage=100;
                }
                thecontainer.innerHTML+= "<div class='feature col' ondblclick=\"addContribution(\'"+appeal.appealID+"\')\" style='cursor:pointer;min-width:200px;border: 2px solid green;border-radius: 25px;margin:3%;padding:1%;'>"+
                "<h2 style='text-align:center'>"+appeal.appealTitle+"</h2><br><textarea style='width:100%;' disabled>Description : \n"+appeal.description+"</textarea>"+
                "<br><input type='text'disabled value='Expiry Date : "+appeal.toDate+"'style='width:100%'></p><p>Donation target : RM "+appeal.appealTarget+"</p>"+
                "<div class='w3-light-grey w3-round'><div class='w3-container w3-blue w3-round' style='width:"+percentage+"%;text-align:center;height:12px;'></div>RM "+totalContribution+"</div><br>";
              });
            }
          </script>
          
        </div>
      </div>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


      
  </body>
</html>
