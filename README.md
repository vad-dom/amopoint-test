<h1>Amopoint Test Task</h1>

<p>Тестовое задание на вакансию PHP-разработчика.</p>

<p>Текст задания: <a href="https://github.com/vad-dom/amopoint-test/blob/main/TASK.md">TASK.md</a></p>

<p>Используемые технологии и технические решения: <a href="https://github.com/vad-dom/amopoint-test/blob/main/TECHNICAL_NOTES.md">TECHNICAL_NOTES.md</a></p>

<br>

<h2>📂 Структура проекта</h2>

<pre>
├── docker/                              # Docker configuration
├── src/
│   ├── app/
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

<br>

<h2>📘 Реализованные пункты задания</h2>

<h3>1. Console command + JSON API</h3>

<ul>
  <li>Laravel console command: <code>php artisan joke:fetch</code></li>
  <li>Получение данных из external API:
    <br>
    <code>https://official-joke-api.appspot.com/random_joke</code>
  </li>
  <li>Автоматический запуск scheduler каждые 5 минут</li>
  <li>Сохранение jokes в SQLite</li>
  <li>JSON endpoint:
    <br>
    <code>GET /api/jokes?limit=20</code>
  </li>
</ul>

<br>

<h3>2. JavaScript task</h3>

<p>Решение находится в файле:</p>

<pre><code>src/public/js/type-fields-toggle.js</code></pre>

<p>Подключение:</p>

<pre><code>&lt;script src="http://localhost:8080/js/type-fields-toggle.js"&gt;&lt;/script&gt;</code></pre>

<p>Также можно использовать как browser console snippet.</p>

<p>Алгоритм:</p>

<ul>
  <li>Отслеживается изменение поля "Тип"</li>
  <li>Проверяются поля формы с атрибутом <code>name</code></li>
  <li>Отображаются только поля, содержащие выбранный тип</li>
  <li>Дополнительно скрываются spacer elements <code>&lt;p&gt;&amp;nbsp;&lt;/p&gt;</code></li>
</ul>

<br>

<h3>3. Дополнительное задание — статистика посещений</h3>

<ul>
  <li>JS tracker:
    <br>
    <code>src/public/js/visit-tracker.js</code>
  </li>

  <li>API endpoint:
    <br>
    <code>POST /api/visits</code>
  </li>

  <li>Определение IP на backend через Laravel Request</li>

  <li>GeoIP lookup для определения города и страны</li>

  <li>Парсинг User-Agent:
    <ul>
      <li>browser</li>
      <li>platform</li>
      <li>device</li>
    </ul>
  </li>

  <li>Страница статистики:
    <br>
    <code>http://localhost:8080/stats</code>
  </li>

  <li>Chart.js graphs:
    <ul>
      <li>уникальные посещения по часам</li>
      <li>разбиение посещений по городам</li>
    </ul>
  </li>
</ul>

<br>

<h2>🔐 Тестовый пользователь</h2>

<pre><code>Email: test@example.com
Password: password</code></pre>

<p>Используется для входа на страницу статистики:</p>

<pre><code>http://localhost:8080/stats</code></pre>

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
