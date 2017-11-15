<?php

namespace Drupal\raceresults;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Race split entity.
 *
 * @see \Drupal\raceresults\Entity\RaceSplit.
 */
class RaceSplitAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\raceresults\Entity\RaceSplitInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished race split entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published race split entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit race split entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete race split entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add race split entities');
  }

}
