<?php


class CtaModelAdmin extends ModelAdmin {

	private static $managed_models = array(
		'CtaBlock' => array( 'title'=>'CTA Blocks' )
	);

	private static $menu_icon = 'iq-cta/images/admin-icon.png';
	private static $menu_title = 'CTAs';

	private static $url_segment = 'cta';


}
