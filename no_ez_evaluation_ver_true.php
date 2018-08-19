<?php

class IEnumerable
{
    public static function map(array $list, callable $func)
    {
        $result = [];
        foreach ($list as $iter) {
            echo 'Map : ' . (string)$iter . PHP_EOL;
            $result[] = $func($iter);
        }

        return $result;
    }

    public static function filter(array $list, callable $func)
    {
        $result = [];

        foreach ($list as $iter) {
            echo 'Filter : ' . (string)$iter . PHP_EOL;
            if ($func($iter)) {
                $result[] = $iter;
            }
        }

        return $result;
    }

    public static function each(array $list, callable $func)
    {
        foreach ($list as $iter) {
            echo 'Each : ' . (string)$iter . PHP_EOL;
            $func($iter);
        }
    }
}

echo 'PHP內存用量 : ' . memory_get_usage() . PHP_EOL;

$nums = [1, 2, 3];
$nums = IEnumerable::map($nums, function ($x) {
    return $x * 3;
});
$nums = IEnumerable::filter($nums, function ($x) {
    return $x%2 == 1;
});
IEnumerable::each($nums, function ($x) {
    echo (string)$x . PHP_EOL;
});

echo 'PHP內存用量 : ' . memory_get_usage() . PHP_EOL;
