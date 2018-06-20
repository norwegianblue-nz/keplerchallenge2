<?php
/**
 * @file
 * Contains \Drupal\entrylinks\Controller\FirstController.
 */
 
namespace Drupal\entrylinks\Controller;
 
use Drupal\Core\Controller\ControllerBase;
 
class EntryLinksController extends ControllerBase {
  public function content() {
    \Drupal::service('page_cache_kill_switch')->trigger();
/**
 * //norwegian.blue - following left in for reference. This controller actually
 * //                 now displays a blank page. entrylinks_block is used to 
 * //                 generate a block that includes the required php files 
 * //                 for the AJAX refresh.
 * 
 *    $phpcode = '<?php INCLUDE("/var/www/vhosts/keplerchallenge.co.nz/drupal-8.x/web/sites/keplerchallenge.co.nz/static/registrationAJAX.php") ?>';
 *    ob_start();
 *    print eval('?>' . $phpcode);
 *    $phpoutput = ob_get_contents();
 *    ob_end_clean();
 *    $txtoutput = t('Hmm<br />' . '<script type="text/javascript">setTimeout(function() {Ajax();}, 10000);</script>') ;
 *    $htmlop = $phpoutput . $txtoutput ;
 * 
 */
    return [
      '#cache'=> ['max-age' => 0 ,],
      '#type' => 'markup',
//      '#markup' => $phpoutput,
      '#markup' => $this->t('&nbsp;'),
    ];
  }
}

//    return [
//      '#type' => 'markup',
//      '#markup' => $this->t('<ul class="admin-list">'
//          . '<li>%manageballotslink<div class="description">Choose a ballot to manage (change settings, set up messages and draw the ballot)</div></li>'
//          . '<li>%manageentrieslink<div class="description">Display ballot entries and choose from the list entries to manage</div></li>'
//          . '<li>%viewpaymentslink<div class="description">View ballot payments</div></li>'
//          . '<li>%createballotlink<div class="description">Create ballot entry page for new season</div></li>'
//          ,['%manageballotslink' => $manageballotslink->toString(),'%manageentrieslink' => $manageentrieslink->toString(),'%viewpaymentslink' => $viewpaymentslink->toString(),'%createballotlink' => $createballotlink->toString()]
//          ),
//    ];
// 