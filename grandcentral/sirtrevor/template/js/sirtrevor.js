(function($)
{
  /*
    HR Block
  */
  SirTrevor.Blocks.HR = SirTrevor.Block.extend({
  
    type: 'HR',
  
    title: function(){ return i18n.t('blocks:HR:title'); },
  
    editorHTML: '<div class="st-required st-text-block st-text-block--HR" contenteditable="true"></div>',
  
    icon_name: 'HR',
  
    loadData: function(data){
      this.getTextBlock().html(SirTrevor.toHTML(data.text, this.type));
    }
  });

//	Fetch all instances
	var instances = $("[data-type=\'sirtrevor\'] textarea"),
	i = instances.length, instance;

//	Instanciate all instances
	while (i--)
	{
		instance = $(instances[i]);

	    new SirTrevor.Editor(
		{
			el: instance,
			blockTypes: ["Text", "Heading", "List", "Quote", "HR"],
		});
	}
})(jQuery); 