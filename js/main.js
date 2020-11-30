(function () {
    
    "use strict";
    
    // Materialaize Init
    M.AutoInit();

    // Hide Loading Page After Window It Load
    window.onload = function() {
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
    }

    // Make Sidenav form right
    document.addEventListener('DOMContentLoaded', function() {
        let elems = document.querySelectorAll('.sidenav'),
            instances = M.Sidenav.init(elems, {edge: "right"});
    });

    // Go Up Button Scroll
    let upButton = document.querySelector("#goUp");
    upButton.onclick = function () {
        document.body.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    };
    window.onscroll = function () {
        if (this.pageYOffset >= 710) {
            upButton.classList.add("showing")
            upButton.classList.remove("hideing");
        } else {
            upButton.classList.add("hideing")
            upButton.classList.remove("showing");
        }
    };

    // Get Row id When Click Delete Button
    let btns = document.querySelectorAll(".select-id"),
        inputHidden = document.querySelector("#btnId");
    for (let i = 0; i < btns.length; i++) {
        btns[i].onclick = function () {
            let id = this.dataset.id;
            inputHidden.value = id;
        }
    }

})();