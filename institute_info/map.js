AIzaSyC2cDUyaElfdMXs6bGXUanTZujOGbUWR5Q //api key

function loadMap(){
    let dhaka = { lat: 23.8041, lng: 90.4152};
    let map = new google.maps.Map(document.getElementById('map'),{
        zoom: 13,
        center: dhaka
    });
    var marker = new google.maps.Marker({
        position: dhaka,
        map: map
    })
}