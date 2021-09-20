<?php

namespace Drupal\reinfate;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Oleg entities.
 */
class ReinfateListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Feedback ID');
    $header['name'] = $this->t('Name');
    $header['email'] = $this->t('Email');
    $header['telephone'] = $this->t('Telephone');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /** @var \Drupal\reinfate\Entity\feedback $entity */
    $row['id'] = $entity->id();
    // Link name to entity edit page.
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.reinfate_feedback.edit_form',
      ['reinfate_feedback' => $entity->id()]
    );
    $row['email']['data'] = $entity->get('email')->view(['label' => 'hidden']);
    $row['telephone']['data'] = $entity->get('telephone')->view(['label' => 'hidden']);
    return $row + parent::buildRow($entity);
  }

}
