<?php
/**
 * Created by PhpStorm.
 * User: Riz
 * Date: 01/01/2019
 * Time: 15:41
 */

namespace App;


class Math
{
    // ... is the so called "splat" operator. Basically that thing translates to "any number of arguments"
    public function add(...$nums)
    {
        return array_sum($nums);
    }
}