<?php
class TestUtils
{

	public static function generateNumber($digits)
	{
		$min = 1 . str_repeat(0, $digits - 1);
		$max = str_repeat(9, $digits);
		return mt_rand($min, $max);
	}

	public static function generateAlphanumericString($length)
	{
		$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
		$output = "";
		while ($length > 0)
		{
			$shuffled = str_shuffle($chars);
			$output .= $shuffled[0];
			$length--;
		}
		return $output;
	}
}