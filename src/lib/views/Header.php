<?php

class Header {
    public function __construct() {
        $content = "\t\t<div class=\"header\">\n";
        $content .= "\t\t\t<a href=\"/\" class=\"logo-link\">\n";
        $content .= "\t\t\t\t<div class=\"header-logo\">" . Constants::getSiteName() . "</div>\n";
        $content .= "\t\t\t</a>\n";

        $content .= "\t\t\t<ul class=\"menu\">\n";
        $content .= "\t\t\t\t<a class=\"menu-item-link\">\n";
        $content .= "\t\t\t\t\t<li class=\"menu-item\">Categories</li>\n";
        $content .= "\t\t\t\t</a>\n";
        $content .= "\t\t\t\t<a class=\"menu-item-link\">\n";
        $content .= "\t\t\t\t\t<li class=\"menu-item\">Actors</li>\n";
        $content .= "\t\t\t\t</a>\n";
        $content .= "\t\t\t</ul>\n";

        $content .= "\t\t\t<div class=\"profile\">\n";
        $content .= "\t\t\t\t<span class=\"profile-picture\"></span>\n";
        $content .= "\t\t\t\t<span class=\"profile-name\">John Smith</span>\n";
        $content .= "\t\t\t</div>\n";

        $content .= "\t\t\t<div class=\"search\">\n";
        $content .= "\t\t\t\t<form class=\"search-form\" method=\"post\" action=\"" . htmlspecialchars("?view=search&query=") . "\" onsubmit=\"Helper.submitSearch()\">\n";
        $content .= "\t\t\t\t\t<input class=\"search-bar\" placeholder=\"search\">\n";
        $content .= "\t\t\t\t\t<i class=\"fa fa-search search-icon\" aria-hidden=\"true\"></i>\n";
        $content .= "\t\t\t\t</form>\n";
        $content .= "\t\t\t</div>\n";
        $content .= "\t\t</div>\n";

        echo $content;
    }
}

?>
