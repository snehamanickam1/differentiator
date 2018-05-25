<?php
require_once 'Requests-master/Requests-master/library/Requests.php';//library to connect to the server
require "/URLentry.php"


function isCrawledByMw(URLentry){

$url = URLentry->URL;
$test=explode("\n", $urlArray);

    echo $test[$i]." -> ";
    $today = strtotime("now") * 1000;//date value in milliseconds
    $start_date = $today - (30 * 24 * 60 * 60 * 1000);//search last 60 days of data
    Requests::register_autoloader();

    $fullURL = "https://".$url."/*";
    //Json query to the server
    $json='{
        "query": {
            "type": "all",
            "allQueries": [
                {
                    "field": "body.publishDate.date",
                    "from": '.($start_date).',
                    "to": '.($today).',
                    "includeFrom": true,
                    "includeTo": false,
                    "type": "range"
                },
    			{
                    "field": "metaData.url",
                    "value": "'.$fullURL.'",
                    "type": "wildcard"
                }
            ]
        },
        "overlayGroups": [],
        "viewRequests": {
            "expressive": {
                "fields": [

             "enrichments.categories",
     		"id",
     		"metaData.provider.type",
             "metaData.source.mediaType",
             "metaData.source.socialOriginType"
                 ],
                 "type": "sortedResultList",
                 "size": 10,
                 "start": 0,
                 "sortDirectives": [
                     {
                         "script": "(10 + .enrichments.comscoreUniqueVisitors) * .enrichments.sentiment.numeric",
                         "sortOrder": "DESC"
                     }
                 ]

             }
         }
     }
     ';
    $headers = array('Accept' => 'application/json','content-type' => 'application/json');
    $fh_search_service = "http://mag-fh-searchservice.osl.basefarm.net:8080/";

    $result = Requests::post($fh_search_service, $headers ,$json);//Post request to the server

    $json = json_decode($result, true);
    if(sizeof($json['views']['expressive']['results']) > 0){
        switch($json['views']['expressive']['results']['0']['quiddity']['metaData']['provider']['type']){
          case "boardreader":{
            URLentry->type = "review";
          }
          case "mw":{
            URLentry->type = "blog";
          }
          case "ir":{
            URLentry->type = "beview";
          }
          case "webhose":{
            URLentry->type = "forum";
          }
          default:{
            URLentry->type = "unknown";
          }
        }
}
return (URLentry)
}

?>
