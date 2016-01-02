<?php
if($_GET) {
if(isset($_GET['reset'])){
$sharedoutput = shell_exec('/usr/sbin/routerctrl sharedreset');
$sharedoutput = "<p><pre>$sharedoutput</pre></p>";
}
if(isset($_GET['connect'])){
$sharedoutput = shell_exec('/usr/sbin/routerctrl sharedon');
$sharedoutput = "<p><pre>$sharedoutput</pre></p>";
}
if(isset($_GET['disconnect'])){
$sharedoutput = shell_exec('/usr/sbin/routerctrl sharedoff');
$sharedoutput = "<p><pre>$sharedoutput</pre></p>";
}
if(isset($_GET['on'])){
$routeroutput = shell_exec('/usr/sbin/routerctrl start wlan0 ppp0');
$routeroutput =  "<p><pre>$routeroutput</pre></p>";
}
if(isset($_GET['off'])){
$routeroutput = shell_exec('/usr/sbin/routerctrl stop');
$routeroutput =  "<p><pre>$routeroutput</pre></p>";
}
if(isset($_GET['restart'])){
$routeroutput = shell_exec('/usr/sbin/routerctrl restart wlan0 ppp0');
$routeroutput =  "<p><pre>$routeroutput</pre></p>";
}
if(isset($_GET['powersave'])){
$governorbtnoutput = shell_exec('/usr/sbin/routerctrl powersave');
$governorbtnoutput = "<p><pre>$governorbtnoutput</pre></p>";
}
if(isset($_GET['performance'])){
$governorbtnoutput = shell_exec('/usr/sbin/routerctrl performance');
$governorbtnoutput = "<p><pre>$governorbtnoutput</pre></p>";
}
if(isset($_GET['ondemand'])){
$governorbtnoutput = shell_exec('/usr/sbin/routerctrl ondemand');
$governorbtnoutput = "<p><pre>$governorbtnoutput</pre></p>";
}
if(isset($_GET['reboot'])){
$governorbtnoutput = shell_exec('/usr/sbin/routerctrl getsystem reboot');
$governorbtnoutput = "<p><pre>$governorbtnoutput</pre></p>";
}
if(isset($_GET['poweroff'])){
$governorbtnoutput = shell_exec('/usr/sbin/routerctrl getsystem poweroff');
$governorbtnoutput = "<p><pre>$governorbtnoutput</pre></p>";
}
if(isset($_GET['signal'])){
$output = shell_exec('/usr/sbin/routerctrl getmodem signal full');
echo "Siła sygnału: $output";
return 0;
}
elseif(isset($_GET['ppp'])){
$output = shell_exec('/usr/sbin/routerctrl status shared');
$str = "not connected";
if ($output<$str) $output="<font color=green>połączono</font>";
else $output="<font color=red>rozłączono</font>";
echo "Internet: $output";
return 0;
}
elseif(isset($_GET['router'])){
$output = shell_exec('/usr/sbin/routerctrl status router');
if (!preg_match('/off/',$output)) $output="<font color=green>włączony</font>";
else $output="<font color=red>wyłączony</font>";
echo "$output";
return 0;
}
elseif(isset($_GET['temp'])){
$output = shell_exec('cat /sys/class/thermal/thermal_zone0/temp');
$output=$output / 1000;
$output="<font color=red>$output</font>";
echo "Temperatura: $output";
return 0;
}
elseif(isset($_GET['ram'])){
$output = shell_exec('/usr/sbin/routerctrl getsystem ramusage');
$output="$output";
echo "Użycie RAM: $output";
return 0;
}
elseif(isset($_GET['cpu'])){
$output = shell_exec('/usr/sbin/routerctrl getsystem cpuusage');
$output="$output";
echo "Użycie CPU: $output%";
return 0;
}
elseif(isset($_GET['sharedtraffic'])){
$output = shell_exec('/usr/sbin/routerctrl status sharedtraffic');
$output=explode("/",$output);
echo "&#8595;".$output[0]."/&#8593;".$output[1];
return 0;
}
elseif(isset($_GET['routertraffic'])){
$output = shell_exec('/usr/sbin/routerctrl status routertraffic');
$output=explode("/",$output);
echo "&#8595;".$output[0]."/&#8593;".$output[1];
return 0;
}
} else {
$sharedoutput = "";
$routeroutput =  "";
$governorbtnoutput = "";
}
$outputcpu = shell_exec('/usr/sbin/routerctrl getsystem cpu') / 1000;
$outputram = shell_exec('/usr/sbin/routerctrl getsystem ram');
$outputgpu = shell_exec('/usr/sbin/routerctrl getsystem gpu');
$outputstorage = shell_exec('/usr/sbin/routerctrl getsystem storage');
$outputfreestorage = shell_exec('/usr/sbin/routerctrl getsystem freestorage');
$outputoperator = shell_exec('/usr/sbin/routerctrl getmodem operator');
$outputrouter = shell_exec('/usr/sbin/routerctrl status router');
$outputshared = shell_exec('/usr/sbin/routerctrl status shared');
$phpuname = php_uname();
$uptimeoutput = explode(" ", shell_exec('/usr/sbin/routerctrl getsystem uptime'));
if($uptimeoutput[2] === NULL) { $uptimeoutput[0]=$uptimeoutput[0]." godz. i ".$uptimeoutput[1]." min."; }
elseif($uptimeoutput[1] === NULL) { $uptimeoutput[0]=$uptimeoutput[0]." min."; }
else { $uptimeoutput[0]=$uptimeoutput[0]." dni ".$uptimeoutput[1]." godz. i ".$uptimeoutput[2]." min."; }
$uptimeoutput = "<p>Czas pracy systemu: ".$uptimeoutput[0]."</p>";
$governoroutput = shell_exec('cat /sys/devices/system/cpu/cpu*/cpufreq/scaling_governor');
echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//PL" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Wifi Router Control</title>
    <style type="text/css" media="screen">
  * {
    margin: 0px 0px 0px 0px;
    padding: 0px 0px 0px 0px;
  }

  body, html {
    padding: 3px 3px 3px 3px;

    background-color: #D8DBE2;

    font-family: Verdana, sans-serif;
    font-size: 11pt;
    text-align: center;
  }

  div.main_page {
    position: relative;
    display: table;

    width: 385px;

    margin-bottom: 3px;
    margin-left: auto;
    margin-right: auto;
    padding: 0px 0px 0px 0px;

    border-width: 2px;
    border-color: #212738;
    border-style: solid;

    background-color: #FFFFFF;

    text-align: center;
  }

  div.page_header {
    height: 65px;
    width: 100%;

    background-color: #F5F6F7;
  }

  div.page_header span {
    margin: 15px 0px 0px 0px;

    font-size: 180%;
    font-weight: bold;
  }

  div.page_header img {
    margin: 3px 0px 0px 10px;
    border: 0px 0px 0px;
  }

  div.table_of_contents {
    clear: left;

    min-width: 440px;

    margin: 3px 3px 3px 3px;

    background-color: #FFFFFF;

    text-align: left;
  }

  div.table_of_contents_item {
    clear: left;

    width: 100%;

    margin: 4px 0px 0px 0px;

    background-color: #FFFFFF;

    color: #000000;
    text-align: left;
  }

  div.table_of_contents_item a {
    margin: 6px 0px 0px 6px;
  }

  div.content_section {
    margin: 3px 3px 3px 3px;

    background-color: #FFFFFF;

    text-align: left;
  }

  div.content_section_text {
    padding: 4px 8px 4px 8px;

    color: #000000;
    font-size: 100%;
  }

  div.content_section_text pre {
    margin: 8px 0px 8px 0px;
    padding: 8px 8px 8px 8px;

    border-width: 1px;
    border-style: dotted;
    border-color: #000000;

    background-color: #F5F6F7;

    font-style: italic;
  }

  div.content_section_text p {
    margin-bottom: 6px;
  }

  div.content_section_text li {
    padding: 4px 8px 4px 16px;
  }
   div.content_section_text ul {
    padding: 2px 2px 2px 20px;
  }

  div.section_header {
    padding: 3px 6px 3px 6px;

    background-color: #8E9CB2;

    color: #FFFFFF;
    font-weight: bold;
    font-size: 112%;
    text-align: center;
  }

  div.section_header_red {
    background-color: #CD214F;
  }

  div.section_header_grey {
    background-color: #9F9386;
  }
  div.section_header_green {
    background-color: #9FBB86;
  }

  .floating_element {
    position: relative;
    float: left;
  }

  div.table_of_contents_item a,
  div.content_section_text a {
    text-decoration: none;
    font-weight: bold;
  }

  div.table_of_contents_item a:link,
  div.table_of_contents_item a:visited,
  div.table_of_contents_item a:active {
    color: #000000;
  }

  div.table_of_contents_item a:hover {
    background-color: #000000;

    color: #FFFFFF;
  }

  div.content_section_text a:link,
  div.content_section_text a:visited,
   div.content_section_text a:active {
    background-color: #DCDFE6;

    color: #000000;
  }

  div.content_section_text a:hover {
    background-color: #000000;

    color: #DCDFE6;
  }

  div.validator {
  }
    </style>
	<script type="text/javascript" src="jquery-2.1.4.min.js"></script>
  </head>
  <body>
    <div class="main_page">
      <div class="page_header floating_element">
        <a href=index.php><img src="logo.png" alt="Raspberry Pi Logo" class="floating_element"/></a>
        <span class="page_header floating_element">
		 <a href=index.php style="color: rgb(0,200,255)"><font color="00CCFF">RouterCTRL</font></a>
        </span>
      </div>
      <div class="content_section floating_element">
        <div class="section_header section_header_green">
          Status
        </div>
        <div id="status" class="content_section_text">
