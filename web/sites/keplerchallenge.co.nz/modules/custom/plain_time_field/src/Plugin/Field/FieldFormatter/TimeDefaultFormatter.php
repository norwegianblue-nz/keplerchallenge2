<?php

namespace Drupal\plain_time_field\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the 'Random_default' formatter.
 *
 * @FieldFormatter(
 *   id = "time_formatter",
 *   label = @Translation("Time default formatter"),
 *   field_types = {
 *     "time"
 *   }
 * )
 */
class TimeDefaultFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];
    $settings = $this->getSettings();

    $summary[] = t('Displays the time value.');

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $element = [];

    foreach ($items as $delta => $item) {
      // Render each element as markup.
      $element[$delta] = [
        '#type' => 'markup',
        '#markup' => $item->value,
      ];
    }

    return $element;
  }

}
