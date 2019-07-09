let toStart = document.querySelector(".howManyForStart");
let form = document.querySelector(".form-container");
let slidesContainer = document.querySelector(".slides-container");
let slidesQuantity = document.querySelector(".forStart-quantity");
let input = null, inputBtn = null, btnText = null, inputWrap = null, textLabel = null,
textLabelContainer = null;
document.querySelector(".forStart-submit").addEventListener("click",function(){
  let howManySlides = slidesQuantity.value;
  slidesContainer.innerHTML = "";
  for(let i = 0; i < howManySlides; i++)
  {
    inputWrap = document.createElement("DIV");
    inputBtn = document.createElement("BUTTON");
    btnText = document.createTextNode("Browse");
    textLabel = document.createTextNode("Slide "+(i+1));
    input = document.createElement("INPUT");
    textLabelContainer = document.createElement("DIV");
    inputWrap.setAttribute("class","input-wrap");
    input.setAttribute("type","file");
    input.setAttribute("name","userfile[]");
    input.setAttribute("id","toGo"+i);
    input.setAttribute("required","true");
    input.setAttribute("class","slideUpload-input");
    inputBtn.appendChild(btnText);
    inputBtn.setAttribute("class","uploadBtn");
    inputBtn.setAttribute("type","button");
    inputBtn.addEventListener("click",function(){
      document.querySelector("#toGo"+i).click();
    });
    textLabelContainer.appendChild(textLabel);
    inputWrap.appendChild(textLabelContainer);
    inputWrap.appendChild(input);
    inputWrap.appendChild(inputBtn);
    slidesContainer.appendChild(inputWrap);
  }
  //form.innerHTML += "<button class = 'images-Submit' type = 'submit' name = 'submitConfirm'>Create slideshow</button>";
  toStart.style.display = "none";
  form.style.display = "block";
});
