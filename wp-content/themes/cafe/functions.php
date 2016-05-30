<?php /**
 * Cafe functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action
 * hook in WordPress to change core functionality.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, @link http://codex.wordpress.org/Plugin_API
 *
 * @subpackage Cafe
 * @since Cafe 1.0
 */

/*
 * Add theme support and main navigation functions
 */
function cafe_setup() {
	/* Makes Cafe available for translation.
	 * Translations can be added to the /languages/ directory. */
	load_theme_textdomain( 'cafe', get_template_directory() . '/languages' );
	/* Adds support of custom header */
	$header_args = array(
		'default-image'          => '',
		'random-default'         => false,
		'width'                  => 1920,
		'height'                 => 120,
		'flex-height'            => true,
		'flex-width'             => true,
		'default-text-color'     => 'fff',
		'header-text'            => true,
		'uploads'                => true,
		'wp-head-callback'		 => 'cafe_header_style',
		'admin-head-callback'	 => 'cafe_admin_header_style',
	);
	add_theme_support( 'custom-header', $header_args );
	/* Adds background image and color support */
	$background_args = array(
		'default-color'          => 'fff',
		'default-image'          => '',
		'default-repeat'         => '',
		'default-position-x'     => '',
		'wp-head-callback'       => '_custom_background_cb',
		'admin-head-callback'    => '',
		'admin-preview-callback' => '',
	);
	add_theme_support( 'custom-background', $background_args );
	/* Adds RSS feed links to <head> for posts and comments. */
	add_theme_support( 'automatic-feed-links' );
	/*
	 * This theme supports all available post formats by default.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	) );
	/* Styles the visual editor with editor-style.css */
	add_editor_style();
	/* Enable support for Post Thumbnails, and declare two sizes. */
	add_theme_support( 'post-thumbnails' );
	/* Sets up the content width value based on the theme's design. */
	if ( ! isset( $content_width ) ) : 
	$content_width = 690;
	endif;
	add_image_size( 'post-featured-image', 752, 9312, false );
	/* Register menus of theme */
	register_nav_menus( array(
		'primary'   => __( 'Primary menu in header', 'cafe' ),
		'secondary' => __( 'Secondary menu in footer', 'cafe' ),
	) );
}

/**
 * Style the site title in the header displayed on the blog.
 */
function cafe_header_style() {
	$text_color = get_header_textcolor();
	/* If no custom options for text are set, let's bail */
	if ( $text_color == get_theme_support( 'custom-header', 'default-text-color' ) ) :
		return;
	endif;
	/* If we get this far, we have custom styles. */ ?>
	<style type="text/css" id="cafe-header-css">
	<?php /* Has the text been hidden? */
		if ( ! display_header_text() ) : ?>
		.cafe-site-title {
			position: absolute;
			clip: rect(1px 1px 1px 1px); /* IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php else : /* If the user has set a custom color for the text, use that. */ ?>
		.cafe-site-header h1 a {
			color: #<?php echo $text_color; ?>;
		}		
	<?php endif; ?>
	</style>
<?php }

/**
 * Style the header image displayed on the Appearance > Header admin panel.
 */
function cafe_admin_header_style() {
	wp_enqueue_style( 'cafe-admin-header-style', get_template_directory_uri() . "/styles/admin-header.css", false, NULL );
}

/**
 * Enqueue scripts and styles for the front end.
 */
function cafe_register_scripts() {
	/* Add functions realized on script.js */
	wp_enqueue_script( 'cafe-main-script', get_template_directory_uri() . '/js/script.js', array( 'jquery' ) );
	/* Load the main stylesheet */
	wp_enqueue_style( 'cafe-main-style', get_stylesheet_uri() );
	/* Load the Internet Explorer specific stylesheet */
	wp_enqueue_style( 'cafe-ie-style', get_template_directory_uri() . "/styles/ie78.css", array( 'cafe-main-style' )  );
	wp_style_add_data( 'cafe-ie-style', 'conditional', 'lt IE 9' );
	/* Load scripts for compatibility html5 with IE */
	wp_enqueue_script( 'cafe-html5-script', get_template_directory_uri() . '/js/html5.js' );
	/* Load scripts for comments reply */
	if ( is_singular() ) wp_enqueue_script( "comment-reply" );
	/* Load the elements to localize in scripts */
	$script_localization = array( 
		'choose_file'			=> __( 'Choose file...', 'cafe' ),
		'file_is_not_selected'	=> __( 'File is not selected.', 'cafe' ),
	);
	/* Localization in scripts */
	wp_localize_script( 'cafe-main-script', 'script_loc', $script_localization );
}

/**
 * Show in the <title> tag based on what is being viewed.
 */
function cafe_site_title( $title, $sep ) {
	global $page, $paged;
	if ( is_feed() ) :
		return $title;
	endif;
	/* Add the site name. */
	$title .= get_bloginfo( 'name' );
	/* Add the site description for the home/front page. */
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) :
		$title = "$title $sep $site_description";
	endif;
	/* Add a page number if necessary. */
	if ( 2 <= $paged || 2 <= $page ) :
		$title = "$title $sep " . sprintf( __( 'Page', 'cafe' ) . '&nbsp;' . '%s', max( $paged, $page ) );
	endif;
	return $title;
}

