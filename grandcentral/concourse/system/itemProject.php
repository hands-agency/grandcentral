<?php
/**
 * Projects
 *
 * @author	Sylvain Frigui <sf@hands.agency>
 * @access	public
 * @link		http://grandcentral.fr
 */
class itemProject extends _items
{
/**
 * Get the sprints of a projects orderer by starting date
 *
 * @access	public
 */
	public function get_sprints($p = array())
	{
	//	Some vars
		$default = array(
			'project' => $this->get_nickname(),
			'order()' => 'start ASC',
			'status' => 'live',
		);
		
	//	Merge with user params
		if (!empty($p)) $p = array_merge($default, $p);
	//	Fetch the sprints
		$sprints = i('sprint', $p);
		return $sprints;
	}
/**
 * Get the starting date of a project
 *
 * @access	public
 */
	public function get_start()
	{
	//	Get the start 
		$firstSprint = $this->get_sprints(array(
			'limit()' => 1,
		));
		$start = $firstSprint[0]['start'];
		return $start;
	}
/**
 * Get the finishing date of a project
 *
 * @access	public
 */
	public function get_end()
	{
		$lastSprint = $this->get_sprints(array(
			'order()' => 'end ASC',
			'limit()' => 1,
		));
		$end = $lastSprint[0]['end'];
		return $end;
	}
/**
 * Get the length of a project
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