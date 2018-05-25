<?php
$urlArray = $_GET['uCheck'];

$test=explode("\n", $urlArray);
for ($i=0; $i < sizeof($test); $i++) { 

echo $test[$i]." -> ";
$today = strtotime("now") * 1000;//date value in milliseconds
$start_date = $today - (30 * 24 * 60 * 60 * 1000);//search last 60 days of data
require_once 'Requests-master/Requests-master/library/Requests.php';//library to connect to the server
Requests::register_autoloader();
//$var = "https://www.zorgkaartnederland.nl/blog/*";
$NewVar = explode("/",$urlArray);
$New = $NewVar[0]."//".$NewVar[2]."/*";
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
                "value": "'.$New.'",
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
$fh_search_service = "http://mag-fh-searchservice.osl.basefarm.net:8080/";
$headers = array('Accept' => 'application/json','content-type' => 'application/json');
$result = Requests::post($fh_search_service, $headers ,$json);//Post request to the server
$myText = serialize($result);//Json object output is serialized
//echo $myText;
//if()
//echo (string) $myText['views']['expressive']['results']['0']['quiddity']['metaData']['provider']['type'];
$myfile = fopen("json_file.txt", "w") or die("Unable to open file!");
    fwrite($myfile, $myText);
    fclose($myfile);
$fname = fopen("json_file.txt","r") or die("Unable to open file!");
    $content=fread($fname,filesize("json_file.txt"));
    //echo $content;
    $del = strstr($content, 'Connection: close');
    $del1=str_replace("Connection: close", "",$del);
    $del2= strstr($del1,'";s:7:"headers";', true);
    $del3= strstr($del2, '{"views');
    //echo $del3;
    $fchange = fopen("json.json","w") or die("Unable to open file!");
    fwrite($fchange, $del3);
    fclose($fchange);
    fclose($fname);
    $str = file_get_contents('json.json');
    $json = json_decode($str, true);
    //echo '<pre>' . print_r($json, true) . '</pre>';
    echo "Vendor ".(string) $json['views']['expressive']['results']['0']['quiddity']['metaData']['provider']['type'];
    if($json['views']['expressive']['results']['0']['quiddity']['metaData']['provider']['type'] =="boardreader" || $json['views']['expressive']['results']['0']['quiddity']['metaData']['provider']['type'] == "omgili" || 
        $json['views']['expressive']['results']['0']['quiddity']['metaData']['provider']['type'] == "mw" || 
        $json['views']['expressive']['results']['0']['quiddity']['metaData']['provider']['type'] == "ir" || 
        $json['views']['expressive']['results']['0']['quiddity']['metaData']['provider']['type']== "webhose")
    {
        if ($json['views']['expressive']['results']['0']['quiddity']['metaData']['provider']['type'] == "omgili" || 
            $json['views']['expressive']['results']['0']['quiddity']['metaData']['provider']['type'] == "webhose") 
        {
            echo " /Forum";
        }
        elseif ($json['views']['expressive']['results']['0']['quiddity']['metaData']['provider']['type'] == "boardreader") 
        {
            echo " /Review Site";
        }
        elseif ($json['views']['expressive']['results']['0']['quiddity']['metaData']['provider']['type'] == "mw" || 
            $json['views']['expressive']['results']['0']['quiddity']['metaData']['provider']['type'] == "ir") 
        {
            echo " /Blog";
        }
    }
    else
    {
        echo "N/A";
    }
}
?>