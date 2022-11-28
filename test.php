<?php

header("Content-type: application/json; charset=utf-8");
$json_params = file_get_contents("php://input");
$json_url = json_decode($json_params);
//echo $jsonAsArray->url;
$json_sujet  = json_decode($json_params, TRUE);

if(!isset($_COOKIE['url']) && !isset($_COOKIE['sujet'])) {
    setcookie("url", htmlspecialchars($json_url->url));
    setcookie("sujet", htmlspecialchars($json_sujet['sujet']));
}
else if(!isset($_COOKIE['url2']) && !isset($_COOKIE['sujet2'])) {
    setcookie("url2", htmlspecialchars($json_url->url));
    setcookie("sujet2", htmlspecialchars($json_sujet['sujet']));
}
else{
    setcookie("url", htmlspecialchars($json_url->url));
    setcookie("sujet", htmlspecialchars($json_sujet['sujet']));
}



?>