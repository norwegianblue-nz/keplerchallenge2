<?php

namespace Drupal\plain_time_field\Plugin\DataType;

use Drupal\Core\TypedData\Plugin\DataType\StringData;
use Drupal\plain_time_field\Time;

/**
 * A data type for international standard notation time strings.
 *
 * The plain value of this data type is a time string in international standard
 * notation.
 *
 * @DataType(
 *   id = "time_standard",
 *   label = @Translation("Time")
 * )
 */
class TimeStandard extends StringData {// implements TimeInterface {

  /**
   * {@inheritdoc}
   */

  public function getValue() {
    return $this->value;
  }

  /**
   * {@inheritdoc}
   */
  public function getTime() {
    $time = new Time($this->value);
    return $time;
  }

  /**
   * {@inheritdoc}
   */
  public function setValue($value, $notify = TRUE) {
    $time = new Time($value);
    $this->setTime($time, $notify);
  }

  /**
   * {@inheritdoc}
   */
  public function setTime(Time $time, $notify = TRUE) {
    $this->value = $time->format('H:i:s');
    // Notify the parent of any changes.
    if ($notify && isset($this->parent)) {
      $this->parent->onChange($this->name);
    }
  }

}
