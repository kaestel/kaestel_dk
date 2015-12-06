Util.Objects["front"] = new function() {
	this.init = function(scene) {

		var nodes = u.qsa("li.item", scene);
		var i, node
		if(nodes) {
			for(i = 0; node = nodes[i]; i++) {

				u.ce(node, {"type":"link", "use":"h3 a"});

			}
		}

	}
}