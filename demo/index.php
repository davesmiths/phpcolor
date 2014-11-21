<?php

// Some work required on this demo ;)

// Include the class
include_once '../phpcolor.src.php';

// Use a friendlier class name
class_alias('github_davesmiths_phpcolor', 'Color');

// Create a blank colour to set to whatever you want
$colour = new Color(0,0,0,0);

$pri = new Color(0,50,50,1);
echo $pri->hsla().'<br />';
echo $pri->hsla().'<br />';
echo $pri->hex().'<br />';
echo $pri->hex().'<br />';
echo $pri->hsla(0,-100,0,-0.5).'<br />';
echo $pri->hex(0,-100,0,-0.5).'<br />';
$sec = $pri->create(0,-100,0,-0.25);
echo $colour->hsla(-1,200,200,1);
echo $colour->hex(200,50,50,1);
?>

<style>
.b1 {background:<?php $pri->hsla();?>;}
.b2 {background:<?php $pri->hsla(50,50,10);?>;}
.b3 {background:<?php $sec->hsla(100,50,10,-.5);?>;}
.b4 {background:<?php $pri->hsla();?>;}
.b5 {background:<?php $colour->hsla(100,100,50,1);?>;}
.b6 {background:<?php $colour->hex(100,0,50,1);?>;}
.bob {background:<?php $pri->hex();?>;background:<?php $pri->hsla();?>;}
<?php
$sec = $pri->create(0,-100,0,0); // desaturates the colour
?>
.bob {background:<?php $pri->hex();?>;background:<?php $pri->hsla();?>;}
</style>
<p class="b1">Hello</p>
<p class="b2">Hello</p>
<p class="b3">Hello</p>
<p class="b4">Hello</p>
<p class="b5">Hello</p>
<p class="b6">Hello</p>
<p class="b7">Hello</p>
<p class="b8">Hello</p>
<p class="b9">Hello</p>
