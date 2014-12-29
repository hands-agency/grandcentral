<ul class="searchList" data-nodata="<?=$nodata?>"><? if (isset($results)) : ?>
<? foreach ($results as $result): ?><li><a href="<?=$result->edit()?>" title=""><?=$result['title']?></a></li><?endforeach?>
<?php endif ?></ul>