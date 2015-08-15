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
		if (!empty($p)) $p = array_merge($default, $p);
	//	Fetch the jobs
		$jobs = i('job', $p);
		return $jobs;
	}
}
?>