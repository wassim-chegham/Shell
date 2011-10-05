/**
 *	Simple Web Shell
 *	@author chegham wassim
 *	@site http://cheghamwassim.com
 */
$(function() {

	var liste_history = []; // history of commands
	var history_len = liste_history.length;
	var history_index = history_len;
	var tmp_height = $('.window').height();
	var tmp_width = $('.window').width();
	
	function update(yon){
	
		var yes_or_no = yon; // is an update call or an autocomplete one
		var input = $('#c').val();
		var script_url = $('#form_cmd').attr('action'); 

		input = input.split(' ');
		
		// clear command
		if (input[0] == "clear"){
			$('#welcome').empty();
			$('#output').empty();
			$('#c').val('').scrollTop = $('#c').scrollHeight;
		}
		
		// reset command
		else if (input[0] == "reset"){
			liste_history = []; // empty the history
			history_len = 0;
			history_index = 0;
			$('#output').empty();
			$('#c').val('').scrollTop = $('#c').scrollHeight;
		}
		
		// fullscreen mode command
		else if ( input[0] == "full" )
		{
			setFullScreen();
		}
		
		// window mode command
		else if( input[0] == "window" )
		{
			$('.window').removeClass('fullmode').css({'height': tmp_height, 'width': tmp_width});
			$('#c').val('').scrollTop = $('#c').scrollHeight;
		}
		
		// goto command
		else if( input[0] == "goto" )
		{
			if ( input[1] == undefined )
			{
				$('#output').append( generate_div(false, {'command':input.join(' '), 'result':'usage: goto [http://]URL'}) );
				
			}
			else {
	
				var regex = /^http:\/\//;
				if ( regex.test( input[1] ) == false ) input[1] = 'http://'+input[1]; 
				var newWindow = window.open(input[1], '_blank');
				$('.window').removeClass('fullmode').css({'height': tmp_height, 'width': tmp_width});
				$('#c').val('').scrollTop = $('#c').scrollHeight;
				newWindow.focus();
					
			}
			
		}
		
		// login command
		else if ( input[0] == "login" )
		{
			$('#login').val("");
			$('#password').val("");
			$('#response').text("");
			open_login_form();
			$('#output').append( generate_div(false, {'command':input.join(' ')}) );
			$("#c").val('');

		}
		
		// other commands
		else {
		
			$.ajax({
				type: 'post',
				dataType: 'json',
				url : script_url,
				data: 'c='+input.join(' ')+'&a='+yes_or_no,
				beforeSend: function(){
					$('.window').css({'cursor':'wait'});
				},
				success: function(json){
					
						
					$('#output').append( generate_div(false, json) );
					if ( yes_or_no == 'no' ) $("#c").val('');

					liste_history.push( input.join('&nbsp;') );
					history_len++; 	// very important, this reinitializes the history index 
									// to the last element of the history array
					history_index = history_len;

					focus_input();
					$('document').css({'cursor':'default'});
					
				},
				complete: function(){ 
					focus_input();
					$('.window').css({'cursor':'default'});
					
				}
			});
		}
	}

	function check_user()
	{
		var login = $('#login').val();
		var password = $('#password').val();

		var script_url = $('#form_login').attr('action'); 
			$.ajax({
				type: 'post',
				dataType: 'json',
				url : script_url,
				data: 'login='+login+'&password='+password,
				beforeSend: function(){
					$('.window').css({'cursor':'wait'});
				},
				success: function(json){

					$('.window').css({'cursor':'default'});

					if ( json.status == "200" )
					{
						
						close_login_form();
						focus_input();
							$('.input_container .login_name').text(login);
						//$('#output').append( generate_div(false, json) );
						
					}
					else {
						
						switch( json.status )
						{
							case '400': focus_input("#login"); break;
							case '401': focus_input("#password"); break;
						}
						$("div#response").html(json.result);

					}

				}
			});

	}
	
	function setFullScreen()
	{
		$('.window').addClass('fullmode').css({'height': $(document).height(), 'width': $(document).width()+15});
		$('#c').val('').scrollTop = $('#c').scrollHeight;
	}
	
	function generate_div(o_i, obj){
			
			if ( obj.result == null ) obj.result = "";
			if ( obj.user == null ) obj.user = $('.input_container .login_name').text();
			if ( obj.host == null ) obj.host = $('.input_container .host_name').text();
			if ( obj.command == null ) obj.command = "";

			
			var div_output = '';
			div_output += '<!-- the output -->';
			div_output += '<div class="result">';
			div_output += '<pre>';
			
			div_output += obj.result;
			
			div_output += '</pre>';
			div_output += '</div>';
			div_output += '';
			var div_input = '	<!-- the input -->';
			div_input += '	<div class="login">';
			div_input += '		<span class="login_name">'+obj.user+'</span>@<span class="host_name">'+obj.host+'</span>:~$'; 
			div_input += '	</div>';
			div_input += '	<input class="input" name="c" value="'+obj.command+'" type="text" disabled>';
			div_input += '';
	
			if (o_i){
				return "<div>"+div_output+div_input+"</div>";
			}
			else{
				return div_input+div_output;
			}
	}
	
	function focus_input( id ){
		if ( id == undefined ) $('#c').focus();
		else $(id).focus();
	}
	
	function command_history( direction ){
	
			switch(direction){
				case "up":
					if(history_index > 0){
						//console.log("Av - index "+history_index+"\ntaille "+history_len+"\n"+liste_history+"\n"+liste_history[history_index-1]);
						var last_cmd = liste_history[history_index-1]; // get the corresponding command
						$('#c').val( last_cmd ); // set the last command as the new input value
						history_index--;
						//console.log("Ap - index "+history_index+"\ntaille "+history_len+"\n"+liste_history+"\n"+liste_history[history_index-1]);
					}
					break;
				case "down":
					if(history_index < history_len){
						//console.log("Av - index "+history_index+"ls\ntaille "+history_len+"\n"+liste_history+"\n"+liste_history[history_index+1]);
						history_index++;
						var last_cmd = liste_history[history_index]; // get the corresponding command
						$('#c').val( last_cmd ); // set the last command as the new input value
						//console.log("Ap - index "+history_index+"\ntaille "+history_len+"\n"+liste_history+"\n"+liste_history[history_index+1]);
					}
					else {
						$('#c').val('');
					}
					break;
			}
	} 

	function open_login_form()
	{
		$('div#modal').fadeIn('slow', function(){
			$('div#window-login').animate({'top':'50px'});
			focus_input("div#window-login #login");
		});
	}
	
	
	function close_login_form()
	{
		$('div#window-login').animate({'top':'-150px'}, 'slow', '', function(){
			$('div#modal').fadeOut('slow', function(){
				//$('div#window-login').hide();
				focus_input();
			});
		});
	}
	
	

	///////////////////////////////////////////////////////////////////////////
	focus_input();

	$('#c').keypress(function(event){ 
				
		switch(event.keyCode){
			case  13: /* key ENTER */
				// ajax request
				if ( $('#c').val() != '' ) update("no");
				break;
			case  9: /* key TAB */
				// auto complete
				if ( $('#c').val() != '' ) update("yes");
				break;
			case 38:
				// history
				command_history("up");
				break;
			case 40:
				// history
				command_history("down");
				break;
		}
	});

	
	$('#login, #password').keypress(function(event){
		
		/* key ENTER */
		if ( event.keyCode == 13 ) 
		{
			
			if ( $('#login').val() == '' ) 
				focus_input('#login');
			
			else if ( $('#password').val() == '' ) 
				focus_input('#password');
			
			else
				check_user();
		}
		
	});
	

	$(".window:not(div#window-login)").click(function(){ focus_input(); });
		
	$('.w_drag').dblclick(function(){ setFullScreen(); });
	
	
	$('div#window-login div.w_close').live('click', function(){
		
		close_login_form();
		
	});
	
	$('.command').live('click', function(){ $('#c').val( $(this).html() ); });	
	
	/*
	$('.dir').live('click', function(){
		
		$('#c').val( 'ls -l '+$(this).text() );
		$('#form_cmd').submit();
		update('no');
		
	});
	*/
	
	$('form').submit(function () { return false; });
	
	/* UI */
	$('.window')
		.resizable({ containment: 'parent' })
		.draggable({ containment: '#page', handle: '.w_drag' });
	
});
