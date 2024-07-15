# Личный проект Users

## set .env file
скопируйте файл .env.example -> .env file
запустите команду `id` и установите соответствующие знечения переменных variables WWWUSER  WWWGROUP

## install vendor via composer
`docker run --rm --interactive --tty --volume $PWD:/app --user $(id -u):$(id -g) composer:2.7.6  install`

## install and run containers
`docker compose up -d`

## set encrition key
`php artisan key:generate`

## migrate db and seed them
`php artisan migrate`

## Для заполнения таблицы nationalities и genders
` php artisan db:seed NationalitiesSeeder `
` php artisan db:seed GendersSeeder `

## Для создание, удаления и просмотра существующих токенов, есть команды
` php artisan token:create `
` php artisan token:delete `
` php artisan token:list `
` php artisan token:refresh `