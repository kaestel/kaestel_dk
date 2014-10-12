<div class="scene front i:generic">
	<h1>iOS webdevelopment with Squid</h1>
	<h2>Testing local websites on iOS devices using Squid proxy server on OS X</h2>
	<p>
		This is a guide to install and configure your own 
		<a href="http://www.squid-cache.org/" target="_blank">Squid proxy server</a>,
		for testing and debugging websites, using your local hosts
		file to route the requests.
	</p>
	<p>
		I have a local development environment configured with many VirtualHosts 
		running on my local Apache webserver. I map local domain names to localhost (127.0.0.1) 
		in <span class="file">/etc/hosts</span>. 
		Using the Squid proxy I now make those local domains available for all my test
		devices.
	</p>
	<p>
		I'm going to use Macports to install Squid, a free proxy server. If 
		you do not have <a href="http://www.macports.org" target="_blank">Macports</a> installed, 
		go check it out.
	</p>
	<p>
		I'm using Textmate as my text-editor. If 
		you don't know of <a href="http://www.macromates.com" target="_blank">Textmate</a>, 
		go check it out, otherwise replace <em>mate</em> in the following with your
		choice of editor. I suggest vi or nano.
	</p>
	<p class="note">
		This guide does not consider security whatsoever. Read the details 
		of squid.conf to setup your own security.
	</p>

	<h2>Install Squid</h2>

	<p>In terminal, type:</p>
	<code>$ sudo port install squid</code>

	<p>Add permissions to cache storage</p>
	<code>$ sudo chmod -R 777 /opt/local/var/squid</code>

	<h2>Setup and configuration</h2>
	<h3>Update Squid configuration</h3>
	
	<p>Open configuration file:</p>
	<code>$ mate /opt/local/etc/squid/squid.conf</code>
	
	<p>In the configuration file locate and uncomment this line:</p>
	<code>hosts_file /etc/hosts</code>

	<h3>Create swap folders</h3>
	<p>Run Squid first time with -z to create swap folders</p>
	<code>$ squid -z</code>


	<h3>Setting up local domains via hosts</h3>
	<p>
		To make your local domains available on your test devices update entries in <span class="file">/etc/hosts</span>
		pointing them to your own computers IP, like: 
	</p>
	<code>192.168.0.250	kaestel.proxy</code>

	<p>
		Unfortunately you might need to update this whenever running the proxy server on a new network, or
		if your IP changes. I use a dual configuration, with one entry for testing on my local machine and
		another entry for proxy based testing.
	</p>
	<p class="note">
		Note: You cannot access .local domains on iOS devices.
	</p>

	<h3>Configure proxy on iPad/iPhone</h3>
	<p>
		Go to Settings on your iOS device. Go to WiFi, click <span class="icon ios_settings_info">i</span>
		to edit network configuration. In the bottom of the settings pane, set HTTP Proxy to manual and enter 
		IP-address and port number.
	</p>
	<dl>
		<dt>IP</dt>
		<dd>The local IP of the computer running Squid</dd>
		<dt>Port</dt>
		<dd>3128</dd>
	</dl>

	<h2>Run Squid</h2>
	<p>
		Start Squid in no daemon mode. This means it runs until you quit using <span class="command">ctrl-c</span>.
	</p>
	<code>$ squid -N</code>

	<p>Start Squid, do your testing and quit the process when you are done. Thank me later :)</p>

	<h2>Requirements</h2>
	<ul class="requirements">
		<li>OS X</li>
		<li>Terminal</li>
		<li>MacPorts</li>
	</ul>
	<p><span class="type">type</span> <span class="var">var</span> <span class="file">file</span> <span class="value">value</span> <span class="htmltag">tag</span> <span class="command">command</span></p>


</div>
