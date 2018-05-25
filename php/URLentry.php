<?php
class URLentry{
  string URL;
  string type;
  bool crawl;

  URLentry($url){
    this->URL = $url;
    this->type = null;
    this->isCrawled = false;
  }
}
?>
