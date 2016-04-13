<?php

//$path="e:/Sites/eShiaNew/Data/Feqh/Archive";

$path=".";

if(isset($_POST["type"]))
	setcookie("typeCookie",$_POST["type"]);

if(isset($_POST["order"]))
	setcookie("orderCookie",$_POST["order"]);
$dirCookieValue="";
if(isset($_COOKIE["dirCookie"]))
	$dirCookieValue=$_COOKIE["dirCookie"];
if(isset($_POST["dir"]))
	$dirCookieValue=$_POST["dir"];





if(isset($_COOKIE["typeCookie"]))
	$typeCookieValue=$_COOKIE["typeCookie"];



echo '<html dir=rtl><head>
		<link href="./reporttable.css" rel="stylesheet" type="text/css"/>
		<title>نمایش دایرکتوری</title></head><body><div id="content">
		<div class="wrap"><div class="reporthead">
		<form method="post" action="#">
		<input name="dir" type=text placeholder="دایرکتوری را وارد نمایید" value='.$dirCookieValue.'>
		&nbsp;<select name="order">';
		if(isset($_POST["type"]))
		{	
		if ($_POST["order"]=="ASC")
			echo '<option value="ASC" Selected=true>صعودی</option>';
		else
			echo '<option value="ASC">صعودی</option>';
		
		if ($_POST["order"]=="DES")
			echo '<option value="DES" Selected=true>نزولی</option>';
		else
			echo '<option value="DES">نزولی</option>';
		}
		else
		{
		echo '
		<option value="ASC">صعودی</option>
		<option value="DES">نزولی</option>
		';
		}
		echo '</select>
		&nbsp;
		<select name="type">';
		
		if(isset($_POST["type"]))
		{	
		if ($_POST["type"]=="/voice/")
			echo '<option value="/voice/" Selected=true>صوت</option>';
		else
			echo '<option value="/voice/">صوت</option>';
		
		if ($_POST["type"]=="/text/")
			echo '<option value="/text/" Selected=true>متن</option>';
		else
			echo '<option value="/text/">متن</option>';
		
		if ($_POST["type"]=="/_word/")
			echo '<option value="/_word/" Selected=true>word</option>';
		else
			echo '<option value="/_word/">word</option>';
		
		if ($_POST["type"]=="/_subject/")
			echo '<option value="/_subject/" Selected=true>موضوع</option>';
		else
			echo '<option value="/_subject/">موضوع</option>';
	}
	else
	{
		echo '<option value="/voice/">صوت</option>
		<option value="/text/">متن</option>
		<option value="/_word/">word</option>
		<option value="/_subject/">موضوع</option>
		';
	}
		echo '
		
		</select>
		
		&nbsp; 
		<input type="submit" value="نمایش فایل ها">
		</form></div>
		';
if(isset($_POST["type"]) && isset($_POST["dir"]))
		echo "<label dir=ltr>".$path.$_POST["type"].$_POST["dir"]."</label>";
		$output=array();
		
