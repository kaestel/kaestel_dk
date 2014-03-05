
var u, Util = u = new function() {}
Util.testURL = function(url) {
	return url.match(/http\:\/\/mkn\.|http\:\/\/w\.|\.local/i);
}
Util.debug = function(output) {
	if(Util.testURL(location.href)) {
		var element, br;
		if(Util.debugWindow && Util.debugWindow.document) {
			element = Util.debugWindow.document.createTextNode(output);
			br = Util.debugWindow.document.createElement('br');
			Util.debugWindow.document.body.appendChild(element);
			Util.debugWindow.document.body.appendChild(br);
			Util.debugWindow.scrollBy(0,1000);
		}
		else {
			Util.openDebugger();
			if(!Util.debugWindow) {
				alert("Disable popup blocker!");
			}
			else {
				Util.debug(output);
			}
		}
	}
}
Util.debugWindow = false;
Util.openDebugger = function() {
	Util.debugWindow = window.open("", "debugWindow", "width=600, height=400, scrollbars=yes, resizable=yes");
	Util.debugWindow.document.body.style.fontFamily = "Courier";
	var element = Util.debugWindow.document.createTextNode("--- new session ---");
	var br = Util.debugWindow.document.createElement('br');
	Util.debugWindow.document.body.appendChild(br);
	Util.debugWindow.document.body.appendChild(element);
	Util.debugWindow.document.body.appendChild(br.cloneNode(br));
	Util.debugWindow.document.body.appendChild(br.cloneNode(br));
}
Util.tracePointer = function(e) {
	if(Util.testURL(location.href)) {
		var position = document.createElement("div");
		document.body.appendChild(position);
		position.id = "debug_pointer";
		position.style.position = "absolute";
		position.style.backgroundColor = "#ffffff";
		position.style.color = "#000000";
		this.trackMouse = function(event) {
			u.ge("debug_pointer").innerHTML = event.pageX+"x"+event.pageY;
			u.ge("debug_pointer").style.left = 7+event.pageX+"px";
			u.ge("debug_pointer").style.top = 7+event.pageY+"px";
		}
		u.e.addEvent(e, "mousemove", this.trackMouse);
	}
}
Util.bug = function(target, message) {
	if(Util.testURL(location.href)) {
		var option, options = new Array(new Array(0, "auto", "auto", 0), new Array(0, 0, "auto", "auto"), new Array("auto", 0, 0, "auto"), new Array("auto", "auto", 0, 0));
		if(!message) {
			message = target;
			target = options[0];
		}
		if(!u.ge("debug_"+target)) {
			for(var i = 0; option = options[i]; i++) {
				if(!u.ge("debug_id_"+i)) {
					var d_target = document.createElement("div");
					document.body.appendChild(d_target);
					d_target.style.position = "absolute";
					d_target.style.zIndex = 100;
					d_target.style.top = option[0];
					d_target.style.right = option[1];
					d_target.style.bottom = option[2];
					d_target.style.left = option[3];
					d_target.style.backgroundColor = "#ffffff";
					d_target.style.color = "#000000";
					d_target.style.padding = "3px";
					d_target.id = "debug_id_"+i;
					d_target.className = "debug_"+target;
					break;
				}
			}
		}
		u.ge("debug_"+target).innerHTML += message+"<br>";
	}
}
Util.ge = function(id, target) {
	var e, i, regexp, t;
	t = target ? target : document;
	if(document.getElementById(id)) {
		return document.getElementById(id);
	}
	regexp = new RegExp("(^|\\s)" + id + "(\\s|$|\:)");
	for(i = 0; e = t.getElementsByTagName("*")[i]; i++) {
		if(regexp.test(e.className)) {
			return e;
		}
	}
	return t.getElementsByTagName(id).length ? t.getElementsByTagName(id)[0] : false;
}
Util.ges = function(id, target) {
	var e, i, regexp, t;
	var elements = new Array();
	t = target ? target : document;
	regexp = new RegExp("(^|\\s)" + id + "(\\s|$|\:)");
	for(i = 0; e = t.getElementsByTagName("*")[i]; i++) {
		if(regexp.test(e.className)) {
			elements.push(e);
		}
	}
	return elements.length ? elements : t.getElementsByTagName(id);
}
Util.gs = function(e, direction) {
	var node_type = e.nodeType;
	var ready = false;
	var prev_node = false
	for(var i = 0; node = e.parentNode.childNodes[i]; i++) {
		if(node.nodeType == node_type) {
			if(ready) {
				return node;
			}
			if(node == e) {
				if(direction == "next") {
					ready = true;
				}
				else {
					return prev_node;
				}
			}
			else {
				prev_node = node;
			}
		}
	}
	return false;
}
Util.ae = function(e, node_type, attributes) {
	var node = e.appendChild(document.createElement(node_type));
	if(attributes) {
		if(typeof(attributes) == "object") {
			for(attribute in attributes) {
				node.setAttribute(attribute, attributes[attribute]);
			}
		}
		else {
			u.addClass(node, attributes)
		}
	}
	node.e = e;
	return node;
}
Util.ie = function(e, node_type, attributes) {
	var node = e.insertBefore(document.createElement(node_type), e.firstChild);
	if(attributes) {
		if(typeof(attributes) == "object") {
			for(attribute in attributes) {
				node.setAttribute(attribute, attributes[attribute]);
			}
		}
		else {
			u.addClass(node, attributes)
		}
	}
	node.e = e;
	return node;
}
Util.getIJ = function(e, id) {
	var regexp = new RegExp(id + ":[?=\\w/\\#~:.?+=?&%@!\\-]*");
	if(e.className.match(regexp)) {
		return e.className.match(regexp)[0].replace(id + ":", "");
	}
	return false;
}
Util.addClass = function(e, classname) {
	if(classname) {
		var regexp = new RegExp("(^|\\s)" + classname + "(\\s|$|\:)");
		if(!regexp.test(e.className)) {
			e.className += e.className ? " " + classname : classname;
		}
	}
}
Util.removeClass = function(e, classname) {
	if(classname) {
		var regexp = new RegExp(classname + " | " + classname + "|" + classname);
		e.className = e.className.replace(regexp, "");
	}
}
Util.toggleClass = function(e, classname) {
	var regexp = new RegExp("(^|\\s)" + classname + "(\\s|$|\:)");
	if(regexp.test(e.className)) {
		Util.removeClass(e, classname);
	}
	else {
		Util.addClass(e, classname);
	}
}
Util.wrapElement = function(e, wrap) {
	wrap = e.parentNode.insertBefore(document.createElement(wrap), e);
	wrap.appendChild(e);
	return wrap;
}
Util.Events = u.e = new function() {
	this.event_pref = typeof(document.ontouchmove) == "undefined" ? "mouse" : "touch";
	this.kill = function(event) {
		if(event) {
			event.preventDefault();
			event.cancelBubble = true;
		}
	}
	this.addEvent = function(e, type, action) {
		try {
			e.addEventListener(type, action, false);			
		}
		catch(exception) {
			if(document.all) {
			}
			else {
				u.bug("exception:" + e + "," + type + ":" + exception);
			}
		}
	}
	this.removeEvent = function(e, type, action) {
		try {
			e.removeEventListener(type, action, false);
		}
		catch(exception) {
		}
	}
	this.onStart = this.onDown = function(e, action) {
		u.e.addEvent(e, this.event_pref == "touch" ? "touchstart" : "mousedown", action);
	}
	this.onMove = function(e, action) {
		u.e.addEvent(e, this.event_pref == "touch" ? "touchmove" : "mousemove", action);
	}
	this.onEnd = this.onUp = function(e, action) {
		u.e.addEvent(e, this.event_pref == "touch" ? "touchend" : "mouseup", action);
	}
	this.onTransitionEnd = function(e, action) {
		u.e.addEvent(e, "webkitTransitionEnd", action);
		u.e.addEvent(e, "transitionend", action);
	}
	this.onAnimationEnd = function(e, action) {
		u.e.addEvent(e, "webkitAnimationEnd", action);
		u.e.addEvent(e, "animationend", action);
	}
	this.transform = function(e, x, y) {
		if(typeof(e.style.MozTransition) != "undefined" || typeof(e.style.webkitTransition) != "undefined") {
			e.style.MozTransform = "translate("+x+"px, "+y+"px)";
			e.style.webkitTransform = "translate3d("+x+"px, "+y+"px, 0)";
			e.element_x = x;
			e.element_y = y;
		}
		else {
			e.style.position = "absolute";
			u.bug("duration:" + e.duration);
			if(!e.duration) {
				e.style.left = x+"px";
				e.style.top = y+"px";
				e.element_x = x;
				e.element_y = y;
			}
			else {
				e.transitions = 15;
				e.transition_progress = 0;
				e.element_x = e.element_x ? e.element_x : 0;
				e.element_y = e.element_y ? e.element_y : 0;
				e.transitionTo = function() {
						++this.transition_progress;
						this.style.left =  this.end_x-(this.distance_x - (this.interval_x*this.transition_progress))+"px";
						this.style.top =  this.end_y-this.distance_y - this.interval_y*this.transition_progress+"px";
						this.element_x = this.end_x-(this.distance_x - (this.interval_x*this.transition_progress));
						this.element_y = this.end_y-(this.distance_y - (this.interval_y*this.transition_progress));
				}
				e.end_x = x;
				e.end_y = y;
				if(e.end_x > e.element_x) {
					if(e.end_x > 0 && e.element_x >= 0 || e.end_x >= 0 && e.element_x < 0) {
						e.distance_x = e.end_x - e.element_x;
					}
					else {
						e.distance_x = e.element_x - e.end_x;
					}
				}
				else if(e.end_x < e.element_x) {
					if(e.end_x <= 0 && e.element_x > 0 || e.end_x < 0 && e.element_x <= 0) {
						e.distance_x = e.end_x - e.element_x;
					}
					else {
						e.distance_x = e.element_x - e.end_x;
					}
				}
				else {
					e.distance_x = 0;
				}
				if(e.end_y > e.element_y) {
					if(e.end_y > 0 && e.element_y >= 0 || e.end_y >= 0 && e.element_y < 0) {
						e.distance_y = e.end_y - e.element_y;
					}
					else {
						e.distance_y = e.element_y - e.end_y;
					}
				}
				else if(e.end_y < e.element_y) {
					if(e.end_y <= 0 && e.element_y > 0 || e.end_y < 0 && e.element_y <= 0) {
						e.distance_y = e.end_y - e.element_y;
					}
					else {
						e.distance_y = e.element_y - e.end_y;
					}
				}
				else {
					e.distance_y = 0;
				}
				e.interval_x = e.distance_x/e.transitions;
				e.interval_y = e.distance_y/e.transitions;
				for(var i = 0; i < e.transitions; i++) {
					u.t.setTimer(e, e.transitionTo, (e.duration/e.transitions)*i);
				}
				if(typeof(e.transitioned) == "function") {
					u.t.setTimer(e, e.transitioned, e.duration);
				}
			}
		}
	}
	this.transition = function(e, transition) {
		if(typeof(e.style.MozTransition) != "undefined" || typeof(e.style.webkitTransition) != "undefined") {
			e.style.MozTransition = transition;
			e.style.webkitTransition = transition;
			if(typeof(e.transitioned) == "function") {
				this.onTransitionEnd(e, e.transitioned);
			}
		}
		else {
			var duration = transition.match(/[0-9.]+[ms]/g) ? transition.match(/[0-9.]+[ms]/g).toString() : false;
			e.duration = duration ? (duration.match("ms") ? parseFloat(duration) : parseFloat(duration) * 1000) : false;
		}
	}
	this.overlap = function(element, target, strict) {
		if(target.constructor.toString().match("Array")) {
			var target_start_x = Number(target[0]);
			var target_start_y = Number(target[1]);
			var target_end_x = Number(target[2]);
			var target_end_y = Number(target[3]);
		}
		else {
			var target_start_x = target.element_x ? target.element_x : 0;
			var target_start_y = target.element_y ? target.element_y : 0;
			var target_end_x = Number(target_start_x + target.offsetWidth);
			var target_end_y = Number(target_start_y + target.offsetHeight);
		}
		var element_start_x = Number(element.element_x);
		var element_start_y = Number(element.element_y);
		var element_end_x = Number(element_start_x + element.offsetWidth);
		var element_end_y = Number(element_start_y + element.offsetHeight);
		if(strict && element_start_x >= target_start_x && element_start_y >= target_start_y && element_end_x <= target_end_x && element_end_y <= target_end_y) {
			return true;
		}
		else if(strict) {
			return false;
		}
		else if(element_end_x < target_start_x || element_start_x > target_end_x || element_end_y < target_start_y || element_start_y > target_end_y) {
			return false;
		}
		return true;
	}
	this.resetEvents = function(e) {
		u.t.resetTimer(e.t_held);
		u.t.resetTimer(e.t_clicked);
		this.removeEvent(e, "mouseup", this._dblclicked);
		this.removeEvent(e, "touchend", this._dblclicked);
		this.removeEvent(e, "mousemove", this._inputClickMove);
		this.removeEvent(e, "touchmove", this._inputClickMove);
		this.removeEvent(e, "mousemove", this._pick);
		this.removeEvent(e, "touchmove", this._pick);
		this.removeEvent(e, "mousemove", this._drag);
		this.removeEvent(e, "touchmove", this._drag);
		this.removeEvent(e, "mouseup", this._drop);
		this.removeEvent(e, "touchend", this._drop);
		this.removeEvent(e, "mouseout", this._snapback);
	}
	this._inputStart = function(event) {
		this.event_var = event;
		this.current_xps = 0;
		this.current_yps = 0;
		this.swiped = false;
		if(this.click || this.dblclick || this.hold) {
			u.e.onMove(this, u.e._inputClickMove);
			u.e.onEnd(this, u.e._dblclicked);
		}
		if(this.hold) {
			this.t_held = u.t.setTimer(this, u.e._held, 750);
		}
		if(this.drag || this.swipe) {
			u.e.onMove(this, u.e._pick);
			u.e.onEnd(this, u.e._drop);
		}
	}
	this._inputClickMove = function(event) {
		u.e.resetEvents(this);
		if(typeof(this.clickMoved) == "function") {
			this.clickMoved(event);
		}
	}
	this.hold = function(e) {
		e.hold = true;
		u.e.onStart(e, this._inputStart);
	}
	this._held = function(event) {
		u.e.resetEvents(this);
		if(typeof(this.held) == "function") {
			this.held(event);
		}
	}
	this.click = this.tap = function(e) {
		e.click = true;
		u.e.onStart(e, this._inputStart);
	}
	this._clicked = function(event) {
		u.e.resetEvents(this);
		if(typeof(this.clicked) == "function") {
			this.clicked(event);
		}
	}
	this.dblclick = this.doubletap = function(e) {
		e.dblclick = true;
		u.e.onStart(e, this._inputStart);
	}
	this._dblclicked = function(event) {
		if(u.t.valid(this.t_clicked) && event) {
			u.e.resetEvents(this);
			if(typeof(this.dblclicked) == "function") {
				this.dblclicked(event);
			}
			return;
		}
		else if(!this.dblclick) {
			this._clicked = u.e._clicked;
			this._clicked(event);
		}
		else if(!event) {
			this._clicked = u.e._clicked;
			this._clicked(this.event_var);
		}
		else {
			u.e.resetEvents(this);
			this.t_clicked = u.t.setTimer(this, u.e._dblclicked, 400);
		}
	}
	this.drag = function(e, target, strict, snapback, process_time) {
		e.drag = true;
		e.strict = strict ? true : false;
		e.allowed_offset = e.strict ? 0 : 250;
		e.elastica = 2;
		e.snapback = snapback ? true : false;
		e.process_time = process_time ? process_time : 0;
		e.mtm_avg = new Array();
		if(target.constructor.toString().match("Array")) {
			e.start_drag_x = Number(target[0]);
			e.start_drag_y = Number(target[1]);
			e.end_drag_x = Number(target[2]);
			e.end_drag_y = Number(target[3]);
		}
		else {
			e.start_drag_x = target.element_x ? target.element_x : 0;
			e.start_drag_y = target.element_y ? target.element_y : 0;
			e.end_drag_x = Number(e.start_drag_x + target.offsetWidth);
			e.end_drag_y = Number(e.start_drag_y + target.offsetHeight);
		}
		u.e.addEvent(e, "mousedown", this._inputStart);
		u.e.addEvent(e, "touchstart", this._inputStart);
	}
	this._pick = function(event) {
	    u.e.kill(event);
		this.move_timestamp = new Date().getTime();
		this.vertical = (this.end_drag_x - this.start_drag_x == this.offsetWidth);
		this.horisontal = (this.end_drag_y - this.start_drag_y == this.offsetHeight);
		this.offset_x = this.element_x = this.element_x ? this.element_x : 0;
		this.offset_y = this.element_y = this.element_y ? this.element_y : 0;
		this.current_xps = 0;
		this.current_yps = 0;
		this.start_input_x = event.targetTouches ? event.targetTouches[0].pageX : event.pageX;
		this.start_input_y = event.targetTouches ? event.targetTouches[0].pageY : event.pageY;
		u.e.transition(this, "none");
		if(typeof(this.picked) == "function") {
			this.picked(event);
		}
		u.e.resetEvents(this);
		u.e.onMove(this, u.e._drag);
		u.e.onEnd(this, u.e._drop);
		if(this.snapback && u.e.event_pref == "mouse") {
			u.e.addEvent(this, "mouseout", u.e._snapback);
		}
	}
	this._drag = function(event) {
		u.e.kill(event);
		if(this.start_input_x && this.start_input_y) {
			this.new_move_timestamp = new Date().getTime();
			if(this.new_move_timestamp - this.move_timestamp > this.process_time) {
				var offset = false;
				var speed_ex, speed_ey, speed_mtm;
				this.current_x = event.targetTouches ? event.targetTouches[0].pageX : event.pageX;
				this.current_y = event.targetTouches ? event.targetTouches[0].pageY : event.pageY;
				speed_ex = this.element_x;
				speed_ey = this.element_y;
				speed_mtm = this.new_move_timestamp - this.move_timestamp;
				this.mtm_avg[this.mtm_avg.length] = speed_mtm; 
				this.move_timestamp = this.new_move_timestamp;
				if(this.vertical) {
					this.element_y = this.current_y - this.start_input_y + this.offset_y;
				}
				else if(this.horisontal) {
					this.element_x = this.current_x - this.start_input_x + this.offset_x;
				}
				else {
					this.element_x = this.current_x - this.start_input_x + this.offset_x;
					this.element_y = this.current_y - this.start_input_y + this.offset_y;
				}
	 			if(!this.strict) {
					this.current_xps = Math.round(((this.element_x - speed_ex) / speed_mtm)*1000);
					this.current_yps = Math.round(((this.element_y - speed_ey) / speed_mtm)*1000);
				}
				if(u.e.overlap(this, new Array(this.start_drag_x, this.start_drag_y, this.end_drag_x, this.end_drag_y), true)) {
					if(this.current_xps && (Math.abs(this.current_xps) > Math.abs(this.current_yps) || this.horisontal)) {
						if(this.current_xps < 0) {
							this.swiped = "left";
						}
						else {
							this.swiped = "right";
						}
					}
					else if(this.current_yps && (Math.abs(this.current_xps) < Math.abs(this.current_yps) || this.vertical)) {
						if(this.current_yps < 0) {
							this.swiped = "up";
						}
						else {
							this.swiped = "down";
						}
					}
					u.e.transform(this, this.element_x, this.element_y);
				}
				else {
					this.swiped = false;
					this.current_xps = 0;
					this.current_yps = 0;
					if(this.element_x < this.start_drag_x) {
						offset = this.element_x < this.start_drag_x - this.allowed_offset ? - this.allowed_offset : this.element_x - this.start_drag_x;
						this.element_x = this.start_drag_x;
						this.current_x = this.element_x + offset + (Math.round(Math.pow(offset, 2)/this.allowed_offset)/this.elastica);
					}
					else if(this.element_x + this.offsetWidth > this.end_drag_x) {
						offset = this.element_x + this.offsetWidth > this.end_drag_x + this.allowed_offset ? this.allowed_offset : this.element_x + this.offsetWidth - this.end_drag_x;
						this.element_x = this.end_drag_x - this.offsetWidth;
						this.current_x = this.element_x + offset - (Math.round(Math.pow(offset, 2)/this.allowed_offset)/this.elastica);
					}
					else {
						this.current_x = this.element_x;
					}
					if(this.element_y < this.start_drag_y) {
						offset = this.element_y < this.start_drag_y - this.allowed_offset ? - this.allowed_offset : this.element_y - this.start_drag_y;
						this.element_y = this.start_drag_y;
						this.current_y = this.element_y + offset + (Math.round(Math.pow(offset, 2)/this.allowed_offset)/this.elastica);
					}
					else if(this.element_y + this.offsetHeight > this.end_drag_y) {
						offset = (this.element_y + this.offsetHeight > this.end_drag_y + this.allowed_offset) ? this.allowed_offset : (this.element_y + this.offsetHeight - this.end_drag_y);
						this.element_y = this.end_drag_y - this.offsetHeight;
						this.current_y = this.element_y + offset - (Math.round(Math.pow(offset, 2)/this.allowed_offset)/this.elastica);
					}
					else {
						this.current_y = this.element_y;
					}
					if(offset) {
						u.e.transform(this, this.current_x, this.current_y);
					}
				}
				if(typeof(this.moved) == "function") {
					this.moved(event);
				}
			}
		}
	}
	this._drop = function(event) {
	    u.e.kill(event);
		var sum = 0;
		for(var i = 0; i < this.mtm_avg.length; i++) {
			sum += this.mtm_avg[i];
		}
		u.e.resetEvents(this);
		if(this.swipe && this.swiped) {
			if(this.swiped == "left") {
				if(typeof(this.swipedLeft) == "function") {
					this.swipedLeft(event);
				}
			}
			else if(this.swiped == "right") {
				if(typeof(this.swipedRight) == "function") {
					this.swipedRight(event);
				}
			}
			else if(this.swiped == "down") {
				if(typeof(this.swipedDown) == "function") {
					this.swipedDown(event);
				}
			}
			else if(this.swiped == "up") {
				if(typeof(this.swipedUp) == "function") {
					this.swipedUp(event);
				}
			}
		}
		else if(this.start_input_x && this.start_input_y) {
			this.start_input_x = false;
			this.start_input_y = false;
			this.current_x = this.element_x + (this.current_xps/2);
			this.current_y = this.element_y + (this.current_yps/2);
			if(this.current_x < this.start_drag_x) {
				this.current_x = this.start_drag_x;
			}
			else if(this.current_x + this.offsetWidth > this.end_drag_x) {
				this.current_x = this.end_drag_x - this.offsetWidth;
			}
			if(this.current_y < this.start_drag_y) {
				this.current_y = this.start_drag_y;
			}
			else if(this.current_y + this.offsetHeight > this.end_drag_y) {
				this.current_y = this.end_drag_y - this.offsetHeight;
			}
			if(this.current_xps || this.current_yps) {
				u.e.transition(this, "all 1s cubic-bezier(0,0,0.25,1)");
				this.element_x = this.current_x;
				this.element_y = this.current_y;
			}
			else {
				u.e.transition(this, "all 0.1s cubic-bezier(0,0,0.25,1)");
			}
			u.e.transform(this, this.current_x, this.current_y);
			if(typeof(this.dropped) == "function") {
				this.dropped(event);
			}
		}
	}
	this.swipe = function(e, target, strict) {
		e.swipe = true;
		u.e.drag(e, target, strict);
	}
	this._swipe = function(event) {
	}
	this._snapback = function(event) {
	    u.e.kill(event);
		if(this.start_input_x && this.start_input_y) {
			input_x = event.targetTouches ? event.targetTouches[0].pageX : event.pageX;
			input_y = event.targetTouches ? event.targetTouches[0].pageY : event.pageY;
			offset_x = 0;
			offset_y = 0;
			if(this.vertical) {
				offset_y = input_y - this.current_y;
			}
			else if(this.horisontal) {
				offset_x = input_x - this.current_x;
			}
			else {
				offset_x = input_x - this.current_x;
				offset_y = input_y - this.current_y;
			}
			u.e.transform(this, (this.element_x+offset_x), (this.element_y+offset_y));
		}
	}
}
Util.Animation = u.a = new function() {
	this.translate = function(e, x, y) {
		e.style.MozTransform = "translate("+x+"px, "+y+"px)";
		e.style.webkitTransform = "translate3d("+x+"px, "+y+"px, 0)";
		e.element_x = x;
		e.element_y = y;
	}
	this.rotate = function(e, deg) {
		e.style.MozTransform = "rotate("+deg+"deg)";
		e.style.webkitTransform = "rotate("+deg+"deg)";
		e.rotation = deg;
	}
	this.scale = function(e, scale) {
		e.style.MozTransform = "scale("+scale+")";
		e.style.webkitTransform = "scale("+scale+")";
		e.scale = scale;
	}
	this.transition = function(e, transition) {
		e.style.MozTransition = transition;
		e.style.webkitTransition = transition;
	}
}
Util.Timer = u.t = new function() {
	this.actions = new Array();
	this.objects = new Array();
	this.timers = new Array();
	this.setTimer = function(object, action, timeout) {
		var id = this.actions.length;
		this.actions[id] = action;
		this.objects[id] = object;
		this.timers[id] = setTimeout("u.t.execute("+id+")", timeout);
		return id;
	}
	this.resetTimer = function(id) {
		clearTimeout(this.timers[id]);
		this.objects[id] = false;
	}
	this.execute = function(id) {
		this.objects[id].exe = this.actions[id];
		this.objects[id].exe();
		this.objects[id].exe = null;
		this.actions[id] = null;
		this.objects[id] = false;
		this.timers[id] = null;
	}
	this.valid = function(id) {
		return this.objects[id] ? true : false;
	}
}
Util.Image = u.i = new function() {
	this.load = function(e, src) {
		var image = new Image();
		image.e = e;
	    image.addEventListener('load', u.i._loaded ,false);
		image.src = src;
	}
	this._loaded = function(event) {
		if(typeof(this.e.loaded) == "function") {
			this.e.loaded(event);
		}
	}
	this._progress = function(event) {
		u.bug("progress")
		if(typeof(this.e.progress) == "function") {
			this.e.progress(event);
		}
	}
}
Util.getLocation = function(latitude_input, longitude_input) {
	window.latitude_input = latitude_input;
	window.longitude_input = longitude_input;
	this.foundLocation = function(position) {
	  var lat = position.coords.latitude;
	  var long = position.coords.longitude;
		Util.ge(window.latitude_input).value = lat;
		Util.ge(window.longitude_input).value = long;
	}
	this.noLocation = function() {
	  alert('Could not find location');
	}
	navigator.geolocation.getCurrentPosition(this.foundLocation, this.noLocation);
}
Util.saveCookie = function(name, value) {
	document.cookie = name + "=" + value +";"
}
Util.getCookie = function(name){
	var id, position, value, start, end;
	id = name + "=";
	position = document.cookie.indexOf(id);
	if(position != -1) {
		start = position + id.length;
		end = document.cookie.indexOf(';', start);
		end = end > 0 ? end : document.cookie.length;
		value = document.cookie.substring(start, end);
		return unescape(value);
	}
	return false;
}
Util.delCookie = function(name) {
	document.cookie = name + "=;expires=Thu, 01-Jan-70 00:00:01 GMT";
}
Util.saveCookie = function(name, value) {
	document.cookie = name + "=" + value +";"
}
Util.createRequestObject = function() {
	var request_object = false;
		try {
			request_object = new XMLHttpRequest();
		}
		catch(e){
			request_object = new ActiveXObject("Microsoft.XMLHTTP");
		}
	return typeof(request_object.send) == 'undefined' ? false : request_object;
}
Util.XMLRequest = function(url, node, parameters, async, method) {
	parameters = parameters ? parameters : "";
	async = async ? async : true;
	method = method ? method : "POST";
	var XMLRequest = new Object();
	XMLRequest.Http = this.createRequestObject();
	if(!XMLRequest.Http) {
		node.XMLResponse(u.validateResponse(false, false));
		return;
	}
	if(async) {
		XMLRequest.Http.node = node ? node : Util;
		XMLRequest.Http.onreadystatechange = function() {
			if(XMLRequest.Http.readyState == 4) {
				if(!this.node) {
					u.bug("Lost track of node: " + XMLRequest.Http.statusText);
				}
				else {
					this.node.XMLResponse(u.validateResponse(this, true));
				}
			}
		}
	}
	try {
		XMLRequest.Http.open(method, url, async);
		XMLRequest.Http.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		XMLRequest.Http.send(parameters);
	}
	catch(e) {
		node.XMLResponse(u.validateResponse(XMLRequest, false));
		return;
	}
	if(!async) {
		node.XMLResponse(u.validateResponse(XMLRequest, true));
	}
}
Util.XMLResponse = function(response) {
	alert("base responder")
}
Util.validateResponse = function(request, state){
	var e = document.createElement("div");
	if(state) {
		try {
			request.status;
			if(request.status == 200) {
				e.innerHTML = request.responseText;
			}
			else {
				e.innerHTML = '<div class="error">Response error:'+request.status+ ':'+request.url + request.parameters +'</div>';
				u.bug("status NOT 200:" + request.status);
				u.bug(request.statusText);
			}
		}
		catch(e) {
			e.innerHTML = '<div class="error">Response error: no status</div>';
			u.bug("NO status exceptions:" + e);
			u.bug(request.statusText);
		}
	}
	else {
		e.innerHTML = '<div class="error">Request error:'+request.url + request.parameters + '</div>';
		u.bug("Request error:" + request.url + request.parameters);
	}
	return e;
}
Util.Objects = u.o = new Array();
Util.init = function() {
	var i, e, elements, ij_value;
	elements = u.ges("i\:([_a-zA-Z0-9])+");
	for(i = 0; e = elements[i]; i++) {
		while((ij_value = u.getIJ(e, "i"))) {
			u.removeClass(e, "i:"+ij_value);
			if(ij_value && typeof(u.Objects[ij_value]) == "object") {
				u.Objects[ij_value].init(e);
			}
		}
	}
}
window.onload = u.init;
Util.Objects["inputlabel"] = new function() {
	this.init = function(input) {
		input.defaultValue = input.value;
		input.onfocus = function() {
			u.removeClass(this, "default");
			if(this.value == this.defaultValue) {
				this.value = "";
			}
		}
		input.onblur = function() {
			if(this.value == "") {
				u.addClass(this, "default");
				this.value = this.defaultValue;
			}
		}
		u.addClass(input, "default");
	}
}
Util.date = function(format, timestamp) {
	var date = isNaN(timestamp) ? new Date() : new Date(timestamp);
	var tokens = /d|j|m|n|Y|G|H|i|s/g;
	var chars = new Object();
	chars.j = date.getDate();
	chars.d = (chars.j > 9 ? "" : "0") + chars.j;
	chars.n = date.getMonth()+1;
	chars.m = (chars.n > 9 ? "" : "0") + chars.n;
	chars.Y = date.getFullYear();
	chars.G = date.getHours();
	chars.H = (chars.G > 9 ? "" : "0") + chars.G;
	var i = date.getMinutes();
	chars.i = (i > 9 ? "" : "0") + i;
	var s = date.getSeconds();
	chars.s = (s > 9 ? "" : "0") + s;
	return format.replace(tokens, function (_) {
		return _ in chars ? chars[_] : _.slice(1, _.length - 1);
	});
};
Util.Objects["focus"] = new function() {
	this.init = function(input) {
		input.focus();
	}
}

document.write('<script type="text/javascript" src="/app/js/lib/i-app.js"></script>');
