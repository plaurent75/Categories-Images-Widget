<?php
class CatImage extends WP_Widget
{
	function CatImage(){
		$widget_ops = array( 'description' =>'Catégories With Image' );
		$control_ops = array( 'width' => 400, 'height' => 300 );
		 parent::__construct(false, 'PAT Image Catégorie', $widget_ops, $control_ops);
	}

	/* Displays the Widget in the front-end */
	function widget( $args, $instance ){
		extract($args);
		$title = empty( $instance['title'] ) ? '' :  $instance['title']  ;
		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title; ?>
		<ul class="media-list">
			<?php
			$args=array('hierarchical'=>false,'pad_counts'=>true,'parent' => 0,'orderby'=>'count','order'=>'DESC');
			$topCat=get_categories( $args );
			foreach ( $topCat as $category ) {
				$attrImg = array('class' => 'pull-left','alt' => 'Logo '.$category->name,'height' => 40,'width' => 40,'title' => $category->name );
				echo '<li class="media"><div class="media-left"><a title="' . $category->name . '" class="media-heading" href="' . get_category_link( $category->term_id ) . '">';
				z_taxonomy_image($category->term_id, array(40,40,true),$attrImg);
				echo '</a></div><div class="media-body media-middle">';
				echo '<a title="' . $category->name . '" class="media-heading" href="' . get_category_link( $category->term_id ) . '">' . $category->name . ' <span class="badge">' . $category->count . '</span></a>';
				echo '</div></li>';
			}
		 ?>
		</ul>

	<?php
		echo $after_widget;
	}

	/*Saves the settings. */
	function update( $new_instance, $old_instance ){
		$instance = $old_instance;
		$instance['title'] = current_user_can('unfiltered_html') ? $new_instance['title'] : stripslashes( wp_filter_post_kses( addslashes($new_instance['title']) ) );

		return $instance;
	}

	/*Creates the form for the widget in the back-end. */
	function form( $instance ){
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = esc_textarea( $instance['title'] );

		# Title
		echo '<p><label for="' . $this->get_field_id('title') . '">Titre:</label><input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></p>';
	}

}// end CatImage class
