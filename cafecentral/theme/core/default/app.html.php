<?php
	$li = '<li><strong>root</strong> : '.$this->get_root().'</li>';
	foreach ($this->viewable as $key => $value)
	{
		$li .= '<li><strong>'.$key.'</strong> : '.$value.'</li>';
	}
?>

<div>Vue app</div>
<div class="test">
	<ul><?= $li; ?></ul>
</div>