<?php

class IEnumerable
{
    private $list;

    public function __construct(Array $list)
    {
        $this->list = $list;
    }

    public function map(callable $func)
    {
        $result = [];
        foreach ($this->list as $iter) {
            echo 'Map : ' . (string)$iter . PHP_EOL;
            $result[] = $func($iter);
        }

        return new self($result);
    }

    public function filter(callable $func)
    {
        $result = [];

        foreach ($this->list as $iter) {
            echo 'Filter : ' . (string)$iter . PHP_EOL;
            if ($func($iter)) {
                $result[] = $iter;
            }
        }

        return new self($result);
    }

    public function each(callable $func)
    {
        foreach ($this->list as $iter) {
            echo 'Each : ' . (string)$iter . PHP_EOL;
            $func($iter);
        }
    }
}

echo 'PHP內存用量 : ' . memory_get_usage() . PHP_EOL;

$nums = new IEnumerable([1, 2, 3]);
$nums->map(function ($item) {
    return $item*3;
})
->filter(function ($item) {
    return $item%2 == 1;
})
->each(function ($item) {
    echo $item . PHP_EOL;
});

echo 'PHP內存用量 : ' . memory_get_usage() . PHP_EOL;

