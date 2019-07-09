let len = 0,start = 0;
let content = document.querySelector(".main-content");
function readRows(){
  len = content.childElementCount;
  start = -1;
  callAnother();
}
function callAnother(){
  if(start < len-2)
  {
    start++;
    for(let i = 0 ; i < start; i++)
    {
      content.children[i].style.opacity = "0";
      content.children[i].style.display = "none";
    }
    content.children[start].style.display = "block";
    setTimeout(function() {
content.children[start].style.opacity = "1";
    }, 30);
    for(let i = start+1; i < len-1; i++)
    {
      content.children[i].style.opacity = "0";
      content.children[i].style.display = "none";
    }
    setTimeout("callAnother()",2500);
  }
  else {

  }
}
function likeThisSlide(str){
  let xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.querySelector(".star-img").src = "../src/imgForDecoration/star.png";
    }
  };
  xmlhttp.open("GET", "../src/show/like.php?n="+str, true);
  xmlhttp.send();
}