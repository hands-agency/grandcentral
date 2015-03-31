<?php
/********************************************************************************************/
//	Loading the core
/********************************************************************************************/
	boot::get(ADMIN_ROOT.'/core');
/********************************************************************************************/
//	Loading the sentinel
/********************************************************************************************/
	sentinel::getInstance();
/********************************************************************************************/
//	installation du site
/********************************************************************************************/
	// print'<pre>';print_r(registry::get_constants());print'</pre>';
	// print'<pre>';print_r($_POST);print'</pre>';
	if (!empty($_POST))
	{
		new gcInstall($_POST);
		exit;
	}
?>
<!DOCTYPE html>
<html lang="<?= i('admin', current, 'admin')['version']['key'] ?>">
<head>
	<style type="text/css" media="screen">
		/********************************************************************************************/
		/*////////////////////////////////////////////////////////////////////////////////////////////
		/* From Boiler plate (you would be a fool to alter that)
		/////////////////////////////////////////////////////////////////////////////////////////////
		/********************************************************************************************/
		header, section, footer, aside, nav, article, figure
		{
		  display: block;
		}

		html, body, div, span, object, iframe,
		h1, h2, h3, h4, h5, h6, p, blockquote, pre,
		abbr, address, cite, code, del, dfn, em, img, ins, kbd, q, samp,
		small, strong, sub, sup, var, b, i, dl, dt, dd, ol, ul, li,
		fieldset, form, label, legend,
		table, caption, tbody, tfoot, thead, tr, th, td,
		article, aside, canvas, details, figcaption, figure,
		footer, header, hgroup, menu, nav, section, summary,
		time, mark, audio, video
		{
			margin: 0;
			padding: 0;
			border: 0;
			font-size: 100%;
			font:inherit;
			vertical-align: baseline;
		}
		ul, ol
		{
			list-style-type:none;
		}

		fieldset
		{
			margin:0;
			padding:0;
			border:0;
		}

		article, aside, details, figcaption, figure,
		footer, header, hgroup, menu, nav, section
		{
		  display: block;
		}

		table
		{
			border-collapse: collapse;
			border-spacing: 0;
		}
		pre, code, kbd, samp
		{
			font-family:'monaco', monospace, sans-serif;
		}

		.ie7 img
		{
			-ms-interpolation-mode: bicubic;
		}
		input[type="search"]
		{
			-webkit-appearance:textfield;
		}

		/* Clearing float use<div class="clear"><!-- Clearing floats --></div> */
		.clear
		{
			clear:both;
			float:none !important;
			height:0;
			line-height:0;
		}

		/********************************************************************************************/
		/* Body
		/********************************************************************************************/
		body
		{
			font-family:"Helvetica Neue", helvetica, arial, "Lucida Grande", Geneva, Verdana, sans-serif;
			font-size:1em;
			color:#444;
			background:#fff;
		}

		/********************************************************************************************/
		/* Hyperlinking
		/********************************************************************************************/
		a
		{
			color:#419BF9;
			text-decoration:none;
		}
		a:hover
		{}
		a:active
		{
			position:relative;
		    top:1px;
		}
		a:visited
		{}

		/* Accesskey */
		.acceskey
		{text-decoration:underline;}

		/* Kill Browser tweaks */
		*:focus
		{outline: none;}
		*::selection
		{
			background:#df3528;
			color:#fff;
		}
		*::-moz-selection
		{
			background:#df3528;
			color:#fff;
		}
		*::-webkit-selection
		{
			background:#df3528;
			color:#fff;
		}

		/********************************************************************************************/
		/* Go
		/********************************************************************************************/
		h1
		{
			font-size:40px;
			text-align:center;
			margin:30px 0;
		}
		h2
		{
			font-size:30px;
			text-align:center;
			margin:20px 0;
		}
		h3
		{
			font-size:20px;
			text-align:center;
			margin:10px 0;
		}
		.col
		{
			margin:auto;
			width:50%;
			padding:30px 0;
			-moz-box-sizing:border-box;
			-webkit-box-sizing:border-box;
			box-sizing:border-box;
		}
		.col fieldset
		{
			background:rgba(0,0,0, 0.4);
			border-radius:2px;
			color:#fff;
			padding:30px;
		}
	</style>
</head>
<body data-env="<?=$_SESSION['pref']['handled_env']?>">
	<header>
		<h1>Welcome to Grand Central</h1>
	</header>
	<form method="post" accept-charset="utf-8">
		<div class="col">
			<h2>Grand Central admin</h2>
			<fieldset>
				<h3>Database</h3>
				<ol>
					<li><label for="admin_db_host">host</label><input type="text" name="admin_db_host" placeholder="localhost" /></li>
					<li><label for="admin_db_name">name</label><input type="text" name="admin_db_name" placeholder="gc_admin" /></li>
					<li><label for="admin_db_user">user</label><input type="text" name="admin_db_user" placeholder="root" /></li>
					<li><label for="admin_db_password">password</label><input type="text" name="admin_db_password" placeholder="root" /></li>
				</ol>
			</fieldset>
		</div>
		<div class="col">
			<h2>Your app</h2>
			<fieldset>
				<h3>About</h3>
				<ol>
					<li><label for="site_key">key</label><input type="text" name="site_key" placeholder="appkey" /></li>
					<li><label for="site_url">url</label><input type="text" name="site_url" placeholder="http://app.local" /></li>
				</ol>
				<h3>Database</h3>
				<ol>
					<li><label for="site_db_host">host</label><input type="text" name="site_db_host" placeholder="localhost" /></li>
					<li><label for="site_db_name">name</label><input type="text" name="site_db_name" placeholder="gc_site" /></li>
					<li><label for="site_db_user">user</label><input type="text" name="site_db_user" placeholder="root" /></li>
					<li><label for="site_db_password">password</label><input type="text" name="site_db_password" placeholder="root" /></li>
				</ol>
			</fieldset>
		</div>
	
		<p><input type="submit" value="Continue &rarr;"></p>
	</form>

</body>
</html>