/**
 * Add two custom widgets
 * 
 * 1. Cafe_Recent_Comments (Recent Comments with excerpt) widget class */
class Cafe_Recent_Comments extends WP_Widget {
	/* Constructor for widget */
	public function __construct() {
		$widget_ops = array( 
			'classname'   => 'cafe_widget_recent_comments', 
			'description' => __( 'Your site&#8217;s most recent comments with excerpts.' , 'cafe' ),
		);
		parent::__construct( 'cafe_widget_recent_comments', __( 'Recent Comments with excerpt', 'cafe' ), $widget_ops );
		$this->alt_option_name = 'cafe_widget_recent_comments';
		if ( is_active_widget( false, false, $this->id_base ) ) :
			add_action( 'wp_head', array( $this, 'recent_comments_style' ) );
		endif;
		add_action( 'comment_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'edit_comment', array( $this, 'flush_widget_cache' ) );
		add_action( 'transition_comment_status', array( $this, 'flush_widget_cache' ) );
	}

	/* Style for widget */
	function recent_comments_style() {
		if ( ! current_theme_supports( 'widgets' ) || ! apply_filters( 'show_recent_comments_widget_style', true, $this->id_base ) ) :
			return;
		endif;	?>
		<style type="text/css">
		.recentcomments a {
			display:inline !important;
			padding:0 !important;
			margin:0 !important;
		}
		</style>
	<?php }
	
	/* Flush cash for widget */
	function flush_widget_cache() {
		wp_cache_delete( 'widget_recent_comments', 'widget' );
	}
	
	/* The output of widget in frontend */
	function widget( $args, $instance ) {
		global $comments, $comment;
		$cache = wp_cache_get( 'widget_recent_comments', 'widget' );
		if ( ! is_array( $cache ) ) :
			$cache = array();
		endif;
		if ( ! isset( $args['widget_id'] ) ) :
			$args['widget_id'] = $this->id;
		endif;
		if ( isset( $cache[ $args['widget_id'] ] ) ) :
			echo $cache[ $args['widget_id'] ];
			return;
		endif;
		extract( $args, EXTR_SKIP );
		$output = '';
		/* Title of widget */
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Comments' , 'cafe' );
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 2;
		if ( ! $number ) :
			$number = 2;
		endif;
		/* Get comments list based on the arguments */
		$comments = get_comments( apply_filters( 'widget_comments_args', array( 
			'number'      => $number, 
			'status'      => 'approve', 
			'post_status' => 'publish',
		) ) );
		$output .= $before_widget;
		if ( $title ) :
			$output .= $before_title . $title . $after_title;
		endif;
		$output .= '<ul id="recentcomments">';
		if ( $comments ) :
			/* Prime cache for associated posts. (Prime post term cache if we need it for permalinks.) */
			$post_ids = array_unique( wp_list_pluck( $comments, 'comment_post_ID' ) );
			_prime_post_caches( $post_ids, strpos( get_option( 'permalink_structure' ), '%category%' ), false );
			foreach ( (array) $comments as $comment ) :
				/* Checking the length of the current comment and desiding
				 * whether we need '[...]' at the end of the comment excerpt */
				if ( strlen( get_comment( $comment )->comment_content ) < 40 ) :
					$commentExcerptEndLineFiller = '';
				else :
					$commentExcerptEndLineFiller = ' [...]';
				endif; /* Checking ends */
				$output .=  '<li class="recentcomments">' . "<a href='" . esc_url( $comment->comment_author_url ) . "'>" . $comment->comment_author . "</a>" . "&nbsp;" . __( 'on', 'cafe' ) . "&nbsp;" . "<a href='" . esc_url( get_comment_link( $comment->comment_ID ) ) . "'>" . get_the_title( $comment->comment_post_ID ) . "</a>" .
					'<p>' . substr ( get_comment( $comment )->comment_content, 0, 40 ) . $commentExcerptEndLineFiller . '</p>
				</li>';
			endforeach;
		endif;
		$output .= '</ul>';
		$output .= $after_widget;
		/* Outputs the comment list in widget */
		echo $output;
		$cache[$args['widget_id']] = $output;
		wp_cache_set( 'widget_recent_comments', $cache, 'widget' );
	}

	/* Updating widget replacing old instances with new */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['number'] = absint( $new_instance['number'] );
		$this->flush_widget_cache();
		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['widget_recent_comments'] ) ) :
			delete_option( 'widget_recent_comments' );
		endif;
		return $instance;
	}

	/* Creating widget back-end */
	function form( $instance ) {
		$title  = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 2; ?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , 'cafe' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of comments to show:' , 'cafe' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
	<?php }
}

