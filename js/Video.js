function Video(parent) {
	this.parent = parent;
	this.parent.className = "container video";
	this.draw()
}

Video.prototype.draw = function() {
	this.videoContainer = Helper.safeElement("div", "video-container", this.parent);
	var videoInfo = Helper.safeElement("div", "video-info", this.videoContainer);
	var video = Helper.safeElement("video", "html5-video", videoInfo);
	video.setAttribute("controls", "");
	video.setAttribute("width", "640px");

	var videoSource = Helper.safeElement("source", "", video);
	videoSource.setAttribute("src", "../data/SFW/1.mp4");
	videoSource.setAttribute("type", "video/mp4");

	var videoTitle = Helper.safeElement("div", "video-title", videoInfo)
	Helper.safeTextNode("Indiegogo Excrement - First Vaginal Beer", videoTitle);

	new XHR(this.videoContainer, "?webservice=WSVideos&method=getVideoNames", this.drawRecommended, this);
}

Video.prototype.drawRecommended = function(json) {
	var imageWidth = 200;
	var recommended = Helper.safeElement("div", "recommended", this.videoContainer);
	var recommendedTitle = Helper.safeElement("div", "recommended-title", recommended);
	Helper.safeTextNode("Recommended", recommendedTitle);
	var recommendedList = Helper.safeElement("ul", "recommended-list", recommended);

	var recommendedItem = Array();
	var preview = Array();
	var previewLink = Array();
	var videoTitle = Array();
	for(var i = 0; i < 3; i++) {
		recommendedItem[i] = Helper.safeElement("li", "recommended-item", recommendedList);
		previewLink[i] = Helper.safeElement("a", "preview-link", recommendedItem[i]);
		previewLink[i].setAttribute("href", "/?view=video&id=" + json.video[i].id);
		preview[i] = Helper.safeElement("img", "preview", previewLink[i]);
		preview[i].setAttribute("src", "../" + Constants.imageDir + "/" + json.video[i].id + ".jpg");
		preview[i].setAttribute("width", imageWidth + "px");
		preview[i].setAttribute("height", 113 + "px")
		videoTitle[i] = Helper.safeElement("div", "preview-title ellipsis", recommendedItem[i]);
		Helper.safeTextNode(json.video[i].name, videoTitle[i]);
	}
}
