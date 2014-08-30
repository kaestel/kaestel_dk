	</div>

	<div id="navigation">
		<ul>
			<?= $HTML->link("Logs", "/admin/log/list", array("wrapper" => "li.log")) ?>
			<?= $HTML->link("Posts", "/admin/post/list", array("wrapper" => "li.post")) ?>

			<?= $HTML->link("Wishes", "/admin/wish/list", array("wrapper" => "li.wish")) ?>
			<?= $HTML->link("Wishlists", "/admin/wishlist/list", array("wrapper" => "li.wishlist")) ?>
			<?= $HTML->link("Todo", "/admin/todo/list", array("wrapper" => "li.todo")) ?>
			<?= $HTML->link("Todolist", "/admin/todolist/list", array("wrapper" => "li.todolist")) ?>

			<?= $HTML->link("Pages", "/admin/page/list", array("wrapper" => "li.page")) ?>
			<?= $HTML->link("Navigations", "/admin/navigation/list", array("wrapper" => "li.navigation")) ?>

			<?= $HTML->link("Tags", "/admin/tag/list", array("wrapper" => "li.tags")) ?>
			<?= $HTML->link("Users", "/admin/user/list", array("wrapper" => "li.user")) ?>
		</ul>
	</div>

	<div id="footer">
		<ul class="servicenavigation">
			<li class="copyright">Janitor, Manipulator, Modulator - parentNode - Copyright 2014</li>
		</ul>
	</div>
</div>

</body>
</html>