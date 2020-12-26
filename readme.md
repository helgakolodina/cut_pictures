Приложение работает на порту 8000.

Для запуска приложения скорипуйте файл настроек из шаблона:
	
	cp .env.example .env

Запустите сборку docker:

	docker-compose build app

	docker-compose up -d

Соберите приложение Laravel внутри контейнера:

	docker-compose exec app composer install

	docker-compose exec app php artisan key:generate

Создайте таблицы в базе данных:

	docker-compose exec app php artisan migrate


Форма для загрузки картинки для перерезки находиться по адресу /pictures_form.
Необходимо обязательно заполнить название и подкрепить саму картинку.

После отправки формы - перенаправляет на страницу /images_show/{pict_id} (pict_id - айди картинки в базе).
На даннной странице отображается сама картинка и ее части. К каждой части полагается ссылка на детальную.

Детальная страница части картинки находится на /image_slice/{pict_id}/{slice_id} (pict_id - айди картинки в базе, 
slice_id - айди части картинки в базе). На данной странице есть кнопка для скачивания части картинки.

Api: 
Для того, чтобы получить список ссылок для скачивания частей находится по адресу /slice_list_by_picture_id/{pict_id}/  
(pict_id - айди картинки в базе)

