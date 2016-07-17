function Pornflix(parent, view, params) {
	this.parent = parent;
	this.view = view;
	this.params = params;
	new XHR(null, "?webservice=WSConstants&method=getConstants", this.setConstants, this);
}

Pornflix.prototype.setConstants = function(json) {
	Parameters(json);
	this.draw();
}

Pornflix.prototype.draw = function() {
	new Header(this.parent);
	this.container = Helper.safeElement("div", "container", this.parent);

	switch(this.view) {
		case "video":
			new Video(this.container, this.params);
			break;
		case "search":
			new Search(this.container, this.params);
			break;
		default:
			new Feed(this.container);
			break;
	}

	new Footer(this.parent);
};
