<?php
/**
 * The generic api of Grand Central
 *
 * @author	Sylvain Frigui <sf@hands.agency>
 * @access	public
 * @link	http://grandcentral.fr
 */
abstract class _apis
{
	protected $param;
/**
 * Lorem
 * @access	public
 */
	public function __construct($p)
	{
		$this->param = $p;
	//	Start the clock
		sentinel::startwatch();
	}
	
/**
 * Lorem
 * @access	public
 */
	protected function map_hash($hash)
	{
		if (isset($this->param['hash']))
		{
			for ($i=0; $i < count($hash); $i++)
			{
			//	Set or create as null
				$this->param[$hash[$i]] = (isset($this->param['hash'][$i])) ? $this->param['hash'][$i] : null;
			}
		}
	}
	
/**
 * Request
 *
 * @access	public
 */
	abstract public function request($request);

/**
 * Returns the api data in json
 * @access	public
 */
	public function json()
	{
	//	Add Some Return Meta
		$this->result['meta']['self'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$this->result['meta']['executiontime'] = sentinel::stopwatch();
	//	Return
		return json_encode($this->result);
	}
}
?>