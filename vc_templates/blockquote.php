<?php
/*********************Blockquote************************/


/****************************************************/
vc_map( array(
   "name" => __("Sivi Blockquote", "Sivi"),
   "base" => "blockquote",
   "class" => "",
   "icon" => "icon-mnb-my_blockquote",
   'admin_enqueue_css' => array(get_template_directory_uri().'/vc_templates/shortcodes.css'),
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
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Position", "Sivi"),
         "param_name" => "pos",
         "value" => array("Left"=>"","Right"=>"pull-right")
      ),
      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Author", "Sivi"),
         "param_name" => "author"
      ),
	   array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Company", "Sivi"),
         "param_name" => "company"
      ),
	   array(
         "type" => "colorpicker",
         "class" => "",
         "heading" => __("Border custom color", "Sivi"),
         "param_name" => "bcuscolor"
      ),
      array(
         "type" => "textarea_html",
		 "holder"=>'div',
         "class" => "",
         "heading" => __("Content", "Sivi"),
         "param_name" => "content"
      ),
       array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Extra class", "Sivi"),
         "param_name" => "class",
         "description" => __(' Extra class name', "Sivi")
      ),
   )
) );
?>