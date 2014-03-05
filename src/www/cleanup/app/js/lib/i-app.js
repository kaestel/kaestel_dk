/**
* Cache interface
*/
Util.Cache = u.c = new function() {


	this.update = function() {
		this.cache = window.applicationCache;

		u.e.addEvent(this.cache, "downloading", u.c._downloading);
		u.e.addEvent(this.cache, "progress", u.c._progress);
		u.e.addEvent(this.cache, "cached", u.c._cached);
		u.e.addEvent(this.cache, "checking", u.c._checking);
		u.e.addEvent(this.cache, "noupdate", u.c._noupdate);
		u.e.addEvent(this.cache, "updateready", u.c._updateready);
		u.e.addEvent(this.cache, "obsolete", u.c._obsolete);
		u.e.addEvent(this.cache, "error", u.c._error);

//		this.debug();
//		this.cache.swapCache();
		this.cache.update();
	}

	this.debug = function() {
		u.bug("##DEBUG##");
		var s = "";
		for(x in this.cache) {
			s += x+"="+this.cache[x]+"<br>";
		}
		u.bug(s);
		
	}

	this._downloading = function(event) {
		document.body.message.innerHTML += "Cache downloading<br />";
//		u.c.debug();
	}

	this._progress = function(event) {

//		u.c.debug();

		if(u.c.cache.status == 1) {
			document.body.message.innerHTML += "Cache progress - idle<br />";
		}
		if(u.c.cache.status == 3) {
			document.body.message.innerHTML += "Cache progress - downloading<br />";
		}

	}

	this._cached = function(event) {
		document.body.message.innerHTML += "Cached<br />";
	}

	this._checking = function(event) {
		document.body.message.innerHTML += "Cache checking<br />";
	}

	this._noupdate = function(event) {
		document.body.message.innerHTML += "Cache noupdate<br />";
	}

	this._updateready = function(event) {
		document.body.message.innerHTML += "Cache ready<br />";
	}

	this._obsolete = function(event) {
		document.body.message.innerHTML += "Cache obsolete<br />";
	}

 	this._error = function(event) {
		var s = "";
		for(x in event.target) {
			s += x+"="+event.target[x]+"\n";
		}
		document.body.message.innerHTML += "Cache error:"+s+"<br />";
	}
}

