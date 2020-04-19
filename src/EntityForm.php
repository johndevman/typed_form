<?php

namespace Drupal\typed_form;

use Drupal\Core\Entity\EntityInterface;

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

  /**
   * EntityForm constructor.
   *
   * @param \Drupal\Core\Entity\EntityInterface $entity
   * @param \Drupal\typed_form\EntityTypedSchema $entity_typed_schema
   */
  public function __construct(EntityInterface $entity, EntityTypedSchema $entity_typed_schema) {
    $this->entity = $entity;
    $this->entityTypedSchema = $entity_typed_schema;

    $this->schema = $this->entityTypedSchema->createFromEntityType($entity->getEntityType(), $entity->bundle());
  }

  public function schema() {
    return $this->schema;
  }

  public function validate() {

    $this->schema->validate([]);




  }

}
