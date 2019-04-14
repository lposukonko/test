<?php

namespace app\helpers;

/**
 * Helper class for array sorting
 *
 * Class ArraySortHelper
 * @package app\helpers
 */
class ArraySortHelper
{

    /**
     * Sorting array
     *
     * @param $number
     * @param $array
     * @return int
     */
    public static function run ($number, $array): int
    {
        $size = count($array);
        $counter = 0;
        $left_index = 0;
        $right_index = 0;

        for ($i = 0; $i < $size; $i++) {
            if ($left_index + $right_index >= $size) {
                break;
            }

            $left_counter = $counter;
            $right_counter = $counter;
            if ($array[$left_index] === $number) {
                $left_counter++;
            }

            if ($array[$size - $right_index - 1] !== $number) {
                $right_counter++;
            }

            if ($left_counter > $right_counter) {
                $right_index++;
                continue;
            }

            if ($left_counter < $right_counter) {
                $left_index++;
                continue;
            }

            $left_index++;
            $right_index++;
            $counter = $left_counter;
        }

        return $counter ? $left_index : -1;
    }

}