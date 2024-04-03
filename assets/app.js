import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';

document.getElementById("openModal1").addEventListener("click", function() {
  openModal(1);
});
document.getElementById("openModal2").addEventListener("click", function() {
  openModal(2);
});
document.getElementById("openModal3").addEventListener("click", function() {
  openModal(3);
});
document.getElementById("closeModal").addEventListener("click", closeModal);
document.getElementById("prev1").addEventListener("click", plusSlides);
document.getElementById("next1").addEventListener("click", minusSlides);

function openModal(initialSlideIndex) {
  slideIndex = initialSlideIndex;
  document.getElementById("myModal").style.display = "block";
  showSlides(slideIndex);
}

function closeModal() {
  document.getElementById("myModal").style.display = "none";
}

var slideIndex = 1;

function plusSlides() {
  slideIndex += 1;
  showSlides(slideIndex);
}

function minusSlides() {
  slideIndex -= 1;
  showSlides(slideIndex);
}

showSlides(slideIndex);

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");

  if (n > slides.length) {
      slideIndex = 1;
  }
  if (n < 1) {
      slideIndex = slides.length;
  }
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  slides[slideIndex - 1].style.display = "block";
}

  


  
 