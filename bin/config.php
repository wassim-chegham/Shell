<?php

$config = array();

$config['users'] = array(
						'maneki'=>'lasemetibohacker',
						'demo'=>'demo'
					);

$config['shell_script_path'] = 'bin/exec.php';
$config['login_script_path'] = 'bin/check_user.php';

$config['page_title'] = 'SimpShell v2.0 (PHP)';


$config['color_term2html'] = array(
			chr(27)."[01;31m" 	=> '<span style="font-weight:bold;color:pink">',
			chr(27)."[01;32m" 	=> '<span style="font-weight:bold;color:lightGreen">',
			chr(27)."[01;33m"	=> '<span style="font-weight:bold;color:yellow">',
			chr(27)."[01;34m" 	=> '<span class="dir" style="font-weight:bold;color:Fuchsia">',  // directory	
			chr(27)."[30;42m"	=> '<span class="dir" style="font-weight:bold;color:Fuchsia">', // directory
			chr(27)."[01;35m" 	=> '<span style="font-weight:bold;color:magenta">',
			chr(27)."[01;36m" 	=> '<span style="font-weight:bold;color:lightCyan">',
			chr(27)."[01;37m" 	=> '<span style="font-weight:bold;color:white">',
			chr(27)."[0;30m"	=> '<span style="font-weight:bold;color:grey">',
			chr(27)."[0;31m"	=> '<span style="font-weight:bold;color:red">',
			chr(27)."[0;32m" 	=> '<span style="font-weight:bold;color:green">',
			chr(27)."[0;36m" 	=> '<span style="font-weight:bold;color:brown">',
			chr(27)."[0;33m" 	=> '<span style="font-weight:bold;color:blue">',
			chr(27)."[0;34m" 	=> '<span style="font-weight:bold;color:cyan">',
			chr(27)."[0m" 		=> '</span>',
			chr(27)."[m" 		=> '',
			chr(27)."[01m" 		=> '', // bold
			chr(27)."[04m"	 	=> '', // underscore
			chr(27)."[07m" 		=> ''  // reverse
		);

