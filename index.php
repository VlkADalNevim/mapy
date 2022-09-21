<?php
require_once("db.php");
    
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<!-- Responsive Design -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/9526c175c2.js" crossorigin="anonymous"></script>
		<!-- CSS -->
		<link href="index.css" rel="stylesheet" type="text/css">

		<title>Mapy</title>
	</head>

	<body>

        <!------ Map ------>

            <div id="map"></div>


        <!------ Options ------>
        <div class="mapOptions">
            <form method="post" action="uloz_Data.php">
                <label for="x">X</label>
                <input type="text" id="x" name="x" value="Fb.x"><br><br>
                <label for="y">Y</label>
                <input type="text" id="y" name="y" value="Fb.y"><br><br>
                <label for="popis">Popis:</label>
                <input type="text" id="popis" name="popis"><br><br>
                <input type="submit" value="Submit" name="Submit">
            </form>
        </div>

        <!------ JS ------>
        <script>
            let map;
            
            let markersArray = []; 

            function initMap() {
                map = new google.maps.Map(document.getElementById('map'), {
                center: {lat:50.073658, lng:14.418540},
                zoom: 8
                });

                map.addListener('click', function(e) {
                    console.log(e.latLng);
                    addMarker(e.latLng);
                    console.log(e.Fb.x)
                    document.getElementById("x").value = e.Fb.x;
                    document.getElementById("y").value = e.Fb.y;
                });
            }


            function addMarker(latLng) {
                console.log(latLng)
                let marker = new google.maps.Marker({
                    map: map,
                    position: latLng,
                    draggable: true
                });

                markersArray.push(marker);
            }

            response=Array();
            <?php

            $sql = "SELECT id, x, y, popis FROM marker";
            $result = $connection->query($sql);
            
            if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
                ?>
                    response.push(<?php echo "\"".$row["id"]."-". $row["x"]."-".$row["y"]."-".$row["popis"]."\""?>)
                <?php
              }
            } else {
              echo "0 results";
            }
            $connection->close();
            ?>
            console.log(response)
            for (let index = 0; index < response.length; index++) {
                var x = response[index].split("-");
                const list =  {lat:x[1],lng:x[2]}

                //addMarker(x[2],x[2]);

                console.log(list)
                
            }
            const contentString =
                '<div id="content">' +
                '<div id="siteNotice">' +
                "</div>" +
                '<h1 id="firstHeading" class="firstHeading"><?= $row['popis'] ?></h1>' +
                '<div id="bodyContent">' +
                "<p><?= $row['x'] ?>, <?= $row['y'] ?></p>" +
                "</div>" +
                "</div>";

            const infowindow = new google.maps.InfoWindow({
                content: contentString,
            });

            marker.addListener("click", () => {
                infowindow.open({
                anchor: marker,
                map,
                shouldFocus: false,
                });
            });

            
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmgM2G9Z2ZxibQIoy_5lmB4hiCdMTVmEk&callback=initMap" async defer></script>

    </body>
</html>
