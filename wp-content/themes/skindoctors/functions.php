<?php

add_action('admin_menu', 'remove_dashboard_boxes');
function remove_dashboard_boxes() {
    remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );//Szybki dostęp
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'core' ); //Ostatnie komentarze
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'core' ); //Odnośniki do witryny
    remove_meta_box('dashboard_plugins', 'dashboard', 'core' ); //Wtyczki
    remove_meta_box('dashboard_quick_press', 'dashboard', 'core' ); //QuickPress
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core' );//Najnowsze szkice
    remove_meta_box('dashboard_primary', 'dashboard', 'core' );//Blog WordPressa
    remove_meta_box('dashboard_secondary', 'dashboard', 'core' );   //Pozostałe nowości dotyczące WordPressa 
}

add_action( 'admin_menu', 'remove_menu_pages' );
function remove_menu_pages() {
    remove_menu_page('edit.php'); // Wpisy
    //remove_menu_page('upload.php'); // Media
    //remove_menu_page('link-manager.php'); //Odnośniki
    remove_menu_page('edit-comments.php'); // Komentarze    
    //remove_menu_page('edit.php?post_type=page'); // Strony
    //emove_menu_page('plugins.php'); // Wtyczki
    //remove_menu_page('themes.php'); // Wygląd
    //remove_menu_page('users.php'); // Użytkownicy
    //remove_menu_page('tools.php'); // Narzędzia
    //remove_menu_page('options-general.php'); // Ustawienia
}

add_filter('show_admin_bar', '__return_false');

register_nav_menus( array(
	'top' => 'Menu główne',
) );

if (function_exists('register_sidebar') ){
    register_sidebar(
    	array(
	        'name' => __( 'Prawa kolumna' ),
  			'id' => 'right',
	        'before_widget' => '',
	        'after_widget' => '',
	        'before_title' => '<h4>',
	        'after_title' => '</h4>', 
		)
	);
}	

add_theme_support( 'post-thumbnails' ); 

function tags_add_custom_types( $query ) {
    if( is_tag() && $query->is_main_query() ) {

        // this gets all post types:
        $post_types = get_post_types();

        // alternately, you can add just specific post types using this line instead of the above:
        // $post_types = array( 'post', 'your_custom_type' );

        $query->set( 'post_type', $post_types );
    }
}
add_filter( 'pre_get_posts', 'tags_add_custom_types' );

add_action('init', 'custom_post_types');

