<?php

namespace Drupal\typed_form;

class TypedSchema {

  /**
   * @var \Drupal\Core\TypedData\TypedDataInterface[]
   */
  private $objects;

  /**
   * TypedSchema constructor.
   *
   * @param \Drupal\Core\TypedData\TypedDataInterface[] $objects
   */
  public function __construct(array $objects) {
    $this->objects = $objects;
  }

  public function toArray() {
    $values = [];

    foreach ($this->objects as $key => $object) {
      $values[$key] = $object->getDataDefinition()->toArray();
    }

    return $values;
  }


}