/* 2. Cafe_Recent_Posts (Recent Posts with author and category) widget class */
class Cafe_Recent_Posts extends WP_Widget {
	/* Constructor for widget */
	public function __construct() {
		$widget_ops = array( 
			'classname'   => 'cafe_widget_recent_posts', 
			'description' => __( "Your site&#8217;s most recent posts with author and category." , 'cafe' ), 
		);
		parent::__construct( 'cafe_widget_recent_posts', __( 'Recent Posts (author and category)' , 'cafe' ), $widget_ops );
		$this->alt_option_name = 'cafe_widget_recent_posts';
		add_action( 'save_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );
	}

	/* The output of widget in frontend */
	function widget( $args, $instance ) {
		$cache = wp_cache_get( 'widget_recent_posts', 'widget' );
		if ( ! is_array( $cache ) ) :
			$cache = array();
		endif;
		if ( ! isset( $args['widget_id'] ) ) :
			$args['widget_id'] = $this->id;
		endif;
		if ( isset( $cache[ $args['widget_id'] ] ) ) :
			echo $cache[ $args['widget_id'] ];
			return;
		endif;
		ob_start();
		extract( $args );
		/* Title of widget */
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts' , 'cafe' );
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 2;
		if ( ! $number ) :
			$number = 2;
		endif;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
		$rec_post_request = new WP_Query( apply_filters( 'widget_posts_args', array( 
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
		) ) );
		if ( $rec_post_request->have_posts() ) :
			echo $before_widget; 
		if ( $title ) : 
			echo $before_title . $title . $after_title; 
		endif; ?>
		<ul>
		<?php while ( $rec_post_request->have_posts() ) : 
			$rec_post_request->the_post(); ?>
			<li>
				<a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>
			<p> <?php _e( 'posted by', 'cafe' ); ?> <span class="cafe_lowercase"> <a href="<?php the_author_link() ;?>"> <?php the_author() ?> </a></span> <?php _e( 'in', 'cafe' ); ?> <span class="cafe_lowercase"><?php the_category( ', ' ) ?><span> </p>
			<?php if ( $show_date ) : ?>
				<span class="post-date"><?php echo date_i18n( get_option( 'date_format' ), strtotime( $post->post_date ) ); ?></span>
			<?php endif; ?>
			</li>
		<?php endwhile; ?>
		</ul>
		<?php echo $after_widget; 
		/* Reset the global $the_post as this query will have stomped on it */
		wp_reset_postdata();
		endif;
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set( 'widget_recent_posts', $cache, 'widget' );
	}
	
	/* Updating widget replacing old instances with new */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		$this->flush_widget_cache();
		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['widget_recent_entries'] ) ) :
			delete_option( 'widget_recent_entries' );
		endif;
		return $instance;
	}
	
	/* Flush cash for widget */
	function flush_widget_cache() {
		wp_cache_delete( 'widget_recent_posts', 'widget' );
	}

	/* Creating widget back-end */
	function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 2;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false; ?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , 'cafe' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' , 'cafe' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
		<p><input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' , 'cafe' ); ?></label></p>
	<?php }
} /* Widget added */

