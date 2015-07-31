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
}
?>