<?php
/**
 * Created by PhpStorm.
 * User: Mibert
 * Date: 15.01.2017
 * Time: 13:35
 */

namespace Date;

/**
 * This class has methods that tranform the timestamp from DB to some easy-reading format of date and time for users
 * @package Date
 */
class DateFormat
{
	/**
	 * This method return the fully formatted string of date to show it to user.
	 * It will be worked in all locales, if your one will have file 'date.php'.
	 * This file return an array, that must have the following keys:
	 *     'minutes_ago', 'hours_ago', 'yesterday' and 'later'.
	 * 		The values have to be a string that you want to show user.
	 * 
	 * @param string $time - the timestamp from DB, but it is presented as a string
	 *
	 * @return string|\Symfony\Component\Translation\TranslatorInterface
	 */
	public static function when($time)
	{
		date_default_timezone_set('Europe/Kiev');
		$timestamp = strtotime($time);        // changing the sting into the timestamp format
		$date = date('Y-m-d', $timestamp);    // need to know the exact date from getted timestamp, without time

		/*
		 * Here is comparing $date(from $timestamp) with some other dates
		 *     to show user 'today' or 'yesterday' instead of 'Y-m-d', if it true of course.
		*/
		switch ($date) {
			/* Comparing with today's date*/
			case date('Y-m-d'):
				$minutes_ago = (int)date('i') - (int)date('i', $timestamp);

				/* Show how many $minutes_ago, if 'hours from current time = hours from $timestamp' is true */
				if (date('H', $timestamp) == date('H')) {
					return trans('date.minutes_ago', ['minutes' => $minutes_ago]);
				}

				/*
				 * So, if hour(s)-1 from current date = hours from timestamp,
				 *     we need to show only how many $minutes_ago.
				 * To do that we need to take(minus) 60minutes from current date(that's why 'current hour(s)-1') and
				 *     plus them to our minutes that are < 0.
				 *
				 * for example:
				 *     Current time         = 15:05
				 *     Time form $timestamp = 14:45
				 * We will show that the difference ($minutes_ago) is 20, not an 1hour - 40 minutes
				 */
				if (date('H', $timestamp) == date('H', strtotime('-1 hour')) && $minutes_ago < 0) {
					return trans('date.minutes_ago', ['minutes' => $minutes_ago + 60]);
				}

				/*From here the difference between hours will be always >=1*/
				$hours_ago = (int)date('H') - (int)date('H', $timestamp);

				/*The same as in previous 'if', but there we need to show how many $hours_ago too*/
				if ($minutes_ago < 0) {
					return trans('date.hours_ago', [
						'hours'   => $hours_ago - 1,
						'minutes' => $minutes_ago + 60
					]);

				/*All 'if' are false, show how many $hours_ago and $minutes_ago*/
				}else {
					return trans('date.hours_ago', [
						'hours'   => $hours_ago,
						'minutes' => $minutes_ago
					]);
				}

			/*Comparing with yesterday's date*/
			case date('Y-m-d', strtotime('-1 day')):
				return trans('date.yesterday', ['time' => date('H:i', $timestamp)]);

			/*In default return full date and time*/
			default:
				$formatted = trans('date.later', [
					'time' => date('H:i', $timestamp),
					'date' => date('d F' . (date('Y', $timestamp) === date('Y') ? null : ' Y'), $timestamp)
				]);
				return strtr($formatted, trans('date.month_declensions'));
		}
	}
}