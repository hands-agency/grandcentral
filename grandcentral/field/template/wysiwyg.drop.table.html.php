<table>
	<? for ($irow=1; $irow <= $row ; $irow++) : ?>
		<tr>
			<? for ($icol=1; $icol <= $col ; $icol++) : ?>
			<td data-row="<?=$irow?>" data-col="<?=$icol?>"></td>
			<? endfor ?>
		</tr>
	<? endfor ?>
</table>
<style type="text/css">
	table {
		width:200px;
		height:200px;
	}
	table td {
		background:#F2F2F2;
		border-right:1px solid #fff;
		border-bottom:1px solid #fff;
	}
	table td:hover {
		background:#ddd;
		cursor:pointer;
	}
</style>
<script type="text/javascript" charset="utf-8">
	$('table td').click(function()
	{
		row = $(this).data('row');
		col = $(this).data('col');
		html = '<p>table with '+col+' cols AND '+row+' row</p>';
		editor.composer.commands.exec('insertHTML', html);
	});
</script>