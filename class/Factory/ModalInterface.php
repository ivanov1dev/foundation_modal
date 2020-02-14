<?php

/**
 * Интерфейс класса модала.
 */
interface ModalInterface {

  /**
   * Заголовок модала.
   *
   * @return string
   *   Заголовок модала.
   */
  public function title();

  /**
   * Содержимое модала.
   *
   * @return string
   *   Содержимое модала.
   */
  public function body();

  /**
   * Классы модала.
   *
   * @param array $classes
   *   Набор классов.
   *
   * @return array
   *   Массив классов.
   */
  public function classes(array $classes = array());

}
