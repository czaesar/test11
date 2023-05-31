<?php

//В базе данных имеется таблица с товарами goods (id INTEGER, name TEXT), таблица с тегами tags (id INTEGER, name TEXT) и таблица связи товаров и тегов goods_tags (tag_id INTEGER, goods_id INTEGER, UNIQUE(tag_id, goods_id)). 
//Выведите id и названия всех товаров, которые имеют все возможные теги в этой базе.

$pdo = new PDO('mysql:host=localhost;dbname=название_базы_данных', 'пользователь', 'пароль');


$sql = "
SELECT g.id, g.name
FROM goods g
WHERE NOT EXISTS (
  SELECT t.id
  FROM tags t
  LEFT JOIN goods_tags gt ON t.id = gt.tag_id
  WHERE g.id = gt.goods_id AND gt.tag_id IS NULL
)";


$stmt = $pdo->query($sql);

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($results as $row) {
    echo "ID: " . $row['id'] . ", Name: " . $row['name'] . "<br>";
}