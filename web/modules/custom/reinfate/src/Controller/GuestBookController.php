<?php

namespace Drupal\reinfate\Controller;

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

    $entity = $storage->getQuery()
      ->sort('created', 'DESC')
      ->pager(5);
    $coments_ids = $entity->execute();
    $feedbacks = $storage->loadMultiple($coments_ids);
    $view_builder = $this->entityTypeManager->getViewBuilder('reinfate_feedback');
    $renders = [];
    $renders = $view_builder->viewMultiple($feedbacks);
    $pager = [
      '#type' => 'pager',
    ];
    return [
      '#theme' => 'reinfate-page',
      '#form' => $form,
      '#feedbacks' => $renders,
      '#pager' => $pager,
    ];
  }

}
