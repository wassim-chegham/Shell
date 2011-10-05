<?php ?>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Choose SimpShell version</title>
    <style type="text/css">
    body{margin:0;padding:0;background:url("http://groovemeisters.com/images/template/background-pattern.jpg") repeat scroll 0 0 transparent}
    div#main{font:1.2em "Verdanna";width:820px;height:200px;position:relative;margin:100px 0 0 50%;left:-410px;text-align:center;}
    a{text-decoration:none;display:block;width:300px;margin:10px;padding:4px 4px 4px 50px;-moz-border-radius:4px;outline:0;color:white;border:10px solid white;-moz-box-shadow:0 0 10px black;position:relative;float:left;}
    a:hover{color:black;}
    a#php{background:#777ADB url(assets/php-logo.gif) no-repeat left center;}
    a#py{background:#E8D415 url(assets/python-logo.png) no-repeat left center;}
    a#back{color:#80bde9;float:none;border:0;display:inline;padding:10px;}
    iframe{border:0;width:100%;height:100%;}
    div#bottom-bar{position:fixed;bottom:0;left:-1px;width:100%;text-align:center;background:#181818;border-top:1px solid gray;-moz-box-shadow:0 0 3px black;}
    div#bottom-bar a{border-width:4px;width:220px;font-size:1em;}
    a#back-bis{width:20px !important;-moz-border-radius:20px !important;background:white;color:black;padding:4px !important;}
    </style>
  </head>
  
  <body>
    
<?php if ( isset($_GET["php"]) or isset($_GET["py"]) ): ?>
<?php
  if ( isset($_GET["php"]) ) $url="php";
  else if ( isset($_GET["py"]) ) $url="py";
?>
    <iframe src="http://apps.<?php echo $url; ?>.cheghamwassim.com/shell/index.<?php echo $url; ?>" ></iframe>    
    <div id="bottom-bar">
      <a id="php" href="?php" title="Launch the PHP SimpShell">Launch PHP SimpShell</a>
      <a id="py" href="?py" title="Launch the PYTHON SimpShell">Launch Python SimpShell</a>
      <a id="back-bis" href="http://cheghamwassim.com/labs/apps" title="Go back to homepage">&rarr;</a>
    </div>      
<?php else: ?>
    <div id="main">
      <a id="php" href="?php" title="Launch the PHP SimpShell">Launch PHP SimpShell</a>
      <a id="py" href="?py" title="Launch the PYTHON SimpShell">Launch Python SimpShell</a>
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <a id="back" href="http://cheghamwassim.com/labs/apps" title="Go back to homepage">Go back to homepage</a>
    </div>    
<?php endif; ?>
  </body>
  
</html>
