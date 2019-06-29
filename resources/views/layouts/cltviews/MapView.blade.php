@include('./layouts/adminview/head')
 

  <body>
    <h1>map</h1>
    <div id="map"></div>
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
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA7a-pVRxc_cx00QNTiPWQZW50qxiqZGO0&callback=initMap">
    </script>
  </body>
</html>
