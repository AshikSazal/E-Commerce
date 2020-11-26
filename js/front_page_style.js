var count=0;
var time=0;
var dots = document.getElementsByClassName("dot");
var slides = document.getElementsByClassName("front-pic2");
slides[count].style.display = "block";
dots[count].className += " active";
var a=document.createElement('a');
a.href='https://www.google.com';
var image = document.getElementById('pic-link').getElementsByTagName('img')[0];
a.appendChild(image);
document.getElementById('pic-link').appendChild(a);
var i;
window.onload = function(){
  setTimeout(next,5000);
};

function next(){
  clearTimeout(time);
  next2();
}
function prev(){
  clearTimeout(time);
  prev2();
}
function currentSlide(n) {
  clearTimeout(time);
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none"; // for removing previous picture
  }
  for (i = 0; i < dots.length; i++) {
		dots[i].className = dots[i].className.
							replace(" active", ""); // for removing previous dot color
	}
  slides[n].style.display = "block";
  dots[n].className += " active";
  count=n;
  time=setTimeout(next2, 5000);
}
function next2() {
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
		dots[i].className = dots[i].className.
							replace(" active", "");
	}
  count++;
  if(count>=slides.length){
    count=0;
    slides[count].style.display = "block";
    dots[count].className += " active";
  }
  else{
    slides[count].style.display = "block";
    dots[count].className += " active";
  }
  time=setTimeout(next2, 5000);
}
function prev2() {
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
		dots[i].className = dots[i].className.
							replace(" active", "");
	}
  count--;
  if(count<0){
    count=slides.length-1;
    slides[count].style.display = "block";
    dots[count].className += " active";
  }
  else{
    slides[count].style.display = "block";
    dots[count].className += " active";
  }
  time=setTimeout(next2, 5000);
}
