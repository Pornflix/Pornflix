function Video(parent, params) {
	this.parent = parent;
	this.parent.className = "container video";
	this.id = params;
	new XHR(null, "?webservice=WSVideos&method=getVideoInfo&id=" + this.id, this.draw, this);
}

Video.prototype.draw = function(json) {
	this.videoContainer = Helper.safeElement("div", "video-container", this.parent);
	var videoInfo = Helper.safeElement("div", "video-info", this.videoContainer);
	var video = Helper.safeElement("video", "html5-video video-js", videoInfo);
	video.setAttribute("controls", "");
	video.width = 640;
	video.height = 360;
	video.setAttribute("data-setup", "{}");

	var videoSource = Helper.safeElement("source", "", video);
	videoSource.setAttribute("src", "../" + Constants.dataDir + "/" + this.id + "/video.mp4");
	videoSource.setAttribute("type", "video/mp4");

	var videoTitle = Helper.safeElement("div", "video-title", videoInfo)
	Helper.safeTextNode(json.name, videoTitle);

	new XHR(this.videoContainer, "?webservice=WSVideos&method=getTags&id=" + this.id, this.drawTags, this);
}

Video.prototype.drawTags = function(json) {
	var tags = Helper.safeElement("div", "tags", this.videoContainer);
	var tagsTitle = Helper.safeElement("div", "tags-title", tags);
	Helper.safeTextNode("Tags", tagsTitle);

	for(var i = 0; i < json.length; i++) {
		var tagsLink = Helper.safeElement("a", "tags-link", tags);
		Helper.safeTextNode(json[i].name, tagsLink);
		var tagsList = Helper.safeElement("ul", "tags-list", tags);
		var tagsItem = Array();
		for(var j = 0; j < json[i].tag.length; j++) {
			var className = "tags-item tags-item-" + json[i].name.toLowerCase() + " " + (json[i].tag[j].extra ? "tags-item-extra-" + json[i].tag[j].extra.toLowerCase() : "");
			tagsItem[j] = Helper.safeElement("li", className, tagsList);
			Helper.safeTextNode(json[i].tag[j].name, tagsItem[j]);
			var tagsCount = Helper.safeElement("span", "tags-count tags-count-" + json[i].name.toLowerCase(), tagsItem[j])
			Helper.safeTextNode(json[i].tag[j].count, tagsCount);
		}
	}
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
	for(var i = 0; i < json.video.length; i++) {
		recommendedItem[i] = Helper.safeElement("li", "recommended-item", recommendedList);
		previewLink[i] = Helper.safeElement("a", "preview-link", recommendedItem[i]);
		previewLink[i].setAttribute("href", "/?view=video&id=" + json.video[i].id);
		preview[i] = Helper.safeElement("img", "preview", previewLink[i]);
		preview[i].setAttribute("src", "../" + Constants.dataDir + "/" + json.video[i].id + "/preview.jpg");
		preview[i].setAttribute("width", imageWidth + "px");
		preview[i].setAttribute("height", Math.round(((9/16)*imageWidth)) + "px")
		videoTitle[i] = Helper.safeElement("div", "preview-title ellipsis", recommendedItem[i]);
		videoTitle[i].style.width =  "200px";
		Helper.safeTextNode(json.video[i].name, videoTitle[i]);
	}
}
