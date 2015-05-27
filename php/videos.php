<?php
    include "WSVideos.php";

    function showVideos() {
        $xmlstring = getVideos();

        $xml = new SimpleXMLElement($xmlstring);
        $length = count($xml->row);

        for($i = 0; $i < $length; $i++) {
            echo "          <li><div id=\"preview\"><img src=\"images/" . $xml->row[$i]['id'] . ".jpg\" height=\"140.625px\" width=\"250px\"></div><p>" . $xml->row[$i]['name'] . "</p></li>";
        }
    }
?>
