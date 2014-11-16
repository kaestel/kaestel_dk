	</div>

	<div id="navigation">
		<ul>
			<?= $HTML->link("Logs", "/janitor/log/list", array("wrapper" => "li.log")) ?>

			<?= $HTML->link("Wishes", "/janitor/wish/list", array("wrapper" => "li.wish")) ?>
			<?= $HTML->link("Wishlists", "/janitor/wishlist/list", array("wrapper" => "li.wishlist")) ?>

			<?= $HTML->link("Todo", "/janitor/admin/todo/list", array("wrapper" => "li.todo")) ?>
			<?= $HTML->link("Todolist", "/janitor/admin/todolist/list", array("wrapper" => "li.todolist")) ?>

			<?= $HTML->link("Posts", "/janitor/admin/post/list", array("wrapper" => "li.post")) ?>
			<?= $HTML->link("Pages", "/janitor/admin/page/list", array("wrapper" => "li.page")) ?>
			<?= $HTML->link("Navigations", "/janitor/admin/navigation/list", array("wrapper" => "li.navigation")) ?>

			<?= $HTML->link("Tags", "/janitor/admin/tag/list", array("wrapper" => "li.tags")) ?>
			<?= $HTML->link("Users", "/janitor/admin/user/list", array("wrapper" => "li.user")) ?>
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