<ul><div id="temp"></div></ul>
<ul><div id="cpu"></div></ul>
<ul><div id="ram"></div></ul>
<ul><div id="ppp"></div></ul>
<ul><div id="signal"></div></ul>
        </div>
        <div class="section_header section_header_red">
          Udostępniane połączenie
        </div>';
		/* THIS WAS JUST FOR TESTING 
		<iframe marginwidth="0" marginheight="0" width="333" height="20" scrolling="no" frameborder=0 src="status.php?temp"></iframe>
		 <iframe marginwidth="0" marginheight="0" width="333" height="20" scrolling="no" frameborder=0 src="status.php?cpu"></iframe>
		 <iframe marginwidth="0" marginheight="0" width="333" height="20" scrolling="no" frameborder=0 src="status.php?ram"></iframe>
		 <iframe marginwidth="0" marginheight="0" width="333" height="20" scrolling="no" frameborder=0 src="status.php?ppp"></iframe>
		 <iframe marginwidth="0" marginheight="0" width="333" height="20" scrolling="no" frameborder=0 src="status.php?signal"></iframe>
		*/
if (!preg_match('/not/',$outputshared)) {
	 $tmpbtn = '  
	 <button name="disconnect" type="submit">Rozłącz</button>  
	 <button name="reset" type="submit">Zresetuj</button>';
}
	else {
	 $tmpbtn = '  
	 <button name="connect" type="submit">Połącz</button>  
	 <button name="reset" type="submit">Zresetuj</button>';
	}
