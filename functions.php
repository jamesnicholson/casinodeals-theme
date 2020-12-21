<?php

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Afflilate Links Manager',
		'menu_title'	=> 'Afflilate Links',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'icon_url' => 'https://casinodeals.club/wp-content/uploads/2020/12/skull.png',
		'redirect'		=> false
	));

	add_action('admin_head', 'my_custom_fonts');

	function my_custom_fonts() {
	  echo '<style>
		.wp-menu-image img{
			margin-top: 3px;
			width: 50%;
			padding: 5px 0 0 0 !important;
		}
	  </style>';
	}
}