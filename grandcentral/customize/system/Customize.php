<?php
class Customize{

	protected $root_custom;
	protected $root_color;
	protected $root_declination;

	protected $root_uni;
	protected $root_bicolore;

	protected $colors;
	protected $declinations;

	protected $colors_uni;
	protected $colors_bicolore;

	protected $tree = array();

	protected $sizes;
	protected $finitions;

	public function getDatas()
	{
		$dir_color = new dir($this->root_color);
		// $dir_declination = new dir($this->root_declination);

		$dir_uni = new dir($this->root_uni);
		$dir_bicolore = new dir($this->root_bicolore);


		$this->colors = $dir_color->get(true);
		// $this->declinations = $dir_declination->get(true);

		$this->colors_uni = $dir_uni->get(true);
		$this->colors_bicolore = $dir_bicolore->get(true);

		// Thumbnail
		// foreach ($this->declinations as $key_declination => $declination) {
		// 	$this->tree[$key_declination] = array();
		// 	foreach ($declination as $key_detail => $detail) {
		// 		$this->tree[$key_declination][$key_detail] = array();
		// 		foreach ($detail as $key_img => $detail_img) {
		// 			$temp = media('custom/declination/'.$key_declination.'/'.$key_detail.'/'.$detail_img->get_key());
		// 			// $this->tree[$key_declination][$key_detail][$detail_img->get_name()] = $temp->get_url();
		// 			$this->tree[$key_declination][$key_detail][$detail_img->get_name()] = $temp->thumbnail(720,null)->get_url();
		// 		}
		// 	}
		// }

		// Boucle polo uni
		foreach ($this->colors_uni as $key_uni => $uni) {

			$this->tree['uni'][$key_uni] = array();

			foreach ($uni as $key_img => $detail_img) {
				$temp = media('custom/uni/'.$key_uni.'/'.$detail_img->get_key());

				$this->tree['uni'][$key_uni][$detail_img->get_name()] = $temp->thumbnail(720,null)->get_url();

			}

		}

		// Boucle polo bicolore
		foreach ($this->colors_bicolore as $key_declination => $declination) {
			$this->tree['bicolore'][$key_declination] = array();

			foreach ($declination as $key_detail => $detail) {

				$this->tree['bicolore'][$key_declination][$key_detail] = array();
				foreach ($detail as $key_img => $detail_img) {
					$temp = media('custom/bicolore/'.$key_declination.'/'.$key_detail.'/'.$detail_img->get_key());
					$this->tree['bicolore'][$key_declination][$key_detail][$detail_img->get_name()] = $temp->thumbnail(720,null)->get_url();
				}
			}
		}

	}

	public function __construct()
	{
		$this->root_custom = app('media')->get_templateroot('site').'/custom';
		$this->root_color = $this->root_custom.'/color';
		$this->root_declination = $this->root_custom.'/declination';

		$this->root_uni = $this->root_custom.'/uni';
		$this->root_bicolore = $this->root_custom.'/bicolore';

		$this->tree['uni'] = array();
		$this->tree['bicolore'] = array();

		$this->sizes = array(
			'man' => array(
				'xs' => 0,
				's' => 0,
				'm' => 0,
				'l' => 0,
				'xl' => 0,
				'2xl' => 0,
				'3xl' => 0,
				'4xl' => 0,
			),
			'woman' => array(
				'0' => 0,
				'1' => 0,
				'2' => 0,
				'3' => 0,
				'4' => 0,
				'5' => 0,
				'6' => 0,
				'7' => 0,
			)
		);
		$this->finitions = array(
			'BRODE' => cst('CUSTOMIZE_BRODE'),
			'IMPRIME' => cst('CUSTOMIZE_IMPRIME'),
			// 'PLASTIQUE' => cst('CUSTOMIZE_PLASTIQUE')
		);

		$this->getDatas();
	}

	public function get_tree()
	{
		// print '<pre>';
		// print_r($this->tree);
		// print '</pre>';
		// die;
		return $this->tree;
	}
	public function get_img_polo($params)
	{
		if(isset($params['choicetyperadio']) && !empty($params['choicetyperadio']))
		{
			if($params['choicetyperadio'] == "uni")
			{
				if(isset($params['colorpoloradio']) && !empty($params['colorpoloradio']))
					return $this->tree["uni"][$params['colorpoloradio']];
				else
					return null;
			}
			else if ($params['choicetyperadio'] == "bicolore")
			{
				if((isset($params['colorpoloradio']) && !empty($params['colorpoloradio']))
					&& (isset($params['colordetailradio']) && !empty($params['colordetailradio'])))
					return $this->tree["bicolore"][$params['colorpoloradio']][explode('-',$params['colordetailradio'])[0]];
				else
					return null;
			}
		}
		else
		{
			return null;
		}
	}
	public function get_colors()
	{
		$array_colors = array();
		foreach ($this->colors as $key => $color) {
			$array_colors[$color->get_name()] = media('custom/color/'.$color->get_key())->thumbnail(100,null)->get_url();
		}
		return $array_colors;
	}
	public function get_declinations()
	{
		return $this->declinations;
	}

	public function get_sizes()
	{
		return $this->sizes;
	}

	public function get_finitions()
	{
		return $this->finitions;
	}

	public function get_min_quantity($choicetypepolo)
	{
		return $choicetypepolo == "uni" ? 10 : 100;
	}



}
 ?>
