<?php
    function getVideos()
    {
        $servername = "localhost";
        $username = "root";
        $password = "Shylah6525";
        $dbname = "SFW";
        $content = "<videos>\n";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die ("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT * FROM videos;";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $name = $row['name'];
            $added = $row['added'];
            $content .= "<row id=\"$id\" name=\"$name\" date=\"$date\"></row>\n";
        }
        $content .= "</videos>";
        $conn->close();
        return $content;
    }
?>
