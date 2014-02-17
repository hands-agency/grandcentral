<?php
/**
 * String formated attributes handling class
 *
 * @package 	Core
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class attrMedia extends attrArray
{
/**
 * xxxx
 *
 * @param	mixed	string, array, file class or dir class
 * @return	string	une string
 * @access	public
 */
	public function set($data)
	{
		$medias = array();
		switch (true)
		{
			case is_a($data, 'dir'):
				foreach ($data->get() as $file)
				{
					$medias[] = $file->get_root();
				}
				break;
			case is_a($data, 'file'):
				$medias[] = $data->get_root();
				break;
			case is_array($data):
				$medias = $data;
				break;
			case is_string($data):
				$medias[] = $data;
				break;
		}

		if (count($medias) > 0)
		{
			$this->data = array();
			foreach ($medias as $media)
			{
				$tmp = (isset($media['url'])) ? media($media['url']) : media($media);
				if ($tmp->exists()) $this->data[] = $tmp->get_path();
			}
		}
		
		return $this;
	}
/**
 * xxxx
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function unfold()
	{
		$return = array();
		if (!empty($this->data))
		{
			foreach ((array) $this->data as $file)
			{
				// print'<pre>';print_r($file);print'</pre>';
				$return[] = media($file['url']);
			}
		}
		return $return;
	}
/**
 * xxxx
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function __toString()
	{
		$return = '';
		if (!empty($this->data))
		{
			foreach ($this->data as $file)
			{
				// print'<pre>';print_r($file);print'</pre>';
				$return .= media($file['url'])->__tostring();
			}
		}
		return $return;
	}
/**
 * Default field attributes for Int	
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public static function get_properties()
	{
	//	Start with the default for all properties
		$params = parent::get_properties();
	//	Somes specifics for this attr
		$params['required'] = array(
			'name' => 'required',
			'type' => 'bool',
			'label' => 'Required',
			'labelbefore' => true
		);
		$params['min'] = array(
			'name' => 'min',
			'type' => 'number',
			'label' => 'Min'
		);
		$params['max'] = array(
			'name' => 'max',
			'type' => 'number',
			'label' => 'Max'
		);
	//	Return
		return $params;
	}
}
?>