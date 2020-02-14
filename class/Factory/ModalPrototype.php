<?php

/**
 * Прототип класса модала.
 */
abstract class ModalPrototype implements ModalInterface {
  protected $data;

  /**
   * Конструктор класса.
   *
   * @param array $data
   *   Массив данных.
   */
  public function __construct(array $data) {
    $this->data = $data;
  }

  /**
   * Заголовок модала.
   *
   * @inheritdoc
   */
  abstract public function title();

  /**
   * Содержимое модала.
   *
   * @inheritdoc
   */
  abstract public function body();

  /**
   * Классы модала.
   *
   * @inheritdoc
   */
  public function classes(array $classes = array()) {
    return $classes;
  }

}
