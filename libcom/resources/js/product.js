import { add_item } from "./panierajax";

let quantity = document.getElementById("product-quantity");
let buy = document.getElementById("product-buy");
$(buy).on("click", () => {
    let id = buy.getAttribute("product_id");
    add_item(id, quantity.value);
});
