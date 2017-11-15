<?php

/**
 * @file
 * Contains race_split.page.inc.
 *
 * Page callback for Race split entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Race split templates.
 *
 * Default template: race_split.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_race_split(array &$variables) {
  // Fetch RaceSplit Entity Object.
  $race_split = $variables['elements']['#race_split'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
