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
}

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
}
