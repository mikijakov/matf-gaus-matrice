<?php
class gausova_eliminacija
{
    public function __construct() {
        return $this;
    }
    public function izracunaj($A, $x)
    {
        // Spaja u jednu matricu kombinovano
        for ($i = 0; $i < count($A); $i++) {
            $A[$i][] = $x[$i];
        }
        $n = count($A);
        for ($i = 0; $i < $n; $i++) {
            // U i koloni trazi maksimum
            $maxEl  = abs($A[$i][$i]);
            $maxRed = $i;
            for ($k = $i + 1; $k < $n; $k++) {
                if (abs($A[$k][$i]) > $maxEl) {
                    $maxEl  = abs($A[$k][$i]);
                    $maxRed = $k;
                }
            }
            // Kolonu po kolonu menja maksimalnu sa trenutnom u petlji
            for ($k = $i; $k < $n + 1; $k++) {
                $tmp            = $A[$maxRed][$k];
                $A[$maxRed][$k] = $A[$i][$k];
                $A[$i][$k]      = $tmp;
            }
            for ($k = $i + 1; $k < $n; $k++) {
                $c = -$A[$k][$i] / $A[$i][$i];
                for ($j = $i; $j < $n + 1; $j++) {
                    if ($i == $j) {
                        $A[$k][$j] = 0;
                    } else {
                        $A[$k][$j] += $c * $A[$i][$j];
                    }
                }
            }
        }
        // Resava jednacinu
        $x = array_fill(0, $n, 0);
        for ($i = $n - 1; $i > -1; $i--) {
            if($A[$i][$i] == 0 && (count($A[$i]) != count(array_keys($A[$i], '0')))){
                return "Sistem nema rešenja";
            }
            else if (count($A[$i]) == count(array_keys($A[$i], '0'))) {
                return "Sistem ima beskonačno mnogo rešenja";
            }
            else if (($A[$i][$n] == 0) && ($A[$i][$i] < 0)){
                $x[$i] = 0;
            }
            else {
                $x[$i] = $A[$i][$n] / $A[$i][$i];
                for ($k = $i - 1; $k > -1; $k--) {
                    $A[$k][$n] -= $A[$k][$i] * $x[$i];
                }
            }
        }
        return $x;
    }
}