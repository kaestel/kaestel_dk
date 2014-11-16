			<h2>Perception is not reality</h2>
			<h2>Perception != Reality</h2>
			<p>... a new one will arrive soon. Let me know when it is here.</p>

			<? if(isset($reciept)) { ?>
				<h2><?=$reciept ?></h2>
			<? }
			else { ?>
			<form action="/" method="post" name="letmeknow">
				<fieldset>
					<label for="email">Email<?= isset($error) ? '<span class="error">'.$error.'</span>' : '' ?></label>
					<input type="text" id="email" name="email" value="<?= $email ?>" />
					<button class="init:button fright" type="submit"><span><span>Save me</span></span></button>
				</fieldset>
			</form>
			<? } ?>
