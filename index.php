<?php

get_header();

if ( is_home() ) {

	if ( ashe_options( 'featured_slider_label' ) === true || ashe_options( 'featured_links_label' ) === true ) {
		// Featured Slider, Carousel
		if ( ashe_options( 'featured_slider_label' ) === true && ashe_options( 'general_slider_width' ) !== 'inner' ) {
			ashe_featured_slider();
		}

		// Featured Links, Banners
		if ( ashe_options( 'featured_links_label' ) === true ) {
			get_template_part( 'templates/header/featured', 'links' );
		}
	}
}

?>

<div class="main-content clear-fix<?php echo ashe_options( 'general_content_width' ) === 'boxed' ? ' boxed-wrapper': ''; ?>" data-layout="<?php echo esc_attr( ashe_page_layout() ); ?>" data-sidebar-sticky="<?php echo esc_attr( ashe_options( 'general_sidebar_sticky' ) ); ?>" data-sidebar-width="<?php echo esc_attr( ashe_options( 'general_sidebar_width' ) ); ?>">

	<?php get_template_part( 'templates/sidebars/sidebar', 'left' ); ?>

	<div class="main-container">
		<?php

		// Featured Slider, Carousel
		if ( ashe_options( 'featured_slider_label' ) === true && ashe_options( 'general_slider_width' ) === 'inner' ) {
			ashe_featured_slider();
		}

		// Category Description
		if ( is_category() ) {
			get_template_part( 'templates/grid/category', 'description' );
		}

		// Author Description
		if ( is_author() && ashe_options( 'blog_page_show_author_description' ) ) {
			get_template_part( 'templates/single/author', 'description' );
		}

		?>
		<ul class="blog-grid">

		<?php
    $args = array(
      'post_type' => 'books',
      'posts_per_page' => -1,
      'order' => 'ASC',
      'category_name' => 'featured'
    );
    $the_query = new WP_Query( $args );

		// Loop Start
    if ( $the_query->have_posts() ) :
        while ( $the_query->have_posts() ) : $the_query->the_post();

		echo '<li>';

		// Blog Feed Wrapper
		if ( strpos( ashe_page_layout(), 'list' ) === 0 ) {
			get_template_part( 'templates/grid/blog', 'list' );
		} else {
			get_template_part( 'templates/grid/blog', 'grid' );
		}

		echo '</li>';

		endwhile; // Loop End

		else:

	 	?>

		<div class="no-result-found">
			<h1><?php esc_html_e( 'Nothing Found!', 'ashe-child' ); ?></h1>
			<p>
				<?php esc_html_e( 'It seems we can\'t find what you\'re looking for. Perhaps searching can help or go back to ', 'ashe-child' ); ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Homepage', 'ashe-child' ); ?></a>
			</p>
			<div class="ashe-widget widget_search">
				<?php get_search_form(); ?>
			</div>
		</div>

		<?php endif; ?>

		</ul>

		<?php get_template_part( 'templates/grid/blog', 'pagination' ); ?>

	</div><!-- .main-container -->

	<?php get_template_part( 'templates/sidebars/sidebar', 'right' ); ?>

</div>

<?php get_footer(); ?>
