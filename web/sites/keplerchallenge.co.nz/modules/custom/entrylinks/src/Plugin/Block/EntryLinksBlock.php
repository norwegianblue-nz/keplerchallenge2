<?php

namespace Drupal\entrylinks\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides a block with a simple text.
 *
 * @Block(
 *   id = "entry_links_countdown",
 *   admin_label = @Translation("Countdown to Links"),
 * )
 */
class EntryLinksBlock extends BlockBase {

 /**
   * {@inheritdoc}
   */
  public function build() {
    $phpcode = '<?php INCLUDE("/var/www/vhosts/keplerchallenge.co.nz/drupal-8.x/web/sites/keplerchallenge.co.nz/static/registrationAJAX.php") ?>';
    ob_start();
    print eval('?>' . $phpcode);
    $output = ob_get_contents();
    ob_end_clean();
    return [
      '#markup' => $output,
    ];
  }

  /**
   * {@inheritdoc}
   */
  protected function blockAccess(AccountInterface $account) {
    return AccessResult::allowedIfHasPermission($account, 'access content');
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $config = $this->getConfiguration();

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['entrylinks_settings'] = $form_state->getValue('entrylinks_settings');
  }
}