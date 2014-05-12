<div class="scene front i:generic">

	<div class="article i:article">
		<h1>iOS wyebde gvelo</h1>
		<p>
			I have a local development environment configured with many VirtualHosts 
			running on my local Apache webserver. I map local domain names to localhost (127.0.0.1) 
			in <span class="file">/etc/hosts</span>. 
			Using the Squid proxy I now make those local domains available for all my test
			devices.
		</p>

		<h1>iOS wyebde gvelo pment with Squid ahkyashfr lkjuyt</h1>
		<h2>Testing local websites on iOS devices using Squid proxy server on OS X</h2>
		<p>
			I have a local development environment configured with many VirtualHosts 
			running on my local Apache webserver. I map local domain names to localhost (127.0.0.1) 
			in <span class="file">/etc/hosts</span>. 
			Using the Squid proxy I now make those local domains available for all my test
			devices.
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

		<p>Add permissions to cache storage</p>
		<code>$ sudo chmod -R 777 /opt/local/var/squid</code>

		<h2>Setup and configuration</h2>
		<h3>Update Squid configuration</h3>
		<p>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod 
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo 
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse 
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat 
			non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
		</p>
	
		<p>Open configuration file:</p>
		<code>$ mate /opt/local/etc/squid/squid.conf</code>

		<div class="image image_id:80 format:png"><a href="/images/0/missing/500x.png">Missing image</a></div>

		<h3>Create swap folders</h3>
		<p>Run Squid first time with -z to create swap folders</p>
		<code>$ squid -z</code>

		<p>
			Unfortunately you might need to update this whenever running the proxy server on a new network, or
			if your IP changes. I use a dual configuration, with one entry for testing on my local machine and
			another entry for proxy based testing.
		</p>
		<ul class="requirements">
			<li>OS X</li>
			<li>Terminal</li>
			<li>MacPorts</li>
		</ul>
		<p class="note">
			Note: You cannot access .local domains on iOS devices.
		</p>

		<h3>Configure proxy on iPad/iPhone</h3>
		<div class="image image_id:79 format:jpg"><a href="/images/0/missing/500x.png">Missing image</a></div>
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
		<div class="image image_id:78 format:jpg"><a href="/images/0/missing/500x.png">Missing image</a></div>
		<p>
			Start Squid in no daemon mode. This means it runs until you quit using <span class="command">ctrl-c</span>.
		</p>
		<h3>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod 
			tempor incididunt ut labore et dolore magna aliqua.
		</h3>
		<p>Start Squid, do your testing and quit the process when you are done. Thank me later :)</p>

		<h3>Lorem ipsum dolor sit amet, consectetur adipisicing</h3>
		<h4>Nostrud exercitation ullamco laboris nisi ut aliquip</h4>
		<p>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod 
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo 
		</p>
		<h4>Ullamco laboris nisi ut aliquip ex ea commodo </h4>
		<p>
			Ut enim ad minim veniam, 
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo 
			lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod 
			tempor incididunt ut labore et dolore magna aliqua.
		</p>
		<h5>Ullamco laboris nisi ut aliquip ex ea commodo </h5>
		<p>
			Ut enim ad minim veniam, 
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo 
			lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod 
			tempor incididunt ut labore et dolore magna aliqua.
		</p>
		<h6>Ullamco laboris nisi ut aliquip ex ea commodo </h6>
		<p>
			Ut enim ad minim veniam, 
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo 
			lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod 
			tempor incididunt ut labore et dolore magna aliqua.
		</p>

		<div class="image image_id:0 format:png variant:missing"><a href="/images/0/missing/500x.png">Missing image</a></div>

		<h2>Requirements</h2>
		<ul class="requirements">
			<li>OS X</li>
			<li>Terminal</li>
			<li>MacPorts</li>
		</ul>

		<dl class="definition">
			<dt class="name">Name</dt>
			<dd class="name">Util.date</dd>
			<dt class="shorthand">Shorthand</dt>
			<dd class="shorthand">u.date</dd>
			<dt class="syntax">Syntax</dt>
			<dd class="syntax">
				<span class="type">String</span> = Util.date(
				<span class="type">String</span> <span class="var">format</span> 
				[, <span class="type">Mixed</span> <span class="var">timestamp</span> 
				[, <span class="type">Array</span> <span class="var">months</span>]
				]);
			</dd>
		</dl>

		<p>
			Ut enim ad minim veniam, 
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo 
			lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod 
			tempor incididunt ut labore et dolore magna aliqua.
		</p>

		<dl class="parameters">
			<dt><span class="var">format</span></dt>
			<dd>
				<div class="summary">
					<span class="type">String</span> date/time format
				</div>
				<div class="details">

					<h5>Options</h5>
					<dl class="options">
						<dt><span class="value">d</span></dt>
						<dd>Day of the month, 2 digits with leading zeros: 01 to 31</dd>

						<dt><span class="value">j</span></dt>
						<dd>Day of the month without leading zeros: 1 to 31</dd>

						<dt><span class="value">m</span></dt>
						<dd>Numeric representation of a month, with leading zeros: 01 through 12</dd>

						<dt><span class="value">n</span></dt>
						<dd>Numeric representation of a month, without leading zeros: 1 through 12</dd>

						<dt><span class="value">F</span></dt>
						<dd>Full month string, given as array</dd>

						<dt><span class="value">Y</span></dt>
						<dd>Full numeric representation of a year, 4 digits</dd>

						<dt><span class="value">G</span></dt>
						<dd>24-hour format of an hour without leading zeros: 0 through 23</dd>

						<dt><span class="value">H</span></dt>
						<dd>24-hour format of an hour with leading zeros 00 through 23</dd>

						<dt><span class="value">i</span></dt>
						<dd>Minutes with leading zeros 00 to 59</dd>

						<dt><span class="value">s</span></dt>
						<dd>Seconds, with leading zeros	00 through 59</dd>
					</dl>
				</div>
			</dd>

			<dt><span class="var">timestamp</span></dt>
			<dd>
				<div class="summary">
					<span class="type">String/Number</span> Optional, unix timestamp in milliseconds since 1970 or valid Date-string. If <span class="var">timestamp</span> is omitted, current time is used.
				</div>
			</dd>
			<dt><span class="var">months</span></dt>
			<dd>
				<div class="summary">
					<span class="type">Array</span> Optional, Array with months. If <span class="var">months</span> is omitted, the &quot;F&quot;-character cannot be used.
				</div>
			</dd>
		</dl>

		<p><span class="type">type</span> <span class="var">var</span> <span class="file">file</span> <span class="value">value</span> <span class="htmltag">tag</span> <span class="command">command</span></p>

		<?php
			$model = new Model();
		?>

	</div>

	<form action="" method="" class="i:standardForm labelstyle:inject">

		<h3>Form elements</h3>
		<p>Some description to what the form does.</p>
		<fieldset>
			<?= $model->input("string", array("type" => "string", "label" => "String", "hint_message" => "hint message", "error_message" => "error message")) ?>
			<?= $model->input("string_required", array("type" => "string", "label" => "String required", "required" => true, "hint_message" => "hint message", "error_message" => "error message")) ?>

			<?= $model->input("text", array("type" => "text", "label" => "Test", "hint_message" => "hint message", "error_message" => "error message")) ?>
			<?= $model->input("text_required", array("type" => "text", "label" => "Test required", "required" => true, "hint_message" => "hint message", "error_message" => "error message")) ?>
		</fieldset>

		<ul class="actions">
			<li class="save"><input type="submit" value="Submit" class="button primary" /></li>
			<li class="cancel"><a href="#" class="button">Cancel</a></li>
		</ul>

		<fieldset>
			<?= $model->input("select", array("type" => "select", "label" => "Select", "options" => array(0 => "test"), "hint_message" => "hint message", "error_message" => "error message")) ?>
			<?= $model->input("select_required", array("type" => "select", "label" => "Select required", "options" => array(0 => "test"), "required" => true, "hint_message" => "hint message", "error_message" => "error message")) ?>

			<?= $model->input("checkbox", array("type" => "checkbox", "label" => "Checkbox", "hint_message" => "hint message", "error_message" => "error message")) ?>
			<?= $model->input("checkbox_required", array("type" => "checkbox", "label" => "Checkbox required", "required" => true, "hint_message" => "hint message", "error_message" => "error message")) ?>
		</fieldset>

		<ul class="actions">
			<li class="save"><input type="submit" value="Submit" class="button primary" /></li>
			<li class="cancel"><a href="#" class="button">Cancel</a></li>
		</ul>

		<fieldset>
			<h3>TODO: radiobuttons
			<?//= $model->input("radio_buttons", array("type" => "checkbox", "label" => "Checkbox", "hint_message" => "hint message", "error_message" => "error message")) ?>
			<?//= $model->input("radio_buttons", array("type" => "checkbox", "label" => "Checkbox required", "required" => true, "hint_message" => "hint message", "error_message" => "error message")) ?>
		</fieldset>

		<ul class="actions">
			<li class="save"><input type="submit" value="Submit" class="button primary" /></li>
			<li class="cancel"><a href="#" class="button">Cancel</a></li>
		</ul>

	</form>

</div>
