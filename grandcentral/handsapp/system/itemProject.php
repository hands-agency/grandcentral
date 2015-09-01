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
		$p = (!empty($p)) ? array_merge($default, $p) : $default;
	//	Fetch the sprints
		$sprints = i('sprint', $p);
		return $sprints;
	}
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
			'order()' => 'end DESC',
			'limit()' => 1,
		));
		$end = $lastSprint[0]['end'];
		return $end;
	}
/**
 * Get the Data set of the pulse for Google Charts
 *
 * @access	public
 */
	public function get_pulsedata($scale = 1)
	{
		
	//	When does this project starts
		$start = $this->get_start();
		
	//	Get the amount of days for this project
		$days = ceil($this->get_length()->days);
		
	//	Fill the weeks with intensity
		$data = '';
		for ($i=0; $i < ceil($days); $i++)
		{
		//	Intensity
			$intensity = rand(20, 80);
			
		//	Today
			$today = $start->modify('+'.$i.' days');

		//	Today
			if ($today->format('Y-m-d') == date('Y-m-d'))
			{
				$pointSize = 5;
				$pointColor = 'fill-color:#FFC000';
				$add = true;
			}
		//	First and last point
			else if ($i == 0 OR $i == $days-1)
			{
				$pointSize = 5;
				$pointColor = null;
				$add = true;
			}
		//	Default
			else
			{
				$pointSize = 0;
				$pointColor = null;
				$add = null;
			}
			
		//	Add the point only if is a multiple of granularity
			if ($add == true OR $i % $scale == 0)
			{
			//	Add to data
				$data .= "[".$i.", ".$intensity.", 'point { size: ".$pointSize.";".$pointColor."', '".$today->format("Y-m-d D")." (W".$today->format("W").")'],";
			}
		}
		$data = "[".$data."]";
		
	//	Return
		return $data;
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