echo '<div class="content_section_text">
        <div style="display:table; width:100%;" > 
			<div style="display:table-row">';
echo "			<div style=\"display:table-cell; text-align:left; width:50%;\">
				 <p><i>$outputoperator</i>:
				 <span id='sharedtraffic'></span></p>
				</div>";
echo '			 <div style="display:table-cell; text-align:right; width:25%;">
				 <form action="index.php" method="get">';
echo "$tmpbtn
				</form>
				 </div>";
echo "		</div>
		</div>";
echo " <div>$sharedoutput</div>";
echo '
	  </div>
        <div class="section_header">
           Zarządzanie Router\'em
		</div>';
if (!preg_match('/off/',$outputrouter)) {
	$outputrouter="<font color=green>$outputrouter</font>";
	$tmpbtn = '  
  <button name="off" type="submit">Wyłącz</button>   
  <button name="restart" type="submit">Zrestartuj</button>';
}
	else {
	 $outputrouter="<font color=red>wyłączony</font>";
  	 $tmpbtn = '  
	 <button name="on" type="submit">Uruchom</button>
	 <button name="restart" type="submit">Zrestartuj</button>';
	}
echo '<div class="content_section_text">
		<div style="display:table; width:100%;" > 
			<div style="display:table-row">';
echo "			<div style=\"display:table-cell; text-align:left; width:50%;\">
				 <p>$outputrouter:
				 <span id='routertraffic'></span></p>
				</div>";
