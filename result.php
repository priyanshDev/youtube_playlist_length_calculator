<?php

include("config.php");


if (isset($_POST["submit"])){
    if (empty($_POST["link"])){
        echo "pls enter a valid link";
    }    
    else {
        $url  = $_POST["link"];
        parse_str(parse_url($url , PHP_URL_QUERY), $query);
        $playlistId = $query['list'];

        $url  = "https://www.googleapis.com/youtube/v3/playlistItems?" . 
        "part=contentDetails" . 
        "&playlistId=".$playlistId . 
        "&maxResults=50" . 
        "&key=".$apikey;





$response = file_get_contents($url);

$data = json_decode($response, true);
$videosId = [];
foreach($data['items'] as $items){
    $videosId[] = $items['contentDetails']['videoId'];
}

$ids  = implode("," ,$videosId);

$url  = $url = "https://www.googleapis.com/youtube/v3/videos?part=contentDetails&id=$ids&key=$apikey";


$ch  = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response  = curl_exec($ch);
curl_close($ch);


$data  = json_decode($response, true);

$totalsec = 0;

foreach($data['items'] as $videos){
    $duration  = $videos['contentDetails']['duration'];
    $interval = new DateInterval($duration);
    $seconds  = $interval->h*3600 + $interval->i*60+$interval->s;
    $totalsec += $seconds;
}

$hour  = floor($totalsec/3600);
$minutes  = floor(($totalsec%3600)/60);
$seconds  =  floor($totalsec%60);

echo "Total youtube playlist time is: {$hour} 
        hours {$minutes} minutes {$seconds} seconds";
        
    }

$urli = "https://www.googleapis.com/youtube/v3/playlists?part=snippet&id=$playlistId&key=$apikey";
$responsei = file_get_contents($urli);
$dati  = json_decode($responsei, true);

$creator = $dati['items'][0]['snippet']['channelTitle'];









}









?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="result">
            <p>Creator is <?php echo "{$creator }" ?> </p>
            <p>Video Count is <?php echo "loda" ?> </p>
        </div>
    </div>
</body>
</html>


<!-- // Playlist name 
// creator 
// video count 
// Average video length 
// Total length
// at 1.25
// at 1.5
// at 1.75
// at 2x  -->