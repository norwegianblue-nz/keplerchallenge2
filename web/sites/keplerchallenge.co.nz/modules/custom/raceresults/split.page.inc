<?php

/**
 * @file
 * Contains split.page.inc.
 *
 * Page callback for Split entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Split templates.
 *
 * Default template: split.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_split(array &$variables) {
  // Fetch Split Entity Object.
  $split = $variables['elements']['#split'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
