<?php

ini_set('memory_limit', '1M');

$n = 0;
foreach (getItem() as $key => $value) {
    $n += $value;
}

echo $n;

function getItem()
{
    for ($i=0; $i < 1000000000; $i++) {
        yield $i;
    }
}