/**
 * Initializing two widget areas: sidebar and footer 
 */
function cafe_initialize_widgets() {
	/* Register widgets that were added before */
	register_widget( 'Cafe_Recent_Comments' );
	register_widget( 'Cafe_Recent_Posts' );
	/* Register main widget area in sidebar */
	register_sidebar( array(
		'name'          => __( 'Main Widget Area', 'cafe' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Appears on posts and pages in the sidebar.', 'cafe' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	/* Register secondary widget area in footer */
	register_sidebar( array(
		'name'          => __( 'Secondary Widget Area', 'cafe' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears in the footer section of the site.', 'cafe' ),
		'before_widget' => '<aside id="%1$s" class="cafe-footer-widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="cafe-footer-widget-title">',
		'after_title'   => '</h3>',
	) );
}

/* Function to show the caption of thumbnail */
function cafe_the_post_caption( $size = '', $attr = '' ) {
	global $post;
	$thumb_id = get_post_thumbnail_id( $post->ID );
	$args = array(
		'post_type'   => 'attachment',
		'post_status' => null,
		'parent'      => $post->ID,
		'include'     => $thumb_id,
	);
	$thumbnail_image = get_posts( $args );
	if ( $thumb_id && $thumbnail_image && isset( $thumbnail_image[0] ) ) :
		/* Showing the thumbnail caption */
		$caption = $thumbnail_image[0]->post_excerpt;
		if ( $caption ) :
			$output = '<p class="thumbnail-caption-text">';
			$output .= $caption;
			$output .= '</p>';
			echo $output;
		endif;
	endif;
}

/**
 * Page navigation 
 */
function cafe_page_nav() {
	if ( get_previous_posts_link() || get_next_posts_link() ) : ?> 
		<nav class="cafe-nav-link">
			<div class="alignleft"><h3><?php next_posts_link( '&lArr; ' . __( 'Older posts', 'cafe' ) ); ?></h3></div> 
			<div class="alignright"><h3><?php previous_posts_link( __( 'Newer posts', 'cafe'  ) . ' &rArr;' ); ?></h3></div>
			<div class="cafe-clear"></div>
		</nav> <!-- END of .cafe_nav_link -->
	<?php endif;;
}

/**
 * Breadcrums function
 */
function cafe_breadcrumb() {
	$devider = "<span> / </span>";
	if ( ! is_front_page() ) :
		echo '<a href= "' . esc_url( home_url() ) . '">Home </a>';
		if ( is_archive() ) :
			if ( is_category() ) : 
				$thisCat = get_category( get_query_var( 'cat' ), false );
				echo $devider . "<div> " . __( 'Category:', 'cafe' ) . '&nbsp;'; print_r( $thisCat->name ); echo " </div> "; 
			elseif ( is_author() ) : 
				echo $devider; the_author_posts_link(); 
			elseif ( is_tag() ) :
				echo $devider . "<div> " . __( 'Tag: ', 'cafe' ) . '&nbsp;'; single_tag_title(); echo " </div> ";
			else :
				echo $devider . "<div> " . __( 'Archive for:', 'cafe' ) . '&nbsp;';	wp_title( ' ', true, 'right' );	echo " </div> ";
			endif;
		endif;
		if ( is_single() || is_page() ) :
			$parent = get_ancestors( get_the_ID(),'page' );
			if ( isset( $parent ) ) :
				$parent = array_reverse( $parent );
				foreach ( $parent as $page ) : 
				   echo $devider . "<a href='" . get_permalink( $page ) . "'> " . get_the_title( $page) . "</a>";
				endforeach; 
			endif;
			echo $devider . "<div> " . get_the_title() . " </div> ";
		elseif ( is_404() ) :
			echo $devider . "<div> " . __( 'Page not found', 'cafe' ) . " </div> ";
		endif;
	endif;
}

/**
 * Add actions
 */
add_action( 'after_setup_theme', 'cafe_setup' );
add_action( 'wp_enqueue_scripts', 'cafe_register_scripts' );
add_filter( 'wp_title', 'cafe_site_title', 10, 2 );
add_action( 'widgets_init', 'cafe_initialize_widgets' );
add_action( 'cafe_post_caption', 'cafe_the_post_caption' );
add_action( 'cafe_page_navigation', 'cafe_page_nav' );
add_action( 'cafe_breadcrumb_output', 'cafe_breadcrumb' );
