<?php
// (код представлен в папке architecture, в файле solid_d.php).
// Имеется метод getUserData, который получает данные из внешнего API, передавая 
// в запрос необходимые парамерты, вместе с ключом (token) идентификации. Необходимо реализовать
//  универсальное решение getSecretKey(), 
// с использованием какого-либо шаблона (pattern) проектирования для хранения этого ключа всевозможными способами:

// class XMLHttpService extends XMLHTTPRequestService {}

// class Http {
//     private $service;

//     public function __construct(XMLHttpService $xmlHttpService) { }

//     public function get(string $url, array $options) {
//         $this->service->request($url, 'GET', $options);
//     }

//     public function post(string $url) {
//         $this->service->request($url, 'GET');
//     }
// }


interface KeyStorageInterface {
    public function saveKey(string $key): void;
    public function getKey(): string;
}

class FileKeyStorage implements KeyStorageInterface {
    private $filePath;

    public function __construct(string $filePath) {
        $this->filePath = $filePath;
    }

    public function saveKey(string $key): void {
        file_put_contents($this->filePath, $key);
    }

    public function getKey(): string {
        return file_get_contents($this->filePath);
    }
}

class DBKeyStorage implements KeyStorageInterface {
    private $connection;

    public function __construct(PDO $connection) {
        $this->connection = $connection;
    }

    public function saveKey(string $key): void {
      
    }

    public function getKey(): string {
       
    }
}

class MemoryKeyStorage implements KeyStorageInterface {
    private $key;

    public function saveKey(string $key): void {
        $this->key = $key;
    }

    public function getKey(): string {
        return $this->key;
    }
}



class UserDataApi {
    private $http;
    private $keyStorage;

    public function __construct(Http $http, KeyStorageInterface $keyStorage) {
        $this->http = $http;
        $this->keyStorage = $keyStorage;
    }

    public function getUserData(array $params) {
        $key = $this->keyStorage->getKey();

    
    }
}

// Пример использования:

$keyStorage = new FileKeyStorage('/path/to/key.txt'); // Используем файл для хранения ключа
$keyStorage = new DBKeyStorage($pdoConnection); // Используем базу данных для хранения ключа
$keyStorage = new MemoryKeyStorage(); // Используем память сервера для хранения ключа

$http = new Http(new XMLHttpService());
$userDataApi = new UserDataApi($http, $keyStorage);

$userDataApi->getUserData(['param1' => 'value1', 'param2' => 'value2']);