if(isset($_POST["dir"]))
{
	// صوت
	if(isset($_POST["type"]))
	{
	if($_POST["type"]=="/voice/")
	{
	$path=$path.$_POST["type"];
	setcookie("dirCookie",$_POST["dir"]);
	
	if ($_POST["dir"]<>"" && file_exists($path.$_POST["dir"]))
	{
		
		
		if ($handle = opendir($path.$_POST["dir"])) {
		echo "<h3>نمایش پوشه : ".$_POST["dir"]."<br></h3>";
		echo '<center><table width=100% dir=ltr><tr><th>File Name</th><th>File Size</th><th>Last Modified </th></tr>';
		while (false !== ($entry = readdir($handle))) {

			if ($entry != "." && $entry != "..") {
				$fileSize=filesize($path.$_POST["dir"]."/".$entry);


				$tblLine="<tr><td>&nbsp;$entry&nbsp;</td><td>&nbsp;".$fileSize."&nbsp;Byte</td><td>&nbsp;".date ("Y / m / d H:i:s.",filemtime($path.$_POST["dir"]."/".$entry))."&nbsp;</td></tr>";
				array_push($output,$tblLine);
			}
		}
		
		closedir($handle);
		}
		$len=count($output);
		echo "<h3>تعداد فایل : ".$len."</h3><br>";
		
		if(isset($_POST["order"]))
		{
		if($_POST["order"]=="ASC")
		{
			for($i=0;$i<$len;$i+=1)
				echo $output[$i];
		}
		else 
		{
			for($i=$len-1;$i>=0;$i-=1)
				echo $output[$i];
		}
		}
		echo "</table></center>";
	}
	else
	{
		echo "پوشه مورد نظر وجود ندارد";
	}
	}
	}
	// متن
	
	if(isset($_POST["type"]))
	{
	if($_POST["type"]=="/text/")
	{
	$path=$path.$_POST["type"];
	setcookie("dirCookie",$_POST["dir"]);
	
	if ($_POST["dir"]<>"" && file_exists($path.$_POST["dir"]))
	{
		
		
		if ($handle = opendir($path.$_POST["dir"])) {
		echo "<h3>نمایش پوشه : ".$_POST["dir"]."<br></h3>";
		echo '<center><table width=100% dir=ltr><tr><th>File Name</th><th>File Size</th><th>Last Modified </th></tr>';
		while (false !== ($entry = readdir($handle))) {

			if ($entry != "." && $entry != "..") {
				if(file_exists($path.$_POST["dir"]."/".$entry."/dafault.htm"))
					$fileSize=filesize($path.$_POST["dir"]."/".$entry."/dafault.htm");
				else
					$fileSize=0;
				$tblLine="<tr><td>&nbsp;$entry&nbsp;</td><td>&nbsp;".$fileSize."&nbsp;Byte</td><td>&nbsp;".date ("Y / m / d H:i:s.",filemtime($path.$_POST["dir"]."/".$entry))."&nbsp;</td></tr>";
				array_push($output,$tblLine);
				
			}
		}
		
		closedir($handle);
		}
		$len=count($output);
		echo "<h3>تعداد فایل : ".$len."</h3><br>";
		
		if(isset($_POST["order"]))
		{
		if($_POST["order"]=="ASC")
		{
			for($i=0;$i<$len;$i+=1)
				echo $output[$i];
		}
		else 
		{
			for($i=$len-1;$i>=0;$i-=1)
				echo $output[$i];
		}
		}
		echo "</table></center>";
	}
	else
	{
		echo "پوشه مورد نظر وجود ندارد";
	}
	}
	}
	
	// word
	$path=$path.$_POST["type"];
	if(isset($_POST["type"]))
	{
	if($_POST["type"]=="/_word/")
	{
	setcookie("dirCookie",$_POST["dir"]);
	
	if ($_POST["dir"]<>"" && file_exists($path.$_POST["dir"]))
	{
		
		
		if ($handle = opendir($path.$_POST["dir"])) {
		echo "<h3>نمایش پوشه : ".$_POST["dir"]."<br></h3>";
		echo '<center><table width=100% dir=ltr><tr><th>File Name</th><th>File Size</th><th>Last Modified </th></tr>';
		while (false !== ($entry = readdir($handle))) {

			if ($entry != "." && $entry != "..") {
				$fileSize=filesize($path.$_POST["dir"]."/".$entry);
				
				
				$tblLine="<tr><td>&nbsp;$entry&nbsp;</td><td>&nbsp;".$fileSize."&nbsp;Byte</td><td>&nbsp;".date ("Y / m / d H:i:s.",filemtime($path.$_POST["dir"]."/".$entry))."&nbsp;</td></tr>";
				array_push($output,$tblLine);
			}
		}
		
		closedir($handle);
		}
		$len=count($output);
		echo "<h3>تعداد فایل : ".$len."</h3><br>";
		
		if(isset($_POST["order"]))
		{
		if($_POST["order"]=="ASC")
		{
			for($i=0;$i<$len;$i+=1)
				echo $output[$i];
		}
		else 
		{
			for($i=$len-1;$i>=0;$i-=1)
				echo $output[$i];
		}
		}
		echo "</table></center>";
	}
	else
	{
		echo "پوشه مورد نظر وجود ندارد";
	}
	}
	}
	
	// subject
	
	if(isset($_POST["type"]))
	{
	if($_POST["type"]=="/_subject/")
	{
		$path=$path.$_POST["type"];
	setcookie("dirCookie",$_POST["dir"]);
	
	if ($_POST["dir"]<>"" && file_exists($path.$_POST["dir"]))
	{
		
		
		if ($handle = opendir($path.$_POST["dir"])) {
		echo "<h3>نمایش پوشه : ".$_POST["dir"]."<br></h3>";
		echo '<center><table width=100% dir=ltr><tr><th>File Name</th><th>File Size</th><th>Last Modified </th></tr>';
		while (false !== ($entry = readdir($handle))) {

			if ($entry != "." && $entry != "..") {
				$fileSize=filesize($path.$_POST["dir"]."/".$entry);
				
				
				$tblLine="<tr><td>&nbsp;$entry&nbsp;</td><td>&nbsp;".$fileSize."&nbsp;Byte</td><td>&nbsp;".date ("Y / m / d H:i:s.",filemtime($path.$_POST["dir"]."/".$entry))."&nbsp;</td></tr>";
				array_push($output,$tblLine);
			}
		}
		
		closedir($handle);
		}
		$len=count($output);
		echo "<h3>تعداد فایل : ".$len."</h3><br>";
		
		if(isset($_POST["order"]))
		{
		if($_POST["order"]=="ASC")
		{
			for($i=0;$i<$len;$i+=1)
				echo $output[$i];
		}
		else 
		{
			for($i=$len-1;$i>=0;$i-=1)
				echo $output[$i];
		}
		}
		echo "</table></center>";
	}
	else
	{
		echo "پوشه مورد نظر وجود ندارد";
	}
	}
	}
}
echo "</div></div></body></html>";
?>