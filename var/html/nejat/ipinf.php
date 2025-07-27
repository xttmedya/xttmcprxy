<?php if($_GET['postcode']){ ?>

//alert(<?php echo $_GET['postcode'];?>)

<?php }?>

      function initialize() {
        var mapOptions = {
          zoom: 4,
          center: new google.maps.LatLng("<?php echo $_GET['postcode'];?>"),
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        var map = new google.maps.Map(document.getElementById('map_canvas'),mapOptions);
        map.setTilt(45);


        var addressArray = new Array("<?php echo $_GET['postcode'];?>");
        var geocoder = new google.maps.Geocoder();

        var markerBounds = new google.maps.LatLngBounds();

        for (var i = 0; i < addressArray.length; i++) {
        geocoder.geocode( { 'address': addressArray[i]}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {

        var marker = new google.maps.Marker({
        map: map,
        position: results[0].geometry.location
        });
        markerBounds.extend(results[0].geometry.location);
        map.fitBounds(markerBounds);

        } else {
        alert("Geocode was not successful for the following reason: " + status);
        }
        });
        }
      }

      function loadScript() {
        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&' +
            'callback=initialize';
        document.body.appendChild(script);
      }

      window.onload = loadScript;
    </script>