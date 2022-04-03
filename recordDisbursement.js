function nextDoc(nextbutton,prevbutton){
            
    if(documentsindex==documents.length-2){
        nextbutton.disabled=true;
        nextbutton.setAttribute("class","w-100 btn btn-secondary btn-lg");
    }
    prevbutton.setAttribute("class","w-100 btn btn-primary btn-lg");
    prevbutton.disabled=false;
    documentsindex ++;
    document.getElementById("seeDocument").src="uploadedPdf/"+(documents[documentsindex]).fileName;
    document.getElementById("documentDescription").innerHTML = "Description :\n"+(documents[documentsindex]).description;
}
function prevDoc(prevbutton,nextbutton){
    
    if(documentsindex==1){
        prevbutton.disabled=true;
        prevbutton.setAttribute("class","w-100 btn btn-secondary btn-lg");
    }
    nextbutton.setAttribute("class","w-100 btn btn-primary btn-lg");
    nextbutton.disabled=false;
    documentsindex --;
    document.getElementById("seeDocument").src="uploadedPdf/"+(documents[documentsindex]).fileName;
    document.getElementById("documentDescription").innerHTML = "Description :\n"+(documents[documentsindex]).description;
}
function allowDistribute(selectoption,myself,submitButton){
    var currentTotalDonation=0;
    var disbursed=0;
    parent.Contributions.forEach(contribution=>{
        if(contribution.appealID==selectoption.value){
            if(contribution.referenceNo==""){
                currentTotalDonation+=parseFloat(contribution.estimatedValue);
            }else{
                currentTotalDonation+=parseFloat(contribution.amount);
            }
        }
    });
    parent.Disbursements.forEach(disburse=>{
        if(disburse.appealID==selectoption.value){
            disbursed+=parseFloat(disburse.cashAmount);
        }
    });
    currentTotalDonation-=disbursed;
    if(myself.value>currentTotalDonation||myself.value<1){
        submitButton.disabled=true;
        submitButton.setAttribute("class","w-100 btn btn-secondary btn-lg");
    }else{
        submitButton.disabled=false;
        submitButton.setAttribute("class","w-100 btn btn-primary btn-lg");
    }
    myself.setAttribute("max",currentTotalDonation);
}
function getAppealDetails(myself){
    var select = document.getElementById("appealIDSelect");
    var appealFromDate = document.getElementById("fromDate");
    var appealToDate = document.getElementById("toDate");
    var appealDescription = document.getElementById("description");
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
        appealFromDate.innerHTML = "";
        appealToDate.innerHTML = "";
        appealDescription.innerHTML = "";
        contriAndAppealDetails.hidden = true;
    }
    else{
        appealFromDate.innerHTML = fromDate;
        appealToDate.innerHTML = toDate;
        appealDescription.innerHTML ="Description : \n"+description;
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
    document.getElementById("cashAmount").disabled=false;
    var selectoption = document.getElementById("applicantIDSelect");
    selectoption.selectedIndex =0;
    var options = selectoption.options;
    for(var i=0;i<options.length;i++){
        if(options[i].value!=""){
            options[i].hidden=false;
        }
    }
    for(var i=0;i<options.length;i++){
        parent.Disbursements.forEach(disbursement=>{
            if(disbursement.appealID==myself.value){
                if(options[i].value==disbursement.username){
                    options[i].hidden=true;
                }
            }
        });
    }
    var disbursed = 0;
    parent.Disbursements.forEach(disburse=>{
        if(disburse.appealID==myself.value){
            disbursed+=parseFloat(disburse.cashAmount);
        }
    });
    selectoption.disabled=false;
    var thetarget = myself.options[myself.selectedIndex].dataset.targetAmount;
    document.getElementById("disbursedAmount").innerHTML="RM "+disbursed;
    document.getElementById("appealTarget").innerHTML="RM "+thetarget;
    var currentTotalDonation=0;
    parent.Contributions.forEach(contribution=>{
        if(contribution.appealID==myself.value){
            if(contribution.referenceNo==""){
                currentTotalDonation+=parseFloat(contribution.estimatedValue);
            }else{
                currentTotalDonation+=parseFloat(contribution.amount);
            }
        }
    });
    donationleft = currentTotalDonation-disbursed;
    document.getElementById("donationleft").value =donationleft;
    document.getElementById("amountleft").innerHTML="RM "+(donationleft);
}

function showApplicant(){
    var applicantList =  document.getElementById("applicantList");
    if (applicantList.hidden == true){
        applicantList.hidden = false;
    }
    else {
        applicantList.hidden = true;
    }
}

function getApplicantDetails(myself){
    document.getElementById("documentDescription").focus();
    var select = document.getElementById("applicantIDSelect");
    var applicantName = document.getElementById("applicantName");
    var applicantAddress = document.getElementById("applicantAddress");
    var householdIncome = document.getElementById("householdIncome");
    var applicantDetails =  document.getElementById("applicantDetails");
    var name = select.options[select.selectedIndex].dataset.name;
    var address = select.options[select.selectedIndex].dataset.address;
    var income = select.options[select.selectedIndex].dataset.income;
    
    if (select.value == "-1"){
        applicantName.innerHTML = "";
        applicantAddress.innerHTML = "";
        householdIncome.innerHTML = "";
        applicantDetails.hidden = true;
    }
    else{
        applicantName.innerHTML = name;
        applicantAddress.innerHTML = address;
        householdIncome.innerHTML = income;
        applicantDetails.hidden = false;
    }
    documents = [];
    documentsindex =0;
    parent.Documents.forEach(documentItem=>{
        if(documentItem.username==myself.value){
            documents.push(documentItem);
        }
    });
    document.getElementById("prevButton").hidden=true;
    document.getElementById("nextButton").hidden=true;
    document.getElementById("prevButton").disabled=true;
    document.getElementById("nextButton").disabled=true;
    document.getElementById("prevButton").setAttribute("class","w-100 btn btn-secondary btn-lg");
    document.getElementById("nextButton").setAttribute("class","w-100 btn btn-primary btn-lg");
    if(documents.length>1){
        document.getElementById("prevButton").hidden=false;
        document.getElementById("nextButton").hidden=false;
        document.getElementById("nextButton").disabled=false;
    }
    document.getElementById("seeDocument").src="uploadedPdf/"+documents[documentsindex].fileName;
    document.getElementById("seeDocument").hidden=false;
    document.getElementById("documentDescription").innerHTML = "Description :\n"+documents[documentsindex].description;
    document.getElementById("documentDescription").hidden=false;
    document.getElementById("seeDocument").focus();
}

function validate() {
    var appealID = document.getElementById("appealIDSelect").value;
    var applicantID = document.getElementById("applicantIDSelect").value;

    if (appealID == ""){
        alert("Please select an appeal ID");
        return false;
    }
    else if(applicantID == ""){
        alert("Please select an applicant ID");
        return false;
    }
    return true;
    

}