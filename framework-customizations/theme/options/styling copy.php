<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'styling' => array(
		'title'   => esc_html__( 'Styling', 'jevelin' ),
		'type'    => 'tab',
		'options' => array(
			'styling-box' => array(
				'title'   => esc_html__( 'Body', 'jevelin' ),
				'type'    => 'box',
				'options' => array(
					'styling_body' => array(
						'type'  => 'typography-v2',
						'value'      => array(
					        'family'    => 'Source Serif Pro',
					        'subset'    => 'latin',
					        'variation' => 'regular',
					        'size'      => 14,
						),
						'components' => array(
					        'family'         => true,
					        'size'           => true,
					        'line-height'    => false,
					        'letter-spacing' => false,
					        'color'          => false
						),
						'label' => esc_html__('Body Font', 'jevelin'),
						'desc'  => esc_html__('Choose default body Google font', 'jevelin'),
					),

					'google_fonts_subset' => array(
						'type'  => 'checkboxes',
						'value' => array(
							'latin' => true,
						),
						'label' => esc_html__('Choose the character sets', 'jevelin'),
						'desc'  => esc_html__('Select the character sets you want to use for fonts (will be used only if available)', 'jevelin'),
						'choices' => array(
							'greek' => esc_html__('Greek ', 'jevelin'),
							'greek-ext' => esc_html__('Greek Extended', 'jevelin'),
							'latin' => esc_html__('Latin', 'jevelin'),
							'vietnamese' => esc_html__('Vietnamese', 'jevelin'),
							'cyrillic-ext' => esc_html__('Cyrillic Extended', 'jevelin'),
							'latin-ext' => esc_html__('Latin Extended', 'jevelin'),
							'cyrillic' => esc_html__('Cyrillic ', 'jevelin'),
						),
						'inline' => true,
					),

					'google_fonts_mini' => array(
						'label' => esc_html__( 'Only main font weights', 'jevelin' ),
						'desc'  => esc_html__( 'Improve page speed by loading only main font weights', 'jevelin' ),
						'type'  => 'switch',
						'value' => true,
						'left-choice' => array(
							'value' => false,
							'label' => esc_html__('Off', 'jevelin'),
						),
						'right-choice' => array(
							'value' => true,
							'label' => esc_html__('On', 'jevelin'),
						),
					),


					'title_styling_headings' => array(
					    'type'  => 'html-full',
					    'value' => '',
					    'label' => false,
					    'html'  => '<h3 class="hndle sh-custom-group-divder"><span>'.esc_html__('Headings', 'jevelin').'</span></h3>',
					),

					'styling_headings' => array(
						'type'  => 'typography-v2',
						'value'      => array(
					        'family'    => 'Roboto',
					        'subset'    => 'latin',
					        'variation' => '700',
						),
						'components' => array(
					        'family'         => true,
					        'size'           => false,
					        'line-height'    => false,
					        'letter-spacing' => false,
					        'color'          => false
						),
						'attr'  => array( 'class' => 'custom-class', 'data-foo' => 'bar' ),
						'label' => esc_html__('Headings', 'jevelin'),
					    'desc'  => esc_html__('Choose default Google font for all headings', 'jevelin'),
					),

					'styling_h1' => array(
					    'type'  => 'slider',
					    'value' => 42,
					    'properties' => array(
					        'min' => 1,
					        'max' => 65,
					    ),
					    'label' => esc_html__('Heading 1', 'jevelin'),
					    'desc'  => esc_html__('Select heading 1 font size (rem)', 'jevelin'),
					),

					'styling_h2' => array(
					    'type'  => 'slider',
					    'value' => 38,
					    'properties' => array(
					        'min' => 5,
					        'max' => 65,
					    ),
					    'label' => esc_html__('Heading 2', 'jevelin'),
					    'desc'  => esc_html__('Select heading 2 font size (pixels)', 'jevelin'),
					),

					'styling_h3' => array(
					    'type'  => 'slider',
					    'value' => 24,
					    'properties' => array(
					        'min' => 5,
					        'max' => 65,
					    ),
					    'label' => esc_html__('Heading 3', 'jevelin'),
					    'desc'  => esc_html__('Select heading 3 font size (pixels)', 'jevelin'),
					),

					'styling_h4' => array(
					    'type'  => 'slider',
					    'value' => 20,
					    'properties' => array(
					        'min' => 5,
					        'max' => 65,
					    ),
					    'label' => esc_html__('Heading 4', 'jevelin'),
					    'desc'  => esc_html__('Select heading 4 font size (pixels)', 'jevelin'),
					),

					'styling_h5' => array(
					    'type'  => 'slider',
					    'value' => 16,
					    'properties' => array(
					        'min' => 5,
					        'max' => 65,
					    ),
					    'label' => esc_html__('Heading 5', 'jevelin'),
					    'desc'  => esc_html__('Select heading 5 font size (pixels)', 'jevelin'),
					),

					'styling_h6' => array(
					    'type'  => 'slider',
					    'value' => 8,
					    'properties' => array(
					        'min' => 5,
					        'max' => 65,
					    ),
					    'label' => esc_html__('Heading 6', 'jevelin'),
					    'desc'  => esc_html__('Select heading 6 font size (pixels)', 'jevelin'),
					),

					
					
					'title_styling_menu' => array(
					    'type'  => 'html-full',
					    'value' => '',
					    'label' => false,
					    'html'  => '<h3 class="hndle sh-custom-group-divder"><span>'.esc_html__('Menu', 'jevelin').'</span></h3><p>This font will apply both menu in header and footer. It would also apply on label of tags, category and button.</p>',
					),

					'styling_menu' => array(
						'type'  => 'typography-v2',
						'value'      => array(
					        'family'    => 'News Cycle',
					        'subset'    => 'latin',
					        'variation' => '700',
						),
						'components' => array(
					        'family'         => true,
					        'size'           => false,
					        'line-height'    => false,
					        'letter-spacing' => false,
					        'color'          => false
						),
						'attr'  => array( 'class' => 'custom-class', 'data-foo' => 'bar' ),
						'label' => esc_html__('Menu', 'jevelin'),
					    'desc'  => esc_html__('Choose Google font for menu', 'jevelin'),
					),
					
					
					
					
					
					
					'title_footer_styling' => array(
					    'type'  => 'html-full',
					    'value' => '',
					    'label' => false,
					    'html'  => '<h3 class="hndle sh-custom-group-divder"><span>'.esc_html__('Footer Styling', 'jevelin').'</span></h3>',
					),

					'footer_background_color' => array(
					    'type'  => 'rgba-color-picker',
					    'value' => '#ededed',
					    'label' => esc_html__('Footer Background Color', 'jevelin'),
					    'desc'  => esc_html__('Select footer background color', 'jevelin'),
					),

					'footer_text_color' => array(
					    'type'  => 'color-picker',
					    'value' => '#9e9e9e',
					    'label' => esc_html__('Footer Text Color', 'jevelin'),
					    'desc'  => esc_html__('Select footer text color', 'jevelin'),
					),

										


					'title_copyright_styling' => array(
					    'type'  => 'html-full',
					    'value' => '',
					    'label' => false,
					    'html'  => '<h3 class="hndle sh-custom-group-divder"><span>'.esc_html__('Copyright Styling', 'jevelin').'</span></h3>',
					),

					
					'copyright_text_color' => array(
					    'type'  => 'color-picker',
					    'value' => '#ffffff',
					    'label' => esc_html__('Copyright Text Color', 'jevelin'),
					    'desc'  => esc_html__('Select copyright text color', 'jevelin'),
					),

					

				)
			),
		)
	)
);
