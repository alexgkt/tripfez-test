<?php 

class Test {
    private $data = [
        'first' => 1,
        'second' => 2,
        'third' => 3
    ];
    function __call($name, $args) {
        if (substr($name, 0, 3) == 'get') {
            $match = strtolower(substr($name, 3));
            if (isset($this->data[$match])) {
                return $this->data[$match];
            }
            else {
                return false;
            }
        }
    }
}

$test = new Test();
$test->getFirst(); // returns 1
$test->getSecond(); // returns 2
$test->getFifth(); // returns false;