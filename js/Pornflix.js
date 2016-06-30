function Pornflix(parent, view) {
	this.parent = parent;
	this.view = view;
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
			new Video(this.container);
			break;
		default:
			new Feed(this.container);
			break;
	}

	new Footer(this.parent);
};
