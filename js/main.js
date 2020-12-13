(function () {
  "use strict";

  // Materialaize Init
  M.AutoInit();

  // Hide Loading Page After Window It Load
  window.onload = function () {
    let preloader = document.querySelector(".loading-page");
    preloader.classList.add("hide");
    if (preloader.classList.contains("hide")) {
      document.body.classList.remove("flow");
    }
  };

  // Open and close nav menu
  let navMenuBtn = document.querySelector("#navMenu");
  navMenuBtn.onclick = function () {
    this.classList.toggle("active");
    this.parentElement.children[1].classList.toggle("slide-open");
    document.body.classList.toggle("flow");
    this.previousElementSibling.classList.toggle("hide");
  };

  // Make Sidenav form right
  document.addEventListener("DOMContentLoaded", function () {
    let elems = document.querySelectorAll(".sidenav"),
      instances = M.Sidenav.init(elems, { edge: "right" });
  });

  // Go Up Button Scroll
  let upButton = document.querySelector("#goUp");
  if (upButton) {
    upButton.onclick = function () {
      document.body.scrollTo({
        top: 0,
        behavior: "smooth",
      });
    };
    window.onscroll = function () {
      if (this.pageYOffset >= 710) {
        upButton.classList.add("showing");
        upButton.classList.remove("hideing");
      } else {
        upButton.classList.add("hideing");
        upButton.classList.remove("showing");
      }
    };
  }

  // Get Row id When Click Delete Button
  let btns = document.querySelectorAll(".select-id"),
    inputHidden = document.querySelector("#btnId");
  for (let i = 0; i < btns.length; i++) {
    btns[i].onclick = function () {
      let id = this.dataset.id;
      inputHidden.value = id;
    };
  }

  // Show Visa Price After Select
  let visaList = document.querySelector("#visaList"),
      priceInput = document.querySelector("#price"),
      orginlPrice = document.querySelector("#orginlPrice");
  if (visaList) {
    visaList.onchange = function () {
      let option = this.options[this.selectedIndex];
      priceInput.focus();
      priceInput.value = option.dataset.price;
      orginlPrice.value = option.dataset.price;
    }
  }

  // Show Inputs Fields After Click Edit In Transactions Page
  let editBtn = document.querySelectorAll(".show-transactions .text-label .btn"),
      cancelBtn = document.querySelectorAll(".show-transactions .input-group .cancel-btn"),
      inputImg = document.querySelectorAll(".show-transactions .img-input");
  if (editBtn) {
    for (let i = 0; i < editBtn.length; i++) {
      editBtn[i].onclick = function () {
        editBtn[i].parentElement.nextElementSibling.classList.remove("hide");
        editBtn[i].parentElement.classList.add("hide");
      }
    }
  }
  // Hide Inputs Fields After Click Cancel In Transactions Page
  if (cancelBtn) {
    for (let i = 0; i < cancelBtn.length; i++) {
      cancelBtn[i].onclick = function () {
        cancelBtn[i].parentElement.parentElement.previousElementSibling.classList.remove("hide");
        cancelBtn[i].parentElement.parentElement.classList.add("hide");
      }
    }
  }
  // Show New Image On Change
  if (inputImg) {
    for (let i = 0; i < inputImg.length; i++) {
      inputImg[i].onchange = function () {
        inputImg[i].closest(".p-img").previousElementSibling.children[0].src = window.URL.createObjectURL(inputImg[i].files[0]);
      }
    }
  }

  // Filter Table Show/Hide Visa || Services
  let filterTable = document.querySelectorAll(".filter-table .filter-item");
  for (let i = 0; i < filterTable.length; i++) {
    filterTable[i].onclick = function () {
      let tr = document.querySelectorAll(`.${filterTable[i].dataset.type}`);
      if (!this.checked == true) {
        for (let i = 0; i < tr.length; i++) {
          tr[i].classList.add("hide");
        }
      } else {
        for (let i = 0; i < tr.length; i++) {
          tr[i].classList.remove("hide");
        }
      }
    }
  }

})();

/*
    Template Designed By: ** Hussam Bashat ** (Front-End Developer)
    Contact me => facebook.com/hussam.bashat
    Designed in: 23/11/2020
*/