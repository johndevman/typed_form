<?php

namespace Drupal\typed_form\Controller;

use Drupal\Component\Serialization\Json;
use Drupal\node\Entity\Node;
use Drupal\typed_form\EntityForm;
use Drupal\typed_form\EntityTypedSchema;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class EntityFormController {

  public function handle(Request $request) {
    $node = Node::create(['type' => 'page']);

    $form = new EntityForm($node, new EntityTypedSchema(\Drupal::service('entity_field.manager')));

    $form->handleRequest($request);

    if ($form->isSubmitted()) {

      $constraints = $form->validate();

      if (!empty($constraints)) {
        throw new BadRequestHttpException();
      }

      $data = $form->getData();

      // Map all data to the entity.
      foreach ($data as $key => $value) {
        $node->set($key, $value);
      }

      // Validate entity.
      $entity_constraints = $node->validate();

      if (!empty($entity_constraints)) {
        // @todo
      }

      $node->save();
    }

    return $form->toBuild();
  }

}
