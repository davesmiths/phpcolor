<?php

class github_davesmiths_phpcolor {

    // Initiate function
    //      $myColour = new Color([0-360],[0-100],[0-100],[0-1]);
    function __construct($h, $s, $l, $a) {
        $this->h = $h;
        $this->s = $s;
        $this->l = $l;
        $this->a = $a;
        $this->cacheHSLA = array();
        $this->cacheHex = array();
    }

    // Output My Colour as a CSS Hex string
    //      $myColour->hex();
    // and desaturate My Colour
    //      $myColour->hex(0,-100,0,0);
    public function hex($h=0, $s=0, $l=0, $a=0) {
        $cacheKey = $h.','.$s.','.$l.','.$a;
        if (isset($this->cacheHex[$cacheKey])) {
            $hex = $this->cacheHex[$cacheKey];
        }
        else {
            $c = $this->normaliseHSLA($h, $s, $l, $a);
            $c = $this->hslToRGB($c[0],$c[1],$c[2]);
            $c = $this->rgbToHex($c[0],$c[1],$c[2]);
            $hex = '#'.$c;
            $this->cacheHex[$cacheKey] = $hex;

        }
        echo $hex;
    }
    // Output My Colour as CSS HSLA
    //      $myColour->hsla();
    // and desaturate My Colour
    //      $myColour->hsla(0,-100,0,0);
    public function hsla($h=0, $s=0, $l=0, $a=0) {

        $cacheKey = $h.','.$s.','.$l.','.$a;
        if (isset($this->cacheHSLA[$cacheKey])) {
            $hsla = $this->cacheHSLA[$cacheKey];
        }
        else {
            $c = $this->normaliseHSLA($h, $s, $l, $a);
            $hsla = 'hsla('.$c[0].','.$c[1].'%,'.$c[2].'%,'.$c[3].')';
            $this->cacheHSLA[$cacheKey] = $hsla;
        }

        echo $hsla;

    }
    // Create a new colour based on My Colour
    //      $newColour = $myColour->create();
    // and desaturate My Colour
    //      $newColour = $myColour->hsla(0,-100,0,0);
    public function create($h=0, $s=0, $l=0, $a=0) {
        $c = $this->normaliseHSLA($h, $s, $l, $a);
        return new color($c[0],$c[1],$c[2],$c[3]);
    }

    // Utility function to normalise the HSLA colour
    //      -1,-1,-1,-1 is normalised to 359,0,0,0
    //      361,101,101,1.1 is normalised to 1,100,100,1
    private function normaliseHSLA($h, $s, $l, $a) {

        $h = $this->h + $h;
        $s = $this->s + $s;
        $l = $this->l + $l;
        $a = $this->a + $a;

        // Hue cycles around so 360 + 10 = 10 and 0 - 10 = 350. s,l and a are limited to their bounds
        if ($h > 360) {$h = $h - 360;} else if ($h < 0) {$h = $h + 360;}
        if ($s > 100) {$s = 100;} else if ($s < 0) {$s = 0;}
        if ($l > 100) {$l = 100;} else if ($l < 0) {$l = 0;}
        if ($a > 1) {$a = 1;} else if ($a < 0) {$a = 0;}

        return array($h, $s, $l, $a);
    }
    // Utility functions to convert hsl to hex
    //     hueToRGB, hslToRGB, rgbToHex
    // Functions are a conversion to PHP from JS at
    //     http://codepen.io/davesmiths/pen/GsLAq
    // which was a conversion from a language given in a Stackoverflow question at
    //     http://stackoverflow.com/questions/2353211/hsl-to-rgb-color-conversion
    //     http://www.w3.org/TR/2011/REC-css3-color-20110607/#hsl-color
    private function hueToRGB($m1, $m2, $h) {
        if ($h < 0) {
            $h += 1;
        }
        else if ($h > 1) {
            $h -= 1;
        }
        if ($h * 6 < 1) {
            $rtn = $m1 + ($m2 - $m1) * $h * 6;
        }
        else if ($h * 2 < 1) {
            $rtn = $m2;
        }
        else if ($h * 3 < 2) {
            $rtn = $m1 + ($m2 - $m1) * (2/3 - $h) * 6;
        }
        else {
            $rtn = $m1;
        }
        return $rtn;
    }
    private function hslToRGB($h,$s,$l) {
        $h = $h / 360;
        $s = $s / 100;
        $l = $l / 100;
        if ($l <= 0.5) {
            $m2 = $l * ($s + 1);
        }
        else {
            $m2 = $l + $s - $l * $s;
        }

        $m1 = $l * 2 - $m2;
        $r = round(255*$this->hueToRGB($m1, $m2, $h + 1/3));
        $g = round(255*$this->hueToRGB($m1, $m2, $h));
        $b = round(255*$this->hueToRGB($m1, $m2, $h - 1/3));
        return array($r,$g,$b);
    }
    private function rgbToHex($r,$g,$b) {
        $r = substr('0'.dechex($r),-2);
        $g = substr('0'.dechex($g),-2);
        $b = substr('0'.dechex($b),-2);
        return $r.$g.$b;
    }

};
?>
