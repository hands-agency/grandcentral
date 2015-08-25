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
/**
 * Returns the api data in csv
 * @access	public
 */
	public function csv()
	{
	//	The headers (TODO doesnt go here !)
		header('Content-Type: application/csv');
    	header('Content-Disposition: attachment; filename="test.csv";');

	//	Some vars
		$header = array();
		$data = array();

	//	Loop through data
		foreach ($this->result['data'] as $item)
		{
			$tmp = array();
			foreach ($item as $key => $value)
			{
			//	Save the headers on the first loop
				if (!isset($doneHeader)) $header[] = $key;
			//	The attr goes in the cell
				if (is_string($value)) $tmp[] = $value;
				else if (is_array($value)) $tmp[] = json_encode($value);
			}
			$data[] = $tmp;
			$doneHeader = true;
		}
		
	//	Merge data & header
		array_unshift($data, $header);
	
	//	Open the "output" stream
    //	see http://www.php.net/manual/en/wrappers.php.php#refsect2-wrappers.php-unknown-unknown-unknown-descriptioq
		$fp = fopen('php://output', 'w');
		foreach ($data as $fields)
		{
		    fputcsv($fp, $fields);
		}
	}
}
?>