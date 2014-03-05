
// news list image 
Util.Objects["video"] = new function() {
	this.init = function(li) {

		u.ce(li);
		li.clicked = function() {

			if(!this.videoplayer) {
				this.videoplayer = u.videoPlayer();
				u.ae(this, this.videoplayer);
			}

			if(!u.hc(this, "playing")) {
				this.videoplayer.loadAndPlay(this.url);
				u.ac(this, "playing");
			}
			else {
				this.videoplayer.stop();
				u.rc(this, "playing");
			}

		}

	}
}

// extension of curated list page
Util.Objects["curatedList"] = new function() {
	this.init = function(scene) {

		scene.nodes = u.qsa("li.page", scene);

		var i, node;
		for(i = 0; node = scene.nodes[i]; i++) {

			// enabled buttons
			node.bn_enable = u.qs(".status", node);
			if(node.bn_enable) {
				u.ce(node.bn_enable);
				node.bn_enable.clicked = function() {
					this.response = function(response) {
						if(response.cms_status == "success") {
							location.reload();
						}
						else {
							alert(response.message);
						}
					}
					u.request(this, this.url);
				}
			}

			// delete buttons
			node.bn_delete = u.qs(".delete", node);
			if(node.bn_delete) {
				node.bn_delete.a = u.qs("a", node.bn_delete);
				u.ce(node.bn_delete);

				node.bn_delete.restore = function(event) {
					this.a.innerHTML = "Delete";
					u.rc(this.a, "confirm");
				}

				node.bn_delete.clicked = function(event) {
					u.e.kill(event);

					// first click
					if(!u.hc(this.a, "confirm")) {
						u.ac(this.a, "confirm");
						this.a.innerHTML = "Confirm";
						this.t_confirm = u.t.setTimer(this, this.restore, 3000);
					}
					// confirm click
					else {
						u.t.resetTimer(this.t_confirm);

						this.response = function(response) {
							if(response.cms_status == "success") {
								location.reload();
							}
							else {
								alert(response.message);
							}
						}
						u.request(this, this.url);
					}

				}
			}

		}

		scene.curated_lists = u.qsa(".pages ul.news", scene);

		var list, j;
		// enable sorting of curated lists
		for(i = 0; list = scene.curated_lists[i]; i++) {

			u.s.sortable(list);
			list.picked = function(event) {
				u.bug(u.nodeId(event.target.node))
			}
			list.dropped = function(event) {

				this.response = function(response) {
					if(response.cms_status == "success") {
//						location.reload();
					}
					else {
						alert(response.message);
					}
				}
				// get new order
				var new_order = "";
				this.nodes = u.qsa("li.draggable", this);
				for(i = 0; node = this.nodes[i]; i++) {
					if(u.cv(node, "item_id")) {
						new_order += "/"+u.cv(node, "item_id");
					}
				}

				u.request(this, "/admin/cms/curatedpage/"+u.cv(this, "item_id")+"/updateCuration"+new_order)
			}

			// load images for list items
			list.nodes = u.qsa("li.draggable", list);
			for(j = 0; node = list.nodes[j]; j++) {
				u.as(node, "backgroundImage", "url(/images/"+u.cv(node, "item_id")+"/landscape/x50."+u.cv(node, "format")+")");
			}

		}

		// enable dragging news onto curated list
		var news_items = u.qsa(".all_items .items li.item", scene);
		for(i = 0; node = news_items[i]; i++) {
			node.scene = scene;

			// load background
			u.as(node, "backgroundImage", "url(/images/"+u.cv(node, "item_id")+"/landscape/x50."+u.cv(node, "format")+")");

			// click
			u.e.click(node);
			node.moved = function(event) {
				u.e.kill(event);

				this.scene._news_clone = u.ae(document.body, "div", {"class":"news_clone", "html":this.innerHTML});
				u.as(this.scene._news_clone, "height", u.gcs(this, "height"));
				u.as(this.scene._news_clone, "width", u.gcs(this, "width"));
				u.as(this.scene._news_clone, "padding", u.gcs(this, "padding"));
				u.as(this.scene._news_clone, "margin", u.gcs(this, "margin"));
				u.as(this.scene._news_clone, "backgroundImage", u.gcs(this, "background-image"));
				u.as(this.scene._news_clone, "position", "absolute");
				u.as(this.scene._news_clone, "left", u.absX(this)+"px");
				u.as(this.scene._news_clone, "top", u.absY(this)+"px");

				// mouse offset to top/left corner
				this.scene._news_clone.offset_x = u.absX(this) - u.eventX(event);
				this.scene._news_clone.offset_y = u.absY(this) - u.eventY(event);
//				u.bug(this.scene._news_clone.offset_x + " x " + this.scene._news_clone.offset_y)

				// remember what is being dragged
				this.scene._dragged_news = this;
				
				document.body.scene = this.scene;

				// follow mouse events
				u.e.addMoveEvent(document.body, this.scene._news_drag);
				u.e.addEndEvent(document.body, this.scene._news_drop);
			}
		}

		// attached to body
		scene._news_drag = function(event) {
//			u.bug("move")
			var left = (u.eventX(event) + this.scene._news_clone.offset_x);
			var top = (u.eventY(event) + this.scene._news_clone.offset_y);

			// move 
			u.as(this.scene._news_clone, "left", left+"px");
			u.as(this.scene._news_clone, "top", top+"px");

			var i, list;
			for(i = 0; list = this.scene.curated_lists[i]; i++) {
				if(
					u.eventX(event) > u.absX(list) && 
					u.eventX(event) < u.absX(list)+list.offsetWidth && 
					u.eventY(event) > u.absY(list) && 
					u.eventY(event) < u.absY(list)+list.offsetHeight
				) {
					u.ac(list, "activetarget");
				}
				else {
					u.rc(list, "activetarget");
					
				}
			}
		}

		// attached to body
		scene._news_drop = function(event) {
//			u.bug("drop")

			// stop tracking mouse
			u.e.removeMoveEvent(document.body, this.scene._news_drag);
			u.e.removeEndEvent(document.body, this.scene._news_drop);

			var i, list;
			for(i = 0; list = this.scene.curated_lists[i]; i++) {
				if(
					u.eventX(event) > u.absX(list) && 
					u.eventX(event) < u.absX(list)+list.offsetWidth && 
					u.eventY(event) > u.absY(list) && 
					u.eventY(event) < u.absY(list)+list.offsetHeight
				) {

					this.scene.response = function(response) {
						if(response.cms_status == "success") {

					
	//						u.notify(response.message);
							location.reload();

		//					location.href = this.actions["cancel"].url;
						}
						else {
							page.notify(response.cms_message, {"class":"error"});
		//					alert(response.message);
						}


						// if(response.cms_status == "success") {
						// 	location.reload();
						// }
						// else {
						// 	alert(response.message);
						// }
					}

					u.request(this.scene, "/admin/cms/curatedpage/"+u.cv(list, "item_id")+"/addToCuration/"+u.cv(this.scene._dragged_news, "item_id"))

					u.rc(list, "activetarget");
				}
				else {
					u.rc(list, "activetarget");
				}
			}

			// get rid of clone
			this.scene._news_clone.parentNode.removeChild(this.scene._news_clone);
			this.scene._news_clone = false;
			this.scene._dragged_news = false;
			this.scene = false;
		}
	}
}

