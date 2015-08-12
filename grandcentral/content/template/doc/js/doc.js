$(document).ready(function()
{
//	Always PHP
	hljs.configure({languages:['php']});
	$('pre').each(function(i, block)
	{
		hljs.highlightBlock(block);
	});
});