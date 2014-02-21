<table border="0" cellspacing="5" cellpadding="5">
	<tr><td colspan="5"><h2>Admin</h2></td></tr>
	<?php foreach ($matrix['admin'] as $k => $items) : ?>
	<tr class="item">
		<td><h3><?= $k; ?></h3></td>
		<?php foreach ($matrix['admin']['right'] as $right) : ?>
		<td>
		<?php
		$param = array(
			'label' => $right,
			'value' => true
		);
		echo new field_bool($right, $param);
		?>
		</td>
		<?php endforeach; ?>
	</tr>
	<?php foreach ($items as $kk => $item) : ?>
	<tr class="bool">
		<td class="title"><?= $item; ?></td>
		<?php foreach ($matrix['admin']['right'] as $right) : ?>
		<td>
		<?php
		$param = array(
			'label' => $right,
			'value' => true
		);
		echo new field_bool($right.'_'.$kk, $param);
		?>
		</td>
		<?php endforeach; ?>
	</tr>
	<?php endforeach; ?>
	<?php endforeach; ?>
</table>

<style type="text/css">
	fieldset .right h2 {
		font-size: 1.6em;
		padding: 10px;
	}
	fieldset .right h3 {
		font-size: 1.3em;
		padding: 6px;
		background-color: #EEE;
	}
	fieldset .right .item {
		background-color: #EEE;
	}
	fieldset .right .title {
		font-weight: bold;
	}
	fieldset .right ul .bool li {
		float: left;
		
	}
	fieldset .right td .field {
		display: inline !important;
	}
	fieldset .right td input {
		width: auto;
		float: left;
	}
	
</style>