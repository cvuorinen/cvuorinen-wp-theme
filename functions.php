<?php

// In child themes the functions.php is applied before the parent
// theme's functions.php. So we need to wait for the parent theme to add
// it's filter before we can remove it.
add_action( 'after_setup_theme', 'my_child_theme_setup' );
function my_child_theme_setup() {
  // Removes the filter that adds the "singular" class to the body element
  // which centers the content and does not allow for a sidebar
  remove_filter( 'body_class', 'twentyeleven_body_classes' );
}
