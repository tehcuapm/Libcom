google.maps.event.addDomListener(window, 'load', init);
function init(){
    const input = document.getElementById("autocomplete")

    const auto = new google.maps.places.Autocomplete(input);
}
