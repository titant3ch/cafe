<?php 

function custom_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

// function new_excerpt_more( $more ) {
//     return ' ... ';
// }
// add_filter( 'excerpt_more', 'new_excerpt_more' );

function new_excerpt_more( $more ) {
    return '.. <div id="readMore"><a href="'. get_permalink( get_the_ID() ) . '">' . __('Read More', 'your-text-domain') . '</a></div>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );

function register_my_menu() {
  register_nav_menu('header-menu',__( 'Header Menu' ));
}
add_action( 'init', 'register_my_menu' );

function my_login_logo() { ?>
    <style type="text/css">
        body.login {
            background-image: url(../../cafe/wp-content/themes/cafe/img/12.jpg)!important;
            background-position: center center;
        }
        body.login div#login h1 a {
            background-image: url(../../cafe/wp-content/themes/cafe/img/coffee.png)!important;
            background-image: none,url(../../cafe/wp-content/themes/cafe/img/coffee.png)!important;
            pointer-events: none;
            cursor: default;
        }
        #login > form {
            margin-top: 100px;
            border-radius: 5px;
        }
        .login form {
            background: rgba(255,255,255,.5)!important;
        }
        #nav > a {
            color: white!important;
            font-size: 1rem;
            display: none;
        }
        #backtoblog > a {
            font-family: 'Oxygen';
            color: white!important;
            font-size: .9rem;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

add_theme_support( 'post-thumbnails' ); 

function remove_comment_fields($fields) {
    unset($fields['url']);
    return $fields;
}
add_filter('comment_form_default_fields','remove_comment_fields');

// Short Codes

function caption_shortcode( $atts, $content = null ) {
    return '<span class="current">' . $content . '</span>';
}
add_shortcode( 'current', 'caption_shortcode' );

// User Roles

// add editor the privilege to edit theme

// get the the role object
$role_object = get_role( 'editor' );

// add $cap capability to this role object
$role_object->add_cap( 'edit_theme_options' );


?>