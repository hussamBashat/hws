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

  // Column Customize in Supernatural Table
  let selectAll = document.querySelector("#checkAllColumns"),
      allCheckboxes = document.querySelectorAll("#columns input[type='checkbox']:not(#checkAllColumns)"),
      selectFilesCheckbox = document.querySelector("#checkAllFiles"),
      allFilesCheckbox = document.querySelectorAll("#filesCollapsible input[type='checkbox']:not(#checkAllFiles)"),
      selectServicesCheckbox = document.querySelector("#checkAllServices"),
      allServicesCheckbox = document.querySelectorAll("#servicesCollapsible input[type='checkbox']:not(#checkAllServices)");

  // Checked/Unchecked All Slave Checkboxes When Select Master Checkbox 
  function masterCheckbox (master, slave) {
    master.onclick = function () {
      if (this.checked == true) {
        slave.forEach( function (slave) {
          slave.checked = true;
        });
      } else {
        slave.forEach( function (slave) {
          slave.checked = false;
        });
      }
    }
    slave.forEach( function (slave) {
      slave.onclick = function () {
        slaveCheckbox(selectAll, allCheckboxes);
        slaveCheckbox(selectFilesCheckbox, allFilesCheckbox);
        slaveCheckbox(selectServicesCheckbox, allServicesCheckbox);
      }
    });
  }
  masterCheckbox(selectAll, allCheckboxes);
  masterCheckbox(selectFilesCheckbox, allFilesCheckbox);
  masterCheckbox(selectServicesCheckbox, allServicesCheckbox);

  // Checked/Unchecked Master Checkbox When Select All/Any Slave Checkboxes 
  function slaveCheckbox (master, slave) {
    let checkedState = [];
    slave.forEach( function (slave) {
      checkedState.push(slave.checked);
    });
    if (checkedState.includes(false)) {
      master.checked = false;
    } else {
      master.checked = true;
    }      
  }

  // Behavior After Write User Not Exist
  let inputUserList = document.querySelector("#marketerList"),
      statusSelect = document.querySelector("#status"),
      cartButton = document.querySelector(".cart-btn");
  if (inputUserList) {
    inputUserList.onkeyup = function () {
      let myOption =  document.querySelector("#marketer option[value='" + this.value + "']");
      if (myOption != null && myOption.value.length > 0) {
        this.classList.remove("invalid");
        if (this.classList.contains("show-page")) {
          this.closest(".input-group").children[1].children[0].disabled = false;
        } else {
          cartButton.disabled = false;
        }
      } else {
        this.classList.add("invalid");
        if (this.classList.contains("show-page")) {
          this.closest(".input-group").children[1].children[0].disabled = true;
        } else {
          cartButton.disabled = true;
        }
      }
    }
  }

  // Select Transactions Status Behavior
  if (statusSelect) {
    statusSelect.onchange = function () {
      emptyStatus();
    }
    function emptyStatus () {
      if (statusSelect.value == "") {
        statusSelect.closest(".select-wrapper").children[0].classList.add("invalid");
        cartButton.disabled = true;
      } else {
        cartButton.disabled = false;
        statusSelect.closest(".select-wrapper").children[0].classList.remove("invalid");
      }
    }
    emptyStatus();
  }

  // Show Visa Price After Select
  let visaList = document.querySelector("#visaList"),
      priceInput = document.querySelector("#price"),
      orginlPrice = document.querySelector("#orginlPrice"),
      priceInvoice = document.querySelector("#visaPriceInvoice"),
      visaName = document.querySelector("#visaNameInvoice");
  if (visaList) {
    visaList.onchange = function () {
      let option = this.options[this.selectedIndex];
      priceInput.focus();
      priceInput.value = option.dataset.price;
      orginlPrice.value = option.dataset.price;
      visaName.innerHTML = '(' + option.value + ')';
      priceInvoice.closest(".modal-line").classList.remove("hide");
      priceInvoice.innerHTML = option.dataset.price;
      priceInput.onkeyup = function () {
        if (this.value != "" && this.value >= 0) {
          priceInvoice.innerHTML = this.value;
          // Calc Invoice Items
          totalInvice();
        }
      }
      // Calc Invoice Items
      totalInvice();
    }
  }

  // Show Inputs Fields After Click Edit In Transactions Page
  let editBtn = document.querySelectorAll(".show-transactions .text-label .btn"),
      cancelBtn = document.querySelectorAll(".show-transactions .input-group .cancel-btn");
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

  // Validation File On Change Input
  let myform = document.querySelector("#addTrans"),
      inputFile = document.querySelectorAll(".input-file"),
      extinsion = ["image/png", "image/jpg","image/jpeg"];
  if (inputFile) {
    for (let i = 0; i < inputFile.length; i++) {
      inputFile[i].onchange = function () {
        if (!inputFile[i].classList.contains("pdf")) {  // IF Images File
          if (!extinsion.includes(inputFile[i].files[0].type)) { // If Error File
            inputFile[i].parentElement.nextElementSibling.nextElementSibling.classList.remove("hide");
            inputFile[i].classList.remove("is-success");
          } else {  // If Success File
            ValidateImgDimensions(inputFile[i]); // Show Preview Image And Validate Dimensions
            inputFile[i].parentElement.nextElementSibling.nextElementSibling.classList.add("hide");
            inputFile[i].classList.add("is-success");
          }
        } else {
          if (inputFile[i].files[0].type != "application/pdf") {  // If Not PDF File  -- Erorr -- 
            inputFile[i].parentElement.nextElementSibling.nextElementSibling.classList.remove("hide");
            inputFile[i].classList.remove("is-success");
          } else {  // Success File It's PDF
            inputFile[i].parentElement.nextElementSibling.nextElementSibling.classList.add("hide");
            inputFile[i].classList.add("is-success");
          }
        }
        // Submit Form If Allthings it's OK
        myform.onsubmit = function (e) {
          if (inputFile[i].classList.contains("is-success")) {
            return
          } else {
            e.preventDefault();
          }
        }
      }
    }
  }
  
  // Function To Validation Photograph Image Dimensions
  const ValidateImgDimensions = (selector) => {
    let img = new Image();
    img.src = window.URL.createObjectURL(selector.files[0]);
    if (selector.classList.contains("img-input")) {
      selector.closest(".p-img").previousElementSibling.children[0].src = window.URL.createObjectURL(selector.files[0]);
    }
    img.onload = () => {
      if (selector.classList.contains("photograph")) {
        if (img.width === 150 && img.height === 200) {
          selector.parentElement.nextElementSibling.nextElementSibling.classList.add("hide");
          selector.parentElement.nextElementSibling.nextElementSibling.innerHTML = "<i class='material-icons'>error</i> ملف غير صالح (الامتدادات المسموحة هي 'JPG' 'JPEG' 'PNG')";
          selector.classList.add("is-success");
        } else {
          selector.parentElement.nextElementSibling.nextElementSibling.classList.remove("hide");
          selector.parentElement.nextElementSibling.nextElementSibling.innerHTML = '<i class="material-icons">error</i> أبعاد الصورة غير مناسبة, أدخل صورة بأبعاد [200*150]';
          selector.classList.remove("is-success");
        }
      }
    }
  }

  // For Amout Paid Only
  let paidInput = document.querySelector("#amount_paid");
  if (paidInput) {
    let paidInvoice = document.querySelector(`#${amount_paid.dataset.invoice}`);
    paidInput.onkeyup = function () {
      paidInvoice.innerHTML = this.value;
      // Calc Invoice Items
      totalInvice();
    }
  }

  // Remove Disabled After Select Checkbox
  let checkService = document.querySelectorAll(".input-field input[type='checkbox']"),
      dateInput = document.querySelector(".datepicker");
  for (let i = 0; i < checkService.length; i++) {
    checkService[i].onclick = function () {
      // Invoice Show Hide Items Funtion
      invoiceItems(checkService[i]);
      // Calc Invoice Items
      totalInvice();
      if (!checkService[i].closest(".input-field.and-date")) { // All Checkbox Expect Fingerprint Checkbox
        if (checkService[i].closest(".input-field").nextElementSibling.children[0].disabled == true) {
          checkService[i].closest(".input-field").nextElementSibling.children[0].disabled = false;
          checkService[i].closest(".input-field").nextElementSibling.children[0].focus();
        } else {
          checkService[i].closest(".input-field").nextElementSibling.children[0].disabled = true;
        }
      } else {  // Fingerprint Checkbox Only
        if (checkService[i].closest(".input-field").nextElementSibling.children[0].disabled == true) {
          checkService[i].closest(".input-field").nextElementSibling.children[0].disabled = false;
          checkService[i].closest(".input-field").nextElementSibling.children[0].focus();
          dateInput.disabled = false;
        } else {
          checkService[i].closest(".input-field").nextElementSibling.children[0].disabled = true;
          dateInput.disabled = true;
        }
      }
    }
  }

  // Disabled / Enabled Inputs "qualtal" In Sohw Transactions Page
  let superCheck = document.querySelectorAll(".checkchekbox");
  if (superCheck) {
    for (let i = 0; i < superCheck.length; i++) {
      if (superCheck[i].checked == true) {
        superCheck[i].closest(".input-field").nextElementSibling.children[0].disabled = false;
        if (superCheck[i].classList.contains("fingerprint")) {
          dateInput.disabled = false;
        }
      } else {
        superCheck[i].closest(".input-field").nextElementSibling.children[0].disabled = true;
        if (superCheck[i].classList.contains("fingerprint")) {
          dateInput.disabled = true;
        }
      }
    }
  }

  // Show / Hide Items In Invoice
  function invoiceItems (selector) {
    let invoicePrices = document.querySelector(`#${selector.dataset.invoice}`),
        orginalPrice = selector.dataset.orginalprice;
    if (selector.checked) {
      invoicePrices.closest(".modal-line").classList.remove("hide");
      invoicePrices.innerHTML = selector.closest(".input-field").nextElementSibling.children[0].value;
      selector.closest(".input-field").nextElementSibling.children[0].onkeyup = function () {
        if (this.value != "" && this.value >= 0) {
          invoicePrices.innerHTML = this.value;
          // Calc Invoice Items
          totalInvice();
        }
      }
    } else {
      invoicePrices.closest(".modal-line").classList.add("hide");
      invoicePrices.innerHTML = 0;
      selector.closest(".input-field").nextElementSibling.children[0].value = orginalPrice; // return Orginal Price
    }
  }

  // Totla Invoice Calc
  function totalInvice () {
    let itemPrices = document.querySelectorAll("#invoice .sum"),
        totlaElement = document.querySelector("#totalInvoice"),
        rest = document.querySelector("#restInvoice"),
        sum = 0;
    if (totlaElement) {
      for (let i = 0; i < itemPrices.length; i++) {
        sum += parseInt(itemPrices[i].innerHTML);
      }
      totlaElement.innerHTML = sum;
      totlaElement.parentElement.nextElementSibling.value = sum;
      if (paidInput.value != "" && paidInput.value >= 0) {
        rest.innerHTML =  Math.abs(sum - parseInt(paidInput.value));
      }
    }
  }
  totalInvice();

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