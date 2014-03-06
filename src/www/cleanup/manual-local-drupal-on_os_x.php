<?php $body_class = "blog" ?>
<?php $page_description = "Local iPad testing with Squid Proxy Server" ?>
<?php $page_title = "Local iPad testing with Squid Proxy Server @ Hvadhedderde" ?>
<?php include_once($_SERVER["LOCAL_PATH"]."/templates/shell.header.php") ?>

<div class="scene i:scene">

	<div class="blog">
		<h1>Install local Drupal on OS X</h1>
		<p>
			This is a guide to setup and configure a local Drupal installation. 
			We will create the Drupal installation in ~/Sites/drupal.
		</p>


		<h2>Install Drupal</h2>
		<p>In terminal, type:</p>
		<code>$ cd ~/Sites</code>

		<p>Download Drupal - update version number to match your requirement.</p>
		<code>$ curl -O http://ftp.drupal.org/files/projects/drupal-7.22.tar.gz</code>

		<p>Extract code</p>
		<code>$ tar -xvzf drupal-7.22.tar.gz</code>
		
		<p>Rename folder</p>
		<code>$ mv drupal-7.22 drupal</code>
		
		<p>Create settings file</p>
		<code>$ cp ~/Sites/drupal/sites/default/default.settings.php ~/Sites/drupal/sites/default/settings.php</code>

		<p>Fix permissions</p>
		<code>$ chmod -R a+w ~/Sites/drupal/sites/default</code>


		<p>Create drupal DB</p>
		<code>$ mysql5 -u __USERNAME__ -p__PASSWORD__ -e "create database [databasename];"</code>
		
		<p>Finish installation by navigating to http://localhost/drupal</p>
		<p>When setting up database use 127.0.0.1 instead of localhost</p>
		
	</div>

</div>

<?php include_once($_SERVER["LOCAL_PATH"]."/templates/shell.footer.php") ?>