<?php
	
	require_once('config.php');
	include('dbObject.class.php');
	
	class Shell extends dbObject {
		
		private $_is_private_session;
		//private $_login_name;
		//private $_login_time;
		//private $_host_name;
		private $_is_autocomplete;
		
		function __construct()
		{
			
			parent::__construct();
			
			$this->_is_private_session = false;
			$this->_autocomplete = false;

			$_SESSION['login_time'] = 0;
			$_SESSION['login_name'] = "guest"; //uniqid('guest_');
			$_SESSION['host_name'] = "cheghamwassim.com";

		}
		
		////////////////////////////////////////////////////////////////////////
		// GETTERS
		////////////////////////////////////////////////////////////////////////
		public static function get_login_name()
		{
			return $_SESSION['login_name'];
		}
		
		public static function get_login_time()
		{
			return $_SESSION['login_time'];
		}
		
		public static function get_host_name()
		{
			return $_SESSION['host_name'];
		}
		
		public static function is_autocomplete()
		{
			return $this->_is_autocomplete;
		}
		
		////////////////////////////////////////////////////////////////////////
		// SETTERS
		////////////////////////////////////////////////////////////////////////
		private static function set_login_name( $login )
		{
			$_SESSION['login_name'] = $login;
		}
		
		private static function set_login_time( $time )
		{
			$_SESSION['login_time'] = $time;
		}
		
		public static function set_host_name( $host )
		{
			$_SESSION['host_name'] = $host;
		}
		
		public function set_autocomplete( $auto )
		{
			$this->_is_autocomplete = $auto == "yes" ? true : false;
		}
		
		////////////////////////////////////////////////////////////////////////
		// STATIC
		////////////////////////////////////////////////////////////////////////
		public static function create_window($id="", $title="", $content="", $width="100", $height="100", $css="")
		{
		
			$html = "<div id='".$id."' class='window' style='width:".$width."px;height:".$height."px;left:-".floor($width/2)."px;".$css."' >";
			
				$html .= "<div class='w_top'>\n";
					$html .= "<div class='w_top_left'></div>\n";
					$html .= "<div class='w_top_right'></div>\n";
					$html .= "<div class='w_top_top'>";
						$html .= "<div class='w_close'></div>";
						$html .= "<div class='w_drag'>".$title."</div>";
					$html .= "</div>\n";
				$html .= "</div>\n";
				
				$html .= "<div class='w_middle'>\n";
					$html .= "<div class='w_middle_left'></div>\n";
					$html .= "<div class='w_middle_right'></div>\n";
					$html .= "<div class='w_middle_main'>".$content."</div>\n";
				$html .= "</div>\n";
				
				$html .= "<div class='w_bottom'>\n";
					$html .= "<div class='w_bottom_left'></div>\n";
					$html .= "<div class='w_bottom_right'></div>\n";
					$html .= "<div class='w_bottom_bottom'></div>\n";
				$html .= "</div>\n";
				
			$html .= "</div>\n";
			
			return $html;
		}
		
		////////////////////////////////////////////////////////////////////////
		// PRIVATE
		////////////////////////////////////////////////////////////////////////
		private function _is_valid_cmd($needle, $haystack)
		{
			
			foreach( $haystack as $arr)
			{
				foreach( $arr as $key )
				{
					if ( $needle == $arr[0] ) return true;
				}
			}
			
			return false;
		}
		
		private function _is_public_cmd($needle, $haystack)
		{
			foreach( $haystack as $arr)
			{
				foreach( $arr as $key )
				{
					if ( $needle == $arr[0] and $arr[2] == true ) return true;
				}
			}
			
			return false;
		}
		
		private function _autoComplete($needle)
		{
			global $config;
			$fnd = "";
			
			foreach( $config['valid_cmd'] as $arr)
			{
				if ( preg_match("/^$needle/", $arr[0]) and $arr[2] ) 
					$fnd .= '<span class="command">'.$arr[0]."</span>: ".$arr[1]."\n";
			}
			
			return $fnd;
		}
		
		private function _echo_color($text)
		{
			global $config;
			return  strtr( $text, $config['color_term2html'] );
		} 
		
		////////////////////////////////////////////////////////////////////////
		// PUBLIC
		////////////////////////////////////////////////////////////////////////
		
		// to do : recode this function and use check_user_from_db() inside !!
		public function check_user( $login, $password )
		{
			global $config;
			
			$res = array();
			
			// right login ?
			if ( array_key_exists( $login, $config['users'] ) )
			{
			
				// right password ?
				if ( $config['users'][ $login ] == $password )
				{
					
					// already logged in ?
					if ( $this->is_private_session && $this->login_name == $login )
					{
						
						$res['result'] = "You are already logged in as '".$login."'!";
						$res['status'] = "403";
						
					}
					else {
						
						$json['result'] = "Welcome ".$login.", please have fun!";
						$json['status'] = "200";
						
						//$_SESSION['login_name'] = $login;
						//$_SESSION['login_time'] = time();
						
						$this->is_private_session = true;
						self::set_login_name( $login );
						self::set_login_time( time() );
					
					}
					
				}
				else {
					
					$json['result'] = "Bad password given!";
					$json['status'] = "401";
					
				}
				
			}
			else {
				
				$json['result'] = "Bad login!";
				$json['status'] = "400";
				
			}
			
			$json['user'] = self::get_login_name();
			$json['host'] = self::get_host_name();
			return json_encode( $json );
		}
		
		public function execute($cmd)
		{
			global $config;
			
			$cmd_tmp = $cmd;
			$cmd_split = split(' ', $cmd_tmp);
			$help = split(' ', $cmd_tmp);
			$json = array('result'=>'');
			
			if ( $this->_is_autocomplete )
			{
				// autocomplete command names
				$ac = $this->_autoComplete($help[0]);
				if ( $ac != "" ) $json['result'] = $ac;
				else $json['result'] = "No command found that matches <i><u>".$help[0]."</u></i>";
			}
			else {
	
				
				// the "help" command
				if ( $help[0] == 'help' )
				{
					// all commands
					if ( ! isset( $help[1] ) )
					{
						$str = "";
						foreach( $config['valid_cmd'] as $arr )
						{
							// print out all commands with their help
							if ( $arr[2] == true ) 
								$str .= '<span class="command">'.$arr[0]."</span> : ".$arr[1]."\n";
						}
						$json['result'] = $str;
					}
					// help of a specific command
					else if ( $this->_is_valid_cmd($help[1], $config['valid_cmd']) )
					{
						foreach( $config['valid_cmd'] as $arr )
						{
							if ( $help[1] == $arr[0] )
								$json['result'] = $help[1]." : ".$arr[1]; // print out each command with its help
						}
					}
	
				}
				
				// other commands
				else if ( $cmd_split[0] == "login" ) 
				{
					
					//$json['result'] = Shell::create_window("window-login", "SimpShell Login", "", "300", "100", "top:50px;");
					$json['result'] = "Coming soon ...";
					
				}
				else if ( $cmd_split[0] == "whoami" ) 
				{
					
					$json['result'] = $_SESSION['login_name'];
					
				}
				else if ( strstr($cmd_split[0], '=') or $this->_is_valid_cmd($cmd_split[0], $config['valid_cmd']) )
				{
	
					if ( strstr($cmd_split[0], '=') or $this->_is_public_cmd($cmd_split[0], $config['valid_cmd']) )
					{
	
						if ( strstr($cmd_tmp, '>') or strstr($cmd_tmp, '<') ) 
						{
							$json['result'] = "<span style='color:red;'>Sorry, O/I redirections do not work in DEMO mode!<span>\n";
						}
	
						if ( $cmd_split[0] == 'ls' or $cmd_split[0] == 'dir' or $cmd_split[0] == 'vdir') 
						{
							$cmd_tmp = array_shift($cmd_split).' --color=always '.implode(' ', $cmd_split);
						}
						
						$json['result'] = $this->_echo_color( shell_exec("cd ../WD && ".$cmd_tmp." 2>&1 ") );
					
					}
					else{
						
						$json['result'] = "<span style='color:red;'>You need to login to use this command!<span>\n";
						
						/*
						echo "Available commands:\n";
						foreach( $config['valid_cmd'] as $arr )
						{
							if ( $arr[2] == true ) echo $arr[0]."\n";
						}
						*/
					}
				}
				// invalid command
				else
					$json['result'] = $cmd_split[0]." : Command not valid! Type 'Help' for available commands";
			}
			
			// json response
			$json['command'] = $cmd;
			$json['user'] = self::get_login_name();
			$json['host'] = self::get_host_name();

			return json_encode( $json );
			
		}
	
	}
	
	$Shell = new Shell();
	
?>
