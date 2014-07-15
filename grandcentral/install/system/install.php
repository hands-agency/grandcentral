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

<form method="post" accept-charset="utf-8">
	<fieldset>
		<legend>Admin</legend>
		<fieldset>
			<legend>Database</legend>
			<label for="admin_db_host">host : </label><input type="text" name="admin_db_host" value="localhost" /><br />
			<label for="admin_db_name">name : </label><input type="text" name="admin_db_name" value="gc_admin" /><br />
			<label for="admin_db_user">user : </label><input type="text" name="admin_db_user" value="root" /><br />
			<label for="admin_db_password">password : </label><input type="text" name="admin_db_password" value="root" /><br />
		</fieldset>
	</fieldset>
	<fieldset>
		<legend>Site</legend>
		<label for="site_key">key : </label><input type="text" name="site_key" value="test" /><br />
		<label for="site_url">url : </label><input type="text" name="site_url" value="http://install.local" /><br />
		<fieldset>
			<legend>Database</legend>
			<label for="site_db_host">host : </label><input type="text" name="site_db_host" value="localhost" /><br />
			<label for="site_db_name">name : </label><input type="text" name="site_db_name" value="gc_site" /><br />
			<label for="site_db_user">user : </label><input type="text" name="site_db_user" value="root" /><br />
			<label for="site_db_password">password : </label><input type="text" name="site_db_password" value="root" /><br />
		</fieldset>
	</fieldset>
	
	<p><input type="submit" value="Continue &rarr;"></p>
</form>