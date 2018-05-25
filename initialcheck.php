<?php

$url="http://my.chinacars.com/";

if(strpos($url, 'forum')==true)
{
	echo "page is forum";
}
else if(strpos($url, 'blog')==true)
{
	echo "page is blog";
}
else if(strpos($url, 'review')==true)
{
	echo "page is a review site";
}

else
{
	include 'main.php';
}

?>