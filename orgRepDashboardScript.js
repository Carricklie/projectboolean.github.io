function generateContributionID(contributionIDContainer,appealidText){
    var counter =0;
    Contributions.forEach(contribution=>{
        counter++;
    });
    contributionIDContainer.value="CON"+(counter+1);
    appealidText.value=appealToDonate;
}

function goodsMode(thisbutton){
    var otherbutton = document.getElementById("Cash");
    thisbutton.disabled=true;
    thisbutton.setAttribute("class","btn btn-secondary");
    otherbutton.disabled=false;
    otherbutton.setAttribute("class","btn btn-success");
    var form1 = document.getElementById("form1");
    var form2 = document.getElementById("form2");
    var footer1 = document.getElementById("footer1");
    var footer2 = document.getElementById("footer2");
    form1.hidden=false;
    form2.hidden=true;
    footer1.hidden=false;
    footer2.hidden=true;
}
function cashMode(thisbutton){
    var otherbutton = document.getElementById("Goods");
    thisbutton.disabled=true;
    thisbutton.setAttribute("class","btn btn-secondary");
    otherbutton.disabled=false;
    otherbutton.setAttribute("class","btn btn-success");
    var form1 = document.getElementById("form1");
    var form2 = document.getElementById("form2");
    var footer1 = document.getElementById("footer1");
    var footer2 = document.getElementById("footer2");
    form2.hidden=false;
    form1.hidden=true;
    footer2.hidden=false;
    footer1.hidden=true;
}
function puttitle(fileInput,titleInput){
    var splittedPath = fileInput.value.split("\\");
    titleInput.value = splittedPath[splittedPath.length-1];  
}
function openiFrame(myself,other1,other2,target){
    document.getElementById("mainpage").src = target;
    document.getElementById("mainpage").hidden = false;
    document.getElementById("headerContent").hidden =true;
    document.getElementById("appealTable").hidden = true;
    document.getElementById("noappeal").hidden = true;
    myself.setAttribute("class","nav-link active");
    other1.setAttribute("class","nav-link");
    other2.setAttribute("class","nav-link");
}

