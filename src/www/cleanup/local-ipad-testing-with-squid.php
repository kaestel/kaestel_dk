<?php $body_class = "blog" ?>
<?php $page_description = "Local iPad testing with Squid Proxy Server" ?>
<?php $page_title = "Local iPad testing with Squid Proxy Server @ Hvadhedderde" ?>
<?php include_once($_SERVER["LOCAL_PATH"]."/templates/shell.header.php") ?>

<div class="scene i:scene">

	<div class="blog">
		<h1>Test local files on iOS devices using Squid Proxy Server on OS X</h1>
		<p>
			This is a guide to install and configure a proxy server to 
			test local websites, even using your local hosts file.
		</p>
		<p>
			I have a local development environment with many websites 
			running on my local webserver. I use Apache with VirtualHost, and 
			map my local domain names to localhost (127.0.0.1) in my /etc/hosts
			file. This solution makes those domains available for all your test
			devices, even if working on multiple different networks.
		<p>
			This guide does not consider security whatsoever. Read the details 
			of squid.conf to setup your own security.
		</p>
		<p>
			I'm going to use Macports to install Squid, a free proxy server. If 
			you do not have <a href="http://www.macports.org">Macports</a> installed, 
			go check it out.
		</p>
		<p>
			I'm also going to use Textmate as my text-editor. If 
			you don't know of <a href="http://www.macromates.com">Textmate</a>, 
			go check it out, otherwise replace <em>mate</em> in the following with your
			choice of editor. I suggest vi or nano.
		</p>


		<h2>Install Squid</h2>
		<p>In terminal, type:</p>
		<code>$ sudo port install squid</code>
		<p>Add permissions to cache storage</p>
		<code>$ sudo chmod -R 777 /opt/local/var/squid</code>

		<h2>Update Squid configuration</h2>
		
		<p>Open configuration file:</p>
		<code>$ mate /opt/local/etc/squid/squid.conf</code>
		
		<p>Add to configuration file (allow access to everyone - or change to your required IP-scope):</p>
		<code>acl localnet src 0.0.0.0/0.0.0.0
hosts_file /etc/hosts</code>

		<h2>Create swap folders</h2>
		<p>Run Squid first time with -z to create swap folders</p>
		<code>$ squid -z</code>


		<h2>Setting up local domains via hosts</h2>
		<p>
			To map your local domains create an entry in /etc/hosts which points to your own computers IP, like: 
		</p>
		<code>192.168.0.250	hvadhedderde.proxy</code>
		<p>
			Unfortunately you might need to update this whenever running the proxy server on a new network.<br />
			Note: domain cannot use .local, which is reserved on iOS devices.
		</p>


		<h2>Configure proxy on iPad</h2>
		<p>
			Go to Settings on your iOS device. Choose WiFi, and click the arrow on your network 
			to edit network configuration. Set HTTP Proxy to manual and enter IP-address and port number.
		</p>
		<p>
			IP: The IP of the computer running squid<br />
			Port: 3128
		</p>


		<h2>Run Squid</h2>
		<p>
			Start Squid in no daemon mode. This means it runs until you exit with ctrl-c.
		</p>
		<code>$ squid -N</code>

		<p>Start Squid, do your testing and quit the process.</p>

	</div>

</div>

<?php include_once($_SERVER["LOCAL_PATH"]."/templates/shell.footer.php") ?>