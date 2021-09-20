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
 *    "list_builder" = "Drupal\reinfate\ReinfateListBuilder",
 *    "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *    "access" = "Drupal\Core\Entity\EntityAccessControlHandler",
 *    "form" = {
 *      "default" = "Drupal\reinfate\Form\FeedbackDefaultForm",
 *      "edit" = "Drupal\reinfate\Form\FeedbackDefaultForm",
 *      "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm"
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
 *     "collection" = "/admin/structure/reinfate",
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
      ->setLabel(t('Name'))
      ->setDefaultValue(NULL)
      ->setRequired(TRUE)
      ->addPropertyConstraints('value', [
        'Length' => [
          'min' => 2,
          'max' => 100,
          // Set messages here, because not sure is it good idea to
          // copy validation code just to pass a field name to it.
          'maxMessage' => 'Name is too long. It should have %limit character or less.|Name is too long. It should have %limit characters or less.',
          'minMessage' => 'Name is too short. It should have %limit character or more.|Name is too short. It should have %limit characters or more.',
        ],
      ])
      ->setSetting('max_length', 100)
      ->setDisplayOptions('form', [
        'type' => 'string',
      ])
      ->setDisplayOptions('view', [
        'type' => 'string',
      ]);

    $fields['email'] = BaseFieldDefinition::create('email')
      ->setLabel(t('Email'))
      ->setDefaultValue(NULL)
      ->setRequired(TRUE)
      ->setDisplayOptions('form', [
        'type' => 'email_default',
      ])
      ->setDisplayOptions('view', [
        'type' => 'email_mailto',
      ]);

    $fields['telephone'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Mobile number'))
      ->setDefaultValue(NULL)
      ->setRequired(TRUE)
      ->addPropertyConstraints(
        'value', [
          'Regex' => [
            'pattern' => '/^\+[0-9]{11,13}$/',
            'message' => t('Mobile number format is +38(050)-826-3469'),
          ],
        ]
      )
      ->setSetting('max_length', 13)
      ->setDisplayOptions('form', [
        'type' => 'telephone_default',
      ])
      ->setDisplayOptions('view', [
        'type' => 'telephone_link',
      ]);

    $fields['feedback'] = BaseFieldDefinition::create('string_long')
      ->setLabel(t('Feedback'))
      ->setDefaultValue(NULL)
      ->setRequired(TRUE)
      ->addPropertyConstraints('value', [
        'Length' => [
          'max' => 1000,
          'maxMessage' => 'Feedback is too long. It should have %limit character or less.|Feedback is too long. It should have %limit characters or less.',
        ],
      ])
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'text_default',
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textarea',
      ]);

    $fields['avatar'] = BaseFieldDefinition::create('image')
      ->setLabel(t('Avatar'))
      ->setDefaultValue(NULL)
      ->setSettings([
        'file_extensions' => 'png jpg jpeg',
        'file_directory' => 'reinfate/avatars',
        'max_filesize' => 2097152,
        'alt_field' => FALSE,
      ])
      ->setDisplayOptions('view', [
        'type' => 'image',
        'label' => 'hidden',
        'settings' => [
          // Not sure can I rely on default image_style or should
          // create my own.
          'image_style' => 'thumbnail',
          'image_link' => 'file',
        ],
      ])
      ->setDisplayOptions('form', [
        'type' => 'image',
      ]);

    $fields['image'] = BaseFieldDefinition::create('image')
      ->setLabel(t('image'))
      ->setDescription(t('You can add an image to your feedback'))
      ->setDefaultValue(NULL)
      ->setSettings([
        'file_extensions' => 'png jpg jpeg',
        'file_directory' => 'reinfate/images',
        'max_filesize' => 5242880,
        'alt_field' => FALSE,
      ])
      ->setDisplayOptions('view', [
        'type' => 'image',
        'label' => 'hidden',
        'settings' => [
          'image_style' => 'medium',
          'image_link' => 'file',
        ],
      ])
      ->setDisplayOptions('form', [
        'type' => 'image',
      ]);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'))
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'datetime_custom',
        'settings' => [
          'data_format' => 'm/j/Y H:i:s',
        ],
      ]);

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the node was last edited.'));

    return $fields;
  }

}