function custom_post_types() {
	//Rejestrowanie custom post types
	$news_args = array(
		'labels' => array (
			'name' => 'Aktualności',
			'singular_name' => 'Aktualność',
			'all_items' => 'Aktualności',
			'add_new' => 'Dodaj nową',
			'add_new_item' => 'Dodaj nową aktualność',
			'edit_item' => 'Edytuj aktualność',
			'new_item' => 'Nowa aktualność',
			'view_item' => 'Zobacz aktualność',
			'search_items' => 'Szukaj w aktualnościach',
			'not_found' => 'Nie znaleziono aktualności',
			'not_found_in_trash' => 'Brak aktualności w koszu',
			'paten_item_colon' => ''
		),
		'public' => true,
		'public_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'taxonomies' => array('post_tag'), 
		'capability_type' => 'post',
		'hierarchical' => false,
		'show_in_nav_menus' => true,
		'show_in_menu' => true,
		//'menu_position' => 5,
		'supports' => array (
			'title', 'editor', 'thumbnail',
		),
		'has_archive' => true
	);
	register_post_type('news', $news_args);

	$slides_args = array(
		'labels' => array (
			'name' => 'Slajder',
			'singular_name' => 'Slajd',
			'all_items' => 'Slajdy',
			'add_new' => 'Dodaj nowy',
			'add_new_item' => 'Dodaj nowy slajd',
			'edit_item' => 'Edytuj slajd',
			'new_item' => 'Nowy slajd',
			'view_item' => 'Zobacz slajd',
			'search_items' => 'Szukaj w slajdach',
			'not_found' => 'Nie znaleziono slajdów',
			'not_found_in_trash' => 'Brak slajdów w koszu',
			'paten_item_colon' => ''
		),
		'public' => true,
		'public_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		//'taxonomies' => array('category'), 
		'capability_type' => 'post',
		'hierarchical' => false,
		//'menu_position' => 5,
		'supports' => array (
			'title','thumbnail',
		),
		'has_archive' => false
	);
	register_post_type('slides', $slides_args);

	$recomendations_args = array(
		'labels' => array (
			'name' => 'Rekomendacje',
			'singular_name' => 'Rekomendacja',
			'all_items' => 'Rekomendacje',
			'add_new' => 'Dodaj nową',
			'add_new_item' => 'Dodaj nową rekomendację',
			'edit_item' => 'Edytuj rekomendację',
			'new_item' => 'Nowa rekomendacja',
			'view_item' => 'Zobacz rekomendację',
			'search_items' => 'Szukaj w rekomendacjach',
			'not_found' => 'Nie znaleziono rekomendacji',
			'not_found_in_trash' => 'Brak rekomendacji w koszu',
			'paten_item_colon' => ''
		),
		'public' => true,
		'public_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		//'taxonomies' => array('category'), 
		'capability_type' => 'post',
		'hierarchical' => false,
		//'menu_position' => 5,
		'supports' => array (
			'title','editor', 'thumbnail',
		),
		'has_archive' => false
	);
	register_post_type('recomendations', $recomendations_args);
	
	$treatments_args = array(
		'labels' => array (
			'name' => 'Zabiegi',
			'singular_name' => 'Zabieg',
			'all_items' => 'Zabiegi',
			'add_new' => 'Dodaj nowy',
			'add_new_item' => 'Dodaj nowy zabieg',
			'edit_item' => 'Edytuj zabieg',
			'new_item' => 'Nowy zabieg',
			'view_item' => 'Zobacz zabieg',
			'search_items' => 'Szukaj w zabiegach',
			'not_found' => 'Nie znaleziono zabiegów',
			'not_found_in_trash' => 'Brak zabiegów w koszu',
			'paten_item_colon' => ''
		),
		'public' => true,
		'rewrite' => array('slug' => 'zabiegi'),
		'public_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'show_in_nav_menus' => true,
		'show_in_menu' => true,
		'taxonomies' => array('category', 'post_tag'), 
		'capability_type' => 'post',
		'hierarchical' => false,
		//'menu_position' => 5,
		'supports' => array (
			'title', 'editor', 'thumbnail',
		),
		'has_archive' => true
	);
	register_post_type('treatments', $treatments_args);

	$tips_args = array(
		'labels' => array (
			'name' => 'Porady',
			'singular_name' => 'Porada',
			'all_items' => 'Porady',
			'add_new' => 'Dodaj nową',
			'add_new_item' => 'Dodaj nową poradę',
			'edit_item' => 'Edytuj poradę',
			'new_item' => 'Nowa porada',
			'view_item' => 'Zobacz poradę',
			'search_items' => 'Szukaj w poradach',
			'not_found' => 'Nie znaleziono porad',
			'not_found_in_trash' => 'Brak porad w koszu',
			'paten_item_colon' => ''
		),
		'public' => true,
		'rewrite' => array('slug' => 'porady'),
		'public_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'show_in_nav_menus' => true,
		'show_in_menu' => true, 
		'taxonomies' => array('category', 'post_tag'), 
		'capability_type' => 'post',
		'hierarchical' => false,
		//'menu_position' => 5,
		'supports' => array (
			'title', 'editor', 'thumbnail',
		),
		'has_archive' => true
	);
	register_post_type('tips', $tips_args);

	$doctors_args = array(
		'labels' => array (
			'name' => 'Specjaliści',
			'singular_name' => 'Specjalista',
			'all_items' => 'Specjaliści',
			'add_new' => 'Dodaj nowego',
			'add_new_item' => 'Dodaj nowego specjalistę',
			'edit_item' => 'Edytuj specjalistę',
			'new_item' => 'Nowy specjalista',
			'view_item' => 'Zobacz specjalistę',
			'search_items' => 'Szukaj w specjalistach',
			'not_found' => 'Nie znaleziono specjalistów',
			'not_found_in_trash' => 'Brak specjalistów w koszu',
			'paten_item_colon' => ''
		),
		'public' => true,
		'rewrite' => array('slug' => 'specjalisci'),
		'public_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'show_in_nav_menus' => false,
		'show_in_menu' => true, 
		'capability_type' => 'post',
		'hierarchical' => false,
		//'menu_position' => 5,
		'supports' => array (
			'title', 'editor', 'thumbnail',
		),
		'has_archive' => false
	);
	register_post_type('doctors', $doctors_args);

	$special_offers_args = array(
		'labels' => array (
			'name' => 'Oferty specjalne',
			'singular_name' => 'Oferta',
			'all_items' => 'Oferty',
			'add_new' => 'Dodaj nową',
			'add_new_item' => 'Dodaj nową ofertę',
			'edit_item' => 'Edytuj ofertę',
			'new_item' => 'Nowa oferta',
			'view_item' => 'Zobacz ofertę',
			'search_items' => 'Szukaj w ofertach',
			'not_found' => 'Nie znaleziono ofert',
			'not_found_in_trash' => 'Brak ofert w koszu',
			'paten_item_colon' => ''
		),
		'public' => true,
		'rewrite' => array('slug' => 'oferty-specjalne'),
		'public_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'show_in_nav_menus' => true,
		'show_in_menu' => true, 
		//'taxonomies' => array('category', 'post_tag'), 
		'capability_type' => 'post',
		'hierarchical' => false,
		//'menu_position' => 5,
		'supports' => array (
			'title', 'editor', 'thumbnail',
		),
		'has_archive' => true
	);
	register_post_type('special_offers', $special_offers_args);

	$media_args = array(
		'labels' => array (
			'name' => 'W mediach',
			'singular_name' => 'Wzmianka w mediach',
			'all_items' => 'Wzmianki w mediach',
			'add_new' => 'Dodaj nową',
			'add_new_item' => 'Dodaj nową wzmiankę w mediach',
			'edit_item' => 'Edytuj wzmiankę',
			'new_item' => 'Nowa wzmianka',
			'view_item' => 'Zobacz wzmiankę',
			'search_items' => 'Szukaj we wzmiankach',
			'not_found' => 'Nie znaleziono wzmianek',
			'not_found_in_trash' => 'Brak wzmianek w koszu',
			'paten_item_colon' => ''
		),
		'public' => true,
		'public_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'w-mediach'),
		'show_in_nav_menus' => true,
		'show_in_menu' => true,
		//'taxonomies' => array('category'), 
		'capability_type' => 'post',
		'hierarchical' => false,
		//'menu_position' => 5,
		'supports' => array (
			'title', 'editor', 'thumbnail'
		),
		'has_archive' => true
	);
	register_post_type('media', $media_args);
	
}
//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_media_categories', 0 );
function create_media_categories() {

	// Add new taxonomy, make it hierarchical like categories
	//first do the translations part for GUI

	$labels = array(
	    'name' => _x( 'Kategorie', 'Kategorie' ),
	    'singular_name' => _x( 'Kategoria', 'Kategoria' ),
	    'search_items' =>  __( 'Szukaj kategorii' ),
	    'all_items' => __( 'Wszystkie kategorie' ),
	    'parent_item' => __( 'Nadrzędna kategoria' ),
	    'parent_item_colon' => __( 'Nadrzędna kategoria:' ),
	    'edit_item' => __( 'Edytuj kategorię' ), 
	    'update_item' => __( 'Aktualizuj kategorię' ),
	    'add_new_item' => __( 'Dodaj nową' ),
	    'new_item_name' => __( 'Dodaj nową kategorię' ),
	    'menu_name' => __( 'Kategorie' ),
	); 	

	// Now register the taxonomy

	register_taxonomy('mediacats',array('media'), array(
	    'hierarchical' => true,
	    'labels' => $labels,
	    'show_ui' => true,
	    'show_admin_column' => true,
	    'query_var' => true,
	    'rewrite' => array( 'slug' => 'media' ),
	));

}

