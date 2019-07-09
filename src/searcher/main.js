let slides = document.querySelector(".resultsSlides");
let users = document.querySelector(".resultsUsers");
document.querySelector(".slidesBtn").addEventListener("click",function() {
  slides.style.display = "block";
  users.style.display = "none";
});
document.querySelector(".usersBtn").addEventListener("click",function(){
  slides.style.display = "none";
  users.style.display = "block";
});
