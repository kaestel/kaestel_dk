	</div>

	<div id="navigation">
		<ul>
			<? $HTML = new HTML() ?>
			<?= $HTML->link("Logs", "/admin/log/list", array("wrapper" => "li.log")) ?>
			<?= $HTML->link("Posts", "/admin/post/list", array("wrapper" => "li.post")) ?>

			<?= $HTML->link("Wishes", "/admin/wish/list", array("wrapper" => "li.wish")) ?>
			<?= $HTML->link("Wishlists", "/admin/wishlist/list", array("wrapper" => "li.wishlist")) ?>
			<?= $HTML->link("Todo", "/admin/todo/list", array("wrapper" => "li.todo")) ?>
			<?= $HTML->link("Todolist", "/admin/todolist/list", array("wrapper" => "li.todolist")) ?>

			<?= $HTML->link("user", "/admin/user/list", array("wrapper" => "li.user")) ?>
			<?= $HTML->link("Tags", "/admin/tag/list", array("wrapper" => "li.tags")) ?>

			<!--li class="log"><a href="/admin/log/list">Logs</a></li>
			<li class="wish"><a href="/admin/wish/list">Wishes</a></li>
			<li class="wishlist"><a href="/admin/wishlist/list">Wishlists</a></li>
			<li class="todo"><a href="/admin/todo/list">Todo</a></li>
			<li class="todolist"><a href="/admin/todolist/list">Todolist</a></li>
			<li class="user"><a href="/admin/user/list">Users</a></li>
			<li class="tags"><a href="/admin/tag/list">Tags</a></li-->
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