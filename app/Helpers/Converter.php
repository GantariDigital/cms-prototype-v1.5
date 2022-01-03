<?php

namespace App\Helpers;
use Illuminate\Support\Str;

class Converter
{
    /**
    * @param int $number
    * @return string
    */
    public static function numberToRoman($number) {
        $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }
    public static function formatBytes($size, $precision = 2)
    {
        if ($size > 0) {
            $size = (int) $size;
            $base = log($size) / log(1024);
            $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');
            
            return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
        } else {
            return $size;
        }
    }
    
    public static function pageToOffset($page, $limit)
    {
        return ($page - 1) * $limit;
    }
    
    public static function totalPage($total_data, $limit) {
        return (int) ceil($total_data / $limit);
    }
    
    public static function NumberFormattedAttribute($number, $prefix, $start_length = 3, $end_length = 2)
    {
        $length = Str::length($number);
        $prefix_len = ($length-($start_length+$end_length));
        $prefixes = Str::padBoth('', $prefix_len, $prefix);
        return substr($number, 0, $start_length) . $prefixes . substr($number, (-1*$end_length));
    }
    
    public static function dateToWeekOfMonth($date)
    {
        return self::weekOfMonth($date);
    }
    
    private static function weekOfMonth($date_string) {
        //Get the first day of the month.
        $date = strtotime($date_string);
        $firstOfMonth = strtotime(date("Y-m-01", $date));
        //Apply above formula.
        return self::weekOfYear($date) - self::weekOfYear($firstOfMonth) + 1;
    }
    
    private static function weekOfYear($date) {
        $weekOfYear = intval(date("W", $date));
        if (date('n', $date) == "1" && $weekOfYear > 51) {
            // It's the last week of the previos year.
            return 0;
        }
        else if (date('n', $date) == "12" && $weekOfYear == 1) {
            // It's the first week of the next year.
            return 53;
        }
        else {
            // It's a "normal" week.
            return $weekOfYear;
        }
    }
    
    public static function maskEmail($email) {
        
        function mask($str, $first, $last) {
            $len = strlen($str);
            $toShow = $first + $last;
            return substr($str, 0, $len <= $toShow ? 0 : $first).str_repeat("*", $len - ($len <= $toShow ? 0 : $toShow)).substr($str, $len - $last, $len <= $toShow ? 0 : $last);
        }
        
        $mail_parts = explode("@", $email);
        
        $mail_parts[0] = mask($mail_parts[0], 3, 2); // show first 3 letters and last 2 letter
        
        return implode("@", $mail_parts);
    }
}