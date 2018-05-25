<?php
require "searchServideController.php"
require "urlcheck.php"
require "URLentry.php"
// 1. Check source base
// 2. Check URL
// 3. Check source code of the home page


function checkURL($URLentry){

  $url=$URLentry->URL;

  if(strpos($url, 'forum')==true)
  {
  	return "forum";
  }
  else if(strpos($url, 'blog')==true)
  {
  	return "blog";
  }
  else if(strpos($url, 'review')==true)
  {
  	return "review";
  }

  else
  {
    return "unknown"
  }
}



function metaSearch($URLentry)
{
  $urlEn = $URLentry->URL;
 $UrlEnter = get_meta_tags($urlEn);
 $sourceUrl=file_get_contents($urlEn);
 $url_encoded = htmlentities($sourceUrl);

 $ArrayString = http_build_query($UrlEnter) . "\n";
 if (stripos($ArrayString , "forum")>0)
 {
   return "forum";
 }
 elseif (stripos($ArrayString , "blog")>0)
 {
   return "blog";
 }
 elseif (stripos($ArrayString , "review")>0 || stripos($ArrayString , "rating")>0)
 {
   return "review";
 }
}






function differentiate($URLentry){
  $URLobj = isCrawledByMw($URLentry)
  if($URLobj->type == null)
  {

  }

  }else if(){

  }
return URLentry
}

 ?>
