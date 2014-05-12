	</div>

	<div id="navigation">
		<ul>
			<? $HTML = new HTML() ?>
			<?= $HTML->link("Logs", "/admin/log/list", array("wrap" => "li", "wrap_class" => "log")) ?>
			<?= $HTML->link("Posts", "/admin/post/list", array("wrap" => "li", "wrap_class" => "post")) ?>

			<?= $HTML->link("Wishes", "/admin/wish/list", array("wrap" => "li", "wrap_class" => "wish")) ?>
			<?= $HTML->link("Wishlists", "/admin/wishlist/list", array("wrap" => "li", "wrap_class" => "wishlist")) ?>
			<?= $HTML->link("Todo", "/admin/todo/list", array("wrap" => "li", "wrap_class" => "todo")) ?>
			<?= $HTML->link("Todolist", "/admin/todolist/list", array("wrap" => "li", "wrap_class" => "todolist")) ?>
			<?= $HTML->link("user", "/admin/user/list", array("wrap" => "li", "wrap_class" => "user")) ?>
			<?= $HTML->link("Tags", "/admin/tag/list", array("wrap" => "li", "tags" => "tags")) ?>

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
			<li class="copyright">Janitor, JES, WhatTheFramework, Martin Kæstel Nielsen - Copyright 2013</li>
		</ul>
	</div>
</div>

</body>
</html>