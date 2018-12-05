<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	    
    'post-format-gallery' => array(
        'type'     => 'box',
        'title'    => esc_html__('Gallery Settings', 'jevelin'),
        'priority' => 'high',
        'options'  => array(
            'post-gallery' => array(
                'type'  => 'multi-upload',
                'label' => esc_html__( 'Gallery', 'jevelin' ),
                'desc'  => esc_html__( 'Upload images to your gallery', 'jevelin' ),
                'images_only' => true,
            ),
        )
    ),


    'post-format-video' => array(
        'type'     => 'box',
        'title'    => esc_html__('Video Settings', 'jevelin'),
        'priority' => 'high',
        'options'  => array(
            'post-video' => array(
                'type' => 'textarea',
                'label' => esc_html__( 'Video iframe code', 'jevelin' ),
                'desc' => esc_html__( 'Enter Vimeo or YouTube iframe code', 'jevelin' ),
                'help'  => __('Paste iframe code.', '{domain}'),
            ),
            'post-video-thumbnail' => array(
				'label' => esc_html__( 'Video Thumbnail', 'jevelin' ),
				'desc'  => esc_html__( 'Upload a video thumbnail', 'jevelin' ),
				'type'  => 'upload',
				'images_only' => true,
			),
        )
    ),
    
    
    
    
    'post-alignment' => array(
	    'type'	=> 'box',
        'title'	=> esc_html__('Post Meta Alignment', 'jevelin'),
        'priority' => 'high',
        'options' => array(
	        'post-meta-alignment'	=> array(
		        'type' => 'radio',
		        'label' => esc_html__( 'Alignment', 'jevelin' ),
		        'desc' => __( 'Align <b>Credits</b>, <b>Social media</b> and <b>tags</b>', 'jevelin' ),
		        'choices'	=> array(
			        'center' => esc_html__('Center', 'jevelin'),
					'right' => esc_html__('Right', 'jevelin'),
		        ),
			),
        ),
    ),
    
    'shop_post' => array(
		'title'   => esc_html__( 'Shop the Story', 'jevelin' ),
		'type'    => 'box',
		'options' => array(
			'shop-text' => array(
				'type'  => 'text',
				'value' => '',
				'label' => esc_html__('Title', 'jevelin'),
				'desc'  => esc_html__('Enter Shop Heading', 'jevelin'),
			),
			
			'shop-gallery' => array(
                'type'  => 'multi-upload',
                'label' => esc_html__( 'Shop Gallery', 'jevelin' ),
                'desc'  => esc_html__( 'Upload images', 'jevelin' ),
                'images_only' => true,
            ),
		)
	)
);
