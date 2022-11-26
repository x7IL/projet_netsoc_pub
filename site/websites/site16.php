<?php
$title = "Au site numéro 16";
$desc = "Sautez sur l'occasion de lire cette description suivant le site 15 et - attention, fait exclusif - précédent le site 17.";

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
	<p><?=$desc; ?></p>
	<p><?=substr($lorem_ipsum, 0, crc32($background) % strlen($lorem_ipsum)); ?></p>
	<?php foreach (pseudorandlist(all_websites(), __FILE__) as $ws) { ?>
	    <a href="<?=$ws; ?>"><?=$ws; ?></a><br />
	<?php } ?>
    </body>
</html>
