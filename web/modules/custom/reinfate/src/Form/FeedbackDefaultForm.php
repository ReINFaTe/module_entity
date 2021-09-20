<?php

namespace Drupal\reinfate\Form;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\RedirectCommand;
use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Default form for feedback entity type.
 */
class FeedbackDefaultForm extends ContentEntityForm {

  /**
   * {@inheritDoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);
    $form['#prefix'] = '<div id="reinfate-feedback-form"';
    $form['#suffix'] = '</div>';
    $form['actions']['submit']['#ajax'] = [
      'callback' => '::submitAjax',
      'wrapper' => 'reinfate-feedback-form',
    ];
    return $form;
  }

  /**
   * Ajax submit.
   */
  public function submitAjax(array &$form, FormStateInterface $form_state) {
    if ($form_state->hasAnyErrors()) {
      return $form;
    }
    $response = new AjaxResponse();
    $response->addCommand(new RedirectCommand('/guestbook'));
    return $response;
  }

}
