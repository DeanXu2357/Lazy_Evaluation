<?php

class IEnumerable
{
    public static function map(iterable $list, callable $func)
    {
        $result = [];
        foreach ($list as $iter) {
            echo 'Map : ' . (string)$iter . PHP_EOL;
            yield $func($iter);
        }
    }

    public static function filter(iterable $list, callable $func)
    {
        $result = [];

        foreach ($list as $iter) {
            echo 'Filter : ' . (string)$iter . PHP_EOL;
            if ($func($iter)) {
                yield $iter;
            }
        }

        return $result;
    }

    public static function each(iterable $list, callable $func)
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
    return $x % 2 == 1;
});
IEnumerable::each($nums, function ($x) {
    echo (string)$x . PHP_EOL;
});

echo 'PHP內存用量 : ' . memory_get_usage() . PHP_EOL;
