Util.Objects["front"] = new function() {
	this.init = function(scene) {

		scene.resized = function() {
//			u.bug("scene.resized:" + u.nodeId(this));
		}

		scene.scrolled = function() {
//			u.bug("scrolled:" + u.nodeId(this))
		}

		scene.ready = function() {
//			u.bug("scene.ready:" + u.nodeId(this));

			page.cN.scene = this;

			var nodes = u.qsa("li.item", scene);
			var i, node
			if(nodes) {
				for(i = 0; node = nodes[i]; i++) {

	//				u.bug("node:" + node)
					u.ce(node, {"type":"link", "use":"h3 a"});

				}
			}

			// accept cookies?
			page.acceptCookies();

			page.resized();

		}

		// scene is ready
		scene.ready();
	}
}