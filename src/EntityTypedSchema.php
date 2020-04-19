<?php

namespace Drupal\typed_form;

use Drupal\Core\Entity\EntityFieldManagerInterface;
use Drupal\Core\Entity\EntityTypeInterface;

class EntityTypedSchema {

  /**
   * @var \Drupal\Core\Entity\EntityFieldManagerInterface
   */
  private $entityFieldManager;

  public function __construct(EntityFieldManagerInterface $entity_field_manager) {
    $this->entityFieldManager = $entity_field_manager;
  }

  /**
   * @param \Drupal\Core\Entity\EntityTypeInterface $entity_type
   * @param $bundle
   *
   * @return \Drupal\typed_form\TypedSchema
   */
  public function createFromEntityType(EntityTypeInterface $entity_type, $bundle) {
    $field_definitions = $this->entityFieldManager->getFieldDefinitions($entity_type->id(), $bundle);

    $objects = [];

    foreach ($field_definitions as $name => $field_definition) {
      $objects[$name] = \Drupal::typedDataManager()->create($field_definition, NULL, $name);
    }

    return new TypedSchema($objects);
  }

}
