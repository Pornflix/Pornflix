Constants = {};

function Parameters(json) {
	Constants = {
		site: json.site,
		user: "John Smith",
		feedName: {
			0: "Recommended for you",
			1: "Amatuer"
		},
		dataDir: json.dataDir
	};
}
