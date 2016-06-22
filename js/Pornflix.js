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


    this.container = Helper.safeElement("div", "container", this.parent);
	new XHR(this.container, "?webservice=WSVideos&method=memes", this.videoRows, this);
};

Pornflix.prototype.videoRows = function(json) {
	var imageWidth = 200;
	var row = Helper.safeElement("ul", "row", this.container);
	row.setAttribute("style", "width: " + Math.floor(window.innerWidth/(imageWidth+20))*(imageWidth+20) + "px;");
	var title  = Helper.safeElement("div", "title", row);
	var genre = Helper.safeElement("div", "genre", title);
	Helper.safeTextNode("Recommended for you", genre);
	var more = Helper.safeElement("div", "more", title);
	Helper.safeTextNode("More >>", more);

	var videoContainer = Helper.safeElement("div", "video-container", row);
	var video = [];
	var preview = [];
	var videoTitle = [];
	for(var i = 0; i < json.length; i++) {
		video[i] = Helper.safeElement("li", "video", videoContainer);
		preview[i] = Helper.safeElement("img", "preview", video[i]);
		preview[i].setAttribute("src", "../images/" + json[i].id + ".jpg");
		preview[i].setAttribute("width", imageWidth + "px");
		videoTitle[i] = Helper.safeElement("div", "video-title", video[i]);
		Helper.safeTextNode(json[i].name, videoTitle[i]);
	}
}
