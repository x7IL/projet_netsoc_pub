<?php
$title = "Micro-processeur pas cher";
$desc = "Pas les moyens pour un micro processeur? Optez pour un micro-processeur en panne!";

require_once("tools.php");
$colors = ["red", "green", "blue", "teal", "purple", "yellow", "white", "gray"];
$from_color = crc32(__FILE__);
$to_color = crc32($from_color);
$background = crc32($to_color);
$from_color = $colors[$from_color % count($colors)];
$to_color = $colors[$to_color % count($colors)];
$background = "background-image: linear-gradient(".($background % 360)."deg, $from_color, $to_color)";
?>
<html>
    <head>
    <script type="text/javascript" src="../script/test.js"></script>
	<title id = "title"><?=$title; ?></title>
	<meta name="description" content="<?=$desc; ?>" />
    </head>
    <body style="<?=$background; ?>">
	<h1><?=$title; ?></h1>

	<button class="like_button" onclick="requete('site00.php')">
		<span id = "count">0</span> Likes
	</button>
	<p><?=$desc; ?></p>
	<p><?=substr($lorem_ipsum, 0, crc32($background) % strlen($lorem_ipsum)); ?></p>
	<?php foreach (pseudorandlist(all_websites(), __FILE__) as $ws) { ?>
	    <a href="<?=$ws; ?>"><?=$ws; ?></a><br />
	<?php } ?>
    </body>
</html>