Util.Objects["app"] = new function() {
	this.init = function(body) {

		body.message = u.ae(body, "div", {"class":"message"});

		// clear interface
		body.clear = function() {
			this.innerHTML = "";
			this.message = u.ae(body, "div", {"class":"message"});
		}

		// login interface
		body.ui_login = function() {
			this.clear();

			u.ae(this, "h1").innerHTML = "Login"

			// create login form
			u.ae(this, "input", {"class":"text username i:inputlabel i:focus", "type":"email", "name":"username", "value":"username"});
			u.ae(this, "input", {"class":"text password i:inputlabel", "type":"password", "name":"password", "value":"password"});

			this.login = u.ae(this, "input", {"class":"login", "type":"button", "value":"login"});
			u.e.click(this.login);
			this.login.clicked = function(event) {
				var username = u.ge("username").value;
				var password = u.ge("password").value;

				// attempt login
				u.XMLRequest("/app/login", this, "username="+username+"&password="+password);
			}

			// submit on enter
			this.onkeyup = function(event) {
				if(event.keyCode == 13) {
					document.body.login.clicked(event);
				}
			}

			// login handler
			this.login.XMLResponse = function(response) {
				var element, i;

				// find user_id - getElementById not accessible on response node
				for(i = 0; element = response.getElementsByTagName("div")[i]; i++) {
					if(element.id == "user_id") {
//						document.body.message.innerHTML = response.innerHTML;

						u.saveCookie("user_id", element.innerHTML);
						document.body.ui_options();
						return;
					}
				}

				// login error
//				document.body.message.innerHTML = response.innerHTML;
				document.body.message.innerHTML = "Login error";
			}

			// init interface
			u.init(document.body);

		}

		// options interface
		body.ui_options = function() {
			this.clear();

			u.ae(this, "h1").innerHTML = "Choose your purpose";

			// post new content
			var post = u.ae(this, "input", {"class":"button post", "type":"button", "value":"new post"});
			u.e.click(post);
			post.clicked = function(event) {
				document.body.ui_content();
			}

			// update cache
			var cache = u.ae(this, "input", {"class":"button cache", "type":"button", "value":"update cache"});
			u.e.click(cache);
			cache.clicked = function(event) {
				document.body.ui_cache();
			}

			// init interface
			u.init(document.body);

		}

		// add content interface (limited to log-entries)
		body.ui_content = function() {
			this.clear();

			u.ae(this, "h1").innerHTML = "Add log entry"
			u.ae(this, "input", {"class":"text name i:inputlabel i:focus", "type":"text", "name":"name", "value":"name"});
			u.ae(this, "textarea", {"class":"html i:inputlabel", "name":"html"}).innerHTML = "entry text";
			
			u.ae(this, "input", {"class":"timestamp", "type":"hidden", "name":"timestamp", "value":u.date("d-m-Y H:i")});
			u.ae(this, "input", {"class":"latitude", "type":"hidden", "name":"latitude"});
			u.ae(this, "input", {"class":"longitude", "type":"hidden", "name":"longitude"});

			this.save = u.ae(this, "input", {"class":"save", "type":"button", "value":"save"});
			u.e.click(this.save);
			this.save.clicked = function() {
				var name = u.ge("name").value;
				var html = u.ge("html").value;

				var timestamp = u.ge("timestamp").value;
				var latitude = u.ge("latitude").value;
				var longitude = u.ge("longitude").value;

				u.XMLRequest("/app/save", this, "name="+name+"&html="+html+"&timestamp="+timestamp+"&latitude="+latitude+"&longitude="+longitude);

//				u.bug("save")
			}
			this.save.XMLResponse = function(response) {
				u.bug(response.innerHTML);
			}


			// done/cancel - go back
			var done = u.ae(this, "input", {"class":"button done", "type":"button", "value":"cancel"});
			u.e.click(done);
			done.clicked = function(event) {
				document.body.ui_options();
			}

			this.preview = u.ae(this, "div", {"class":"preview"});

			// submit on enter
			// disable on textareas unless combined with ctrl- or metakey (cmd)
			// otherwise replicate to HTML preview
			u.e.addEvent(this, "keydown", function(event) {

				// submit
				if(event.keyCode == 13 && (event.target.nodeName.toLowerCase() != "textarea")) {
					document.body.save.clicked(event);
				}
				else if(event.target.nodeName.toLowerCase() == "textarea" && (event.ctrlKey || event.metaKey)) {
					if(event.keyCode == 49) {
						u.e.kill(event);
						this.format("h1");
					}
					else if(event.keyCode == 50) {
						u.e.kill(event);
						this.format("h2");
					}
					else if(event.keyCode == 51) {
						u.e.kill(event);
						this.format("h3");
					}
					else if(event.keyCode == 48) {
						u.e.kill(event);
						this.format("p");
					}
					else if(event.keyCode == 13) {
						u.e.kill(event);
						var text = u.ge("textarea");
						var value = text.value;
						var cursor = text.selectionStart;
						u.ge("textarea").value = value.substring(0, text.selectionStart) + '<br />' + "\n" + value.substring(text.selectionStart, value.length);
						text.selectionStart = cursor+7;
						text.selectionEnd = cursor+7;
					}
				}
			});

			u.e.addEvent(this, "keyup", function(event) {
				this.preview.innerHTML = u.ge("html").value;
				u.ie(this.preview, "h1").innerHTML = u.ge("name").value;
			});

			this.format = function(tag) {
				var text = u.ge("textarea");
				var value = text.value;
				var cursor_start = text.selectionStart;
				var cursor_end = text.selectionEnd;
				u.ge("textarea").value = value.substring(0, cursor_start) + '<'+tag+'>' + value.substring(cursor_start, cursor_end) + '</'+tag+'>' + "\n" + value.substring(cursor_end, value.length);
				text.selectionStart = cursor_start+2+tag.length;
				text.selectionEnd = cursor_end+2+tag.length;
			}

			// get location
			Util.getLocation("latitude", "longitude");

			// init interface
			u.init(document.body);

		}

		// handle cache updates
		body.ui_cache = function() {
			this.clear();

			if(navigator.onLine) {
				u.ae(this, "h1").innerHTML = "Updating cache"
				u.c.update();
			}
			else {
				u.ae(this, "h1").innerHTML = "Cache offline"
			}

			// done - go back
			var done = u.ae(this, "input", {"class":"button done", "type":"button", "value":"done"});
			u.e.click(done);
			done.clicked = function(event) {
				document.body.ui_options();
			}

		}


		// do the initial app feature check

		// no applicationCache support
		if(!window.applicationCache) {
			body.innerHTML = "No HTML5 support";
		}

		// start app
		else {

			if(!u.getCookie("user_id")) {
				body.ui_login();
			}
			else {
				body.ui_options();
			}

		}

	}
}
