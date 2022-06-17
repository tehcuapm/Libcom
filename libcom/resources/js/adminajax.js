ajaxbtnadmin = document.getElementById("reset-page");

function update_admin() {
    //on fait une requete ajax au serveur laravel
    $.ajax({
        url: "/adminreset",
        method: "GET",

        datatype: "json",
        success: function (data) {
            //on met à jour les infos
            const parent_active = document.getElementById("info_1");
            const parent_nborder = document.getElementById("info_2");
            const parent_mostExpensive = document.getElementById("info_3");


            parent_active.innerHTML = `Users actives : ${data[0]} `;
            parent_nborder.innerHTML = `Number of orders : ${data[1]}`;
            parent_mostExpensive.innerHTML = `Most Expensive order : ${data[2]}$`;
        },
    })
}

ajaxbtnadmin.addEventListener("click", function (event) {
    event.preventDefault();
    update_admin();
});

update_admin()
