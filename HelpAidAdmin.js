function ChangeMain(target,thisnav,othernav) {
    document.getElementById('mainpage').src = target;
    thisnav.setAttribute("class","nav-link active");
    othernav.setAttribute("class","nav-link");
}
function noSpaceAndNoCapital(textbox){
    textbox.value = textbox.value.trim();
    textbox.value = textbox.value.toLowerCase();
}
function autoCapital(textbox){
    if(textbox.value.length==1){
        textbox.value = textbox.value.toUpperCase();
    }else if(textbox.value[textbox.value.length-2]==" "){
        textbox.value = textbox.value.slice(0, -1) + textbox.value[textbox.value.length-1].toUpperCase();
    }
}