<?php

namespace Drupal\plain_time_field\Plugin\Field\FieldWidget;

use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * A time field widget.
 *
 * @FieldWidget(
 *   id = "time_widget",
 *   label = @Translation("Time field widget"),
 *   field_types = {
 *     "time"
 *   }
 * )
 */
class TimeWidget extends WidgetBase implements WidgetInterface {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element['value'] = [
      '#type' => 'datetime',
      '#date_date_element' => 'none',
      '#date_time_element' => 'time',
      '#date_time_format' => 'H:i:s',
      '#date_increment' => $this->getSetting('step'),
      '#default_value' => null,
      '#title' => $this->fieldDefinition->getLabel(),
      '#required' => $element['#required'],
    ];

    if ($items[$delta]->value) {
      $timeItem = $items[$delta];
      $time = $timeItem->getTime();
      $element['value']['#default_value'] = $time->toDrupalDateTime();
    }

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      // Create a default setting 'step', and
      // assign a default value of 1
      'step' => 1,
        ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $element['step'] = [
      '#type' => 'number',
      '#title' => t('Step (in seconds) of the time field'),
      '#description' => 'Define the step between time values, in seconds. Use 60 for full minutes and 3600 for full hours.',
      '#default_value' => $this->getSetting('step'),
      '#required' => TRUE,
      '#min' => 1,
      '#max' => 3600,
    ];

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];

    $summary[] = t('Time field step: @step', array('@step' => $this->getSetting('step')));

    return $summary;
  }

}
