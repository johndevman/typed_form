<?php

namespace Drupal\typed_form;

use Symfony\Component\Validator\ConstraintViolationList;

class TypedSchema {

  /**
   * @var array|\Drupal\Core\TypedData\TypedDataInterface[]
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

  public function validate(array $data) {
    $constraints = new ConstraintViolationList();

    foreach ($data as $key => $value) {
      $object = $this->objects[$key];
      $object->setValue($value, FALSE);

      $constraints->addAll($object->validate());
    }

    return $constraints;
  }

  public function toArray() {
    $values = [];

    foreach ($this->objects as $key => $object) {
      $values[$key] = $object->getDataDefinition()->toArray();
    }

    return $values;
  }

}
