<?php 
/*
* Widgets
*
*
* Last Updated on 9 Nov 2017
*/

function nb_widgets_register(){
	
	  if ( function_exists('register_sidebar') )
      register_sidebar(array(
        'name' => __('Footer Social', 'doula1'),
        'id' => 'ftr_social',
        'before_widget' => '<div class="footer-widget">',
        'after_widget' => '</div>',
        'before_title' => '',
        'after_title' => '',
      )
    );
	
	 if ( function_exists('register_sidebar') )
      register_sidebar(array(
        'name' => __('Footer Column 1', 'doula1'),
        'id' => 'nb_footer_1',
        'before_widget' => '<div class="footer-widget"><aside id="%1$s">',
        'after_widget' => '</aside></div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
      )
    );
	
    if ( function_exists('register_sidebar') )
      register_sidebar(array(
        'name' => __('Footer Column 2', 'doula1'),
        'id' => 'nb_footer_2',
        'before_widget' => '<div class="footer-widget"><aside id="%1$s">',
        'after_widget' => '</aside></div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
      )
    );
	
    if ( function_exists('register_sidebar') )
      register_sidebar(array(
        'name' => __('Footer Column 3', 'doula1'),
        'id' => 'nb_footer_3',
        'before_widget' => '<div class="footer-widget"><aside id="%1$s">',
        'after_widget' => '</aside></div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
      )
    );
	
}
  
add_action('widgets_init', 'nb_widgets_register');

?>