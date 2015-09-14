<!DOCTYPE html>
<html lang="<?=i('version', current)['lang'] ?>">
<head>
	<!-- ZONE:meta-->
	<!-- ZONE:css -->
	<!-- ZONE:script -->
</head>
<body>
	<header>
		<div class="container">	
			<h1><?=i('site', current)['title']?> <?=i('page', current)['title']?></h1>
		</div>
	</header>
	
	<article>
		<div class="container">
			
			<ul id="toc" class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
				<?php foreach ($apis as $api): ?>
				<?php
					$class =  $api->get_name();
					$doc = new doc(new $class(array()));
					$data = $doc->data;
					$apiKey = strtolower(substr($data['key'], 3));
					$methods = $doc->data['method'];
				?>
				<li class="<?=$data['key']?>">
					<div class="key">
						<span><?=$apiKey?></span>
					</div>
					<div class="api">
						<div class="title">
							<a href="#<?=$data['key']?>"><?=$data['descr']?></a>
						</div>
						<div class="methods">
							<?php foreach ($methods as $method): ?>
							<?php
								$m = str_replace($class.'::', '', $method['key']);
								$exampleUrl = $apiPage['url'].'/v2/'.$apiKey;
							?>
							<?php if (in_array($m, $requests)): ?>
							<a href="#<?=$data['key'].$m?>"><?=$method['descr']?></a>
							<?php endif ?>
							<?php endforeach ?>
						</div>
					</div>
				</li>
				<?php endforeach ?>
			</ul>
	
			<ul id="list" class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
				<?php foreach ($apis as $api): ?>
				<?php
					$class =  $api->get_name();
					$doc = new doc(new $class(array()));
					$data = $doc->data;
					$apiKey = strtolower(substr($data['key'], 3));
					$methods = $doc->data['method'];
				?>
				<li id="<?=$data['key']?>">
					<h2><span><?=$apiKey?></span> <?=$data['descr']?></h2>
			
					<?php foreach ($methods as $method): ?>
					<?php
						$m = str_replace($class.'::', '', $method['key']);
						$exampleUrl = $apiPage['url'].'/v2/'.$apiKey;
						$exampleData = '';
					?>
					
					<?php if (in_array($m, $requests)): ?>
					
					<div id="<?=$data['key'].$m?>">
						<h3><span><?=$m?></span></h3>
						<p><?=$method['descr']?></p>
						<pre><?='<em>'.$m.'</em> '.$exampleUrl?></pre>
					
						<?php if (isset($method['param'])): ?>
						<h4>Endpoint</h4>
						<table>
							<tr>
								<th>Name</th>
								<th>Type</th>
								<th>Description</th>
								<th>Example</th>
							</tr>
							<?php foreach ($method['param'] as $param): ?>
							<?php
							//	Try to extract an example
								$ex = extract_example($param['descr']);
								if ($ex !== false)
								{
									$param['descr'] = str_replace('('.$ex.')', '', $param['descr']);
								//	Add example to example Url
									$exampleUrl .= '/'.$ex;
								}
								else $ex = null;
							?>
							<tr>
								<td><?=$param['name']?></td>
								<td><?=$param['type']?></td>
								<td><?=$param['descr']?></td>
								<td><?=$ex?></td>
							</tr>
							<?php endforeach ?>
						</table>	
						<?php endif ?>
					
						<?php if (isset($method['arg'])): ?>
						<h4>Parameters</h4>
						<table>
							<tr>
								<th>Name</th>
								<th>Type</th>
								<th>Description</th>
								<th>Example</th>
							</tr>
							<?php
							//	? insteads of & for the first args
								$doneWithArgs = false;
							?>
							<?php foreach ($method['arg'] as $a): ?>
							<?php
							//	Arguments are not pre-parsed
								$a = explode("\t", $a);
							
							//	Try to extract an example
								$ex = extract_example($a[2]);
								if (isset($ex))
								{
									$a[2] = str_replace('('.$ex.')', '', $a[2]);
								//	Add example to example Url
									$exampleUrl .= ($doneWithArgs === false) ? '?' : '&';
									$exampleUrl .= $ex;
									$doneWithArgs = true;
								}
								else $ex = null;
								?>
							<tr>
								<td><?php if (isset($a[0])) echo $a[0]?></td>
								<td><?php if (isset($a[1])) echo $a[1]?></td>
								<td><?php if (isset($a[2])) echo $a[2]?></td>
								<td><?=$ex?></td>
							</tr>
							<?php endforeach ?>
						</table>	
						<?php endif ?>
					
						<?php if (isset($method['data'])): ?>
						<h4>Input</h4>
						<table>
							<tr>
								<th>Name</th>
								<th>Type</th>
								<th>Description</th>
								<th>Example</th>
							</tr>
							<?php foreach ($method['data'] as $d): ?>
							<?php
							//	Arguments are not pre-parsed
								$d = explode("\t", $d);

							//	Try to extract an example
								$ex = extract_example($d[2]);
								if ($ex !== false)
								{
									$d[2] = str_replace('('.$ex.')', '', $d[2]);
								//	Add example to example Url
									$exampleData .= $ex;
								}
								else $ex = null;
							?>
							<tr>
								<td><?php if (isset($d[0])) echo $d[0]?></td>
								<td><?php if (isset($d[1])) echo $d[1]?></td>
								<td><?php if (isset($d[2])) echo $d[2]?></td>
								<td><?=$ex?></td>
							</tr>
							<?php endforeach ?>
						</table>	
						<?php endif ?>
					
						<?php
						//	Some vars for response & example
							$headerId = 'header'.$class.$m;
							$responseId = 'response'.$class.$m;
						?>
						
						<h4>Example</h4>
						<pre><?='<em>'.$m.'</em> '.$exampleUrl?></pre>
						<?php if ($exampleData): ?><pre><em>data</em> {<?=$exampleData?>}</pre><?php endif ?>
					
						<h4>Service status &amp; headers</h4>
						<pre id="<?=$headerId?>"><!-- Welcome Ajax --></pre>
					
						<h4>Response</h4>
						<pre id="<?=$responseId?>"><!-- Welcome Ajax --></pre>
						
						<script type="text/javascript" charset="utf-8">
							$(document).ready(function()
							{
								$.ajax(
								{
									type: '<?=strtoupper($m)?>',
									url: '<?=$exampleUrl?>',
									data: {<?=$exampleData?>},
									dataType: 'html'
								})
								.fail(function(data, status, xhr)
								{
									console.log('fail <?=$responseId?>');
									$('#toc li.<?=$data['key']?>').addClass('ko');
									$('#list #<?=$data['key']?>').addClass('ko');
									$('#<?=$responseId?>').html(data.responseText);
								})
								.done(function(data, status, xhr)
								{
								//	We're OK here
									console.log('done <?=$responseId?>');
									$('#toc li.<?=$data['key']?>').addClass('ok');
									$('#list #<?=$data['key']?>').addClass('ok');
									$('#list #<?=$data['key'].$m?>').addClass('ok');
								//	Header
									header = '';
									header += 'Status: '+xhr.status+"\n";
									header += 'Content-Type: '+xhr.getResponseHeader('Content-Type')+"\n";
									header += 'Date: '+xhr.getResponseHeader('Date')+"\n";
									header += 'Last-Modified: '+xhr.getResponseHeader('Last-Modified')+"\n";
									header += 'Server: '+xhr.getResponseHeader('Server')+"\n";
									$('#<?=$headerId?>').html(header);
								//	Response
									$('#<?=$responseId?>').html(JSON.stringify(JSON.parse(data),null,'\t'));
								//	$('#<?=$responseId?>').html('You\'ll get that soon');
								//	Highlight
									
								//	Reroot get in ajax & constants
									$('#<?=$responseId?>').each(function(i, block)
									{
										hljs.highlightBlock(block);
									});
								});
							});
						</script>
					</div>
					<?php endif; ?>
					<?php endforeach ?>
				</li>
				<?php endforeach ?>
			</ul>
		</div>
	</article>
</body>
</html>