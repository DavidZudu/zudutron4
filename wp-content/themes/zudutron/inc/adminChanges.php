<?php

//// Hide dashboard menu items
add_action('admin_menu', 'remove_dash_menus', 999);
function remove_dash_menus()
{
  remove_menu_page('edit-comments.php');
//   remove_menu_page('edit.php?post_type=acf-field-group'); // hide custom fields menu items  
}


//// Hide admin bar items
add_action('wp_before_admin_bar_render', 'my_admin_bar_render');
function my_admin_bar_render()
{
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu('comments');
  $wp_admin_bar->remove_menu('acf-field-group');
}


//// Change admin footer "Thank you" message.
add_filter('admin_footer_text', 'change_footer_admin');
function change_footer_admin()
{
  echo 'Thank you for creating with <a style="color:#b83d2f;" target="_blank" rel="noreferrer" href="https://zudu.co.uk/">Zudu</a>. For support, please submit a ticket to our <a style="color:#b83d2f;" target="_blank" rel="noreferrer" href="https://zudu.freshdesk.com/support/login">Helpdesk</a>.';
}


//// Adds notices to dashboard pages
add_action('admin_notices', 'admin_notices');
function admin_notices()
{
  global $pagenow;
  if ($pagenow == 'plugins.php') {
    echo "<div class='notice notice-warning'>
    <p>Updating, adding, or removing plugins without checking with Zudu first may cause the website to break and could incur charges. Ask first; we're happy to help!</p>
    </div>";
  }
}


//// Update CSS within in Admin
function admin_style() {
  wp_enqueue_style('admin-styles', get_template_directory_uri().'/zudu-admin.css');
}
add_action('admin_enqueue_scripts', 'admin_style');


//// Reorder amdin menu
function reorder_admin_menu( $__return_true ) {
  return array(
       'index.php', // Dashboard
       'edit.php?post_type=page', // Pages
       'edit.php', // Posts
       'edit.php?post_type=people',

       'separator1', // --Space--

       'upload.php', // Media
       'plugins.php', // Plugins       
       
       'edit-comments.php', // Comments
       'users.php', // Users

       'separator2', // --Space--

       'themes.php', // Appearance
       'tools.php', // Tools
       'options-general.php', // Settings
 );
}
// add_filter( 'custom_menu_order', 'reorder_admin_menu' );
// add_filter( 'menu_order', 'reorder_admin_menu' );


// Add js file for use on admin
function my_enqueue($hook) {  
  wp_enqueue_script('my_custom_script', get_template_directory_uri().'/zudu-admin.js');
}
add_action('admin_enqueue_scripts', 'my_enqueue');



// Hide menu items unless Screen option is toggled (see zudu-admin.js)
add_action( 'admin_init','setHiddenItems' );

function setHiddenItems() 
{
    global $menu;
    foreach( $menu as $key => $value )
    {
        if( 'ACF' == $value[0] ) $menu[$key][4] .= " hidden-item";    
        if( 'CookieYes' == $value[0] ) $menu[$key][4] .= " hidden-item";    
    }
}