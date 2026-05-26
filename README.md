<h1>AmoPoint Test Task</h1>

<p>Тестовое задание на вакансию PHP-разработчика.</p>

<p>Текст задания: <a href="https://github.com/vad-dom/amopoint-test/blob/main/TASK.md">TASK.md</a></p>

<p>Используемые технологии и технические решения: <a href="https://github.com/vad-dom/amopoint-test/blob/main/TECHNICAL_NOTES.md">TECHNICAL_NOTES.md</a></p>

<br>

<h2>📂 Структура проекта</h2>

<pre>
├── docker/                             # Docker configuration
├── src/
│   ├── app/
│   │   ├── Console/
│   │   │   ├── Commands/               # FetchRandomJokeCommand
│   │   ├── Http/
│   │   │   ├── Controllers/
│   │   │   │   ├── Api/                # JokeController, VisitController
│   │   │   │   ├── Auth/               # Breeze controllers
│   │   │   │   └── StatsController
│   │   │   ├── Requests/               # StoreVisitRequest
│   │   ├── Models/                     # Joke, Visit, User
│   │   ├── Repositories/               # JokeRepository, VisitRepository
│   │   ├── Services/                   # API, analytics and business logic services
│   │   └── View/
│   │       └── Components/             # Breeze Blade components
│   │
│   ├── database/
│   │   ├── migrations/
│   │   └── seeders/                    # VisitSeeder
│   │
│   ├── public/
│   │   └── js/
│   │       ├── type-fields-toggle.js   # JS task solution
│   │       └── visit-tracker.js        # Visit tracking script
│   │
│   ├── resources/
│   │   └── views/
│   │       ├── auth/                   # Breeze views
│   │       ├── layouts/                # Breeze layouts
│   │       ├── profile/                # Breeze profile pages
│   │       └── stats/                  # Statistics dashboard
│   │
│   ├── routes/
│   │   ├── api.php
│   │   ├── console.php
│   │   └── web.php
│   │
│   ├── .env
│   └── .env.example
│
├── README.md
├── TASK.md
├── TECHNICAL_NOTES.md
├── docker-compose.yml
</pre>

<br>

<h2>🚀 Как запустить проект</h2>

<ol>
  <li>
    <strong>Клонировать репозиторий:</strong>
    <pre><code>git clone https://github.com/vad-dom/amopoint-test.git</code></pre>
  </li>

  <li>
    <strong>Перейти в папку проекта:</strong>
    <pre><code>cd amopoint-test</code></pre>
  </li>

  <li>
    <strong>Собрать и запустить контейнер:</strong>
    <pre><code>docker compose up -d --build</code></pre>
    <p>При запуске автоматически:</p>
    <ul>
      <li>Соберется Docker image приложения</li>
      <li>Создастся <code>.env</code> из <code>.env.example</code></li>
      <li>Установятся PHP-зависимости через Composer</li>
      <li>Установятся Node.js зависимости</li>
      <li>Сгенерируется APP_KEY</li>
      <li>Создастся SQLite база данных</li>
      <li>Выполнятся миграции</li>
      <li>Заполнятся тестовые данные (seeders)</li>
      <li>Настроятся права доступа Laravel</li>
      <li>Запустится scheduler Laravel</li>
      <li>Соберутся frontend assets через Vite</li>
      <li>Запустится Apache внутри контейнера</li>
    </ul>
  </li>
  
  <br>
  
  <li>
    <strong>Приложение будет доступно по адресу:</strong>
    <pre><code>http://localhost:8080</code></pre>
  </li>
</ol>

<h2>⚠️ Важно:</h2>
<p>Первый запуск может занять несколько минут, так как Docker скачивает образы и устанавливает зависимости.</p>

<br>

<h2>📘 Реализованные пункты задания</h2>

<h3>1. Консольная команда + JSON API</h3>

<p>Laravel console command:</p>

<pre><code>php artisan joke:fetch</code></pre>

<p>Получение данных из внешнего API:</p>

<pre><code>https://official-joke-api.appspot.com/random_joke</code></pre>

<p>Автоматический запуск scheduler каждые 5 минут.</p>

<p>Сохранение jokes в SQLite.</p>

<p>JSON endpoint:</p>

<pre><code>GET /api/jokes?limit=20</code></pre>

<br>

<h3>2. JS-фильтр полей формы</h3>

<p>Решение находится в файле:</p>

<pre><code>src/public/js/type-fields-toggle.js</code></pre>

<p>Подключение:</p>

<pre><code>&lt;script src="http://localhost:8080/js/type-fields-toggle.js"&gt;&lt;/script&gt;</code></pre>

<p>Также можно использовать как browser console snippet.</p>

<br>

<h3>3. Дополнительное задание — статистика посещений</h3>

<p>JS tracker:</p>

<pre><code>src/public/js/visit-tracker.js</code></pre>

<p>API endpoint:</p>

<pre><code>POST /api/visits</code></pre>

<p>Определение IP на backend через Laravel Request.</p>

<p>Внешний GeoIP для определения города и страны.</p>

<p>Парсинг User-Agent:</p>
<ul>
  <li>browser</li>
  <li>platform</li>
  <li>device</li>
</ul>

<p>Страница статистики:</p>

<pre><code>http://localhost:8080/stats</code></pre>

<h3>Тестовый пользователь</h3>

<code>Email: test@example.com</code><br>
<code>Пароль: password</code>

<p>Chart.js graphs:</p>
<ul>
  <li>уникальные посещения по часам</li>
  <li>разбиение посещений по городам</li>
</ul>

<br>
<h2>🌐 Проверка deployed версии (Fly.io)</h2>

<p>Проект также развернут на Fly.io:</p>

<code>https://amopoint-test-young-lantern-9332.fly.dev/</code>

<h3>Что можно проверить</h3>

<ul>
  <li>
    Главная страница:
    <br>
    <code>/</code>
  </li>

  <li>
    API jokes:
    <br>
    <code>/api/jokes?limit=20</code>
  </li>

  <li>
    Страница статистики visits:
    <br>
    <code>/stats</code>
  </li>

  <li>
    Авторизация:
    <br>
    <code>/login</code>
  </li>
</ul>

<h3>Тестовый пользователь</h3>

<code>Email: test@example.com</code><br>
<code>Пароль: password</code>

<h3>Проверка visit-tracker.js</h3>

<p>На любом внешнем сайте открыть DevTools → Console и выполнить:</p>

<pre><code>const script = document.createElement('script');
script.src = 'https://amopoint-test-young-lantern-9332.fly.dev/js/visit-tracker.js';
document.body.appendChild(script);
</code></pre>

<p>После этого новый visit появится в статистике:</p>

<code>/stats</code>

<br>

<h2>🧪 Полезные команды</h2>

<p>Запустить console command вручную:</p>

<pre><code>docker compose exec app php artisan joke:fetch</code></pre>

<p>Перезапустить проект с очисткой базы:</p>

<pre><code>docker compose down -v
docker compose up -d --build</code></pre>

<p>Перезапустить миграции и seeders:</p>

<pre><code>docker compose exec app php artisan migrate:fresh --seed</code></pre>

<p>Посмотреть scheduler log:</p>

<pre><code>docker compose exec app tail -f /tmp/scheduler.log</code></pre>
