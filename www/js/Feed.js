function Feed(parent) {
	this.parent = parent;
	this.parent.className = "container feed";
	for(var i = 0; i < Object.keys(Constants.feedName).length; i++) {
		new XHR(this.parent, "?webservice=WSVideos&method=getVideoNames&feedName=" + Constants.feedName[i], this.draw, this);
	}
}

Feed.prototype.draw = function(json) {
	var imageWidth = 200;
	var row = Helper.safeElement("ul", "row", this.parent);
	row.setAttribute("style", "width: " + 4*(imageWidth+20) + "px;");
	var title  = Helper.safeElement("div", "title", row);
	var genre = Helper.safeElement("div", "feed-name", title);
	Helper.safeTextNode(json.feedName, genre);
	var more = Helper.safeElement("div", "more", title);
	Helper.safeTextNode("More", more);
	var moreChevron = Helper.safeElement("i", "fa fa-chevron-right more-chevron", more);

	var videoContainer = Helper.safeElement("div", "video-container", row);
	var video = Array();
	var preview = Array();
	var previewLink = Array();
	var videoTitle = Array();
	for(var i = 0; i < json.video.length; i++) {
		video[i] = Helper.safeElement("li", "feed-item", videoContainer);
		previewLink[i] = Helper.safeElement("a", "preview-link", video[i]);
		previewLink[i].setAttribute("href", "/?view=video&id=" + json.video[i].id);
		preview[i] = Helper.safeElement("img", "preview", previewLink[i]);
		preview[i].setAttribute("src", "../" + Constants.dataDir + "/" + json.video[i].id + "/preview.jpg");
		preview[i].setAttribute("width", imageWidth + "px");
		preview[i].setAttribute("height", Math.round(((9/16)*imageWidth)) + "px")
		videoTitle[i] = Helper.safeElement("div", "preview-title ellipsis", video[i]);
		videoTitle[i].style.width = imageWidth + "px";
		Helper.safeTextNode(json.video[i].name, videoTitle[i]);
	}
}
