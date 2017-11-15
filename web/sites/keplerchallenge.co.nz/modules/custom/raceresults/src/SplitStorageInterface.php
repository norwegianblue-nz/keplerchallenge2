<?php

namespace Drupal\raceresults;

use Drupal\Core\Entity\ContentEntityStorageInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\raceresults\Entity\SplitInterface;

/**
 * Defines the storage handler class for Split entities.
 *
 * This extends the base storage class, adding required special handling for
 * Split entities.
 *
 * @ingroup raceresults
 */
interface SplitStorageInterface extends ContentEntityStorageInterface {

  /**
   * Gets a list of Split revision IDs for a specific Split.
   *
   * @param \Drupal\raceresults\Entity\SplitInterface $entity
   *   The Split entity.
   *
   * @return int[]
   *   Split revision IDs (in ascending order).
   */
  public function revisionIds(SplitInterface $entity);

  /**
   * Gets a list of revision IDs having a given user as Split author.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user entity.
   *
   * @return int[]
   *   Split revision IDs (in ascending order).
   */
  public function userRevisionIds(AccountInterface $account);

  /**
   * Counts the number of revisions in the default language.
   *
   * @param \Drupal\raceresults\Entity\SplitInterface $entity
   *   The Split entity.
   *
   * @return int
   *   The number of revisions in the default language.
   */
  public function countDefaultLanguageRevisions(SplitInterface $entity);

  /**
   * Unsets the language for all Split with the given language.
   *
   * @param \Drupal\Core\Language\LanguageInterface $language
   *   The language object.
   */
  public function clearRevisionsLanguage(LanguageInterface $language);

}
