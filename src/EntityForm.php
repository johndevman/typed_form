<?php

namespace Drupal\typed_form;

use Drupal\Component\Serialization\Json;
use Drupal\Core\Entity\EntityInterface;
use Symfony\Component\HttpFoundation\Request;

class EntityForm {

  /**
   * @var \Drupal\Core\Entity\ContentEntityInterface
   */
  private $entity;

  /**
   * @var \Drupal\typed_form\EntityTypedSchema
   */
  private $entityTypedSchema;

  /**
   * @var \Drupal\typed_form\TypedSchema
   */
  private $schema;

  private $isSubmitted = FALSE;
  private $data = [];

  /**
   * EntityForm constructor.
   *
   * @param \Drupal\Core\Entity\EntityInterface $entity
   * @param \Drupal\typed_form\EntityTypedSchema $entity_typed_schema
   * @param array $data
   */
  public function __construct(EntityInterface $entity, EntityTypedSchema $entity_typed_schema, array $data = []) {
    $this->entity = $entity;
    $this->entityTypedSchema = $entity_typed_schema;

    $this->schema = $this->entityTypedSchema->createFromEntityType($entity->getEntityType(), $entity->bundle());

    $this->data = $data;
  }

  public function schema() {
    return $this->schema;
  }

  public function handleRequest(Request $request) {
    if ($request->getMethod() === 'POST') {
      $this->isSubmitted = TRUE;
    }

    $this->data = $request->request->all();
  }

  public function isSubmitted() {
    return $this->isSubmitted;
  }

  public function validate() {
    return $this->schema->validate($this->data);
  }

  public function getData() {
    return $this->data;
  }

  public function toBuild() {
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
        'data-schema' => Json::encode($this->schema->toArray()),
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
