<?php

	session_start();
	
	require_once("bin/Shell.class.php");

	$host = Shell::get_host_name();
	$user = Shell::get_login_name();
	
	$main_window_content = "
		 <div id='welcome'>
			Welcome to SimpShell, a simple web shell.<br /> 
			Type 'help' to view available commands, or 'help [command]' for more details about a command.
			HAVE FUN ;)
		</div>
		<div class='main_window'>
		<!-- the output -->
		<div id='output_container'>
			<div id='output'>
			</div>
		</div>

		<!-- the input -->
		<div class='input_container'>
			<div class='login'>
				<span class='login_name'>".$user."</span>@<span class='host_name'>".$host."</span>:~$ 
			</div>
			<div>
				<form id='form_cmd' action='".$config['shell_script_path']."' method='post' >
					<input class='input' name='c' id='c' value='' type='text' autocomplete='off' />
				</form>
			</div>
		</div>
	</div>
	<script type='text/javascript'>
	</script>
	";
	
	$window_login_content = "
				<form id='form_login' action='".$config['login_script_path']."' method='post' >
					<label for='login'>Login:</label>
					<input class='input' name='login' id='login' value='' type='text' autocomplete='off' />
					<br />
					<label for='login'>Password:</label>
					<input class='input' name='password' id='password' value='' type='password' autocomplete='off' />
					<div id='response'></div>
				</form>
	";
	
	
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

	<head>
		<title><?php echo $config['page_title']; ?></title>
		<link rel="stylesheet" href="http://cheghamwassim.com/apps/php/shell/assets/css/webshell.css" type="text/css" media="screen" charset="utf-8" />
		<script type="text/javascript" src="http://cheghamwassim.com/tools/js/jquery/v1.4.2/jquery.min.js"></script>
		<script type="text/javascript" src="http://cheghamwassim.com/tools/js/jquery-ui/v1.8.4/jquery-ui.min.js"></script>
		<script type="text/javascript" src="http://cheghamwassim.com/apps/php/shell/assets/js/exec.js"></script>
	</head>
	
	<body>
		<div id="modal"></div>
		<div id="page">
		<?php echo Shell::create_window('window-1', $config['page_title'], $main_window_content, '700', '400'); ?>
		</div>
		<?php echo Shell::create_window("window-login", "SimpShell Login", $window_login_content, "300", "100", "top:-150px;"); ?>
	</body>
</html>