$config['valid_cmd'] = array(

		// array( command, description, public/private )

		/* A */
		array("alias", "Create an alias", false), 
		array("apropos", "Search Help manual pages (man -k)", true), 
		array("awk", "Find and Replace text, database sort/validate/index", false), 

		/* B */
		array("bash", "GNU Bourne-Again SHell", false), 
		array("bc", "Arbitrary precision calculator language", false), 
		array("bg", "Send to background", false),  
		array("break", "Exit from a loop", false), 
		array("builtin", "Run a shell builtin", false), 
		array("bzip2", "Compress or decompress named file(s)", false), 

		/* C */
		array("cal", "Display a calendar", true), 
		array("case", "Conditionally perform a command", false), 
		array("cat", "Display the contents of a file", false), 
		array("cd", "Change Directory", false), 
		array("cfdisk", "Partition table manipulator for Linux", false), 
		array("chgrp", "Change group ownership", false), 
		array("chmod", "Change access permissions", false), 
		array("chown", "Change file owner and group", false), 
		array("chroot", "Run a command with a different root directory", false), 
		array("cksum", "Print CRC checksum and byte counts", false), 
		array("clear", "Clear terminal screen", true), 
		array("cmp", "Compare two files", false), 
		array("comm", "Compare two sorted files line by line", false), 
		array("command", "Run a command - ignoring shell functions", false), 
		array("continue", "Resume the next iteration of a loop", false), 
		array("cp", "Copy one or more files to another location", false), 
		array("cron", "Daemon to execute scheduled commands", false), 
		array("crontab", "Schedule a command to run at a later time", false), 
		array("csplit", "Split a file into context-determined pieces", false), 
		array("cut", "Divide a file into several parts", false), 

		/* D */
		array("date", "Display or change the date & time", true), 
		array("dc", "Desk Calculator", false), 
		array("dd", "Convert and copy a file, write disk headers, boot records", false), 
		array("ddrescue", "Data recovery tool", false), 
		array("declare", "Declare variables and give them attributes", false), 
		array("df", "Display free disk space", true), 
		array("diff", "Display the differences between two files", false), 
		array("diff3", "Show differences among three files", false), 
		array("dig", "DNS lookup", false), 
		array("dir", "Briefly list directory contents", true), 
		array("dircolors", "Colour setup for 'ls'", true), 
		array("dirname", "Convert a full pathname to just a path", false), 
		array("dirs", "Display list of remembered directories", false), 
		array("du", "Estimate file space usage", true), 

		/* E */
		array("echo", "Display message on screen", true), 
		array("egrep", "Search file(s) for lines that match an extended expression", false), 
		array("eject", "Eject removable media", false), 
		array("enable", "Enable and disable builtin shell commands", false), 
		array("env", "Environment variables", false), 
		array("ethtool", "Ethernet card settings", false), 
		array("eval", "Evaluate several commands/arguments", false), 
		array("exec", "Execute a command", false), 
		array("exit", "Exit the shell", false), 
		array("expand", "Convert tabs to spaces", false), 
		array("export", "Set an environment variable", false), 
		array("expr", "Evaluate expressions", false), 

		/* F */
		array("false", "Do nothing, unsuccessfully", false), 
		array("fdformat", "Low-level format a floppy disk", false), 
		array("fdisk", "Partition table manipulator for Linux", false), 
		array("fg", "Send job to foreground", false), 
		array("fgrep", "Search file(s) for lines that match a fixed string", false), 
		array("file", "Determine file type", true), 
		array("find", "Search for files that meet a desired criteria", false), 
		array("fmt", "Reformat paragraph text", false), 
		array("fold", "Wrap text to fit a specified width", false), 
		array("for", "Expand words, and execute commands", false), 
		array("format", "Format disks or tapes", false), 
		array("free", "Display memory usage", true), 
		array("fsck", "File system consistency check and repair", false), 
		array("ftp", "File Transfer Protocol", false), 
		array("full", "Switch to full screen display mode", true),
		array("function", "Define Function Macros", false), 

		/* G */
		array("gawk", "Find and Replace text within file(s)", false), 
		array("getopts", "Parse positional parameters", false), 
		array("goto", "Go to the given location (ex: http://google.com)", "true"),
		array("grep", "Search file(s) for lines that match a given pattern", false), 
		array("groups", "Print group names a user is in", true), 
		array("gzip", "Compress or decompress named file(s)", false), 

		/* H */
		array("hash", "Remember the full pathname of a name argument", false), 
		array("head", "Output the first part of file(s)", false), 
		array("history", "Command History", false), 
		array("hostname", "Print or set system name", true), 
		array("help", "Print all commands or print the description of a specific command", true), 

		/* I */
		array("id", "Print user and group id's", true), 
		array("if", "Conditionally perform a command", false), 
		array("ifconfig", "Configure a network interface", false), 
		array("import", "Capture an X server screen and save the image to file", false), 
		array("install", "Copy files and set attributes", false), 

		/* J */
		array("join", "Join lines on a common field", false), 

		/* K */
		array("kill", "Stop a process from running", false), 

		/* L */
		array("less", "Display output one screen at a time", false), 
		array("let", "Perform arithmetic on shell variables", false), 
		array("ln", "Make links between files", false), 
		array("local", "Create variables", false), 
		array("locate", "Find files", false), 
		array("logname", "Print current login name", false), 
		array("login", "Get full shell access", true),
		array("logout", "Exit a login shell", false), 
		array("look", "Display lines beginning with a given string", false), 
		array("lpc", "Line printer control program", false), 
		array("lpr", "Off line print", false), 
		array("lprint", "Print a file", false), 
		array("lprintd", "Abort a print job", false), 
		array("lprintq", "List the print queue", false), 
		array("lprm", "Remove jobs from the print queue", false), 
		array("ls", "List information about file(s)", true), 
		array("lsof", "List open files", false), 

		/* M */
		array("make", "Recompile a group of programs", false), 
		array("man", "Help manual", true), 
		array("mkdir", "Create new folder(s)", false), 
		array("mkfifo", "Make FIFOs (named pipes)", false), 
		array("mkisofs", "Create an hybrid ISO9660/JOLIET/HFS filesystem", false), 
		array("mknod", "Make block or character special files", false), 
		array("more", "Display output one screen at a time", false), 
		array("mount", "Mount a file system", false), 
		array("mtools", "Manipulate MS-DOS files", false), 
		array("mv", "Move or rename files or directories", false), 

		/* N */
		array("netstat", "Networking information", false), 
		array("nice", "Set the priority of a command or job", false), 
		array("nl", "Number lines and write files", false), 
		array("nohup", "Run a command immune to hangups", false), 
		array("nslookup", "Query Internet name servers interactively", false), 
		array("open", "Open a file in its default application", false), 
		array("op", "Operator access", false), 

		/* P */
		array("passwd", "Modify a user password", false), 
		array("paste", "Merge lines of files", false), 
		array("pathchk", "Check file name portability", false), 
		array("ping", "Test a network connection", true), 
		array("popd", "Restore the previous value of the current directory", false), 
		array("pr", "Prepare files for printing", false), 
		array("printcap", "Printer capability database", false), 
		array("printenv", "Print environment variables", false), 
		array("printf", "Format and print data", false), 
		array("ps", "Process status", true), 
		array("pushd", "Save and then change the current directory", false), 
		array("pwd", "Print Working Directory", true), 

		/* Q */
		array("quota", "Display disk usage and limits", false), 
		array("quotacheck", "Scan a file system for disk usage", false), 
		array("quotactl", "Set disk quotas", false), 

		/* R */
		array("ram", "ram disk device", true), 
		array("rcp", "Copy files between two machines", false), 
		array("read", "read a line from standard input", false), 
		array("readonly", "Mark variables/functions as readonly", false), 
		array("renice", "Alter priority of running processes", false), 
		array("remsync", "Synchronize remote files via email", false), 
		array("return", "Exit a shell function", false), 
		array("rm", "Remove files", false), 
		array("rmdir", "Remove folder(s)", false), 
		array("rsync", "Remote file copy (Synchronize file trees)", false), 

		/* S */
		array("screen", "Multiplex terminal, run remote shells via ssh", false), 
		array("scp", "Secure copy (remote file copy)", false), 
		array("sdiff", "Merge two files interactively", false), 
		array("sed", "Stream Editor", false), 
		array("select", "Accept keyboard input", false), 
		array("seq", "Print numeric sequences", true), 
		array("set", "Manipulate shell variables and functions", false), 
		array("sftp", "Secure File Transfer Program", false), 
		array("shift", "Shift positional parameters", false), 
		array("shopt", "Shell Options", true), 
		array("shutdown", "Shutdown or restart linux", false), 
		array("sleep", "Delay for a specified time", false), 
		array("sort", "Sort text files", false), 
		array("source", "Run commands from a file '.'", false), 
		array("split", "Split a file into fixed-size pieces", false), 
		array("ssh", "Secure Shell client (remote login program)", false), 
		array("strace", "Trace system calls and signals", false), 
		array("su", "Substitute user identity", false), 
		array("sudo", "Execute a command as another user", false), 
		array("sum", "Print a checksum for a file", false), 
		array("symlink", "Make a new name for a file", false), 
		array("sync", "Synchronize data on disk with memory", false), 

		/* T */
		array("tail", "Output the last part of files", false), 
		array("tar", "Tape ARchiver", false), 
		array("tee", "Redirect output to multiple files", false), 
		array("tesconnectt", "Evaluate a conditional expression", false), 
		array("time", "Measure Program running time", false), 
		array("times", "User and system times", true), 
		array("touch", "Change file timestamps", false), 
		array("top", "List processes running on the system", false), 
		array("traceroute", "Trace Route to Host", false), 
		array("trap", "Run a command when a signal is set(bourne)", false), 
		array("tr", "Translate, squeeze, and/or delete characters", true), 
		array("true", "Do nothing, successfully", false), 
		array("tsort", "Topological sort", false), 
		array("tty", "Print filename of terminal on stdin", false), 
		array("type", "Describe a command", true), 

		/* U */
		array("ulimit", "Limit user resources", true), 
		array("umask", "Users file creation mask", false), 
		array("umount", "Unmount a device", false), 
		array("unalias", "Remove an alias", false), 
		array("uname", "Print system information", true), 
		array("unexpand", "Convert spaces to tabs", false), 
		array("uniq", "Uniquify files", false), 
		array("unset", "Remove variable or function names", false), 
		array("unshar", "Unpack shell archive scripts", false), 
		array("until", "Execute commands (until error)", false), 
		array("useradd", "Create new user account", false), 
		array("usermod", "Modify user account", false), 
		array("uuencode", "Encode a binary file", false), 
		array("uudecode", "Decode a file created by uuencode", false), 

		/* V */
		array("vdir", "Verbosely list directory contents ('ls -l -b')", true), 
		array("vi", "Text Editor", false), 

		/* W */
		array("watch", "Execute/display a program periodically", false), 
		array("wc", "Print byte, word, and line counts", false), 
		array("whereis", "Report all known instances of a command", true), 
		array("which", "Locate a program file in the user's path", true), 
		array("while", "Execute commands", false), 
		array("who", "Print all usernames currently logged in", false), 
		array("whoami", "Print the current user id and name ('id -un')", true), 
		array("wget", "Retrieve web pages or files via HTTP, HTTPS or FTP", false), 
		array("window", "Switch to window display mode", true),

		/* X */	
		array("xargs", "Execute utility, passing constructed argument list(s)", false), 
		array("yes", "Print a string until interrupted", false), 

		/* OTHERS */
		array(".", "Run a command script in the current shell", false), 
		array("###", "Comment / Remark", false)	

	);



?>