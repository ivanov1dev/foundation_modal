<?php

/**
 * Класс фабрики модалов.
 */
final class ModalFactory {

  /**
   * Геттер объекта модала.
   *
   * @param string $namespace
   *   Пространство модалов.
   * @param string $type
   *   Тип модала.
   * @param array $data
   *   (опционально) Массив данных.
   *
   * @return ModalInterface
   *   Объект рендерера.
   */
  public static function get($namespace, $type, array $data = array()) {
    $class_name = 'Modal' . FoundationString::className($namespace . '_' . $type);
    if (!class_exists($class_name)) {
      throw new \InvalidArgumentException(sprintf('Класс модала "%s" не определен', $class_name));
    }
    return new $class_name($data);
  }

}
