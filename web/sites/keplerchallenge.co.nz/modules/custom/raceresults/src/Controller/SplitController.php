<?php

namespace Drupal\raceresults\Controller;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Url;
use Drupal\raceresults\Entity\SplitInterface;

/**
 * Class SplitController.
 *
 *  Returns responses for Split routes.
 */
class SplitController extends ControllerBase implements ContainerInjectionInterface {

  /**
   * Displays a Split  revision.
   *
   * @param int $split_revision
   *   The Split  revision ID.
   *
   * @return array
   *   An array suitable for drupal_render().
   */
  public function revisionShow($split_revision) {
    $split = $this->entityManager()->getStorage('split')->loadRevision($split_revision);
    $view_builder = $this->entityManager()->getViewBuilder('split');

    return $view_builder->view($split);
  }

  /**
   * Page title callback for a Split  revision.
   *
   * @param int $split_revision
   *   The Split  revision ID.
   *
   * @return string
   *   The page title.
   */
  public function revisionPageTitle($split_revision) {
    $split = $this->entityManager()->getStorage('split')->loadRevision($split_revision);
    return $this->t('Revision of %title from %date', ['%title' => $split->label(), '%date' => format_date($split->getRevisionCreationTime())]);
  }

  /**
   * Generates an overview table of older revisions of a Split .
   *
   * @param \Drupal\raceresults\Entity\SplitInterface $split
   *   A Split  object.
   *
   * @return array
   *   An array as expected by drupal_render().
   */
  public function revisionOverview(SplitInterface $split) {
    $account = $this->currentUser();
    $langcode = $split->language()->getId();
    $langname = $split->language()->getName();
    $languages = $split->getTranslationLanguages();
    $has_translations = (count($languages) > 1);
    $split_storage = $this->entityManager()->getStorage('split');

    $build['#title'] = $has_translations ? $this->t('@langname revisions for %title', ['@langname' => $langname, '%title' => $split->label()]) : $this->t('Revisions for %title', ['%title' => $split->label()]);
    $header = [$this->t('Revision'), $this->t('Operations')];

    $revert_permission = (($account->hasPermission("revert all split revisions") || $account->hasPermission('administer split entities')));
    $delete_permission = (($account->hasPermission("delete all split revisions") || $account->hasPermission('administer split entities')));

    $rows = [];

    $vids = $split_storage->revisionIds($split);

    $latest_revision = TRUE;

    foreach (array_reverse($vids) as $vid) {
      /** @var \Drupal\raceresults\SplitInterface $revision */
      $revision = $split_storage->loadRevision($vid);
      // Only show revisions that are affected by the language that is being
      // displayed.
      if ($revision->hasTranslation($langcode) && $revision->getTranslation($langcode)->isRevisionTranslationAffected()) {
        $username = [
          '#theme' => 'username',
          '#account' => $revision->getRevisionUser(),
        ];

        // Use revision link to link to revisions that are not active.
        $date = \Drupal::service('date.formatter')->format($revision->getRevisionCreationTime(), 'short');
        if ($vid != $split->getRevisionId()) {
          $link = $this->l($date, new Url('entity.split.revision', ['split' => $split->id(), 'split_revision' => $vid]));
        }
        else {
          $link = $split->link($date);
        }

        $row = [];
        $column = [
          'data' => [
            '#type' => 'inline_template',
            '#template' => '{% trans %}{{ date }} by {{ username }}{% endtrans %}{% if message %}<p class="revision-log">{{ message }}</p>{% endif %}',
            '#context' => [
              'date' => $link,
              'username' => \Drupal::service('renderer')->renderPlain($username),
              'message' => ['#markup' => $revision->getRevisionLogMessage(), '#allowed_tags' => Xss::getHtmlTagList()],
            ],
          ],
        ];
        $row[] = $column;

        if ($latest_revision) {
          $row[] = [
            'data' => [
              '#prefix' => '<em>',
              '#markup' => $this->t('Current revision'),
              '#suffix' => '</em>',
            ],
          ];
          foreach ($row as &$current) {
            $current['class'] = ['revision-current'];
          }
          $latest_revision = FALSE;
        }
        else {
          $links = [];
          if ($revert_permission) {
            $links['revert'] = [
              'title' => $this->t('Revert'),
              'url' => $has_translations ?
              Url::fromRoute('entity.split.translation_revert', ['split' => $split->id(), 'split_revision' => $vid, 'langcode' => $langcode]) :
              Url::fromRoute('entity.split.revision_revert', ['split' => $split->id(), 'split_revision' => $vid]),
            ];
          }

          if ($delete_permission) {
            $links['delete'] = [
              'title' => $this->t('Delete'),
              'url' => Url::fromRoute('entity.split.revision_delete', ['split' => $split->id(), 'split_revision' => $vid]),
            ];
          }

          $row[] = [
            'data' => [
              '#type' => 'operations',
              '#links' => $links,
            ],
          ];
        }

        $rows[] = $row;
      }
    }

    $build['split_revisions_table'] = [
      '#theme' => 'table',
      '#rows' => $rows,
      '#header' => $header,
    ];

    return $build;
  }

}
