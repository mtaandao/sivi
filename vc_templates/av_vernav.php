<?php

/*******************Vertical Navigation******************/
class WPBakeryShortCode_Vernavgroup extends WPBakeryShortCodesContainer{

}
/*******************************************/
class WPBakeryShortCode_Vernav extends WPBakeryShortCode {
	
}

/**********************************************************/
vc_map( array(
	"name" => __("Sivi Vertical Navigation", "Sivi"),
	"show_settings_on_create" => true,
	'is_container' => true,
	"content_element" => true,
	"as_parent" => array('only' => 'vernav'),
	"base" => "vernavgroup",
	"class" => "",
	"icon" => "icon-mnb-my_vernav",
	'admin_enqueue_css' => array(get_template_directory_uri() . '/vc_templates/shortcodes.css'),
	"category" => __('Content', "Sivi"),
	"params" => array(
		array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Animation", "Sivi"),
         "param_name" => "anim",
         "value" => array( "None"=>"", "bounce"=>"bounce", "flash"=>"flash", "pulse"=>"pulse", "shake"=>"shake", "swing"=>"swing", "tada"=>"tada", "wobble"=>"wobble", "bounceIn"=>"bounceIn", "bounceInDown"=>"bounceInDown", "bounceInLeft"=>"bounceInLeft", "bounceInRight"=>"bounceInRight", "bounceInUp"=>"bounceInUp", "bounceOut"=>"bounceOut", "bounceOutDown"=>"bounceOutDown", "bounceOutLeft"=>"bounceOutLeft", "bounceOutRight"=>"bounceOutRight", "bounceOutUp"=>"bounceOutUp", "fadeIn"=>"fadeIn", "fadeInDown"=>"fadeInDown", "fadeInDownBig"=>"fadeInDownBig", "fadeInLeft"=>"fadeInLeft", "fadeInLeftBig"=>"fadeInLeftBig", "fadeInRight"=>"fadeInRight", "fadeInRightBig"=>"fadeInRightBig", "fadeInUp"=>"fadeInUp", "fadeInUpBig"=>"fadeInUpBig", "fadeOut"=>"fadeOut", "fadeOutDown"=>"fadeOutDown", "fadeOutDownBig"=>"fadeOutDownBig", "fadeOutLeft"=>"fadeOutLeft", "fadeOutLeftBig"=>"fadeOutLeftBig", "fadeOutRight"=>"fadeOutRight", "fadeOutRightBig"=>"fadeOutRightBig", "fadeOutUp"=>"fadeOutUp", "fadeOutUpBig"=>"fadeOutUpBig", "flip"=>"flip", "flipInX"=>"flipInX", "flipInY"=>"flipInY", "flipOutX"=>"flipOutX", "flipOutY"=>"flipOutY", "lightSpeedIn"=>"lightSpeedIn", "lightSpeedOut"=>"lightSpeedOut", "rotateIn"=>"rotateIn", "rotateInDownLeft"=>"rotateInDownLeft", "rotateInDownRight"=>"rotateInDownRight", "rotateInUpLeft"=>"rotateInUpLeft", "rotateInUpRight"=>"rotateInUpRight", "rotateOut"=>"rotateOut", "rotateOutDownLeft"=>"rotateOutDownLeft", "rotateOutDownRight"=>"rotateOutDownRight", "rotateOutUpLeft"=>"rotateOutUpLeft", "rotateOutUpRight"=>"rotateOutUpRight",  "hinge"=>"hinge", "rollIn"=>"rollIn", "rollOut"=>"rollOut", "zoomIn"=>"zoomIn","zoomInDown"=>"zoomInDown", "zoomInLeft"=>"zoomInLeft","zoomInRight"=>"zoomInRight","zoomInUp"=>"zoomInUp","zoomOut"=>"zoomOut", "zoomOutLeft"=>"zoomOutLeft", "zoomOutRight"=>"zoomOutRight","zoomOutUp"=>"zoomOutUp"),
         "description" => __(" Animation.", "Sivi")
      ),
		array(
		 "type" => "textfield",
		"holder"=>"div",
		  "class" => "",
		  "heading" => __("Title", "Sivi"),
		  "param_name" => "title"
		 ),
        array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Extra class", "Sivi"),
         "param_name" => "class"
      ),
   ),
	"js_view" => 'VcColumnView'
) );
/**********************************************************/
vc_map( array(
	'name' => __( 'Navigation Item', 'Sivi' ),
	'base' => 'vernav',
	"icon" => "icon-mnb-ui-accordion",
	"as_child" => array('only' => 'vernavgroup'),
	'content_element' => true,
	'params' => array(
		array(
		 "type" => "textfield",
		"holder"=>"div",
		  "class" => "",
		  "heading" => __("Title", "Sivi"),
		  "param_name" => "title"
		 ),
		array(
		 "type" => "textfield",
		  "class" => "",
		  "heading" => __("Url", "Sivi"),
		  "param_name" => "link"
			),
		)
	))
?>