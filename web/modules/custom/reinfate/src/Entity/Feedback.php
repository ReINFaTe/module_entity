<?php

namespace Drupal\reinfate\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;

/**
 * Defines feedback entity for guest book.
 *
 * @ContentEntityType(
 *   id = "reinfate_feedback",
 *   label = @Translation("Feedbaсk"),
 *   base_table = "reinfate_feedback",
 *   admin_permission = "administer reinfate_feedback",
 *   handlers = {
 *    "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *    "access" = "Drupal\Core\Entity\EntityAccessControlHandler",
 *    "form" = {
 *      "default" = "Drupal\reinfate\Form\FeedbackDefaultForm",
 *      "edit" = "Drupal\reinfate\Form\FeedbackDefaultForm",
 *    },
 *    "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\DefaultHtmlRouteProvider",
 *     },
 *   },
 *   entity_keys = {
 *    "id" = "id",
 *    "label" = "name",
 *   },
 *   links = {
 *     "canonical" = "/reinfate/{reinfate_feedback}",
 *     "edit-form" = "/reinfate/{reinfate_feedback}/edit",
 *     "delete-form" = "/reinfate/{reinfate_feedback}/delete",
 *   },
 *   field_ui_base_route = "entity.reinfate_feedback.edit_form",
 * )
 */
class Feedback extends ContentEntityBase implements ContentEntityInterface, EntityChangedInterface {
  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);
    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel('Name')
      ->setDefaultValue(NULL)
      ->setRequired(TRUE)
      ->addPropertyConstraints('value', [
        'Length' => [
          'min' => 2,
          'max' => 100,
          'maxMessage' => 'Name is too long. It should have %limit character or less.|Name is too long. It should have %limit characters or less.',
          'minMessage' => 'Name is too short. It should have %limit character or more.|Name is too short. It should have %limit characters or more.',
        ],
      ])
      ->setDisplayOptions('form', [
        'type' => 'string',
      ])
      ->setDisplayOptions('view', [
        'type' => 'string',
      ]);

    $fields['email'] = BaseFieldDefinition::create('email')
      ->setLabel('Email')
      ->setDefaultValue(NULL)
      ->setRequired(TRUE)
      ->setDisplayOptions('form', [
        'type' => 'email_default',
      ])
      ->setDisplayOptions('view', [
        'type' => 'email_mailto',
      ]);

    $fields['telephone'] = BaseFieldDefinition::create('telephone')
      ->setLabel('Mobile number')
      ->setDefaultValue(NULL)
      ->setRequired(TRUE)
      ->setDisplayOptions('form', [
        'type' => 'telephone_default',
      ])
      ->setDisplayOptions('view', [
        'type' => 'telephone_link',
      ]);

    $fields['feedback'] = BaseFieldDefinition::create('string_long')
      ->setLabel('Feedback')
      ->setDefaultValue(NULL)
      ->setRequired(TRUE)
      ->addPropertyConstraints('value', [
        'Length' => [
          'max' => 1000,
          'maxMessage' => 'Feedback is too long. It should have %limit character or less.|Name is too long. It should have %limit characters or less.',
        ],
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textarea',
      ])
      ->setDisplayOptions('view', [
        'type' => 'string',
      ]);

    $fields['avatar'] = BaseFieldDefinition::create('image')
      ->setLabel('Avatar')
      ->setDefaultValue(NULL)
      ->setSettings([
        'file_extensions' => 'png jpg jpeg',
        'file_directory' => 'reinfate/avatars',
        'max_filesize' => 2097152,
        'alt_field' => FALSE,
      ])
      ->setDisplayOptions('view', [
        'type' => 'image',
      ])
      ->setDisplayOptions('form', [
        'type' => 'image',
      ]);

    $fields['image'] = BaseFieldDefinition::create('image')
      ->setLabel('Picture')
      ->setDescription('You can add a picture to your feedback')
      ->setDefaultValue(NULL)
      ->setSettings([
        'file_extensions' => 'png jpg jpeg',
        'file_directory' => 'reinfate/images',
        'max_filesize' => 5242880,
        'alt_field' => FALSE,
      ])
      ->setDisplayOptions('view', [
        'type' => 'image',
      ])
      ->setDisplayOptions('form', [
        'type' => 'image',
      ]);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the node was last edited.'));

    return $fields;
  }

}
