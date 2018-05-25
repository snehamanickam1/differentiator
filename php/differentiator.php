<?php
require "searchServideController.php"
require "urlcheck.php"
require "URLentry.php"
// 1. Check source base
// 2. Check URL
// 3. Check source code of the home page


function checkURL(URLentry){

  $url=URLentry;

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

  }
}



function differentiate(URLentry){
  if(isCrawled(URLentry))
  {

  }else if(checkURL(URLentry)) {

  }else if(){

  }
return URLentry
}

 ?>
