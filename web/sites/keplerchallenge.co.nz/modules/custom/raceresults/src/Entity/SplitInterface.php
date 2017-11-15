<?php

namespace Drupal\raceresults\Entity;

use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\Core\Entity\RevisionableInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Split entities.
 *
 * @ingroup raceresults
 */
interface SplitInterface extends RevisionableInterface, RevisionLogInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Split name.
   *
   * @return string
   *   Name of the Split.
   */
  public function getName();

  /**
   * Sets the Split name.
   *
   * @param string $name
   *   The Split name.
   *
   * @return \Drupal\raceresults\Entity\SplitInterface
   *   The called Split entity.
   */
  public function setName($name);

  /**
   * Gets the Split creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Split.
   */
  public function getCreatedTime();

  /**
   * Sets the Split creation timestamp.
   *
   * @param int $timestamp
   *   The Split creation timestamp.
   *
   * @return \Drupal\raceresults\Entity\SplitInterface
   *   The called Split entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Split published status indicator.
   *
   * Unpublished Split are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Split is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Split.
   *
   * @param bool $published
   *   TRUE to set this Split to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\raceresults\Entity\SplitInterface
   *   The called Split entity.
   */
  public function setPublished($published);

  /**
   * Gets the Split revision creation timestamp.
   *
   * @return int
   *   The UNIX timestamp of when this revision was created.
   */
  public function getRevisionCreationTime();

  /**
   * Sets the Split revision creation timestamp.
   *
   * @param int $timestamp
   *   The UNIX timestamp of when this revision was created.
   *
   * @return \Drupal\raceresults\Entity\SplitInterface
   *   The called Split entity.
   */
  public function setRevisionCreationTime($timestamp);

  /**
   * Gets the Split revision author.
   *
   * @return \Drupal\user\UserInterface
   *   The user entity for the revision author.
   */
  public function getRevisionUser();

  /**
   * Sets the Split revision author.
   *
   * @param int $uid
   *   The user ID of the revision author.
   *
   * @return \Drupal\raceresults\Entity\SplitInterface
   *   The called Split entity.
   */
  public function setRevisionUserId($uid);

}
