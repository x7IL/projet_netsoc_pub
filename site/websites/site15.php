<?php
$title = "Ombre en boite";
$desc = "Boite de conserve enfermant une authentique ombre. Attention à bien ouvrir la conserve dans l'obscurité afin de la conserver à l'interieur.";

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
