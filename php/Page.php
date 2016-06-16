<?php

class Page {
    function generate() {
        $dp = new DefaultPage;

        $dp::generateHeader();
        $dp::generateBody();
        $dp::generateFooter();
    }
}

?>
