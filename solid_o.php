<?php



// Решение должно быть "концептуально" правильным. Мы не будем досконально тестировать корректную работу системы на всех краевых случаях :)

// Даны 2 класса. Один реализует поведение объектов, второй - 
// сам объект. Привести функцию handleObjects в соответствие с принципом открытости-закрытости (O: Open-Closed Principle) SOLID.
// (код представлен в папке architecture, в файле solid_o.php)
// Устранить нарушения первого пункта принципа инверсии зависимостей 
// (D: Dependency Inversion Principle) SOLID: « 1. 
// Модули верхних уровней не должны зависеть от модулей нижних уровней. Оба типа модулей должны зависеть от абстракций. »



// class SomeObject {
//   protected $name;

//   public function __construct(string $name) { }

//   public function getObjectName() { }
// }

// class SomeObjectsHandler {
//   public function __construct() { }

//   public function handleObjects(array $objects): array {
//       $handlers = [];
//       foreach ($objects as $object) {
//           if ($object->getObjectName() == 'object_1')
//               $handlers[] = 'handle_object_1';
//           if ($object->getObjectName() == 'object_2')
//               $handlers[] = 'handle_object_2';
//       }

//       return $handlers;
//   }
// }

// $objects = [
//   new SomeObject('object_1'),
//   new SomeObject('object_2')
// ];

// $soh = new SomeObjectsHandler();
// $soh->handleObjects($objects);

interface ObjectHandlerInterface {
  public function canHandle(SomeObject $object): bool;
  public function handle(SomeObject $object): void;
}

class SomeObject {
  protected $name;

  public function __construct(string $name) {
      $this->name = $name;
  }

  public function getObjectName() {
      return $this->name;
  }
}

class Object1Handler implements ObjectHandlerInterface {
  public function canHandle(SomeObject $object): bool {
      return $object->getObjectName() === 'object_1';
  }

  public function handle(SomeObject $object): void {
      echo 'Handling object 1' . PHP_EOL;
  }
}

class Object2Handler implements ObjectHandlerInterface {
  public function canHandle(SomeObject $object): bool {
      return $object->getObjectName() === 'object_2';
  }

  public function handle(SomeObject $object): void {
      echo 'Handling object 2' . PHP_EOL;
  }
}

class SomeObjectsHandler {
  private $handlers;

  public function __construct(array $handlers) {
      $this->handlers = $handlers;
  }

  public function handleObjects(array $objects): array {
      $handledObjects = [];

      foreach ($objects as $object) {
          foreach ($this->handlers as $handler) {
              if ($handler->canHandle($object)) {
                  $handler->handle($object);
                  $handledObjects[] = $handler;
                  break;
              }
          }
      }

      return $handledObjects;
  }
}

$objects = [
  new SomeObject('object_1'),
  new SomeObject('object_2')
];

$handlers = [
  new Object1Handler(),
  new Object2Handler()
];

$soh = new SomeObjectsHandler($handlers);
$soh->handleObjects($objects);




