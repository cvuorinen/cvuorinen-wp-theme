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

// Post meta info
function cvuorinen_post_meta() {
    /* translators: used between list items, there is a space after the comma */
    $categories_list = get_the_category_list( __( ', ', 'twentyeleven' ) );

    /* translators: used between list items, there is a space after the comma */
    $tag_list = get_the_tag_list( '<span class="tag-link">', __( ',</span> <span class="tag-link">', 'twentyeleven' ), '</span>' );
    
    echo '<ul class="entry-meta-list">';
    
    printf( __( '<li><div class="post-time"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate><span class="entry-date-month">%4$s</span> <span class="entry-date-day">%5$s</span></time></a></div><div style="clear:both;"></div></li>', 'cvuorinen' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_date() ),
		esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date( 'M' ) ),
        esc_html( get_the_date( 'j' ) )
	);
    
//    printf( __( '<li><span class="sep">Author:</span> <span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span></li>', 'twentyeleven' ),
//		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
//		esc_attr( sprintf( __( 'View all posts by %s', 'twentyeleven' ), get_the_author() ) ),
//		get_the_author()
//	);
    
    if ( '' != $categories_list ) {
        printf( __( '<li class="cat-links"><i class="icon icon-bookmark"></i> Categories: %1$s</li>', 'cvuorinen' ),
            $categories_list
        );
    }
    
    if ( '' != $tag_list ) {
        printf( __( '<li class="tag-links"><i class="icon icon-tags"></i> Tags: %1$s</li>', 'cvuorinen' ),
            $tag_list
        );
    }
    
    if ( comments_open() ) {
        echo '<li class="comment-link"><i class="icon icon-comment"></i> ';
        comments_popup_link( '<span class="leave-reply">' . __( 'Comment', 'twentyeleven' ) . '</span>',
            __( '<b>1</b> Comment', 'twentyeleven' ),
            __( '<b>%</b> Comments', 'twentyeleven' )
        );
        echo '</li>';
    }
    
    echo '</ul><div style="clear:both;"></div>';
}

/**
 * Font awesome
 */
function cvuorinen_fontawesome_styles()  
{
    wp_register_style( 'fontawesome-style', get_stylesheet_directory_uri() . '/fontawesome/css/font-awesome.css', array(), '2.0', 'all' );
    wp_enqueue_style( 'fontawesome-style' );
    
    wp_register_style( 'fontawesome-ie-style', get_stylesheet_directory_uri() . '/fontawesome/css/font-awesome-ie7.css', array(), '2.0', 'all' );
    $GLOBALS['wp_styles']->add_data( 'fontawesome-ie-style', 'conditional', 'IE 7' );
    wp_enqueue_style( 'fontawesome-ie-style' );
}  
add_action( 'wp_enqueue_scripts', 'cvuorinen_fontawesome_styles' ); 