<div class="dirs">
	<ul>
		<? if (isset($directories)): ?>
		<? foreach ($directories as $dir): ?>
		<li><a href="#" class="dir"><?= $dir->get_key() ?></a></li>
		<? endforeach ?>
		<? endif ?>
	</ul>
</div>
<div class="files <?if (!isset($files)): ?>empty<?php endif ?>">
	<ul>
		<li class="upload">
			<div id="holder">
				<p>Drag & drop files from your computer to upload (yes you can)</p>
				<progress id="uploadprogress" min="0" max="100" value="0">0</progress>
			</div>
			<p id="upload" class="hidden"><label>Drag & drop not supported, but you can still upload via this input field:<br><input type="file"></label></p>
			<p id="filereader">File API & FileReader API not supported</p>
			<p id="formdata">XHR2's FormData is not supported</p>
			<p id="progress">XHR2's upload progress isn't supported</p>
		</li>
		<? if (isset($files)) : ?>
		<? foreach ($files as $file): ?>
		<li data-path="<?=$file->get_path()?>" data-info="<?= $file->get_extension() ?> • <?= $file->get_size() ?>" data-title="<?= $file->get_key() ?>" >
			<a href="#" class="file">
				<? if (is_a($file, 'image')): ?>
					<span class="preview"><?= $file->thumbnail(120, null); ?></span>
				<? endif ?>
				<span class="title"><?= $file->get_key() ?></span>
				<span class="info"><?= $file->get_extension() ?> • <?= $file->get_size() ?></span>
			</a>
		</li>
		<? endforeach ?>
		<? endif;?>
	</ul>
</div>
<div class="folder">
	<ul>
		<? if (isset($directories)): ?>

		<? foreach ($directories as $dir): ?>
		<?
			$reg = $dir->get_root().'/*.jpg';
			$files = glob($reg);
			usort($files, function($file_1, $file_2)
			{
			    $file_1 = filectime($file_1);
			    $file_2 = filectime($file_2);
			    if($file_1 == $file_2)
			    {
			        return 0;
			    }
			    return $file_1 < $file_2 ? 1 : -1;
			});
		?>
		<li>
			<div class="title">
				<a href="#" class="dir"><?= $dir->get_key() ?></a>
			</div>
			<ul class="preview">
				<?php for ($i=0; $i < $maxPreviews ; $i++) : ?>
					<?php if (isset($files[$i])): ?>
						<li><?= media($files[$i])->thumbnail(100, null) ?></li>
					<?php endif ?>
				<?php endfor; ?>
			</ul>
		</li>
		<? endforeach ?>
		<? endif ?>
	</ul>
</div>
<div class="clear"><!-- Clearing floats --></div>

<script type="text/javascript" charset="utf-8">
$(document).ready(function()
{
	/* D&D UPLOAD TEMP*/
	var holder = document.getElementById('holder'),
	    tests = {
	      filereader: typeof FileReader != 'undefined',
	      dnd: 'draggable' in document.createElement('span'),
	      formdata: !!window.FormData,
	      progress: "upload" in new XMLHttpRequest
	    }, 
	    support = {
	      filereader: document.getElementById('filereader'),
	      formdata: document.getElementById('formdata'),
	      progress: document.getElementById('progress')
	    },
	    acceptedTypes = {
	      'image/png': true,
	      'image/jpeg': true,
	      'image/gif': true
	    },
	    progress = document.getElementById('uploadprogress'),
	    fileupload = document.getElementById('upload');

	"filereader formdata progress".split(' ').forEach(function (api) {
	  if (tests[api] === false) {
	    support[api].className = 'fail';
	  } else {
	    // FFS. I could have done el.hidden = true, but IE doesn't support
	    // hidden, so I tried to create a polyfill that would extend the
	    // Element.prototype, but then IE10 doesn't even give me access
	    // to the Element object. Brilliant.
	    support[api].className = 'hidden';
	  }
	});

	function appendFile(file)
	{
	//	Some vars
		container = $('#mediaLibrary .files ul');
		media = '<li class="new"><span class="preview"></span><span class="title">' + file.name + '</span><span class="info">' + file.type + ' • ' + (file.size ? (file.size/1024|0) + ' K' : '') + '</span></li>';
			
	//	Preview images
		if (tests.filereader === true)
		{
			var reader = new FileReader();
			reader.onload = function (event)
			{
			//	Add
				appendedMedia = $(media).appendTo(container);
				
			//	If it's an image
				if (acceptedTypes[file.type] === true)
				{
					var image = new Image();
					image.src = event.target.result;
					image.width = 173; // a fake resize
				//	Add the image preview
					appendedMedia.find('.preview').html(image);
				}
				
			//	Remasonry
				if (container.parents('.files').hasClass('empty'))
				{
				//	Say the media lib is not empty anymore
					container.parents('.files').removeClass('empty');
					$('#mediaLibrary').data('mediaGallery').initList();
				}
				else container.masonry( 'appended', appendedMedia );
			};
			reader.readAsDataURL(file);
		}
	}

	function readfiles(files)
	{
	//	Create a form data object
		var formData = tests.formdata ? new FormData() : null;
	
	//	Add the ajx params
		formData.append('app', 'media');
		formData.append('template', 'upload');
		formData.append('root', '<?= $_POST['root'] ?>');
	
	//	Append the files
	    for (var i = 0; i < files.length; i++)
		{
			if (tests.formdata) formData.append('file-'+[i], files[i]);
			appendFile(files[i]);
		}

	//	Now post a new XHR request
	    if (tests.formdata)
		{	
	 		var xhr = new XMLHttpRequest();
			xhr.open('POST', ADMIN_URL+'/ajax.html');
		
		//	Done !
			xhr.onload = function()
			{
			//	Fill up the progress bar
				progress.value = progress.innerHTML = 100;
			//	Hide progressbar
				$('#mediaLibrary #holder progress').hide(0, function(){$('#holder p').show()});
			
			//	Debug
				console.log(xhr.response);
			}

			if (tests.progress)
			{
				xhr.upload.onprogress = function (event)
				{
					if (event.lengthComputable)
					{
						var complete = (event.loaded / event.total * 100 | 0);
						progress.value = progress.innerHTML = complete;
					}
				}
			}
		
		//	Send !
			xhr.send(formData);
	    }
	}

	if (tests.dnd)
	{ 
		holder.ondragover = function () { this.className = 'hover'; return false; };
		holder.ondragend = function () { this.className = ''; return false; };
		holder.ondragleave = function () { this.className = ''; return false; };
		holder.ondrop = function (e)
		{
			this.className = '';
			e.preventDefault();
			readfiles(e.dataTransfer.files);
		//	Show progressbar	
			$('#holder p').hide(0, function(){$('#holder progress').show()});
		}
	}
	else
	{
		fileupload.className = 'hidden';
		fileupload.querySelector('input').onchange = function ()
		{
			readfiles(this.files);
		};
	}
});
</script>
