<?php
//Custom fields
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_files',
		'title' => __('Files','odin'),
		'fields' => array (
			array (
				'key' => 'field_54a0b1862cee1',
				'label' => 'Magnet Link',
				'name' => 'magnet_link',
				'type' => 'text',
				'instructions' => __('Access <a href="http://torrent2magnet.com" target="_blank">Torrent2Magnet</a> to generate your magnet link','odin'),
				'required' => 1,
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_54a0b1e22cee2',
				'label' => '.torrent file',
				'name' => 'torrent_file',
				'type' => 'file',
				'instructions' => __('Select your .torrent file','odin'),
				'required' => 1,
				'save_format' => 'id',
				'library' => 'all',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'permalink',
				1 => 'discussion',
				2 => 'comments',
				3 => 'slug',
				4 => 'author',
				5 => 'format',
			),
		),
		'menu_order' => 0,
	));
}
?>
