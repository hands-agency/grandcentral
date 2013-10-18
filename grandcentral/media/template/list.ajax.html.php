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
		<li data-path="<?=$file->get_key()?>">
			<?=$file->get_path()?>
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
			$files = scandir($dir->get_root(), SCANDIR_SORT_DESCENDING);
			$previews = array($files[0], $files[1], $files[3]);
		?>
		<li>
			<div class="title">
				<a href="#" class="dir"><?= $dir->get_key() ?></a>
			</div>
			<ul class="preview">
				<?php foreach ($previews as $preview): ?><li><?= media($dir->get_key().'/'.$preview)->thumbnail(100, null) ?></li><?php endforeach ?>
			</ul>
		</li>
		<? endforeach ?>
		<? endif ?>
	</ul>
</div>
<div class="clear"><!-- Clearing floats --></div>

<script>

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

function previewfile(file)
{
//	Add file
	newFile = '<li class="new"><span class="preview"></span><span class="title">' + file.name + '</span><span class="info">' + file.type + ' • ' + (file.size ? (file.size/1024|0) + ' K' : '') + '</span></li>';
	
//	Preview images
	if (tests.filereader === true && acceptedTypes[file.type] === true)
	{
		var reader = new FileReader();
		reader.onload = function (event)
		{
			var image = new Image();
			image.src = event.target.result;
			image.width = 173; // a fake resize
			$(newFile).insertAfter('#mediaLibrary .files ul .upload').find('.preview').html(image);
		};
		reader.readAsDataURL(file);
	}
//	Just add other files
	else
	{
		$(newFile).insertAfter('#mediaLibrary .files ul .upload');
	}

//	Remasony anyway
/*	var $container = $('#mediaLibrary .files ul');
	$container.imagesLoaded(function(){
		$container.masonry('reload', function()
		{
		//	$container.find('li').show(0);
		});
	});
*/
}

function readfiles(files)
{
//	Create a form data object
	var formData = tests.formdata ? new FormData() : null;
	
//	Add the ajx params
	formData.append('app', 'media');
	formData.append('theme', 'admin');
	formData.append('template', 'upload');
	formData.append('type', 'routine');
	formData.append('root', '<?= $_POST['root'] ?>');
	
//	Add the files (& preview them)
    for (var i = 0; i < files.length; i++)
	{
		if (tests.formdata) formData.append('file-'+[i], files[i]);
		previewfile(files[i]);
	}

//	Now post a new XHR request
    if (tests.formdata)
	{	
 		var xhr = new XMLHttpRequest();
		xhr.open('POST', ADMIN_URL+'/ajax');
		
	//	Done !
		xhr.onload = function()
		{
				progress.value = progress.innerHTML = 100;
			//	Say the media lib is not empty anymore
				$('#mediaLibrary .files').removeClass('empty');
			//	Hide progressbar
				$('#holder progress').hide(0, function(){$('#holder p').show()});
			//	Masonry					
			//	var $container = find('#mediaLibrary .files ul');
			//		$container.imagesLoaded(function(){
			//			$container.masonry({
			//			itemSelector : 'li',
			//		});
			//	});
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
</script>
