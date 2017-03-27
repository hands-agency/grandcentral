jQuery(document).ready(function()
{
//	Override onDrop
	SirTrevor.BlockReorder.prototype.onDrop = function(ev)
	{
        ev.preventDefault();
		//	hack pour le block image gc
		if (typeof ev.originalEvent.dataTransfer != 'undefined')
		{
		//	hack pour le block image gc
			var dropped_on = this.$block,
			item_id = ev.originalEvent.dataTransfer.getData("text/plain"),
			block = $('#' + item_id);

	        if (!_.isUndefined(item_id) &&
	          !_.isEmpty(block) &&
	          dropped_on.attr('id') != item_id &&
	          dropped_on.attr('data-instance') == block.attr('data-instance')
	        ) {
	          dropped_on.after(block);
	        }

			SirTrevor.EventBus.trigger("block:reorder:dropped", item_id);
		//	hack pour le block image gc
		}
		else
		{
			// console.log(this.$block[0].id)
			// console.log(ev.toElement)
			// this.$block.html(ev.toElement)
			SirTrevor.EventBus.trigger("block:reorder:dropped");
		}
	}
//	Override onNewBlockCreated
	SirTrevor.Editor.prototype.onNewBlockCreated = function(block)
	{
		if (block.instanceID === this.ID)
		{
			this.hideBlockControls();
		//	this.scrollTo(block.$el);
        }
	}

//	Instantiate editors
	jQuery('[data-type="sirtrevor"] textarea').each( function()
	{
		new SirTrevor.Editor(
		{
			el: jQuery(this),
			//blockTypes: ["Text", "Image", "Heading", "List", "OrderedList", "Quote", "Video", "Break", "Iframe", "Code", "Gist"]
			blockTypes: ["Text", "Image", "Heading", "List", "Quote", "Video", "Break", "Iframe"]
		});
	});

//	Override link formatter
	var Link = SirTrevor.Formatter.extend(
	{
		title: 'link',
		iconName: 'link',
		cmd: 'CreateLink',
		text : 'link',

		onClick: function()
		{
		//	console.log(getCurrentHref());
		//	Open context
			openContext(
			{
				app:'sirtrevor',
				template:'/field/link',
				link:getCurrentHref(),
			});
			// save text currently selected
			selRange = saveSelection();
		},

		isActive: function()
		{
			var selection = window.getSelection(), node;
			if (selection.rangeCount > 0)
			{
				node = selection.getRangeAt(0)
					.startContainer
					.parentNode;
			}
			return (node && node.nodeName == "A");
		}
	});
	SirTrevor.Formatters.Link = new Link();

	// _.extend(SirTrevor.Editor.prototype,
	// {
	//     	onNewBlockCreated: function()
	// 	{
	// 		console.log('onNewBlockCreated')
	// 	}
	// }


	// Add Button to Use Normal Editor (Only for New Posts)
	// if(window.location.href.indexOf('?') == -1){
	// 	jQuery('#edit-slug-box').append('<a href="?stwp_off" class="right button button-small">Use Code Editor</a>');
	// }


	//Set Upload URL so Photo Uploads Work
	SirTrevor.setDefaults({
	  uploadUrl: '/wp-admin/media-new.php'
	});

	// Modified File Upload Function
	// Changes:
	//     - Get a Nonce Code so Wordpress Accepts the Upload
	//     - Accept Non-JSON Response and get the Photo URL
	//     - Add html-upload form field.
	// SirTrevor.fileUploader = function(block, file, success, error) {
	// 	var uid  = [block.blockID, (new Date()).getTime(), 'raw'].join('-');
	// 	var data = new FormData();
	//
	// 	data.append('async-upload', file);
	// 	data.append('html-upload', 'Upload');
	//
	// 	block.resetMessages();
	//
	// 	// Get Nonce
	// 	jQuery.get(ajaxurl,{action: 'stwp_nonce'},function(nonce,status,xhr){
	// 		data.append('_wpnonce', nonce);
	//
	// 		var callbackSuccess = function(data){
	// 			var imgid = jQuery(data).find('#the-list').children(":first").attr('id');
	// 			imgid = imgid.substr(imgid.indexOf('-')+1,10);
	//
	// 			// Get Image URL
	// 			jQuery.get(ajaxurl,{action:'stwp_imgurl',id: imgid}, function(url, status, xhr){
	//
	// 				var data = {file: {url: url.disp, full: url.full}};
	//
	// 				SirTrevor.log('Upload callback called');
	//
	// 				if (!_.isUndefined(success) && _.isFunction(success)) {
	// 					_.bind(success, block)(data);
	// 				}
	//
	// 			}, 'json');
	// 		};
	//
	// 		var callbackError = function(jqXHR, status, errorThrown){
	// 		  SirTrevor.log('Upload callback error called');
	//
	// 		  if (!_.isUndefined(error) && _.isFunction(error)) {
	// 		    _.bind(error, block)(status);
	// 		  }
	// 		};
	//
	// 		var xhr = jQuery.ajax({
	// 		  url: SirTrevor.DEFAULTS.uploadUrl,
	// 		  data: data,
	// 		  cache: false,
	// 		  contentType: false,
	// 		  processData: false,
	// 		  type: 'POST'
	// 		});
	//
	// 		block.addQueuedItem(uid, xhr);
	//
	// 		xhr.done(callbackSuccess)
	// 		   .fail(callbackError)
	// 		   .always(_.bind(block.removeQueuedItem, block, uid));
	//
	// 		return xhr;
	// 	});
	// };
	//
	// // Disable Save Post Button as well as submit button.
	// SirTrevor.Submittable.intialize = function(){
	//       this.$submitBtn = this.$form.find("input[type='submit'], input#save-post");
	//
	//       var btnTitles = [];
	//
	//       _.each(this.$submitBtn, function(btn){
	//         btnTitles.push($(btn).attr('value'));
	//       });
	//
	//       this.submitBtnTitles = btnTitles;
	//       this.canSubmit = true;
	//       this.globalUploadCount = 0;
	//       this._bindEvents();
	//     };

	// Affichage du nombre de caractère dans le SirTrevor

	// On récupère tous les SirTrevors de la page
	var $st = $('.st-ready');

	// On ajoute des listeners sur chaque SirTrevor
	$.each($st, function() {
		var $self = $(this);

		// Listener focus in
		$self.on('focusin', function() {
			var $this = $(this);
			var $container = $this.closest('li[data-type="sirtrevor"]');
			var $textBlock = $this.find('.st-text-block');

			// Lors du relachement d'une touche
			$this.on('keyup', function() {
				var i = 0;
				// On recupere chaque block du SirTrevor qui contient du texte
				$.each($textBlock, function() {
					// On calcul le nombre total de caracteres du SirTrevor focus
					i += $(this).text().length;
				});

				// On affiche dans un control le nombre de caracteres
				showControl($container, {'control': 'guiding', 'html': i});
			});
		});

		// Listener focus out
		$self.on('focusout', function() {
			var $this = $(this);
			var $container = $this.closest('li[data-type="sirtrevor"]');

			// On change l'aspect du control et le fait disparaitre apres 1 seconde
			showControl($container, {'control': 'ok', 'timeout': 1000, 'feathericon': '', 'class': 'counter'});
		});
	});
});
