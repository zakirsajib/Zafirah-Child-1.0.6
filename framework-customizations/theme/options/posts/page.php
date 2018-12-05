<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(    
    'page-format-gallery' => array(
        'type'     => 'box',
        'title'    => esc_html__('Page Header', 'jevelin'),
        'priority' => 'high',
        'options'  => array(
            'page-gallery' => array(
                'type'  => 'multi-upload',
                'label' => esc_html__( 'Gallery', 'jevelin' ),
                'desc'  => esc_html__( 'Upload images to gallery', 'jevelin' ),
                'images_only' => true,
            ),
            
            'page_background_color' => array(
			    'type'  => 'rgba-color-picker',
			    'label' => esc_html__('Background Color', 'jevelin'),
			    'desc'  => esc_html__('Select background color', 'jevelin'),
			),
					
			'page_accent_color' => array(
			    'type'  => 'rgba-color-picker',
			    'label' => esc_html__('Text Color', 'jevelin'),
			    'desc'  => esc_html__('Select page font color', 'jevelin'),
			),
			'page_header_height' => array(
				'type'  => 'text',
				'value' => '350px',
				'label' => esc_html__('Header Height', 'jevelin'),
				'desc'  => esc_html__('i.e. 350px', 'jevelin'),
			),
			'page_header_title' => array(
				'type'  => 'text',
				'label' => esc_html__('Custom Header Title', 'jevelin'),
			),
					
			'page_header_subtitle' => array(
				'type'  => 'text',
				'value' => '',
				'label' => esc_html__('Custom Header Sub-title', 'jevelin'),
			),
            
        )
    ),


    'page-format-video' => array(
        'type'     => 'box',
        'title'    => esc_html__('Video Settings', 'jevelin'),
        'priority' => 'high',
        'options'  => array(
            'page-video' => array(
                'type' => 'textarea',
                'label' => esc_html__( 'Video URL', 'jevelin' ),
                'desc' => strip_tags("Enter Vimeo or YouTube iframe code.<br>YouTube won't play automatically. <br>You need to set <b>?rel=0&autoplay=1</b> end of the src.<br>To mute add <b>&mute=1</b>", "<b><a><br>"),
                'help'  => __('Paste iframe code. ', 'jevelin'),
            ),
        )
    ),
    
);
