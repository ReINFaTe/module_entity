<?php

namespace Drupal\reinfate\Plugin\Validation\Constraint;

use Drupal\Core\Validation\Plugin\Validation\Constraint\LengthConstraint;

/**
 * Checks LUL.
 *
 * @Constraint(
 *   id = "reinfate_Length",
 *   label = @Translation("Length", context = "Validation"),
 *   type = { "string" }
 * )
 */
class CustomLengthConstraint extends LengthConstraint {
  public $lol = NULL;
  public $maxMessage = 'fuck';
  public $minMessage;
  public $exactMessage = NULL;


}
