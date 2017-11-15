<?php

namespace Drupal\raceresults;

use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
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
class SplitStorage extends SqlContentEntityStorage implements SplitStorageInterface {

  /**
   * {@inheritdoc}
   */
  public function revisionIds(SplitInterface $entity) {
    return $this->database->query(
      'SELECT vid FROM {split_revision} WHERE id=:id ORDER BY vid',
      [':id' => $entity->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function userRevisionIds(AccountInterface $account) {
    return $this->database->query(
      'SELECT vid FROM {split_field_revision} WHERE uid = :uid ORDER BY vid',
      [':uid' => $account->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function countDefaultLanguageRevisions(SplitInterface $entity) {
    return $this->database->query('SELECT COUNT(*) FROM {split_field_revision} WHERE id = :id AND default_langcode = 1', [':id' => $entity->id()])
      ->fetchField();
  }

  /**
   * {@inheritdoc}
   */
  public function clearRevisionsLanguage(LanguageInterface $language) {
    return $this->database->update('split_revision')
      ->fields(['langcode' => LanguageInterface::LANGCODE_NOT_SPECIFIED])
      ->condition('langcode', $language->getId())
      ->execute();
  }

}
