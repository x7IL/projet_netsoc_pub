<?php
$title = "Perri-Air - Made in Druidia";
$desc = "Si vous aussi, vous ne manquez absolument pas d'air mais habitez la planète spaceball, optez pour une canette de Perri-Air.";

require_once("tools.php");
$colors = ["red", "green", "blue", "teal", "purple", "yellow", "white", "gray"];
$from_color = crc32(__FILE__);
$to_color = crc32($from_color);
$background = crc32($to_color);
$from_color = $colors[$from_color % count($colors)];
$to_color = $colors[$to_color % count($colors)];
$background = "background: linear-gradient(".($background % 360)."deg, $from_color, $to_color)";
?>
<html>
    <head>
	<title><?=$title; ?></title>
	<meta name="description" content="<?=$desc; ?>" />
    </head>
    <body style="<?=$background; ?>">
	<h1><?=$title; ?></h1>

	<iframe width="560" height="315" src="https://www.youtube.com/embed/Hw0RDzUsWtA?start=853" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

	<p><?=$desc; ?></p>
	<p><?=substr($lorem_ipsum, 0, crc32($background) % strlen($lorem_ipsum)); ?></p>
	<?php foreach (pseudorandlist(all_websites(), __FILE__) as $ws) { ?>
	    <a href="<?=$ws; ?>"><?=$ws; ?></a><br />
	<?php } ?>
    </body>
</html>
