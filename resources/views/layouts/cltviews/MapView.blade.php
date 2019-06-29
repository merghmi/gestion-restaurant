@include('./layouts/adminview/head')
 

  <body>
   
    <div id="map">
     <html>
    <head>
    <title>Laravel Google Maps Example</title>
        {!! $map['js'] !!}
    </head>
<body>
    <div class="container">
            {!! $map['html'] !!}
    </div>

    </div>
    <script>
      // You can set control options to change the default position or style of many
      // of the map controls.

      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: {lat: -33, lng: 151},
          mapTypeControl: true,
          mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
            mapTypeIds: ['roadmap', 'terrain']
          }
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDLp9ephUey2wYOfubW92ANXt7Rk30Vx7s&callback=initMap">
    </script>
  </body>
</html>
