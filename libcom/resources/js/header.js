import {get_total_quantity} from "./panierajax";

export function refreshQuantity() {
    let span = document.getElementById("panier-quantity")
    get_total_quantity()
        .then((data) => {
            span.innerText = data;
        }).catch((data) => {
            console.log(data)
    })
}
