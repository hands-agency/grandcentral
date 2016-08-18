<div class="dir <?php if (!isset($files)): ?>empty<?php endif ?>">

	<h2><span class="rule"><?=$here?></span></h2>
	<ul class="files">
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
		<?php if (isset($files)) : ?>
		<?php foreach ($files as $file): ?>
		<li data-path="<?=$file->get_path()?>" data-url="<?=$file->get_url()?>" data-info="<?= $file->get_extension() ?> • <?= $file->get_size() ?>" data-title="<?= $file->get_key() ?>">
			<a href="#" class="file <?=$file->get_mimeType()?>">
				<?php
					$preview = (is_a($file, 'image')) ? $file->thumbnail(120, null)->get_url() : null;
				?>
				<span class="preview" style="background-image:url('<?=$preview?>');"></span>
				<span class="title"><?= $file->get_key() ?></span>
			</a>
		</li>
		<?php endforeach ?>
		<?php endif;?>
	</ul>

	<h2><span class="rule">Folders</span></h2>
	<div class="folders">
		<ul>
			<li class="add" data-path="<?=$here?>">
				<div class="title">
					<form method="post" accept-charset="utf-8">
						<input type="text" placeholder="Name this folder">
					</form>
				</div>
				<div class="button">+</div>
			</li>
			<?php if (isset($directories)): ?>
			<?php foreach ($directories as $dir): ?>
			<?php
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
			<li class="folder">
				<div class="title"><?= $dir->get_key() ?></div>
				<ul class="preview">
					<?php for ($i=0; $i < $maxPreviews ; $i++) : ?>
						<?php if (isset($files[$i])): ?>
							<li style="background-image:url('<?= media($files[$i])->thumbnail(100, null)->get_url() ?>')"></li>
						<?php endif ?>
					<?php endfor; ?>
				</ul>
			</li>
			<?php endforeach ?>
			<?php endif ?>
		</ul>
	</div>
</div>

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

		function appendFile(file, filedata)
		{
			console.log(filedata);
		//	Some vars
			$container = $('#mediaLibrary ul.files');
			$upload = $('#mediaLibrary ul.files li.upload');

		//	Preview images
			if (tests.filereader === true)
			{
				var reader = new FileReader();
				reader.onload = function (event)
				{

				//	If it's an image
					if (acceptedTypes[file.type] === true)
					{
						imageBase64 = event.target.result;
					//	Add the image preview, path & url
						media = '<li class="new" data-path="'+filedata.path+'" data-url="'+filedata.url+'" data-info="'+file.type+' • '+(file.size ? (file.size/1024|0)+' K' : '')+'" data-title=""><a class="file" href="#"><span class="preview"><img src="'+imageBase64+'" /></span><span class="title">' + filedata.name + '</span></a></li>';
					//	Add
						$upload.after(media);
					}
				//	This directory is no longer empty
					$('#mediaLibrary .dir').removeClass('empty');
				//	Re init Gallery (drag & masonry)
					$('#mediaLibrary').data('mediaGallery').initList();

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
			formData.append('folder', '<?= $here ?>');

		//	Append the files to the form
		    for (var i = 0; i < files.length; i++)
			{
				if (tests.formdata) formData.append('file-'+[i], files[i]);
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
				//	console.log(xhr.response);
					response = JSON.parse(xhr.response);

				//	Add the files to the page
		    		for (var i = 0; i < files.length; i++)
					{
						appendFile(files[i], response.data.file[i]);
					}
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
