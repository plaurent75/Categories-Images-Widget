# Categories-Images-Widget
Categories Images Widget

Simple Widget for the plugin Categories Images :
https://wordpress.org/plugins/categories-images/

Display a categories list in sidebar with image associated.
Use bootstrap to render it

# Usage

Copy/include the code in your functions.php file and Register the widget from your functions.php

// Register and load the widget

function pat_load_widget() {
	register_widget('CatImage');
}

add_action( 'widgets_init', 'pat_load_widget' );
