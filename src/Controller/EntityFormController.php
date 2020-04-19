<?php

namespace Drupal\typed_form\Controller;

use Drupal\node\Entity\Node;
use Drupal\typed_form\EntityForm;
use Drupal\typed_form\EntityTypedSchema;

class EntityFormController {

  public function handle() {
    $node = Node::create(['type' => 'page']);

    $form = new EntityForm($node, new EntityTypedSchema(\Drupal::service('entity_field.manager')));

    $constraints = $form->schema()->validate($node->toArray());
  }

}
