<?php

namespace Drupal\raceresults;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Split entity.
 *
 * @see \Drupal\raceresults\Entity\Split.
 */
class SplitAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\raceresults\Entity\SplitInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished split entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published split entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit split entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete split entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add split entities');
  }

}
