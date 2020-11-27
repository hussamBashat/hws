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

})();