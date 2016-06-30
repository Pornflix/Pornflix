function Footer(parent) {
	this.parent = parent;
	this.draw();
}

Footer.prototype.draw = function() {
	var footer = Helper.safeElement("div", "footer", this.parent);
	Helper.safeTextNode("This is a footer, shut up", footer);
}
