
window.onload = function() {
	
	var webappCache = window.applicationCache;

	if(navigator.onLine && webappCache) {
//		webappCache.update();
		webappCache.addEventListener("checking", checking, false);
		webappCache.addEventListener("noupdate", noupdate, false);
		webappCache.addEventListener("downloading", downloading, false);
		webappCache.addEventListener("progress", progress, false);
		webappCache.addEventListener("cached", cached, false);
		webappCache.addEventListener("updateready", updateready, false);
		webappCache.addEventListener("obsolete", obsolete, false);
		webappCache.addEventListener("error", error, false);

		var s = "";
		for(x in webappCache) {
			s += x+"="+webappCache[x]+"\n";
		}
		document.getElementById("manifest").innerHTML = "Online<br />";
		
//		alert("hello world");
	}
}

i = 0;

function checking(event) {
	document.getElementById("manifest").innerHTML += "Cache checking<br />";
//	alert("Cache checking");
}
function noupdate(event) {
	document.getElementById("manifest").innerHTML += "Cache noupdate<br />";
//	updateCache();
//	alert("Cache noupdate");
}
function downloading(event) {
	document.getElementById("manifest").innerHTML += "Cache downloading<br />";
//	alert("Cache downloading");
}
function progress(event) {
	i++;
	if(i <= event.target.OBSOLETE) {
		document.getElementById("manifest").innerHTML += "Cache progress:"+i+"/"+event.target.OBSOLETE+"<br />";
//		alert("Cache progress:"+i+"/"+event.target.OBSOLETE);
	}
//	else {
//		alert("Cached");
//	}

}
function cached(event) {
		document.getElementById("manifest").innerHTML += "Cached<br />";

//	alert("Cached");
}
function updateready(event) {
	document.getElementById("manifest").innerHTML += "Cache updateready<br />";
//	alert("Cache updateready");
var webappCache = window.applicationCache;
	webappCache.swapCache();
	document.getElementById("manifest").innerHTML += "Cache swapped<br />";
}
function obsolete(event) {
	document.getElementById("manifest").innerHTML += "Cache obsolete<br />";
//	alert("Cache obsolete");
}

function error(event) {
	var s = "";
	for(x in event.target) {
		s += x+"="+event.target[x]+"\n";
	}
	document.getElementById("manifest").innerHTML += "Cache error<br />";
//	alert("Cache error:");
}


function updateCache() {

	var webappCache = window.applicationCache;

//	alert("Cache update");
//	alert(webappCache);
	webappCache.update();
	webappCache.swapCache();
//	webappCache.swapCache();
	document.getElementById("manifest").innerHTML += "Cache update<br />";
}
//setTimeout(updateCache, 6000);


/*

var cacheStatusValues = [];
cacheStatusValues[0] = 'uncached';
cacheStatusValues[1] = 'idle';
cacheStatusValues[2] = 'checking';
cacheStatusValues[3] = 'downloading';
cacheStatusValues[4] = 'updateready';
cacheStatusValues[5] = 'obsolete';

var cache = window.applicationCache;
cache.addEventListener('cached', logEvent, false);
cache.addEventListener('checking', logEvent, false);
cache.addEventListener('downloading', logEvent, false);
cache.addEventListener('error', logEvent, false);
cache.addEventListener('noupdate', logEvent, false);
cache.addEventListener('obsolete', logEvent, false);
cache.addEventListener('progress', logEvent, false);
cache.addEventListener('updateready', logEvent, false);

function logEvent(e) {
    var online, status, type, message;
    online = (navigator.onLine) ? 'yes' : 'no';
    status = cacheStatusValues[cache.status];
    type = e.type;
    message = 'online: ' + online;
    message+= ', event: ' + type;
    message+= ', status: ' + status;
    if (type == 'error' && navigator.onLine) {
        message+= ' (prolly a syntax error in manifest)';
    }
    console.log(message);
}

window.applicationCache.addEventListener(
    'updateready',
    function(){
        window.applicationCache.swapCache();
        console.log('swap cache has been called');
    },
    false
);

setInterval(function(){cache.update()}, 10000);
*/