function Pornflix(parent) {
	this.parent = parent;
    this.draw();
}

Pornflix.prototype.draw = function() {

    var header = Helper.safeElement("div", "header", this.parent);
	var logoLink = Helper.safeElement("a", "logo-link", header);
	logoLink.setAttribute("href", "/");
    var logo = Helper.safeElement("div", "header-logo", logoLink);
    Helper.safeTextNode(Constants.site, logo);

    var menu = Helper.safeElement("ul", "menu", header);
	var menuItemLink1 = Helper.safeElement("a", "menu-item-link", menu);
    var menuItem1 = Helper.safeElement("li", "menu-item", menuItemLink1)
    Helper.safeTextNode("Categories", menuItem1);
	var menuItemLink2 = Helper.safeElement("a", "menu-item-link", menu);
    var menuItem2 = Helper.safeElement("li", "menu-item", menuItemLink2);
    Helper.safeTextNode("Actors", menuItem2);

    var profile = Helper.safeElement("div", "profile", header);
    var profilePicture = Helper.safeElement("span", "profile-picture", profile);
    var profileName = Helper.safeElement("span", "profile-name", profile);
    Helper.safeTextNode(Constants.user, profileName);

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
	Helper.safeTextNode("More", more);
	var moreChevron = Helper.safeElement("i", "fa fa-chevron-right more-chevron", more);

	var videoContainer = Helper.safeElement("div", "video-container", row);
	var video = Array();
	var preview = Array();
	var previewLink = Array();
	var videoTitle = Array();
	for(var i = 0; i < json.length; i++) {
		video[i] = Helper.safeElement("li", "video", videoContainer);
		previewLink[i] = Helper.safeElement("a", "preview-link", video[i]);
		previewLink[i].setAttribute("href", "#");
		preview[i] = Helper.safeElement("img", "preview", previewLink[i]);
		preview[i].setAttribute("src", "../Data/" + Constants.sfw + "/" + json[i].id + ".jpg");
		preview[i].setAttribute("width", imageWidth + "px");
		preview[i].setAttribute("height", 113 + "px")
		videoTitle[i] = Helper.safeElement("div", "video-title", video[i]);
		Helper.safeTextNode(json[i].name, videoTitle[i]);
	}
}
