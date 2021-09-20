<?php

namespace Drupal\reinfate\Controller;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\ReplaceCommand;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityFormBuilder;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Returns responses for reinfate routes.
 */
class GuestBookController extends ControllerBase {

  /**
   * Construct GuestBookController.
   */
  public function __construct(
    EntityFormBuilder $entityFormBuilder,
    EntityTypeManagerInterface $entityTypeManager
  ) {
    $this->entityFormBuilder = $entityFormBuilder;
    $this->entityTypeManager = $entityTypeManager;
  }

  /**
   * {@inheritDoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity.form_builder'),
      $container->get('entity_type.manager')
    );
  }

  /**
   * Builds main page.
   */
  public function content(): array {
    // Get entity form.
    $storage = $this->entityTypeManager->getStorage('reinfate_feedback');
    $form = $this->entityFormBuilder->getForm($storage->create());

    // Get feedbacks.
    $feedbacks = $this->getFeedbacksRender();
    return [
      '#theme' => 'reinfate-page',
      '#form' => $form,
      '#feedbacks_list' => $feedbacks,
    ];
  }

  /**
   * Ajax response for feedbacks list.
   */
  public function ajaxGetFeedbacks() {
    $response = new AjaxResponse();
    // Get feedbacks.
    $renders = $this->getFeedbacksRender();

    $response->addCommand(new ReplaceCommand('.reinfate-feedbacks-list', $renders));
    return $response;
  }

  /**
   * Get feedbacks.
   */
  public function getFeedbacksRender() {
    $storage = $this->entityTypeManager->getStorage('reinfate_feedback');
    $query = $storage->getQuery()
      ->sort('created', 'DESC')
      ->pager(5);
    $feedbacks = $query->execute();
    $feedbacks = $storage->loadMultiple($feedbacks);
    $view_builder = $this->entityTypeManager->getViewBuilder('reinfate_feedback');
    $renders = $view_builder->viewMultiple($feedbacks);
    $pager = [
      '#type' => 'pager',
    ];
    return [
      '#theme' => 'reinfate_feedbacks_list',
      '#feedbacks' => $renders,
      '#pager' => $pager,
    ];
  }

}
