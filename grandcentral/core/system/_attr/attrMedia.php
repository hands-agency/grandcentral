<?php
/**
 * String formated attributes handling class
 *
 * @package 	Core
 * @author		Sylvain Frigui <sf@hands.agency>
 * @access		public
 * @link		http://grandcentral.fr
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
			case is_string($data) || isset($data['url']):
				$medias[] = $data;
				break;
			case is_array($data):
				$medias = $data;
				break;
		}

		if (count($medias) > 0)
		{
			$this->data = array();
			foreach ($medias as $media)
			{
				$m = (isset($media['url'])) ? media($media['url']) : media($media);
				if ($m->exists())
				{
					$tmp['url'] = $m->get_path();
					$tmp['title'] = (isset($media['title'])) ? $media['title'] : '';
					$this->data[] = $tmp;
				}

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
	public function is_empty()
	{
		return (empty($this->data) || (is_array($this->data) && count($this->data) == 1 && !$this->unfold()[0]->exists())) ? true : false;
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
	public function display($index)
	{
		$alt = null;
		$return = (isset($this->data[$index]['url'])) ? media($this->data[$index]['url'])->set_alt($alt)->__tostring() : null;
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
	//	Some vars
		$return = '';
		$alt = null;
	//	Let's get to work
		if (!empty($this->data))
		{
			foreach ($this->data as $file)
			{
				// print'<pre>';print_r($file);print'</pre>';
				$media = media($file['url']);
				if ($media->exists())
				{
					$return .= media($file['url'])->set_alt($alt)->__tostring();
				}
				else {
					trigger_error('Media '.$file['url'].' doesn\'t exists !', E_USER_NOTICE);
				}
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
