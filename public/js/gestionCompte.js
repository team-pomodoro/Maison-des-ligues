/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var btnModifier;
var divModifier;
var btnAnnuler

window.addEventListener('load', function () {
    btnModifier = document.querySelector("#modifier");
    divModifier = document.querySelector("#divModifier");
    btnAnnuler = document.querySelector("#annuler");
    btnModifier.addEventListener("click", toggleModification);
    btnAnnuler.addEventListener("click", toggleModification);
});



function toggleModification() {

    if (divModifier.classList.contains("invisible")) {
        divModifier.classList.remove("invisible");
        divModifier.classList.add("visible");
        btnModifier.classList.add("invisible");
        btnModifier.classList.remove("visible");
    }else if (divModifier.classList.contains("visible")){
        divModifier.classList.remove("visible");
        divModifier.classList.add("invisible");
        btnModifier.classList.add("visible");
        btnModifier.classList.remove("invisible");
    }

    const inputsForm = document.querySelectorAll("form input");

    inputsForm.forEach(function (input) {
        input.disabled = !input.disabled;
    });
}