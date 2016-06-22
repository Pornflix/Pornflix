function XHR(container, url, onComplete, onCompleteReference, method) {
	this.container = container;
	this.url = url;
	this.onComplete = onComplete;
	this.onCompleteReference = onCompleteReference;
	this.method = method || "GET";

	this.send();
}

XHR.prototype.send = function() {
	var that = this;

	this.xmlhttp = new XMLHttpRequest();

	this.xmlhttp.open(this.method, this.url);

	this.xmlhttp.onreadystatechange = function ()
    {
		if (that.xmlhttp.readyState == 4 && that.xmlhttp.status == 200)
	{

		var result = Array();

		that.checkResponseForTimeout(result);

		if (result[0] == true && result[1] != "")
		{
			that.xmlDoc = result[1];
		}
		else
		{
			that.xmlDoc = '{"error":"There was no data returned"}';
		}

		that.returnResult();
	}
}

	if (this.method == "POST")
	{
		this.xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		this.xmlhttp.send();
	}
	else
	{
		this.xmlhttp.send();
	}
};

XHR.prototype.checkResponseForTimeout = function(result)
{
    var json = null;

    result[0] = false;
    result[1] = json;

    if (this.xmlhttp.response.length == 0)
    {
        if (typeof url != 'undefined')
        {
            console.log("zero response: " + url);
        }
        else
        {
            console.log("zero response");
        }

        return;
    }
    else
    {
        json = JSON.parse(this.xmlhttp.response);

        result[1] = json;

        if (json != null)
        {
            if (json.error == "invalidsession")
            {

                console.log ("checkResponseForTimeout(): ERROR: " + xmlhttp.response);

                window.location.href=window.location.href;

                return;
            }
        }
    }

    result[0] = true;
    return;
};

XHR.prototype.returnResult = function() {
	if (this.onCompleteReference != null && this.onComplete != null)
    {
        this.onComplete.call(this.onCompleteReference, this.xmlDoc, this.xmlhttp);
    }
    else if (this.onComplete != null)
    {
        this.onComplete(this.xmlDoc, this);
    }};