//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_doctors_categories', 0 );
function create_doctors_categories() {

	// Add new taxonomy, make it hierarchical like categories
	//first do the translations part for GUI

	$labels = array(
	    'name' => _x( 'Specjalności', 'Specjalności' ),
	    'singular_name' => _x( 'Specjalność', 'Specjalność' ),
	    'search_items' =>  __( 'Szukaj specjalności' ),
	    'all_items' => __( 'Wszystkie specjalności' ),
	    'parent_item' => __( 'Nadrzędna specjalność' ),
	    'parent_item_colon' => __( 'Nadrzędna specjalność:' ),
	    'edit_item' => __( 'Edytuj specjalność' ), 
	    'update_item' => __( 'Aktualizuj specjalność' ),
	    'add_new_item' => __( 'Dodaj nową' ),
	    'new_item_name' => __( 'Dodaj nową specjalność' ),
	    'menu_name' => __( 'Specjalności' ),
	); 	

	// Now register the taxonomy

	register_taxonomy('doctorscats',array('doctors'), array(
	    'hierarchical' => true,
	    'labels' => $labels,
	    'show_ui' => true,
	    'show_admin_column' => true,
	    'query_var' => true,
	    'rewrite' => array( 'slug' => 'specjalnosci' ),
	));

}

function category_set_post_types( $query ){
    if( $query->is_category ):
        $query->set( 'post_type', 'any' );
    endif;
    return $query;
}
add_action( 'pre_get_posts', 'category_set_post_types' );

