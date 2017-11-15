<?php

namespace Drupal\plain_time_field;

use Drupal\Core\Datetime\DrupalDateTime;

/**
 * Wraps DrupalDateTime().
 *
 * This class extends the basic component and adds in Drupal-specific
 * handling, like translation of the format() method.
 *
 * Static methods in base class can also be used to create DrupalDateTime objects.
 * For example:
 *
 * DrupalDateTime::createFromArray( array('year' => 2010, 'month' => 9, 'day' => 28) )
 *
 * @see \Drupal/Component/Datetime/DateTimePlus.php
 */
class Time {

  const YEAR_INT = 2000;
  const MONTH_INT = 01;
  const DAY_INT = 01;
  const YEAR = '2000';
  const MONTH = '01';
  const DAY = '01';
  const YEAR_ESCAPED = '\2\0\0\0';
  const MONTH_ESCAPED = '\0\1';
  const DAY_ESCAPED = '\0\1';

  /**
   *
   * @var DrupalDateTime
   */
  private $drupalDateTime;

  public function __construct($time = 'now', $settings = []) {
    // Reset all dates to 2000-01-01 and timezone to UTC.
    $dateTime = new \DateTime($time);
    $dateTime->setDate(self::YEAR_INT, self::MONTH_INT, self::DAY_INT);
    $timeString = $dateTime->format("Y-m-d H:i:s");
    $drupalDateTimeTemp = DrupalDateTime::createFromFormat("Y-m-d H:i:s", $timeString, new \DateTimeZone("UTC"), $settings);

    if (empty($drupalDateTimeTemp->errors)) {
      /* @var $drupalDateTime Drupal\Core\Datetime\DrupalDateTime */
      $this->drupalDateTime = $drupalDateTimeTemp;
    }
  }

  public function toDrupalDateTime() {
    return $this->drupalDateTime;
  }

  public function format($format, $settings = []) {
    $format = $this->adaptTimeFormat($format);
    return $this->drupalDateTime->format($format, $settings);
  }

  private function adaptTimeFormat($format) {
    // Since this is a time field, we are eliminating all the date and timezone formats.
    $format = preg_replace('/(?<!\\\\)([dDJlNSwzWFmMntLoYyeIOPTZcrU])/', "", $format);
    // The regexp could have left multiple spaces or spaces at the start or end of the string. Let's fix this.
    $format = trim($format);
    $format = preg_replace('!\s+!', ' ', $format);
    return $format;
  }

}
