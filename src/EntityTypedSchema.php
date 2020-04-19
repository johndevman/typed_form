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

    foreach ($field_definitions as $field_definition) {
      $name = $field_definition->getName();
      $objects[$name] = [];

      $field_storage_definition = $field_definition->getFieldStorageDefinition();
      $property_definitions = $field_storage_definition->getPropertyDefinitions();

      foreach ($property_definitions as $property_name => $property_definition) {
        $objects[$name][$property_name] = $property_definition->toArray();
      }
    }

    return new TypedSchema($objects);
  }

}