function wp_get_menu_array($current_menu) {
 
    $array_menu = wp_get_nav_menu_items($current_menu);
    $menu = array();
    foreach ($array_menu as $m) {
        if (empty($m->menu_item_parent)) {
            $menu[$m->ID] = array();
            $menu[$m->ID]['ID']      =   $m->ID;
            $menu[$m->ID]['title']       =   $m->title;
            $menu[$m->ID]['url']         =   $m->url;
            $menu[$m->ID]['children']    =   array();
        }
    }
    $submenu = array();
    foreach ($array_menu as $m) {
        if ($m->menu_item_parent) {
            $submenu[$m->ID] = array();
            $submenu[$m->ID]['ID']       =   $m->ID;
            $submenu[$m->ID]['title']    =   $m->title;
            $submenu[$m->ID]['url']  =   $m->url;
            $menu[$m->menu_item_parent]['children'][$m->ID] = $submenu[$m->ID];
        }
    }
    return $menu;
     
}

function polylang_shortcode() {
	ob_start();
	pll_the_languages(array('show_flags'=>1,'show_names'=>0));
	$flags = ob_get_clean();
	return $flags;
}
add_shortcode( 'polylang', 'polylang_shortcode' );

/*
add_filter('pre_get_posts', 'query_post_type');
function query_post_type($query) {
  if( is_category() ||  is_tag() ) {
    $post_type = get_query_var('post_type');
    if($post_type)
        $post_type = $post_type;
    else
        $post_type = array('nav_menu_item', 'tips', 'treatments'); // don't forget nav_menu_item to allow menus to work!
    $query->set('post_type',$post_type);
    return $query;
    }
}
*/

/*
add_filter( 'redirect_canonical', 'custom_disable_redirect_canonical' );
function custom_disable_redirect_canonical( $redirect_url ) {
    if ( is_paged() && is_singular() ) $redirect_url = false; 
    return $redirect_url; 
}
*/
