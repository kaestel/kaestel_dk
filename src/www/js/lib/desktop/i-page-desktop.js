u.bug_console_only = true;

Util.Objects["page"] = new function() {
	this.init = function(page) {

		//if(u.hc(page, "i:page")) {
			//alert("wop");
			// header reference
			page.hN = u.qs("#header");
			page.hN.service = u.qs(".servicenavigation", page.hN);
			
			// content reference
			page.cN = u.qs("#content");

			// navigation reference
			page.nN = u.qs("#navigation");
			page.nN.list = u.qs("ul", page.nN);
			page.nN = u.ie(page.hN, page.nN);

			// footer reference
			page.fN = u.qs("#footer");
			// move li to #header .servicenavigation
			page.fN.service = u.qs(".servicenavigation", page.fN);

			// move service navigation items to appropriate node
			u.ae(page.fN.service, u.qs("li.contact", page.hN.service));

			var pix = u.qs("li.pix", page.nN);
			u.ie(page.hN.service, pix);
			page.pix_user_id = u.cv(pix, "user_id");

			u.ie(page.nN, page.hN.service);


			// global resize handler 
			page.resized = function() {

				// forward resize event to current scene
				if(page.cN && page.cN.scene) {

					// adjust content height
					var content_height = u.browserH() - page.nN.offsetHeight - page.fN.offsetHeight;
					if(page.cN.scene.offsetHeight < content_height) {
						u.as(page.cN, "height", content_height+"px", false);
					}
					else {
						u.as(page.cN, "height", "auto", false);
					}

					if(typeof(page.cN.scene.resized) == "function") {
						page.cN.scene.resized();
					}

				}



			}

			// global scroll handler 
			page.scrolled = function() {

				// forward scroll event to current scene
				if(page.cN && page.cN.scene && typeof(page.cN.scene.scrolled) == "function") {
					page.cN.scene.scrolled();
				}

			}



			// Page is ready - called from several places, evaluates when page is ready to be shown
			page.ready = function() {
//				u.bug("page ready")

				// page is ready to be shown - only initalize if not already shown
				if(!u.hc(this, "ready")) {

					// page is ready
					u.addClass(this, "ready");

					// set resize handler
					u.e.addEvent(window, "resize", page.resized);
					// set scroll handler
					u.e.addEvent(window, "scroll", page.scrolled);

					this.initNavigation();

					this.resized();
				}
			}

			// close navigation
			page.closeNav = function() {

				u.t.resetTimer(page.t_nav);

				var open_nodes = u.qsa(".open", page.hN);
				if(open_nodes) {
					var i, node;
					for(i = 0; node = open_nodes[i]; i++) {

						u.a.transition(node.submenu, "all 0.2s linear");
						u.a.setOpacity(node.submenu, 0);
						u.rc(node, "open");
					}
				}

				u.a.transition(page.hN, "all 0.2s ease-out");
				u.a.setHeight(page.hN, page.hN.org_height);

				this.open_nav = false;
			}

			// open/close controller
			page.navController = function(li) {
//				u.bug("navcontroller:" + u.nodeId(li) + "; " + (this.open_nav ? u.nodeId(this.open_nav) : ''))

				if(this.open_nav != li) {

					if(this.open_nav) {
						u.a.transition(this.open_nav.submenu, "all 0.2s linear");
						u.a.setOpacity(this.open_nav.submenu, 0);
						u.rc(this.open_nav, "open");
					}

					u.a.transition(page.hN, "all 0.3s ease-in-out");
					u.a.setHeight(page.hN, li.submenu.offsetHeight + page.hN.org_height);

					u.a.transition(li.submenu, "all 0.3s linear 0.3s");
					u.a.setOpacity(li.submenu, 1);

					u.ac(li, "open");
					this.open_nav = li;
				}
				else {
					this.closeNav();
				}
			}

			// initialize navigation elements
			page.initNavigation = function() {

				// add logo to navigation
				page.logo = u.ie(page.nN, "div", {"class":"logo"});
				u.ce(page.logo);
				page.logo.clicked = function(event) {
					window.location.href = '/';
				}

				this.hN.org_height = this.hN.offsetHeight;

				var i, node;
				// enable submenus where relevant
				this.hN.nodes = u.qsa("h6", page.hN);
				for(i = 0; node = this.hN.nodes[i]; i++) {

					var li = node.parentNode;

					// get submenu and position it correctly
					li.submenu = u.qs("ul.subjects", li);
					li.submenu.li = li;

					// enable mouseover if mouse events are available
					if(u.e.event_pref == "mouse") {
						li._mousedover = function() {
//							u.bug("mouseover")

							u.t.resetTimer(page.t_nav);

							if(!u.hc(this, "open")) {
								page.navController(this);
							}
						}

						li._mousedout = function() {
//							u.bug("mouseout")
							page.t_nav = u.t.setTimer(this, page.closeNav, 500);
						}

						u.e.addEvent(li, "mouseover", li._mousedover);
						u.e.addEvent(li, "mouseout", li._mousedout);
					}

					u.e.click(li);
					li.clicked = function() {
						page.navController(this);
					}
				}


				// inject simple search field on click
				this.hN.li_search = u.qs("li.search", this.hN.service);
				u.ce(this.hN.li_search);
				this.hN.li_search.clicked = function() {

					// close navigation elements
					page.closeNav();

					if(!this.is_open) {

						this.is_open = true;

						if(!this.topmenu) {
							this.topmenu = u.ie(page, "div", {"class":"search"});
							this.form_search = u.ae(this.topmenu, "form", {"method":"post", "action":this.url});
							this.input_search = u.ae(this.form_search, "input", {"type":"text", "name":"sss"});
							this.bn_search = u.ae(this.form_search, "input", {"type":"submit", "value":u.txt["search"]});
					
							u.a.translate(this.topmenu, 0, -1000);
							u.as(this.topmenu, "display", "block");
							this.topmenu.org_height = this.topmenu.offsetHeight;
							u.a.setHeight(this.topmenu, 0);
							u.a.translate(this.topmenu, 0, 0);
						}

						u.as(this.topmenu, "zIndex", 50);

						// close mypix link in case it is open
						if(page.hN.li_mypix.topmenu) {
							u.as(page.hN.li_mypix.topmenu, "zIndex", 40);
							u.a.setHeight(page.hN.li_mypix.topmenu, 0);

							// align current menu with open space
							u.a.transition(this.topmenu, "none");
							u.a.setHeight(this.topmenu, page.hN.li_mypix.topmenu.org_height);
						}
						page.hN.li_mypix.is_open = false;

						// show search
						u.a.transition(page.hN, "all 0.3s ease-in-out");
						u.a.transition(this.topmenu, "all 0.25s ease-in-out");

						u.a.setHeight(this.topmenu, this.topmenu.org_height);
						u.a.translate(page.hN, 0, this.topmenu.org_height);
					}

					// close
					else {
						this.is_open = false;

						u.a.transition(page.hN, "all 0.3s ease-in-out");
						u.a.transition(this.topmenu, "all 0.35s ease-in-out");

						u.a.translate(page.hN, 0, 0);
						u.a.setHeight(this.topmenu, 0);
					}
				}


				// if user is not already logged in, clicking will display login form
				this.hN.li_mypix = u.qs("li.pix", this.hN.service);
				u.ce(this.hN.li_mypix);
				this.hN.li_mypix.clicked = function() {

					page.closeNav();

					// user is already logged in
					if(u.hc(this, "logged_in")) {
					
						location.href = this.url;
					
					}
					else {
					
						if(!this.is_open) {

							this.is_open = true;

							// if login form does not already exist
							if(!this.topmenu) {

								// request login page
								this.response = function(response) {

									this.topmenu = u.qs(".scene div.login", response);
									// got login element
									if(this.topmenu) {

										// inject login and initialize
										this.topmenu = u.ie(page, this.topmenu);
										this.topmenu._form = u.qs("form", this.topmenu);
										this.topmenu._whatis = u.qs("div.whatismypix", this.topmenu);

										var section = u.ae(this.topmenu, "div", {"class":"section"});
										u.ae(section, this.topmenu._form);
										u.ae(section, this.topmenu._whatis);

										u.f.init(this.topmenu._form);

										u.a.translate(this.topmenu, 0, -1000);
										u.as(this.topmenu, "display", "block");
										this.topmenu.org_height = this.topmenu.offsetHeight;
										u.a.setHeight(this.topmenu, 0);
										u.a.translate(this.topmenu, 0, 0);

										// opening login box
										this.topmenu.openLogin = function() {

											u.as(this, "zIndex", 50);

											// close search in case it is open
											if(page.hN.li_search.topmenu) {
												u.as(page.hN.li_search.topmenu, "zIndex", 40);
												u.a.setHeight(page.hN.li_search.topmenu, 0);

												// align current menu with open space
												u.a.transition(this, "none");
												u.a.setHeight(this, page.hN.li_search.topmenu.org_height);
											}
											page.hN.li_search.is_open = false;

											// open mypix login box
											u.a.transition(page.hN, "all 0.3s ease-in-out");
											u.a.transition(this, "all 0.25s ease-in-out");

											u.a.translate(page.hN, 0, this.org_height);
											u.a.setHeight(this, this.org_height);
										}
										this.topmenu.openLogin();
									}
									// if unexpected response - redirect to mypix page
									else {
										location.href = this.url;
									}
								}

								u.request(this, this.url);

							}
							// login box available, just show it
							else {
								this.topmenu.openLogin();
							}
						}
						// close login form
						else {
							this.is_open = false;

							u.a.transition(page.hN, "all 0.3s ease-in-out");
							u.a.transition(this.topmenu, "all 0.35s ease-in-out");

							u.a.translate(page.hN, 0, 0);
							u.a.setHeight(this.topmenu, 0);

						}
					}
				}
			}


			// ready to start page builing process
			page.ready();

		//}
	}
}

u.e.addDOMReadyEvent(u.init);

