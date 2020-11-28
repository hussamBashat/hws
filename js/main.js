(function () {
    
    "use strict";
    
    // Materialaize Init
    M.AutoInit();

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

    //
    let btns = document.querySelectorAll(".select-id"),
        inputHidden = document.querySelector("#btnId");
    for (let i = 0; i < btns.length; i++) {
        btns[i].onclick = function () {
            let id = this.dataset.id;
            inputHidden.value = id;
        }
    }

})();