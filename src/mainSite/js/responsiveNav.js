let mode = -1;
document.querySelector(".responsiveMode-open").addEventListener("click",function(){
    if(mode == -1){
        document.querySelector(".albums").style.display = "inline-block";
        document.querySelector(".signing-in").style.display = "inline-block";
        document.querySelector(".signing-up").style.display = "inline-block";
        mode = 1;
    }
    else{
        document.querySelector(".albums").style.display = "none";
        document.querySelector(".signing-up").style.display = "none";
        document.querySelector(".signing-in").style.display = "none";
        mode = -1;
    }
});
function checkIfRes(){
    if(window.innerWidth > 982){
        document.querySelector(".albums").style.display = "inline-block";
        document.querySelector(".signing-in").style.display = "inline-block";
        document.querySelector(".signing-up").style.display = "inline-block";
        mode = -1;
    }
    setTimeout("checkIfRes()",100);
}
checkIfRes();