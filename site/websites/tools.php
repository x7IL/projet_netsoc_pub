<?php

function all_websites()
{
    $websites = [];
    foreach (scandir(".") as $ws)
	if (pathinfo($ws, PATHINFO_EXTENSION) == "php" && strncmp($ws, "site", 4) == 0)
	    $websites[] = $ws;
    return ($websites);
}

function pseudorandlist($websites, $seed)
{
    $lst = [];
    $idx = crc32($seed);
    for ($i = 0; $i < count($websites) / 3; ++$i)
    {
	$idx = crc32($idx);
	$tmp = $websites[$idx % count($websites)];
	$lst[$tmp] = $tmp;
    }
    return ($lst);
}

ob_start();
?>
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sagittis eget mi quis consectetur. Vivamus pellentesque, nunc nec sagittis congue, justo nisi maximus purus, a egestas tortor velit sit amet est. Sed placerat ac leo id efficitur. Duis ultricies convallis ipsum, ac lobortis enim. Morbi dapibus volutpat augue, in posuere leo tristique eget. Integer elementum diam eget enim faucibus, sit amet bibendum felis condimentum. Donec vel scelerisque ex. Quisque laoreet justo non eros pellentesque, quis molestie ante semper. Aliquam id commodo risus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse eu auctor leo.

Quisque leo ipsum, pharetra vitae iaculis sed, dapibus quis risus. Nunc tincidunt, nibh ac efficitur vehicula, sem est gravida lectus, at commodo augue sem ut eros. Mauris sagittis mi ut lorem commodo dignissim. Pellentesque convallis odio a tristique placerat. Aliquam blandit leo tortor, id dapibus lorem tristique fermentum. Ut tincidunt ipsum eu rhoncus maximus. Duis elementum lectus lacus, at ornare est fermentum id. Duis in vestibulum mi. Proin elementum hendrerit tortor eu facilisis. Praesent ullamcorper augue vel libero fermentum, vitae euismod massa egestas. Praesent sit amet volutpat tortor, eu lobortis turpis. Nunc arcu elit, aliquam sit amet consectetur vitae, malesuada nec mi. Mauris vestibulum, felis et rhoncus gravida, diam orci tristique est, eget condimentum eros enim eget risus. Integer accumsan est a erat tempus, sed vestibulum nisi euismod. Nulla commodo, purus vitae tristique efficitur, magna magna tempus mauris, varius rutrum arcu metus nec ante.

Vestibulum nisl diam, luctus eu iaculis a, maximus vel nunc. Fusce eu gravida quam. Etiam porttitor molestie consequat. Ut nec rutrum nisl, quis vulputate eros. Cras porta aliquet venenatis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed libero turpis, eleifend nec justo nec, mattis vestibulum velit. Maecenas sollicitudin erat nulla, vitae tincidunt sapien consequat in. Cras ac maximus dolor. In eu purus at justo euismod suscipit vel vitae lectus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Quisque a rutrum magna. Curabitur suscipit, lacus nec congue bibendum, risus arcu iaculis dolor, et vulputate nulla est non enim.

Maecenas at diam neque. Etiam ac ornare nunc. Suspendisse eget mi id risus euismod feugiat sit amet at felis. Quisque metus massa, fringilla eu varius in, cursus id ipsum. Nam non justo aliquet, scelerisque purus nec, lobortis tellus. Vestibulum viverra, felis in imperdiet pretium, libero mi volutpat ligula, in scelerisque magna lectus a arcu. Sed eros sapien, vulputate at nibh ac, ultricies hendrerit nunc. Suspendisse ut tristique purus. Maecenas venenatis turpis sit amet rhoncus pretium. Vivamus lacinia eu ipsum id condimentum. Donec tempus fermentum lectus, ut consequat risus varius et.

Integer iaculis sapien id lobortis pharetra. Curabitur vel orci gravida, iaculis ex quis, ultrices mi. Sed finibus eros eget consequat convallis. Curabitur vehicula imperdiet ultricies. Mauris laoreet, metus nec ultrices ultricies, sem dui volutpat magna, non lobortis erat velit ut sem. Sed vulputate magna sed consectetur consequat. Donec eu dui egestas, viverra nibh sed, posuere neque. Ut ex ligula, semper vitae feugiat sollicitudin, tempus nec velit. Curabitur ultricies interdum purus vitae commodo. Nulla imperdiet velit ex, sit amet posuere nisi maximus vel. Etiam augue urna, efficitur vitae iaculis vestibulum, rhoncus ac tortor. Ut vestibulum vitae metus eget facilisis. Praesent vitae felis non sapien eleifend laoreet et ut nulla. Donec blandit commodo ex, quis dictum nisi fringilla eget. Quisque hendrerit congue urna, eu pulvinar libero pharetra eget. Nam egestas, enim sed imperdiet auctor, mauris mi lacinia ligula, id commodo orci leo tempus urna.
<?php
  $lorem_ipsum = ob_get_clean();
