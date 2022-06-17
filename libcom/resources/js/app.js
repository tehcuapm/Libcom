require("./bootstrap");
const { refreshQuantity } = require("./header");
let popup = document.querySelector(".popup");
let activate = document.getElementById("activate-cookie");
let disable = document.getElementById("disable-cookie");

function getCookie(name) {
    //(^| )->le debut de la ligne ou un espace
    //name->le nom du cookie
    //=([^;]+)->tout sauf un ; une ou plusieurs fois
    let match = document.cookie.match(new RegExp("(^| )" + name + "=([^;]+)"));
    return match ? match[2] : "";
}

function togglePopup() {
    let after = ["none", "flex"];
    let display = window.getComputedStyle(popup, null).display;
    //on inverse le style du popup(evite un if)
    popup.style.display = after[1 - after.indexOf(display)];
}

window.onload = () => {
    //si le cookie n'existe pas
    if (getCookie("check_popup") === "") {
        togglePopup();
    }
    refreshQuantity();
};
//permet de passer le token une fois
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});
activate.addEventListener("click", () => {
    document.cookie = "check_popup=1";

    togglePopup();
});
disable.addEventListener("click", () => {
    document.cookie = "check_popup=0";
    togglePopup();
});
