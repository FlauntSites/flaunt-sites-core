<?php

/*******************
	REVIEWS FIELDS
*******************/

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
	'key' => 'group_5897a46ab646c',
	'title' => 'Reviews',
	'fields' => array (
		array (
			'key' => 'field_5897a4aeb05ea',
			'label' => 'Review Quote',
			'name' => 'fsc_review_quote',
			'type' => 'text',
			'instructions' => 'Use a short, one sentence attention grabbing pull quote from the full review. 60 characters max.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => 60,
		),
		array (
			'key' => 'field_5897a46fb05e9',
			'label' => 'Full Review Text',
			'name' => 'fsc_full_review_text',
			'type' => 'textarea',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '',
			'new_lines' => 'wpautop',
		),
		array (
			'key' => 'field_5897a4deb05eb',
			'label' => 'Stars',
			'name' => 'fsc_stars',
			'type' => 'select',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array (
				1 => '1',
				2 => '2',
				3 => '3',
				4 => '4',
				5 => '5',
			),
			'default_value' => array (
			),
			'allow_null' => 0,
			'multiple' => 0,
			'ui' => 0,
			'ajax' => 0,
			'return_format' => 'value',
			'placeholder' => '',
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'reviews',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'acf_after_title',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => array (
		0 => 'permalink',
		1 => 'the_content',
		2 => 'excerpt',
		3 => 'custom_fields',
		4 => 'discussion',
		5 => 'comments',
		6 => 'slug',
		7 => 'author',
		8 => 'format',
		9 => 'page_attributes',
		10 => 'tags',
		11 => 'send-trackbacks',
	),
	'active' => 1,
	'description' => '',
));

endif;