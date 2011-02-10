<?php
/**
 * User hover menu
 *
 * Register for the 'register', 'menu:user_hover' plugin hook to add to the user
 * hover menu. There are three sections: action, default, and admin.
 *
 * @uses $vars['menu']      Menu array provided by elgg_view_menu()
 */

$user = $vars['entity'];
$actions = elgg_get_array_value('action', $vars['menu'], null);
$main = elgg_get_array_value('default', $vars['menu'], null);
$admin = elgg_get_array_value('admin', $vars['menu'], null);

echo '<ul class="elgg-menu elgg-menu-hover">';

// name and username
$name_link = elgg_view('output/url', array(
	'href' => $user->getURL(),
	'text' => "<span class=\"elgg-heading-basic\">$user->name</span>&#64;$user->username",
));
echo "<li>$name_link</li>";

// actions
if (elgg_is_logged_in() && $actions) {
	echo '<li><ul>';
	foreach ($actions as $menu_item) {
		echo elgg_view('navigation/menu/elements/item', array('item' => $menu_item));
	}
	echo '</ul></li>';
}

// main
if ($main) {
	echo '<li><ul>';
	foreach ($main as $menu_item) {
		echo elgg_view('navigation/menu/elements/item', array('item' => $menu_item));
	}
	echo '</ul></li>';
}

// admin
if (elgg_is_admin_logged_in() && $admin) {
	echo '<li><ul class="elgg-hover-admin">';
	foreach ($admin as $menu_item) {
		echo elgg_view('navigation/menu/elements/item', array('item' => $menu_item));
	}
	echo '</ul></li>';
}

echo '</ul>';