<?php

class Pornflix {
    public function Pornflix() {
        $view = !empty($_GET['view']) ? $_GET['view'] : "";

        switch($view) {
            case "video":
                new Header();
                new Video();
                break;
            case "search":
                new Header();
                new Search();
                break;
            default:
                new Header();
                new HomeFeed();
                break;
        }
    }
}

?>
