Util.Objects["articlelist"] = new function() {
	this.init = function(list) {


		list.items = u.qsa(".item", list);

		list.scrolled = function() {

			var scroll_y = u.scrollY()
			var browser_h = u.browserH();

			var i, node, node_y, list_y;
			list_y = u.absY(this);
			// auto extend list
			if(this._prev && list_y + browser_h > scroll_y) {
				this.loadPrev();
			}
			else if(this._next && list_y + this.offsetHeight < scroll_y + (browser_h*2)) {
				this.loadNext();
			}


			for(i = 0; node = this.items[i]; i++) {

				node_y = u.absY(node);

//				u.bug("build Node:" + (abs_y - 200) + "<" + (scroll_y+browser_h) + " && " + (abs_y + 200) + ">" +  scroll_y);

				// auto load nodes
				if(!node._ready && node_y - 200 < scroll_y+browser_h && node_y + 200 > scroll_y) {
//					u.bug("init node:" + u.nodeId(node));
					u.o.article.init(node);
					node._ready = true;
				}

			}
		}
		u.e.addWindowScrollEvent(list, list.scrolled);

		var next_link = u.qs(".pagination li.next a", list.parentNode);
		var prev_link = u.qs(".pagination li.previous a", list.parentNode);

		
		// dummy - should be references to pagination html
		list._prev = prev_link ? prev_link.href : false;
		list._next = next_link ? next_link.href : false;

		// extend list with prev items
		list.loadPrev = function() {
			if(this._prev) {
				u.bug("load prev function")
				
				// receive previous items
				this.response = function(response) {

					var items = u.qsa(".item", response);
					var i, node;
					for(i = items.length; i; i--) {
						node = u.ie(this, items[i-1]);
						u.bug("u.scrollY:" + u.scrollY())

						// correct scroll offset
						window.scrollTo(0, u.scrollY()+node.offsetHeight);
					}

					// more items available
					var prev_link = u.qs(".pagination li.previous a", response);
					this._prev = prev_link ? prev_link.href : false;

					this.items = u.qsa(".item", this);

				}
				u.request(this, this._prev);
				// do not attempt to load more while waiting for response
				this._prev = false;
			}
		
		}
		// extend list with next items
		list.loadNext = function() {
//			u.bug("load next function")
		
			if(this._next) {
		
				// receive previous items
				this.response = function(response) {

					var items = u.qsa(".item", response);
					var i;
					for(i = 0; i < items.length; i++) {
						u.ae(this, items[i]);
					}

					// more items available
					var next_link = u.qs(".pagination li.next a", response);
					this._next = next_link ? next_link.href : false;

					this.items = u.qsa(".item", this);
				}
				u.request(this, this._next);
				// do not attempt to load more while waiting for response
				this._next = false;
			}
		}

		// set initial scrolling
		if(list._prev) {

			list.content_y = u.absY(u.qs("h1"));
			list.start_y = u.absY(list.items[0]);
			window.scrollTo(0, list.start_y-list.content_y);
		}
		else if(u.scrollY()) {
			window.scrollTo(0, 0);
		}
		
		

		// initial load check
		list.scrolled();
	}


}