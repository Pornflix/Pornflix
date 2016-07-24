function Pornflix(parent, view, params) {
	this.parent = parent;
	this.view = view || null;
	if(params) {
		this.id = params['id'] || null;
		this.query = params['query'] || "";
	}
	new XHR(null, "?webservice=WSConstants&method=getConstants", this.setConstants, this);
}

Pornflix.prototype.setConstants = function(json) {
	Parameters(json);
	this.draw();
}

Pornflix.prototype.draw = function() {
	new Header(this.parent, this.query);
	this.container = Helper.safeElement("div", "container", this.parent);

	switch(this.view) {
		case "video":
			new Video(this.container, this.id);
			break;
		case "search":
			new Search(this.container, this.query);
			break;
		default:
			new Feed(this.container);
			break;
	}

	new Footer(this.parent);
};
