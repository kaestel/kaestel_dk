<?php $body_class = "blog" ?>
<?php $page_description = "" ?>
<?php $page_title = "" ?>
<?php include_once($_SERVER["LOCAL_PATH"]."/templates/shell.header.php") ?>

<div class="scene i:scene">

	<div class="blog">
		<h1>Generate new ssh-key</h1>

		<p>This guide only installs Drupal.</p>

		<h2>Check for existing .ssh folder and key</h2>
		<p>In terminal, type:</p>

		<code>$ cd ~/.ssh</code>
		<p>If this fails, create and enter .ssh folder by typing the following in terminal.</p>
		
		<code>$ mkdir ~/.ssh
$ cd ~/.ssh</code>

		

		<p>Check content of .ssh folder</p>
		<code>ls -Fla</code>

		<p>If you already have a id_rsa and id_rsa.pub file listed, you should <em>not</em> create a new key.</p>


		<p>If you do not have id_rsa and id_rsa.pub, create a new key:</p>
		<code>$ ssh-keygen -t rsa -C "__EMAIL__"</code>
		
		<p>Follow the instructions to finish the process.</p>

	</div>

</div>

<?php include_once($_SERVER["LOCAL_PATH"]."/templates/shell.footer.php") ?>