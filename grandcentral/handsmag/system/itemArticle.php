<?php
/**
 * Projects
 *
 * @author	Sylvain Frigui <sf@hands.agency>
 * @access	public
 * @link		http://grandcentral.fr
 */
class itemArticle extends _items
{
/**
 * Get the jobs of a projects orderer by starting date
 *
 * @access	public
 */
	public function get_jobs($p = array())
	{
	//	The sprints
		$sprints = $this->get_sprints()->get_column('id');

	//	Some vars
		$default = array(
			'project' => $sprints,
			'order()' => 'start ASC',
			'status' => 'live',
		);

	//	Merge with user params
		$p = (!empty($p)) ? array_merge($default, $p) : $default;
	//	Fetch the sprints
		$jobs = i('job', $p);
		return $jobs;
	}
}
?>
