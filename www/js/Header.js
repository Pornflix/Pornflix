function Header(parent, params) {
	this.parent = parent;
	this.query = params;
	this.draw();
}

Header.prototype.draw = function() {
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
	var searchForm = Helper.safeElement("form", "search-form", search);
	var searchBar = Helper.safeElement("input", "search-bar", searchForm);
	searchBar.setAttribute("placeholder", "Search");
	searchBar.value = this.query || "";
	searchForm.setAttribute("method", "post");
	searchForm.setAttribute("action", "?view=search&query=");
	searchForm.setAttribute("onsubmit", "Helper.submitSearch()");
	var searchIcon = Helper.safeElement("i", "fa fa-search search-icon", searchForm);
	searchIcon.setAttribute("aria-hidden", "true");
};
