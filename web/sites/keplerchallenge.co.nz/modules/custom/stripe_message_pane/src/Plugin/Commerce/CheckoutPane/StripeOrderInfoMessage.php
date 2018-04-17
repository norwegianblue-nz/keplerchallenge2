<?php

namespace Drupal\stripe_message_pane\Plugin\Commerce\CheckoutPane;

use Drupal\commerce_checkout\Plugin\Commerce\CheckoutPane\CheckoutPaneInterface;
use Drupal\commerce_checkout\Plugin\Commerce\CheckoutPane\CheckoutPaneBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * @CommerceCheckoutPane(
 *  id = "stripe_order_info_message",
 *  label = @Translation("Stripe review order title"),
 *  admin_label = @Translation("Stripe review order title"),
 * )
 */
class StripeOrderInfoMessage extends CheckoutPaneBase implements CheckoutPaneInterface {

  /**
   * {@inheritdoc}
   */
  public function buildPaneForm(array $pane_form, FormStateInterface $form_state, array &$complete_form) {
    $pane_form['message'] = [
      '#markup' => $this->t("<h3>Review Payment</h3>"),
    ];
    return $pane_form;
  }

}