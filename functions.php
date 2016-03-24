<?php

class WPMapaDaDemocracia
{
	protected $dist_path = '';
	protected $dist_url = '';
	
	public function __construct()
	{
		$this->dist_url = get_template_directory_uri() . '/mapa-da-democracia/dist';
		$this->dist_path = dirname(__FILE__).'/mapa-da-democracia/dist';
		
		/**
		 * scripts is included in html header
		 */
		//add_action('wp_enqueue_scripts', array($this, 'javascript'));
		//add_action('wp_enqueue_scripts', array($this, 'css'));
	}
	
	public function javascript()
	{
		die($this->dist_url);
		wp_register_script('WPMapaDaDemocracia-bundle', $this->dist_url . '/bundle.js', array());
	}
	
	public function css()
	{
		wp_register_style('WPMapaDaDemocracia', $this->dist_url . '/style.css');
	}
	
	public function html()
	{
		$html = file_get_contents($this->dist_path."/index.html");
		$html = str_replace('src="/bundle.js"', 'src="'.$this->dist_url.'/bundle.js"', $html);
		$html = str_replace('href="styles.css"', 'href="'.$this->dist_url.'/styles.css"', $html);
		return $html;
	}
}

global $WPMapaDaDemocracia;
$WPMapaDaDemocracia = new WPMapaDaDemocracia();