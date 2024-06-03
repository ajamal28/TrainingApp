import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';


  

//Modal Gallery
var openModal1 = document.getElementById("openModal1");
if (openModal1) {
  openModal1.addEventListener("click", function() {
    openModal(1);
  });
}

var openModal2 = document.getElementById("openModal2");
if (openModal2) {
  openModal2.addEventListener("click", function() {
    openModal(2);
  });
}

var openModal3 = document.getElementById("openModal3");
if (openModal3) {
  openModal3.addEventListener("click", function() {
    openModal(3);
  });
}

var closeModalButton = document.getElementById("closeModal");
if (closeModalButton) {
  closeModalButton.addEventListener("click", closeModal);
}

var prevButton = document.getElementById("prev1");
if (prevButton) {
  prevButton.addEventListener("click", plusSlides);
}

var nextButton = document.getElementById("next1");
if (nextButton) {
  nextButton.addEventListener("click", minusSlides);
}

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

  if (slides.length === 0) {
    // If there are no slides, exit the function
    return;
  }

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



//Filter by Ajax

document.getElementById('price-filter').addEventListener('change', function(){
  var filterValue = this.value;
  var categoryValue = document.getElementById('category-filter').value; 
  sendAjaxRequest(filterValue, categoryValue);
});

document.getElementById('category-filter').addEventListener('change', function(){
  var filterValue = document.getElementById('price-filter').value; 
  var categoryValue = this.value;
  sendAjaxRequest(filterValue, categoryValue);
});

function sendAjaxRequest(priceFilter, categoryFilter) {
  var xhr = new XMLHttpRequest();
  xhr.open('GET', '/Cars/?priceFilter=' + priceFilter + '&categoryFilter=' + categoryFilter, true); 
  xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
  xhr.onload = function() {
      if (xhr.status >= 200 && xhr.status < 300) {
          var carsList = document.getElementById('cars-list');
          carsList.innerHTML = JSON.parse(xhr.response).template; 
      }
  };
  xhr.send();
}
