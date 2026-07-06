<?php

include("config.php");


if (isset($_POST["submit"])){
    if (empty($_POST["link"])){
        echo " ";
    }    
    else {
        $url  = $_POST["link"];

        parse_str(parse_url($url , PHP_URL_QUERY), $query);
        $playlistId = $query['list'];

        $url  = "https://www.googleapis.com/youtube/v3/playlistItems?" . 
        "part=contentDetails" . 
        "&playlistId=".$playlistId . 
        "&maxResults=100" . 
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


        
    }

$urli = "https://www.googleapis.com/youtube/v3/playlists?part=snippet&id=$playlistId&key=$apikey";
$responsei = file_get_contents($urli);
$dati  = json_decode($responsei, true);

$creator = $dati['items'][0]['snippet']['channelTitle'];

$url2 = "https://www.googleapis.com/youtube/v3/playlists?part=contentDetails&id=$playlistId&key=$apikey";

$response2  = file_get_contents($url2);
$data2 = json_decode($response2, true);

$count  = $data2['items'][0]['contentDetails']['itemCount'];

$average  = ($totalsec/60)/$count;
$avgsec = floor(((($totalsec/60)%$count)*60)/$count);

$average  = floor($average);

$mint = floor($totalsec/60);
$mint2 = floor($mint/1.25);
$mint3 = floor($mint/1.5);
$mint4 = floor($mint/1.75);
$mint5 = floor($mint/2);

$hour2  = floor($mint2/60);
$hour3  = floor($mint3/60);
$hour4  = floor($mint4/60);
$hour5  = floor($mint5/60);

$mints2 = $mint2%60;
$mints3 = $mint3%60;
$mints4 = $mint4%60;
$mints5 = $mint5%60;









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
            <p>Video Count is <?php echo "{$count}" ?> </p>
             <p>Average Video Length <?php echo "{$average} minutes {$avgsec} seconds" ?> </p>
             <p>Total Length of Playlist is <?php echo "{$hour} hours {$minutes} minutes {$seconds} seconds";   ?></p>
             <p>Total Length of Playlist at (1.25x) - <?php echo "{$hour2} hours {$mints2} minutes ";   ?></p>
             <p>Total Length of Playlist at (1.50x) - <?php echo "{$hour3} hours {$mints3} minutes";   ?></p>
             <p>Total Length of Playlist at (1.75x) - <?php echo "{$hour4} hours {$mints4} minutes";   ?></p>
             <p>Total Length of Playlist at (2x) - <?php echo "{$hour5} hours {$mints5} minutes ";   ?></p>

        </div>
    </div>
</body>
</html>


