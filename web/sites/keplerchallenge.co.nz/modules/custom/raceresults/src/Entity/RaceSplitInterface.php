<?php

namespace Drupal\raceresults\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Race split entities.
 *
 * @ingroup raceresults
 */
interface RaceSplitInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Race split name.
   *
   * @return string
   *   Name of the Race split.
   */
  public function getName();

  /**
   * Sets the Race split name.
   *
   * @param string $name
   *   The Race split name.
   *
   * @return \Drupal\raceresults\Entity\RaceSplitInterface
   *   The called Race split entity.
   */
  public function setName($name);

  /**
   * Gets the Race split creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Race split.
   */
  public function getCreatedTime();

  /**
   * Sets the Race split creation timestamp.
   *
   * @param int $timestamp
   *   The Race split creation timestamp.
   *
   * @return \Drupal\raceresults\Entity\RaceSplitInterface
   *   The called Race split entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Race split published status indicator.
   *
   * Unpublished Race split are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Race split is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Race split.
   *
   * @param bool $published
   *   TRUE to set this Race split to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\raceresults\Entity\RaceSplitInterface
   *   The called Race split entity.
   */
  public function setPublished($published);

}
