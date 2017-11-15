<?php

namespace Drupal\raceresults\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Race split entity.
 *
 * @ingroup raceresults
 *
 * @ContentEntityType(
 *   id = "race_split",
 *   label = @Translation("Race split"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\raceresults\RaceSplitListBuilder",
 *     "views_data" = "Drupal\raceresults\Entity\RaceSplitViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\raceresults\Form\RaceSplitForm",
 *       "add" = "Drupal\raceresults\Form\RaceSplitForm",
 *       "edit" = "Drupal\raceresults\Form\RaceSplitForm",
 *       "delete" = "Drupal\raceresults\Form\RaceSplitDeleteForm",
 *     },
 *     "access" = "Drupal\raceresults\RaceSplitAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\raceresults\RaceSplitHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "race_split",
 *   admin_permission = "administer race split entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid",
 *     "langcode" = "langcode",
 *   },
 *   links = {
 *     "canonical" = "/admin/raceresults/race_split/{race_split}",
 *     "add-form" = "/admin/raceresults/race_split/add",
 *     "edit-form" = "/admin/raceresults/race_split/{race_split}/edit",
 *     "delete-form" = "/admin/raceresults/race_split/{race_split}/delete",
 *     "collection" = "/admin/raceresults/race_split",
 *   },
 *   field_ui_base_route = "race_split.settings"
 * )
 */
class RaceSplit extends ContentEntityBase implements RaceSplitInterface {

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values += [
      'user_id' => \Drupal::currentUser()->id(),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->get('name')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setName($name) {
    $this->set('name', $name);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwner() {
    return $this->get('user_id')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwnerId() {
    return $this->get('user_id')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid) {
    $this->set('user_id', $uid);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account) {
    $this->set('user_id', $account->id());
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isPublished() {
    return (bool) $this->getEntityKey('status');
  }

  /**
   * {@inheritdoc}
   */
  public function setPublished($published) {
    $this->set('status', $published ? TRUE : FALSE);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

/*    $fields['entry_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Entry'))
      ->setDescription(t('The  ID of the entry this race_split belongs to.'))
      ->setRevisionable(FALSE)
      ->setSetting('target_type', 'entry');
*/
    $fields['split_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Split'))
      ->setDescription(t('The split timing information.'))
      ->setRevisionable(FALSE)
      ->setSetting('target_type', 'split');

    $fields['splittime'] = BaseFieldDefinition::create('time')
      ->setLabel(t('Time'))
      ->setDescription(t('Time to this split location'))
      ->setRevisionable(FALSE);
    
    
    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    return $fields;
  }

}
