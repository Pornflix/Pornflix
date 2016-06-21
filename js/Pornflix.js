function Pornflix(parent) {
    this.parent = parent;
    this.draw();
}

Pornflix.prototype.draw = function() {

    var header = Helper.safeElement("div", "header", this.parent);
    var logo = Helper.safeElement("div", "header-logo", header);
    Helper.safeTextNode("Netflix", logo);

    var menu = Helper.safeElement("ul", "menu", header);
    var menuItem1 = Helper.safeElement("li", "menu-item", menu)
    Helper.safeTextNode("Categories", menuItem1);
    var menuItem2 = Helper.safeElement("li", "menu-item", menu);
    Helper.safeTextNode("Actors", menuItem2);

    var profile = Helper.safeElement("div", "profile", header);
    var profilePicture = Helper.safeElement("span", "profile-picture", profile);
    var profileName = Helper.safeElement("span", "profile-name", profile);
    Helper.safeTextNode("John Smith", profileName);

    var search = Helper.safeElement("div", "search", header);
    var searchBar = Helper.safeElement("input", "search-bar", search);
    searchBar.setAttribute("placeholder", "Search");
    var searchIcon = Helper.safeElement("i", "fa fa-search search-icon", search);
    searchIcon.setAttribute("aria-hidden", "true");


    var container = Helper.safeElement("div", "container", this.parent);
    var row = Helper.safeElement("ul", "row", container);
    var title  = Helper.safeElement("div", "title", row);
    var genre = Helper.safeElement("div", "genre", title);
    Helper.safeTextNode("Recommended for you", genre);
    var more = Helper.safeElement("div", "more", title);
    Helper.safeTextNode("More >>", more);

    var video = [];
    var preview = [];
    var videoTitle = [];
    var videoTitles = ["Parks and Recreation", "The Office", "How I Met Your Mother", "Scrubs", "The IT Crowd"];
    for(var i = 0; i < 5; i++) {
        video[i] = Helper.safeElement("li", "video", row);
        preview[i] = Helper.safeElement("img", "preview", video[i]);
        preview[i].setAttribute("src", "../images/" + (1 + i) + ".jpg");
        preview[i].setAttribute("width", "200px");
        videoTitle[i] = Helper.safeElement("div", "video-title", video[i]);
        Helper.safeTextNode(videoTitles[i], videoTitle[i]);

    }
}
