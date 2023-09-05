<!DOCTYPE html>
        <html>
           <head>
              <title>OSM and Leaflet</title>
              <link rel = "stylesheet" href = "http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css"/>
           </head><body>
              <div id = "map" style = "width: 900px; height: 580px"></div><script src = "http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
              <script>
                 // Creating map options
                 var mapOptions = {
                    center: [17.385044, 78.486671],
                    zoom: 4
                 }

                 // Creating a map object
                 var map = new L.map('map', mapOptions);

                 // Creating a Layer object
                 var layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');

                 // Adding layer to the map
                 map.addLayer(layer);
                 let customIcon = {
    iconUrl:"icon/marker.png",
    iconSize:[40,40]
}

let myIcon = L.icon(customIcon);
//let myIcon = L.divIcon();

let iconOptions = {
    title:"v2v",
    draggable:false,
    icon:myIcon
}

let marker = new L.Marker([51.958, 9.141] , iconOptions);
marker.addTo(map).bindPopup("content");
//marker.bindPopup("content");
//let popup = L.popup().setLatLng([51.958, 9.797] ).setContent("<p>new popup</br> more complicated</p>").openOn(map);
              </script>
           </body>

        </html>