function generateAppealID(){
    document.getElementById("appealinputtext").value = "AP"+(AllAppeals.length+1);
}
function minDate(fromdate){
    var todate = document.getElementById('todate');
    todate.disabled = false;
    todate.setAttribute("min", fromdate.value);

}
function loadTable(thetable){
    var appealRelated = [];
    AllAppeals.forEach(appeal=>{
        if(appeal.orgID == currentorgID){
            appealRelated.push(appeal);
            var tr = thetable.insertRow();
            var tdStatus = tr.insertCell();
            var tdAppealID = tr.insertCell();
            var tdAppealTitle = tr.insertCell();
            var tdTarget = tr.insertCell();
            var tdFromDate = tr.insertCell();
            var tdToDate = tr.insertCell();
            var tdOutcome = tr.insertCell();
            var today = new Date();
            var toDateArr = appeal.toDate.split("-");
            var toDateDate = new Date(toDateArr[0],toDateArr[1]-1,toDateArr[2]);
            if(today>toDateDate){
                tdStatus.setAttribute("style","color:red")
                tdStatus.innerHTML = "Expired";
            }else{
                tdStatus.setAttribute("style","color:green")
                tdStatus.innerHTML = "Active";
            }
            tdAppealID.innerHTML = appeal.appealID;
            tdAppealTitle.innerHTML = appeal.appealTitle;
            tdTarget.innerHTML = appeal.appealTarget;
            tdFromDate.innerHTML = appeal.fromDate;
            tdToDate.innerHTML = appeal.toDate;
            
            
            if(appeal.outcome==""){
                tdOutcome.innerHTML = "-";
            }else{
                tdOutcome.innerHTML = appeal.outcome;
            }
        }
    });
    if(appealRelated.length==0){
        document.getElementById("appealTable").hidden = true;
        document.getElementById("noappeal").hidden = false;
    }
}           
function showDocInput(){
    document.getElementById("registerForm").hidden = true;
    document.getElementById("registerbutton").hidden = true;
    document.getElementById("docbutton").hidden = false;
    document.getElementById("docForm").hidden = false;
}
function showRegistrationInput(){
    document.getElementById("registerForm").hidden = false;
    document.getElementById("registerbutton").hidden = false;
    document.getElementById("docbutton").hidden = true;
    document.getElementById("docForm").hidden = true;
}
function generateApplicantID(){
    var listcount = rowsOfApplicant+1;
    var theID = "app"+listcount;
    return theID;
}
function passwordGenerator(){
    var special = "-/.^&*_!@%=+>)";
    var capLetter = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    var smallLetter = "abcdefghijklmnopqrstuvwxyz";
    var num = "0123456789";
    var result = "";
    var requirement = false;
    while(requirement==false){
        for(var i=0;i<8;i++){
            max = 1;
            min = 0;
            range = max - min + 1;
            rand = Math.random() * range + min;
            if(rand<=0.25){
                max = Math.floor(13);
                min = Math.ceil(0);
                range = max - min + 1;
                intrand = Math.floor(Math.random() * range + min);
                result += special[intrand];
            }else if(rand>0.25&rand<=0.5){
                max = Math.floor(25);
                min = Math.ceil(0);
                range = max - min + 1;
                intrand = Math.floor(Math.random() * range + min);
                result += capLetter[intrand];
            }else if(rand>0.5&rand<=0.75){
                max = Math.floor(25);
                min = Math.ceil(0);
                range = max - min + 1;
                intrand = Math.floor(Math.random() * range + min);
                result += smallLetter[intrand];
            }else{
                max = Math.floor(9);
                min = Math.ceil(0);
                range = max - min + 1;
                intrand = Math.floor(Math.random() * range + min);
                result += num[intrand];
            }
        }
        var specialReq = false;
        var smallReq = false;
        var capReq = false;
        var numReq = false;
        for(var i=0;i<result.length;i++){
            if(special.includes(result[i])){
                specialReq = true;
            }
            if(smallLetter.includes(result[i])){
                smallReq = true;
            }
            if(capLetter.includes(result[i])){
                capReq = true;
            }
            if(num.includes(result[i])){
                numReq = true;
            }
        }
        if(result.length==8&&specialReq&&smallReq&&capReq&&numReq){
            requirement = true;
        }else{
            result ="";
        }
    }
    return result;
}
function generateUsernameAndPass(){
    document.getElementById("username").value = generateApplicantID();
    document.getElementById("password").value = passwordGenerator();
}
function autoCapital(textbox){
    if(textbox.value.length==1){
        textbox.value = textbox.value.toUpperCase();
    }else if(textbox.value[textbox.value.length-2]==" "){
        textbox.value = textbox.value.slice(0, -1) + textbox.value[textbox.value.length-1].toUpperCase();
    }
}
function generateDocID(){
    document.getElementById("docID").value = docidExisted+1;
}
function noSpacesAndSpecials(textbox){
    var illegal = "[$&+,:;=?@#|'<>.^*()%!-]_{}\"/\\";
    textbox.value = textbox.value.toUpperCase();
    textbox.value = textbox.value.trim();
    if(illegal.includes(textbox.value[textbox.value.length-1])){
        textbox.value = textbox.value.slice(0, -1);
    }
}

function getAppealDetails(){
    var select = document.getElementById("appealIDSelect");
    var appealInfo = document.getElementById("appealInfo");
    var appealDetails =  document.getElementById("appealDetails");
    var contributionTable = document.getElementById("contributionTable");
    var contriAndAppealDetails = document.getElementById("contriAndAppealDetails");
    var fromDate = select.options[select.selectedIndex].dataset.fromDate;
    var toDate = select.options[select.selectedIndex].dataset.toDate;
    var description = select.options[select.selectedIndex].dataset.desc;
    var rowCount = contributionTable.rows.length;
    for (var i = rowCount - 1; i > 0; i--) {
        contributionTable.deleteRow(i);
    }
    if (select.value == "-1"){
        appealInfo.innerHTML = "";
        contriAndAppealDetails.hidden = true;
    }
    else{
        appealInfo.innerHTML = fromDate + "<br>" + toDate + "<br>" + description + "<br>";
        contriAndAppealDetails.hidden = false;
        Contributions.forEach(contribution=>{
            if (contribution.appealID == select.value){
                var tr = contributionTable.insertRow(-1);
                var tdContributionID = tr.insertCell();
                var tdReceivedDate = tr.insertCell();
                var tdDetails = tr.insertCell();
                tdContributionID.innerHTML = contribution.contributionID;
                tdReceivedDate.innerHTML = contribution.receivedDate;
                if (contribution.referenceNo == ""){
                    tdDetails.innerHTML = contribution.description + " with estimated value of "
                        + contribution.estimatedValue;
                }
                else {
                    tdDetails.innerHTML = "Cash with amount of " + contribution.amount;
                }
            }
            
            
        });
    }
}

