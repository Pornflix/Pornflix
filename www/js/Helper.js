function Helper() {

}

Helper.safeElement = function(string, className, parent) {
	className = className || "";
	
	if(string == null || typeof string == 'undefined') {
		console.log("Invalid string: " + string);
		return document.createElement("div");
	}
	
	try {
		var element = document.createElement(string);
	}
	catch(e) {
		console.log(e);
	}
	
	if(element == null || typeof element == 'undefined') {
		console.log("Failed to create object with tag: " + string);
		return document.createElement("div");
	}
	
	if(className != "") {
		element.className = className;
	}
	
	if(parent != null && typeof parent != 'undefined') {
		parent.appendChild(element);
	}
	
	return element;
};

Helper.safeTextNode = function(string, parent) {
	if(string == null || typeof string == 'undefined') {
		console.log("Invalid string: " + string);
		return document.createTextNode("Error");
	}
	
	var textNode = document.createTextNode(string);
	
	if(textNode == null || typeof textNode == 'undefined') {
		console.log("Failed to create safe node with string :" + string);
		return document.createTextNode("Error");
	}
	
	if(parent != null || typeof parent != 'undefined') {
		parent.appendChild(textNode);
	}
	
	return textNode;
};

Helper.submitSearch = function() {
	var search = document.getElementsByClassName("search-form")[0];
	search.action += document.getElementsByClassName("search-bar")[0].value;
};

Helper.setSearch = function(value) {
	console.log(value);
	var searchBar = document.getElementsByClassName("search-bar")[0];
	searchBar.value += value || "";
};

Helper.getSearch = function() {
	var searchBar = document.getElementsByClassName("search-bar")[0];
	return searchBar.value;
};

Helper.addTag = function(id) {
	var tag = prompt("Add tag:");
	new XHR("?ws=QVideos&method=addTag&id=" + id + "&tag=" + tag);
};

Helper.changeTag = function(id, tag) {
	var startraw = prompt("Start:").split(":");
	var endraw = prompt("End:").split(":");

	var start = startraw[0] * 60 + parseInt(startraw[1]);
	var end = endraw[0] * 60 + parseInt(endraw[1]);

	new XHR("?ws=QVideos&method=changeTag&id=" + id + "&tag=" + tag + "&start=" + start + "&end=" + end);
}

Helper.videoTag = function(raw_time) {
	var time = JSON.parse(raw_time);
	var myPlayer = videojs("video");

	time.sort(function (a,b) {
		return a.start - b.start;
	});

	var i = 0;
	while(myPlayer.currentTime() > time[i].start) {
		i++;

		if(!time[i]) {
			i = 0;
			break;
		}
	}

	myPlayer.currentTime(time[i].start);
}

Helper.getRandomDescription = function() {
	new XHR("?ws=QVideos&method=getRandomDescription",
	Helper.setRandomDescription);
};

Helper.setRandomDescription = function(data) {
	document.getElementsByClassName("video-desc")[0].innerHTML = data;
};
