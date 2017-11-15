<?php

namespace Drupal\plain_time_field;

/**
 * Interface for time.
 *
 * @ingroup typed_data
 */
interface TimeInterface {

  /**
   * Returns the date time object.
   *
   * @return Drupal\time\Time|null
   *   A date object or NULL if there is no date.
   */
  public function getTime();

  /**
   * Sets the date time object.
   *
   * @param Drupal\time\Time $time
   *   An instance of a date time object.
   */
  public function setTime(Time $time, $notify = TRUE);
}
