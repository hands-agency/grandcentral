<?=$li ?>
<script type="text/javascript">
//	Warn the user about his data
	msg = '<?=$msg?>';
	$('[data-key="<?=$_POST['field']?>"]').find('.editWrapper .help').html(msg).show('fast');
</script>