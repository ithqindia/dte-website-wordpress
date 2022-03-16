<?php

abstract class MildhillCoreTitle {
	protected $slug;
	public $overriding_whole_title = false;
	
	public function load_template( $parameters = array() ) {
		return mildhill_core_get_template_part( 'title/layouts/' . $this->slug, 'templates/' . $this->slug, '', $parameters );
	}
}