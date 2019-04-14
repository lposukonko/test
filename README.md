### Развертывание

Склонировать
`$ git clone https://github.com/torset1/test.git`

Перейти в папку
`$ cd test`

Установить зависимости
`$ composer install`

Подключиться к базе
`$ mysql -u root -p`

Создать БД
`mysql> create database my_test;`

Проверить БД
`mysql> show databases;`

Выход
`mysql> \q`

Выполнить миграции
`$ php yii migrate --migrationPath=@yii/rbac/migrations`

`$ php yii migrate `

### Ссылки

`$ php yii task/calculate 5,5,1,7,2,3,5 5 1`

`http://localhost:8080/task/calculate?token=[token]&array=[1,23,45,6,7,8,45,15]&number=5`
