<?php

namespace Drupal\plain_time_field\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldItemInterface;

/**
 * Provides a field type of Time.
 *
 * @FieldType(
 *   id = "time",
 *   label = @Translation("Time"),
 *   default_formatter = "time_formatter",
 *   default_widget = "time_widget",
 * )
 */
class TimeItem extends FieldItemBase implements FieldItemInterface {

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['value'] = DataDefinition::create('time_standard')
        ->setLabel(t('Time value'))
        ->setRequired(TRUE);

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return array(
      // columns contains the values that the field will store
      'columns' => array(
        // List the values that the field will save. This
        // field will only save a single value, 'value'
        'value' => array(
          'description' => 'The time value',
          'type' => 'varchar',
          'length' => '8', // hh:mm:ss
          'not null' => FALSE,
        ),
      ),
      'indexes' => array(
        'value' => array('value'),
      ),
    );
  }

  public function getTime() {
    return $this->properties['value']->getTime();
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value = $this->get('value')->getValue();
    return $value === NULL || $value === '';
  }

}
