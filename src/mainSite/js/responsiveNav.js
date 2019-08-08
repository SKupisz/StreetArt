let mode = -1;
document.querySelector(".responsiveMode-open").addEventListener("click",function(){
    if(mode == -1){
        document.querySelector(".albums").style.display = "inline-block";
        document.querySelector(".signing-in").style.display = "inline-block";
        document.querySelector(".signing-up").style.display = "inline-block";
        mode = 1;
    }
    else{
        document.querySelector(".albums").classList.add("forResponsiveMode");
        document.querySelector(".signing-up").classList.add("forResponsiveMode");
        document.querySelector(".signing-in").classList.add("forResponsiveMode");
        mode = -1;
    }
});
function checkIfRes(){
    if(window.innerWidth > 982){
        document.querySelector(".albums").style.display = "inline-block";
        document.querySelector(".signing-in").style.display = "inline-block";
        document.querySelector(".signing-up").style.display = "inline-block";
    }
    else if(window.innerWidth < 983 && mode == -1 && document.querySelector(".albums").style.display == "inline-block"){
        document.querySelector(".albums").style.display = "none";
        document.querySelector(".signing-in").style.display = "none";
        document.querySelector(".signing-up").style.display = "none";
        mode = -1;
    }
    setTimeout("checkIfRes()",30);
}
checkIfRes();