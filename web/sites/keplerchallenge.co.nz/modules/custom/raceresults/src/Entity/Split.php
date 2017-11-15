<?php

namespace Drupal\raceresults\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\RevisionableContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Split entity.
 *
 * @ingroup raceresults
 *
 * @ContentEntityType(
 *   id = "split",
 *   label = @Translation("Split"),
 *   handlers = {
 *     "storage" = "Drupal\raceresults\SplitStorage",
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\raceresults\SplitListBuilder",
 *     "views_data" = "Drupal\raceresults\Entity\SplitViewsData",
 *     "translation" = "Drupal\raceresults\SplitTranslationHandler",
 *
 *     "form" = {
 *       "default" = "Drupal\raceresults\Form\SplitForm",
 *       "add" = "Drupal\raceresults\Form\SplitForm",
 *       "edit" = "Drupal\raceresults\Form\SplitForm",
 *       "delete" = "Drupal\raceresults\Form\SplitDeleteForm",
 *     },
 *     "access" = "Drupal\raceresults\SplitAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\raceresults\SplitHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "split",
 *   data_table = "split_field_data",
 *   revision_table = "split_revision",
 *   revision_data_table = "split_field_revision",
 *   translatable = TRUE,
 *   admin_permission = "administer split entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "revision" = "vid",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/raceresults/split/{split}",
 *     "add-form" = "/admin/raceresults/split/add",
 *     "edit-form" = "/admin/raceresults/split/{split}/edit",
 *     "delete-form" = "/admin/raceresults/split/{split}/delete",
 *     "version-history" = "/admin/raceresults/split/{split}/revisions",
 *     "revision" = "/admin/raceresults/split/{split}/revisions/{split_revision}/view",
 *     "revision_revert" = "/admin/raceresults/split/{split}/revisions/{split_revision}/revert",
 *     "revision_delete" = "/admin/raceresults/split/{split}/revisions/{split_revision}/delete",
 *     "translation_revert" = "/admin/raceresults/split/{split}/revisions/{split_revision}/revert/{langcode}",
 *     "collection" = "/admin/raceresults/split",
 *   },
 *   field_ui_base_route = "split.settings"
 * )
 */
class Split extends RevisionableContentEntityBase implements SplitInterface {

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
  public function preSave(EntityStorageInterface $storage) {
    parent::preSave($storage);

    foreach (array_keys($this->getTranslationLanguages()) as $langcode) {
      $translation = $this->getTranslation($langcode);

      // If no owner has been set explicitly, make the anonymous user the owner.
      if (!$translation->getOwner()) {
        $translation->setOwnerId(0);
      }
    }

    // If no revision author has been set explicitly, make the split owner the
    // revision author.
    if (!$this->getRevisionUser()) {
      $this->setRevisionUserId($this->getOwnerId());
    }
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

    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of author of the Split entity.'))
      ->setRevisionable(TRUE)
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setTranslatable(TRUE)
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'author',
        'weight' => 0,
      ])
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'weight' => 5,
        'settings' => [
          'match_operator' => 'CONTAINS',
          'size' => '60',
          'autocomplete_type' => 'tags',
          'placeholder' => '',
        ],
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the Split timing point.'))
      ->setRevisionable(TRUE)
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'inline',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
    
        // The description of the split timing point.
    $fields['subject'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Description'))
      ->setDescription(t('A human understandable description of the Split timing point (eg. Luxmore Hut).'))
      ->setRequired(TRUE)
      ->setSettings([
        'max_length' => 255,
        'text_processing' => 0,
      ])
      ->setDisplayOptions('view', [
        'label' => 'inline',
        'type' => 'string',
        'weight' => -3,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -3,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);


    $fields['location'] = BaseFieldDefinition::create('geolocation')
      ->setLabel(t('Location'))
      ->setDescription(t('The location of the Split timing point.'))
      ->setRevisionable(TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setDisplayOptions('view', array(
        'label' => 'hidden',
        'type' => 'geolocation_map',
        'weight' => -2,
        'settings' => array(
          'set_marker' => '1',
          'info_text' => 'lat,long: :lat,:lng',
          'google_map_settings' => array(
            'type' => 'TERRAIN',
            'zoom' => 9,
            'mapTypeControl' => TRUE,
            'streetViewControl' => FALSE,
            'zoomControl' => TRUE,
            'scrollwheel' => FALSE,
            'disableDoubleClickZoom' => FALSE,
            'draggable' => TRUE,
            'height' => '300px',
            'width' => '100%',
            'info_auto_display' => TRUE,
            'disableAutoPan' => TRUE,
            'preferScrollingToZooming' => FALSE,
            'gestureHandling' => 'auto',
          ),
        ),
      ))
      ->setDisplayOptions('form', array(
        'type' => 'geolocation_googlegeocoder',
        'weight' => -2,
        'title' => t('title thing'),
        'settings' => array(
          'set_marker' => '1',
          'info_text' => t('Some info text'),
          'use_overridden_map_settings' => 0,
          'google_map_settings' => array(
            'type' => 'TERRAIN',
            'zoom' => 5,
            'mapTypeControl' => TRUE,
            'streetViewControl' => FALSE,
            'zoomControl' => TRUE,
            'scrollwheel' => FALSE,
            'disableDoubleClickZoom' => FALSE,
            'draggable' => TRUE,
            'height' => '300px',
            'width' => '100%',
            'info_auto_display' => TRUE,
            'disableAutoPan' => TRUE,
            'preferScrollingToZooming' => FALSE,
            'gestureHandling' => 'auto',
          ),
/*          'populate_address_field' => TRUE,
          'target_address_field' => 'address',
          'default_longitude' => 25.39459,
          'default_latitude' => 42.73639,
          'auto_client_location' => FALSE,
          'auto_client_location_marker' => FALSE,
          'allow_override_map_settings' => FALSE,*/
        ),
      ))
      ->setDisplayConfigurable('form', TRUE);
    
    $fields['distance'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Split Distance'))
      ->setDescription(t('The distance from start'))
      ->setDefaultValue(0)
      ->setRevisionable(TRUE)
      ->setRequired(TRUE)
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
    
    $fields['status'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Publishing status'))
      ->setDescription(t('A boolean indicating whether the Split is published.'))
      ->setRevisionable(TRUE)
      ->setDefaultValue(FALSE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    $fields['revision_translation_affected'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Revision translation affected'))
      ->setDescription(t('Indicates if the last edit of a translation belongs to current revision.'))
      ->setReadOnly(TRUE)
      ->setRevisionable(TRUE)
      ->setTranslatable(TRUE);

    return $fields;
  }

}
