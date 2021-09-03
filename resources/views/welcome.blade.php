<?php
function calculate($x,$y){
    for ($i=0; $i<$x; $i++){
        echo $i;
        for ($j=0; $j<$y; $j++){
            echo $j*$i;
        }
    }
}
calculate(1000,2000);
?>
