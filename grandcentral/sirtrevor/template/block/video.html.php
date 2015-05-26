<?php
$block = $_PARAM['block']['data'];

if($block['source'] == 'youtube'):
?>
	<p><iframe src="https://www.youtube.com/embed/<?php echo $block['remote_id']; ?>" frameborder="0" allowfullscreen></iframe></p>
<?php
elseif($block['source'] == 'vimeo'):
?>
	<p><iframe src="http://player.vimeo.com/video/<?php echo $block['remote_id']; ?>?title=0&byline=0" width="100%" height="480" frameborder="0" allowfullscreen=""></iframe></p>
<?php 
elseif($block['source'] == 'dailymotion'):
?>
	<p><iframe src="//www.dailymotion.com/embed/video/<?php echo $block['remote_id']; ?>" width="100%" height="480" frameborder="0" allowfullscreen></iframe>
<?php endif; ?>