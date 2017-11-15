<?php

namespace Drupal\raceresults\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Race split entities.
 */
class RaceSplitViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.

    return $data;
  }

}