echo '			<div style="display:table-cell; text-align:right; width:25%;">
				 <form action="index.php" method="get">';
echo "$tmpbtn
				 </form>
				</div>";
echo "  	</div>
		</div>";
echo "<div>$routeroutput</div>";
echo '
	  </div>
        <div class="section_header">
            <div id="docroot"></div>
                Ustawienie systemu
        </div>
        <div class="content_section_text">';
echo $phpuname;
echo $uptimeoutput;
$ram = $outputram + $outputgpu;
if ($outputram < $outputgpu) $outputramgpu="dynamiczne"; 
else $outputramgpu="$outputram/ $outputgpu";
echo "	 <li>Zegar procesora: $outputcpu Mhz</li>
		 <li>Rozmiar pamięci RAM: $ram</li>
		 <li>Dzielenie pamięci RAM/GPU: $outputramgpu</li>
		 <li>Całkowita pamięć systemu: $outputstorage</li>
		 <li>Wolna pamięć systemu: $outputfreestorage</li>";
echo '	 <p> 
		  <form action="index.php" method="get" style="text-align:center">
			<button name="reboot" type="submit">Zrestartuj system</button> 
			<button name="poweroff" type="submit">Wyłącz system</button>
		  </form>
		 <p>';
if (preg_match('/ondemand/',$governoroutput)) {
	$governoroutput = " <p>Zarządzanie energią procesora: <i>“na żądanie”</i></p>";
	$btntmp ='		 
		 <button name="powersave" type="submit">Oszczędzanie energii</button>  
		 <button name="performance" type="submit">Wysoka wydajność</button>';
}
elseif (preg_match('/powersave/',$governoroutput)) {
	$governoroutput = " <p>Zarządzanie energią procesora: <i>“oszczędzanie”</i></p>";
	$btntmp ='		 
		 <button name="performance" type="submit">Wysoka wydajność</button>   
		 <button name="ondemand" type="submit">Na żądanie</button>';
}
elseif (preg_match('/performance/',$governoroutput)) {
	$governoroutput = " <p>Zarządzanie energią procesora: <i>“wydajność”</i></p>";
	$btntmp ='		 
		 <button name="powersave" type="submit">Oszczędzanie energii</button>  
		 <button name="ondemand" type="submit">Na żądanie</button>';
}
echo $governoroutput;
echo ' <p>
		<form action="index.php" method="get" style="text-align:center">';
echo "$btntmp";
echo '	</form>
	   </p>';
echo "$governorbtnoutput";
echo '
        </div>
      </div>
    </div>
Paweł B. &#169; 2015 GNU General Public License
<script language="javascript" type="text/javascript">
function showstatus() {
$wrap="";
$("#temp").load("index.php?temp",function () {});
$("#cpu").load("index.php?cpu",function () {});
$("#ram").load("index.php?ram",function () {});
$("#ppp").load("index.php?ppp",function () {});
$("#signal").load("index.php?signal",function () {});
$("#sharedtraffic").load("index.php?sharedtraffic",function () {});
$("#routertraffic").load("index.php?routertraffic",function () {});
}
showstatus(); 
setInterval(function(){
showstatus()
}, 5000);
</script>
  </body>
</html>';

?>
