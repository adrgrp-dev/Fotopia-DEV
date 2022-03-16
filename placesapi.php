<!DOCTYPE html>
<html>
    <head>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&&libraries=places&key=AIzaSyCTPPWUkcYXU_s0Qelncs3GKrKW_kQDUIs&&callback=initAutocomplete"></script>
    </head>
    <body>
        <label for="locationTextField">Location</label>
        <input id="locationTextField" type="text" size="50">

        <script>
            function init() {
                var input = document.getElementById('locationTextField');
                var autocomplete = new google.maps.places.Autocomplete(input);
            }

            google.maps.event.addDomListener(window, 'load', init);
        </script>
    </body>
</html>