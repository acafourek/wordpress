<?php
function fb_get_recommendations_bar($options = array()) {
	$params = '';
	
	foreach ($options as $option => $value) {
		$params .= $option . '="' . $value . '" ';
	}
	
	return '<div class="fb-recommendations-bar" ' . $params . '></div>';
}

function fb_recommendations_bar_automatic($content) {
	if (!is_home()) {
		$options = get_option('fb_options');
		
		foreach($options['recommendations_bar'] as $param => $val) {
			$param = str_replace('_', '-', $param);
				
			$options['recommendations_bar']['data-' . $param] =  $val;
		}
		
		$content .= fb_get_recommendations_bar($options['recommendations_bar']);
	}
	
	return $content;
}

function fb_get_recommendations_bar_fields($placement = 'settings') {
	$parent = array('name' => 'recommendations_bar',
									'field_type' => 'checkbox',
									'help_text' => 'Click to learn more.',
									'help_link' => 'https://developers.facebook.com/docs/reference/plugins/recommendationsbar/',
									);
	
	$children = array(array('name' => 'trigger',
													'field_type' => 'text',
													'help_text' => 'This specifies the percent of the page the user must scroll down before the plugin is expanded.',
													),
										array('name' => 'read_time',
													'field_type' => 'text',
													'help_text' => 'The number of seconds the plugin will wait until it expands.',
													),
										array('name' => 'action',
													'field_type' => 'dropdown',
													'options' => array('like', 'recommend'),
													'help_text' => 'The verb to display in the button.',
													),
										array('name' => 'side',
													'field_type' => 'dropdown',
													'options' => array('left', 'right'),	
													'help_text' => 'The side of the window that the plugin will display.',
													),
										);
	
	fb_construct_fields($placement, $children, $parent);
}

?>