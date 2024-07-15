# проект Users.V2

v2 значит что этот проект пытались раньше запустить, но не получалось. Вторая попытка.

## Установка на локальный компьютер
Опишем позже

## Установка на продакшн
Опишем позже после того как установим на прод

### В этом проекте использована концепция "Laravel-Action-10".
Что это за концепция можете узнать в readme проекта Laravel-Action-10. Здесь просто отсылка.

## При создании базы очень важно проверить и установить нужную кодировку

## указать другой ssh-ключ
git config core.sshCommand "ssh -i ~/.ssh/id_rsa -F /dev/null"

## если нужно запустить конкретный заполнитель базы

` clear && ./vendor/bin/sail php artisan db:seed --class "Database\Seeders\Users\NominalUsers" `

## Для заполнения таблицы nationalities

` php artisan db:seed NationalitiesSeeder `

## Для заполнения таблицы genders

` php artisan db:seed GendersSeeder `

## Для создание, удаления и просмотра существующих токенов, есть команды
` php artisan token:create `
` php artisan token:delete `
` php artisan token:list `

## Postman документация

https://api.postman.com/collections/32913668-db3f0bcc-1b40-458f-ae8a-0ac37d8d3c28?access_key=PMAT-01J14S6H0S9HPCZYXRCZX55AAX