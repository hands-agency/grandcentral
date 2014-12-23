<ul class="searchList" data-nodata="<?=$nodata?>"><? if (isset($results)) : ?>
<? foreach ($results as $result): ?><li><?=$result['title']?></li><?endforeach?>
<?php endif ?></ul>