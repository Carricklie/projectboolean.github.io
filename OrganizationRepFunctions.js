function openModal(){
    var selectOptionOrg = window.parent.document.getElementById("orgSelect");
    Organizations.forEach(org=>{
        var newOption = document.createElement("option");
        newOption.value = org.orgID;
        newOption.innerHTML = org.orgName;
        selectOptionOrg.add(newOption);
    });
    var modal = window.parent.document.getElementById("openModalOrgRep"); 
    modal.click();
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