import {each} from "lodash";
import {genElement} from "./dom_helper";
import {add_item} from "./panierajax";
let addButtons = document.querySelectorAll(".add-product-button");

addButtons.forEach((item) => {
    item.addEventListener("click", () => {
        let id = item.getAttribute("product_id");
        add_item(id, 1);
    });
});

let searchBar = document.getElementById("search-bar");

function genCardItem(element) {
    let div = genElement(parent, "div", "", "product-item");
    let imgSon = genElement(div, "img", "", "item-img");
    imgSon.setAttribute("src", element["path_file"]);
    let title = genElement(div, "h4", element.title, "item-title");
    let divForm = genElement(div, "div", "", "items-buttons");
    let form = genElement(divForm, "form", "", "");
    $(form).attr("action", "article/" + element.id)
    let buttonSee = genElement(form, "button", "SEE", "");
    buttonSee.setAttribute("type", "submit");
    if (element.stock > 0) {
        let buttonBuy = genElement(
            divForm,
            "button",
            "BUY",
            "add-product-button"
        );
        buttonBuy.setAttribute("product_id", element.id);
        $(buttonBuy).on("click", () => {
            let id = buttonBuy.getAttribute("product_id");
            add_item(id, 1);
        });
    }
}

$(searchBar).on("input", (resp) => {
    let value = resp.target.value;
    $.ajax({
        url: "/search",
        method: "POST",
        data: {
            value: value,
        },
        dataType: "json",
        success: function (resp) {
            // console.log(resp)
            parent = document.getElementById("products-list");
            parent.innerHTML = "";
            resp.data.forEach((element) => {
                genCardItem(element);

            });
        },
        error: function (errorThrown) {
            console.log(errorThrown);
        },
    });
});
