function puttitle(fileInput,titleInput){
    var splittedPath = fileInput.value.split("\\");
    titleInput.value = splittedPath[splittedPath.length-1];  
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
function autoCapital(textbox){
    if(textbox.value.length==1){
        textbox.value = textbox.value.toUpperCase();
    }else if(textbox.value[textbox.value.length-2]==" "){
        textbox.value = textbox.value.slice(0, -1) + textbox.value[textbox.value.length-1].toUpperCase();
    }
}
function generateUsernameAndPass(){
    document.getElementById("username").value = generateApplicantID();
    document.getElementById("password").value = passwordGenerator();
}
function generateDocID(){
    document.getElementById("docID").value = docidExisted+1;
}
function noSpacesAndSpecials(textbox){
    var illegal = "[$&+,:;=?@#|'<>.^*()%!-]_{}\"/\\ ";
    textbox.value = textbox.value.toUpperCase();
    textbox.value = textbox.value.trim();
    if(illegal.includes(textbox.value[textbox.value.length-1])){
        textbox.value = textbox.value.slice(0, -1);
    }
}