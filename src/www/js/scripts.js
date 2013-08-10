var Util = new function() {

	// Util objects container
	this.Objects = new Array();

}

// Compiles mailto link based on name and domain
Util.otliam = function(name, dom){
	document.write('<a onclick="Util.otliamNoise(\''+name+'\', \''+dom+'\')" class="otliam">'+name+'<span>@</span>'+dom+'</a>');
}
Util.otliamNoise = function(name, dom){
	location.href = "ma"+"ilto:"+name+"@"+dom;
}