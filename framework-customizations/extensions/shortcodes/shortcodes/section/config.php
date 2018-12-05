<?php if (!defined('FW')) die('Forbidden');

$cfg = array(
	'page_builder' => array(
		'tab'         => __('Layout Elements', 'fw'),
		'title'       => __('Section', 'fw'),
		'description' => __('Add a Section', 'fw'),
		'type'        => 'section', // WARNING: Do not edit this
		'title_template' => '
    	<b>{{- title }}</b>
            {{ if( typeof o.background_image.data.icon != "undefined" && o.background_image.data.icon ) { }}
                <img src="{{- o.background_image.data.icon }}" width="100%" height="100%"/>
            {{ } }}'
	)
);