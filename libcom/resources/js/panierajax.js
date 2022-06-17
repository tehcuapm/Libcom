let messageHandler = require("./message");
const { refreshQuantity } = require("./header");

export function add_item(id, quantity) {
    $.ajax({
        url: "/panier/add",
        type: "POST",
        data: {
            id: id,
            quantity: quantity,
        },
        success: (response) => {
            messageHandler.addMessageTimeout(response.message, 3000);
            refreshQuantity();
        },
        error: (resp) => {
            console.log(resp);
        },
    });
}

export async function get_total_quantity() {
    let quantity = 0;
    await $.ajax({
        url: "/panier/quantity",
        type: "GET",
        success: (resp) => {
            quantity = resp.quantity;

        },
    });
    return quantity;
}

export async function get_total_price() {
    let price = 0;
    await $.ajax({
        url: "/panier/price",
        type: "GET",
        success: (resp) => {
            price = resp.price;
        },
        error:(resp)=>{
            console.log(resp)
        }
    });
    return price;
}
