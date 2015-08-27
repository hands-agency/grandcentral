<?php
/**
 * Sprints
 *
 * @author	Sylvain Frigui <sf@hands.agency>
 * @access	public
 * @link		http://grandcentral.fr
 */
class itemSprint extends _items
{
/**
 * Get the jobs of a sprint orderer by starting date
 *
 * @access	public
 */
	public function get_jobs($p = array())
	{
	//	Some vars
		$default = array(
			'sprint' => $this->get_nickname(),
			'order()' => 'start',
		);
		
	//	Merge with user params
		$p = (!empty($p)) ? array_merge($default, $p) : $default;
	//	Fetch the jobs
		$jobs = i('job', $p);
		return $jobs;
	}
/**
 * Get the starting date of a sprint
 *
 * @access	public
 */
	public function get_start()
	{
		return $this['start'];
	}
/**
 * Get the finishing date of a sprint
 *
 * @access	public
 */
	public function get_end()
	{
		return $this['end'];
	}
	
/**
 * Get the length of a sprint
 *
 * @access	public
 */
	public function get_length()
	{
	//	Get the start 
		$start = $this->get_start();
		$length = $start->diff($this->get_end());
		return $length;
	}
}
?>