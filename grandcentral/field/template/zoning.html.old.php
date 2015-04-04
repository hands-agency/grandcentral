<div class="zoningselected">
	
	<div class="field" data-name="<?= $_FIELD->get_name(); ?>" data-env="<?= $handled_env; ?>">
		
		<div class="zones">
			<iframe src="<?=$iframe['url']->args(array('page' => $page->get_nickname()))?>"></iframe>
		</div>

	</div>
</div>

<div class="zoningavailable">
	<ul class="tabs">
		<li class="on"><a>Apps</a></li>
		<li><a>Section</a></li>
	</ul>
	<div class="available">
		<!--button>New</button-->
		<ul class="choices"><!-- Welcome Ajax --></ul>
	</div>
</div>
<div class="clear"><!-- Clearing floats --></div>
<?=$name?>
<?=$values?>
<?=$valuestype?>