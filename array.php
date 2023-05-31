<?php
$array = [
  ['id' => 1, 'date' => "12.01.2020", 'name' => "test1"],
  ['id' => 2, 'date' => "02.05.2020", 'name' => "test2"],
  ['id' => 4, 'date' => "08.03.2020", 'name' => "test4"],
  ['id' => 1, 'date' => "22.01.2020", 'name' => "test1"],
  ['id' => 2, 'date' => "11.11.2020", 'name' => "test4"],
  ['id' => 3, 'date' => "06.06.2020", 'name' => "test3"],
];

//выделить уникальные записи (убрать дубли) в отдельный массив. в конечном массиве не должно быть элементов с одинаковым id.
$uniqueArray = array_values(array_unique(array_column($array, 'id')));

print_r($uniqueArray);



// отсортировать многомерный массив по ключу (любому)

// вернуть из массива только элементы, удовлетворяющие внешним условиям (например элементы с определенным id)

// изменить в массиве значения и ключи (использовать name => id в качестве пары ключ => значение)


usort($array, function($a, $b) {
    return strcmp($a['name'], $b['name']);
});


$filteredArray = array_filter($array, function($item) {
    return $item['id'] == 2;
});


$modifiedArray = array_map(function($item) {
    return [$item['name'] => $item['id']];
}, $array);


$modifiedArray = array_merge(...$modifiedArray);

print_r($modifiedArray);