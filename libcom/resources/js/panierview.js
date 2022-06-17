import {genElement} from "./dom_helper";
import {addMessageTimeout} from "./message";
import {refreshQuantity} from "./header";
import {get_total_price, get_total_quantity} from "./panierajax";
import {value} from "lodash/seq";

function genTable(data) {
    let thead = document.querySelector("thead")
    let tbody = document.querySelector("tbody")
    genHead(thead, ["Title", "Price", "Quantity", "Delete"])
    genContent(tbody, data);

}

function genHead(head, infos) {
    head.innerHTML = "";
    let template = `<tr>`
    infos.forEach((element) => {
        template += `<th>${element}</th>`
    })
    template += `</tr>`
    head.innerHTML = template
    return template

}

function genLine(element) {
    return `
    <td>
        <div class="product-infos">
            <a href="article/${element.id}"><img
                    src=${element.path_file} alt="coussin"
                    class="product-photo">
            </a>
            <label>${element.title}(${element.stock})</label>
        </div>

    </td>
    <td>${element.price}</td>
    <td>
        <p>${element.quantity}</p>
    </td>
    <td>
        <div class="all-buttons">
            <img src="assets/delete.png" alt="" class="icon delete-button" >


            <input min=1 type="text" name="quantity" class="quantity" value=${element.quantity}>
            <img class="icon update-button" src="assets/update.png" alt="update">


        </div>

    </td>
`;
}

function genTotal(price, quantity) {
    return `

    <td></td>
    <td>=>${price}</td>
    <td>=>${quantity}</td>
    <td>
        <div class="all-buttons">
            <div>
                <img class="icon clear-all-button"
                        src="assets/delete.png"
                        alt="">
                <label>clear all</label>

            </div>
            <div>
               <img class="icon order-all-button"
                        src="assets/buy.png"
                        alt="">
               <label>order all</label>


            </div>
        </div>
    </td>
    `;
}

function init_line_listeners(line, value) {
    $(line).find(".delete-button").on("click", (e) => {

        $.ajax({

            url: `panier/remove/${value.id}`,
            type: "GET",
            success: (resp) => {
                addMessageTimeout(resp.data, 2000);
                refreshPanier()

            }
        })
    })

    $(line).find(".update-button").on('click', (e) => {
        let quantity = $(line).find(".quantity").val()
        $.ajax({
            url: `panier/update/${value.id}`,
            type: "POST",
            data: {
                quantity: quantity
            },
            success: (resp) => {
                addMessageTimeout(resp.message, 2000);
                refreshPanier()

            },
            error: (resp) => {
                console.log(resp)
            }
        })
    })
}

function init_total_listeners(footer) {
    $(footer).find(".clear-all-button").on("click", (e) => {

        $.ajax({

            url: `/panier/clear`,
            type: "GET",
            success: (resp) => {
                addMessageTimeout(resp.data, 2000);
                refreshPanier()

            }
        })
    })
    $(footer).find(".order-all-button").on('click', (e) => {
        document.location.href = "/order/create";
    })
}

async function genContent(tbody, data) {
    tbody.innerHTML = ""
    Object.entries(data).forEach(([key, value]) => {
        let line_template = genLine(value)
        let line = genElement(tbody, "tr", line_template)
        init_line_listeners(line, value);


    })
    let quantity = await get_total_quantity();

    if (quantity > 0) {
        let price = await get_total_price();

        let template = genTotal(price, quantity);
        let footer = genElement(tbody, "tr", template)
        init_total_listeners(footer);
    }


}

function refreshPanier() {
    $.ajax({
        url: "panier/all",
        type: "GET",
        success: (data) => {
            console.log(data["panier"])
            genTable(data["panier"]);
            refreshQuantity()
        },
        error:(resp)=>{
            console.log(resp)
        }
    })


}

refreshPanier();
