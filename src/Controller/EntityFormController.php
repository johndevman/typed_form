<?php

namespace Drupal\typed_form\Controller;

use Drupal\Component\Serialization\Json;
use Drupal\node\Entity\Node;
use Drupal\typed_form\EntityForm;
use Drupal\typed_form\EntityTypedSchema;

class EntityFormController {

  public function handle() {
    $node = Node::create(['type' => 'page']);

    $form = new EntityForm($node, new EntityTypedSchema(\Drupal::service('entity_field.manager')));

    $schema = $form->schema();

    $ui_schema = [
      'title' => [
        'type' => 'string',
      ],
    ];

    return [
      '#type' => 'html_tag',
      '#tag' => 'div',
      '#attributes' => [
        'class' => [
          'typed-form',
        ],
        'data-schema' => Json::encode($schema->toArray()),
        'data-ui-schema' => Json::encode($ui_schema),
      ],
      '#attached' => [
        'library' => [
          'typed_form/core',
        ],
      ],
    ];
  }

}
