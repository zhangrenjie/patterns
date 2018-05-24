<?php

namespace php_design_patterns\patterns\Chians2;

abstract class Handler
{
    const LEVEL = [
        'one' => 1,
        'two' => 2,
        'three' => 3,
    ];

    protected $nextHandler = null;



}