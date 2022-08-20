<?php

/*
 * Main file for creating a routing map.
 * The routes change when the files in this folder are changed. If there is a time difference between the servers,
 * you must execute "php console -routes-cc" or delete the cached "routes.txt" file after making the changes.
 *
 * Основной файл для создания карты маршрутизации.
 * Маршруты перерасчитываются при изменении файлов в этой папке. Если есть разница во времени между серверами, необходимо выполнить
 * «php console -routes-cc» или удалить кешированный файл «routes.txt» после внесения изменений.
 */

// Route::get("/")->controller("Controller@index")->name("home");
// Route::post("/time")->controller('Controller@time');

Route::getType(["post", "get"]);
    Route::add("/")->controller("Controller@index");
    Route::add("/")->controller("Controller@index");
Route::endType();