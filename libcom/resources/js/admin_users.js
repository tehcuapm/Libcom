$(document).ready(async function () {
    //on genere la datatable avec les infos de l'api
    let table = $("#users").DataTable({
        ajax: '/users/all',
        columns: [
            {data: "id",title:"The User ID"},
            {data: "name",title:"His name"},
            {data: "email",title:"His email"},
            {data: "last_connection",title:"Last connection data"},
            {data: "created_at",title:"Creation date"}

        ]
    });
    //on met un listener sur chaque ligne
    $("#users tbody").on("click","tr",function (){
        let row = table.row(this)[0]
        let user_id = table.row(row).data()["id"];
        document.location.href="/profile/"+user_id;
    })
    $("#users_wrapper").css("position","inherit")
});
