<?php

class Pornflix {
    public function Pornflix() {
        $view = !empty($_GET['view']) ? $_GET['view'] : "";

        switch($view) {
            case "video":
                new Video();
                break;
            case "search":
                new Search();
                break;
            default:
                new Feed();
                break;
        }
    }
}

?>
