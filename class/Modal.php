<?php

/**
 * Класс фабрики модалов.
 */
final class Modal {

  /**
   * Геттер модала.
   *
   * @param string $ns
   *   Пространство модалов.
   * @param string $title
   *   Заголовок модала.
   * @param string $body
   *   Тело модала.
   * @param array $classes_modal
   *   Классы модала.
   * @param array $classes_header
   *   Классы заголовка модала.
   * @param array $classes_body
   *   Классы тела модала.
   * @param array $classes_dialog
   *   Классы диалога модала.
   *
   * @return array
   *   Массив данных модала.
   */
  public static function get($ns, $title, $body, array $classes_modal = array(), array $classes_header = array(), array $classes_body = array(), array $classes_dialog = array()) {
    $ns = self::id($ns);
    $classes_modal = array_merge(array($ns), $classes_modal);

    return array(
      'id' => $ns,
      'title' => $title,
      'body' => $body,
      'classes_modal' => $classes_modal,
      'classes_header' => $classes_header,
      'classes_body' => $classes_body,
      'classes_dialog' => $classes_dialog,
    );
  }

  /**
   * Геттер модала.
   *
   * @param string $ns
   *   Пространство модалов.
   * @param string $title
   *   Заголовок модала.
   * @param string $body
   *   Тело модала.
   * @param array $classes_modal
   *   Классы модала.
   * @param array $classes_header
   *   Классы заголовка модала.
   * @param array $classes_body
   *   Классы тела модала.
   * @param array $classes_dialog
   *   Классы диалога модала.
   *
   * @return array
   *   Массив AJAX команд.
   * @throws \Exception
   */
  public static function build($ns, $title, $body, array $classes_modal = array(), array $classes_header = array(), array $classes_body = array(), array $classes_dialog = array()) {
    return self::show(self::get($ns, $title, $body, $classes_modal, $classes_header, $classes_body, $classes_dialog));
  }

  /**
   * Геттер модала с формой.
   *
   * @param string $ns
   *   Пространство модалов.
   * @param string $title
   *   Заголовок модала.
   * @param string $form
   *   Класс формы.
   * @param array $options
   *   Массив опций формы.
   *
   * @return array
   *   Массив AJAX команд.
   * @throws \Exception
   */
  public static function buildForm($ns, $title, $form, array $options = array()) {
    $body = FormFactory::get($form)->render($options);

    return self::show(self::get($ns, $title, $body));
  }

  /**
   * Геттер идентификатора модала.
   *
   * @param string $namespace
   *   Пространство модалов.
   *
   * @return string
   *   Идентификатор модала.
   */
  public static function id($namespace) {
    return 'modal-window-' . str_replace('_', '-', $namespace);
  }

  /**
   * Геттер ссылки на модальное окно.
   *
   * @param string $namespace
   *   Пространство модалов.
   *
   * @return string
   *   Идентификатор модала.
   */
  public static function button($title, $namespace, array $args, $type = 'primary', $size = 'md') {
    array_unshift($args, $namespace);

    $id = implode('-', $args);
    $url = implode('/', $args);
    $attributes = array(
      'html' => TRUE,
      'attributes' => array(
        'class' => array(
          'use-ajax', 'btn', 'btn-' . $type, 'btn-' . $size, 'btn-' . $id,
        ),
      ),
    );

    return l($title, 'modal/' . $url, $attributes);
  }

  /**
   * Геттер HTML ссылки на закрытие модала.
   *
   * @param string $title
   *   Текст ссылки.
   * @param string $href
   *   (опционально) Адрес ссылки.
   * @param array $attributes
   *   (опционально) Массив аттрибутов ссылки.
   *
   * @return string
   *   HTML контент.
   */
  public static function cancelLink($title = 'Отмена', $href = '#', array $attributes = array()) {
    // добавление класса хэндлера
    $attributes['class'][] = 'modal-window-handler';
    // удаление дубликатов
    $attributes['class'] = array_unique($attributes['class']);

    return l($title, $href, array('attributes' => $attributes, 'html' => TRUE));
  }

  /**
   * Геттер HTML ссылки/кнопки на закрытие модала.
   *
   * @param string $title
   *   Текст ссылки.
   * @param string $href
   *   (опционально) Адрес ссылки.
   * @param array $attributes
   *   (опционально) Массив аттрибутов ссылки.
   *
   * @return string
   *   HTML контент.
   */
  public static function cancelButton($title = 'Отмена', $href = '#', array $attributes = array()) {
    $attributes += array(
      'class' => array(),
    );

    // добавление классов кнопок
    array_unshift($attributes['class'], 'btn-default');
    array_unshift($attributes['class'], 'btn');

    // добавление класса хэндлера
    $attributes['class'][] = 'modal-window-handler';

    return self::cancelLink($title, $href, $attributes);
  }

  /**
   * Геттер кнопки на закрытие модала.
   *
   * @param string $title
   *   Текст ссылки.
   * @param array $attributes
   *   (опционально) Массив аттрибутов ссылки.
   *
   * @return array
   *   Элемент формы.
   */
  public static function cancelElement($title = 'Отмена', array $attributes = array()) {
    $attributes += array(
      'class' => array(),
    );

    // добавление классов кнопок
    array_unshift($attributes['class'], 'btn-default');
    array_unshift($attributes['class'], 'btn');

    // добавление класса хэндлера
    $attributes['class'][] = 'modal-window-handler';

    return array(
      '#type' => 'button',
      '#value' => $title,
      '#attributes' => $attributes,
    );
  }

  /**
   * Геттер кнопки на закрытие модала.
   *
   * @param string $title
   *   Текст ссылки.
   * @param array $attributes
   *   (опционально) Массив аттрибутов ссылки.
   *
   * @return array
   *   Элемент формы.
   */
  public static function resetElement($title = 'Отмена', array $attributes = array()) {
    return array(
      '#type' => 'button',
      '#button_type' => 'reset',
      '#value' => $title,
      '#attributes' => $attributes,
    );
  }

  /**
   * Команды обновления страницы.
   *
   * @param string|null $url
   *   (опционально) URL для переадресации.
   *
   * @return array
   *   Массив команд.
   */
  public static function reload($url = NULL) {
    $commands = array();
    $commands[] = ajax_command_invoke('.modal-window', 'modal', array('hide'));
    if ($url) {
      $commands[] = ctools_ajax_command_redirect($url);
    }
    else {
      $commands[] = ctools_ajax_command_reload();
    }

    return $commands;
  }

  /**
   * Команды сокрытия модала страницы.
   *
   * @return array
   *   Массив команд.
   */
  public static function hide() {
    $commands = array();
    $commands[] = ajax_command_invoke('.modal-window', 'modal', array('hide'));
    return $commands;
  }

  /**
   * Команды для вывода модала.
   *
   * @param array $modal
   *   Данные модала.
   *
   * @return array
   *   Массив команд.
   * @throws \Exception
   */
  public static function show(array $modal) {
    $id = '.' . $modal['id'];

    $commands = array();
    $commands[] = ajax_command_invoke('.btn-group', 'removeClass', array('open'));
    $commands[] = ajax_command_invoke('.dropdown', 'removeClass', array('open'));
    $commands[] = ajax_command_remove($id);
    $commands[] = ajax_command_append('body', theme('modal', $modal));
    $commands[] = ajax_command_invoke($id, 'modal', array(
      array('backdrop' => 'static', 'keyboard' => FALSE),
    ));
    $commands[] = ajax_command_invoke($id, 'modal', array('show'));

    return $commands;
  }

}
