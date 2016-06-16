function Pornflix(parent) {
    this.parent = parent;
    this.draw();
}

Pornflix.prototype.draw = function() {

    var header = Helper.safeElement("div", "header", this.parent);
    var logo = Helper.safeElement("div", "header-logo", header);
    Helper.safeTextNode("Pornflix", logo);

    var menu = Helper.safeElement("ul", "menu", header);
    var menuItem1 = Helper.safeElement("li", "menu-item", menu)
    Helper.safeTextNode("Categories", menuItem1);
    var menuItem2 = Helper.safeElement("li", "menu-item", menu);
    Helper.safeTextNode("Pornstars", menuItem2);

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
}
