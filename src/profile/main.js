let profDisplay = document.querySelector(".prof-info-display");
let profEdit = document.querySelector(".prof-info-edit");
let descDisplay = document.querySelector(".describe-info");
let descEdit = document.querySelector(".desc-edit-info");
document.querySelector(".info-change").addEventListener("click",function(){
  profDisplay.style.display = "none";
  profEdit.style.display = "block";
});
document.querySelector(".doNotSave").addEventListener("click",function(){
  profDisplay.style.display = "block";
  profEdit.style.display = "none";
});
document.querySelector(".desc-change").addEventListener("click",function(){
  descDisplay.style.display = "none";
  descEdit.style.display = "block";
});
document.querySelector(".doNotSaveDesc").addEventListener("click",function(){
  descDisplay.style.display = "block";
  descEdit.style.display = "none";
});
