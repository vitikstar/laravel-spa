# Коментарі API

API для управління коментарями у системі.

# Розгортання та тестування додатку

## Встановіть Git

Перейдіть на офіційний сайт [Git](https://git-scm.com/downloads).
Завантажте та встановіть Git, використовуючи стандартний процес для вашої операційної системи.

## Клонування репозиторію

Відкрийте термінал та виконайте наступну команду для клонування репозиторію:

```bash
git clone https://github.com/vitikstar/laravel-spa.git
```

## Перейдіть в кореневу папку проекту

```bash
cd laravel-spa
```

## Встановіть Docker

Перейдіть на офіційний сайт [Docker](https://www.docker.com/products/docker-desktop/).
Завантажте та встановіть Docker, використовуючи стандартний процес для вашої операційної системи.



### Запустіть Docker Compose

```bash
docker-compose up -d
```

Це створить необхідні контейнери

### Встановіть всі залежності

```bash
docker exec -it laravel-spa-php-1 composer install 
```
### Скопіюйте файл .env в корінь проекту


Після цього Ваш додаток буде доступний за адресою http://localhost:8082.

### Також для успішної аутентифікації виконайте команду

```bash
docker exec -it laravel-spa-php-1 php artisan passport:keys
```

### Використовуйте Postman для тестування API

Завантажте та встановіть [Postman](https://www.postman.com/downloads/?utm_source=postman-home).
Використовуйте Postman для здійснення тестів API.
Для простоти завантажте [колекцію](spa.postman_collection.json) та імпортуйте її в постман
Тепер ви готові використовувати цей проект та тестувати його API за допомогою Postman.

## Огляд

API надає можливість отримання, додавання та керування коментарями у системі.

## Аутентифікація

Більшість ендпоінтів вимагають аутентифікації. Для аутентифікації використовується токен (див. нижче). Адреса за якою доступні ендпоінти http://spa.edu-smart.space/ або якщо запустити контейнер http://localhost:8082

### Реєстрація нового користувача

#### `POST /api/register`

Створює нового користувача у системі.

##### Параметри запиту:

- `name` (обов'язковий, унікальний) - ім'я користувача
- `email` (обов'язковий, унікальний) - електронна пошта користувача
- `password` (обов'язковий) - пароль користувача
- `avatar` (необов'язковий) - файл в форматі jpeg,jpg,png,gif


##### Приклад успішної відповіді:

```json
    {
        "token":
            "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMDExYzk4MWUxZDhhNWE0Mzg5ZmYxMjMxNTBlMmUxNjdhNTYyMDY5MWNkNzM3Mzc4NzM3ZWFhYjZlOTIyYmUxNjc2MzU3NjBmOTdiZjk4N2IiLCJpYXQiOjE2OTk1MzIyOTcuMjEwNTkzLCJuYmYiOjE2OTk1MzIyOTcuMjEwNTk0LCJleHAiOjE3MzExNTQ2OTcuMjAxODQ3LCJzdWIiOiIyNCIsInNjb3BlcyI6W119.KuZObyuVeToYYJmWLEfhJ9ZUqRk2aW_qVJEdKAQP_FPfHaaYwP6LeCqiTLJBPPYNhou04a1Pbry0rBrn_YU8_pXV9jFco4YOn_CK-5ddFWl_FGEu54Mm-aZAowWBIk2NAIBpCfcnVQMy3uhTdIxuH0Rbf2G3AsACfUrfwsXVSH4EuL-i8Iuswov6VFVWiayNWmGxP7PARopY7aaR1pNahJ8BMb3CKaHDS0fjp8FWoo4ssN3b0gjKSov3rhrDwpvi_I7mXyKE3dwW3oOyvWu1ETsumNtkkFbgv6K-qbnuPEaorFSldPf2ZItK7XF0q2MH7U4nCMfBaFqTlhnyr8zxmefEau7lhhqY-3f3TolNTtDPWjjpPJzurVYXcBjhTpUB40olWbOVaBw1luv45pHxXMkx5IQh0VSPGr46mK1Bu43Z9I9JyoZvAEERZs2p1tInmLkiUB5MkTHLkSM1OjQKh2LHaTi9h2GaiBHjBHdzB-W9GDXcEyAeuphvVz86jvKK6Se9j_dqGJ-3mJrphnpgdayAid5JJ4jpP4hWpMn0AaYKzsrjzy4EVdYzV9FIXV1SEwkmcfCodv2nHvJHo7VNmv6spQG7KQ5tm37nXe5UxJT6rIIKcDaL-NnBz_ZNy45uh81Te3XTFq2GDTrHn__aCy9ylaR2TZ4bihjoB8dWDnc"
    }
```

#### `POST /api/login`

Створює нового користувача у системі.

##### Параметри запиту:

- `email` (обов'язковий) - електронна пошта користувача
- `password` (обов'язковий) - пароль користувача


##### Приклад успішної відповіді:

```json
    {
        "token":
            "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMDExYzk4MWUxZDhhNWE0Mzg5ZmYxMjMxNTBlMmUxNjdhNTYyMDY5MWNkNzM3Mzc4NzM3ZWFhYjZlOTIyYmUxNjc2MzU3NjBmOTdiZjk4N2IiLCJpYXQiOjE2OTk1MzIyOTcuMjEwNTkzLCJuYmYiOjE2OTk1MzIyOTcuMjEwNTk0LCJleHAiOjE3MzExNTQ2OTcuMjAxODQ3LCJzdWIiOiIyNCIsInNjb3BlcyI6W119.KuZObyuVeToYYJmWLEfhJ9ZUqRk2aW_qVJEdKAQP_FPfHaaYwP6LeCqiTLJBPPYNhou04a1Pbry0rBrn_YU8_pXV9jFco4YOn_CK-5ddFWl_FGEu54Mm-aZAowWBIk2NAIBpCfcnVQMy3uhTdIxuH0Rbf2G3AsACfUrfwsXVSH4EuL-i8Iuswov6VFVWiayNWmGxP7PARopY7aaR1pNahJ8BMb3CKaHDS0fjp8FWoo4ssN3b0gjKSov3rhrDwpvi_I7mXyKE3dwW3oOyvWu1ETsumNtkkFbgv6K-qbnuPEaorFSldPf2ZItK7XF0q2MH7U4nCMfBaFqTlhnyr8zxmefEau7lhhqY-3f3TolNTtDPWjjpPJzurVYXcBjhTpUB40olWbOVaBw1luv45pHxXMkx5IQh0VSPGr46mK1Bu43Z9I9JyoZvAEERZs2p1tInmLkiUB5MkTHLkSM1OjQKh2LHaTi9h2GaiBHjBHdzB-W9GDXcEyAeuphvVz86jvKK6Se9j_dqGJ-3mJrphnpgdayAid5JJ4jpP4hWpMn0AaYKzsrjzy4EVdYzV9FIXV1SEwkmcfCodv2nHvJHo7VNmv6spQG7KQ5tm37nXe5UxJT6rIIKcDaL-NnBz_ZNy45uh81Te3XTFq2GDTrHn__aCy9ylaR2TZ4bihjoB8dWDnc"
    }
```
##### Приклад неуспішної відповіді:

```json
    {
        "error":
            "Invalid credentials"
    }
```
При реєстрації користувача на пошту адміністратора приходить лист.

#### `POST /api/add-comment`

Додає новий коментар.

##### Параметри запиту:

- `email` (обов'язковий) - електронна пошта користувача
- `password` (обов'язковий) - пароль користувача
- `file`  - файл формату JPG, GIF, PNG або текстовий файл який не може бути більший 100кб


Потрібна аутентифікація в системі

При додані тексту здійснюється перевірка на валідність тексту та адміністратору на пошту надсилається сповіщення.

##### Приклад успішної відповіді:

```json
    {
        "response": {
            "user_id": 24,
            "text": "<a>xcxfx</a>",
            "parent_comment_id": "1",
            "updated_at": "2023-11-09T13:28:40.000000Z",
            "created_at": "2023-11-09T13:28:40.000000Z",
            "id": 5,
            "file": "storage/comment_file/5/1699536520.jpeg"
        }
    }
```


#### `GET /api/get-comment`

Вибирає всі коментарі з бази данних згідно фільтру

##### Параметри запиту:

- `offset`  - зміщення
- `limit`  - ліміт записів
- `order_by`  - поле по якому сортувати
- `order_direction`  - ASC або DESC
- `user_id`  - id користувача якому належать коментарі

  Всі ці параметри є необовязковими. Якщо нічого не передати то вернуться всі коментарі які є в базі. 



##### Приклад успішної відповіді:

```json
    {
        "comments": [
            {
                "id": 1,
                "user_id": 24,
                "text": "<a>xcxfx</a>",
                "parent_comment_id": 0,
                "created_at": "2023-11-09T12:24:03.000000Z",
                "updated_at": "2023-11-09T12:24:03.000000Z",
                "user": {
                    "id": 24,
                    "name": "viktor",
                    "avatar_url": "storage/avatars/24/1699532297.jpeg",
                    "email": "vitya.ak22071990@gmail.com",
                    "passport_id": null,
                    "passport_token": null,
                    "email_verified_at": null,
                    "created_at": "2023-11-09T12:18:17.000000Z",
                    "updated_at": "2023-11-09T12:18:17.000000Z"
                },
                "parent_comment": null,
                "child_comments": [
                    {
                        "id": 3,
                        "user_id": 24,
                        "text": "<a>xcxfx</a>",
                        "parent_comment_id": 1,
                        "created_at": "2023-11-09T12:24:36.000000Z",
                        "updated_at": "2023-11-09T12:24:36.000000Z",
                        "user": {
                            "id": 24,
                            "name": "viktor",
                            "avatar_url": "storage/avatars/24/1699532297.jpeg",
                            "email": "vitya.ak22071990@gmail.com",
                            "passport_id": null,
                            "passport_token": null,
                            "email_verified_at": null,
                            "created_at": "2023-11-09T12:18:17.000000Z",
                            "updated_at": "2023-11-09T12:18:17.000000Z"
                        }
                    }
                ]
            },
            {
                "id": 2,
                "user_id": 24,
                "text": "<a>xcxfx</a>",
                "parent_comment_id": null,
                "created_at": "2023-11-09T12:24:13.000000Z",
                "updated_at": "2023-11-09T12:24:13.000000Z",
                "user": {
                    "id": 24,
                    "name": "viktor",
                    "avatar_url": "storage/avatars/24/1699532297.jpeg",
                    "email": "vitya.ak22071990@gmail.com",
                    "passport_id": null,
                    "passport_token": null,
                    "email_verified_at": null,
                    "created_at": "2023-11-09T12:18:17.000000Z",
                    "updated_at": "2023-11-09T12:18:17.000000Z"
                },
                "parent_comment": null,
                "child_comments": []
            },
            {
                "id": 3,
                "user_id": 24,
                "text": "<a>xcxfx</a>",
                "parent_comment_id": 1,
                "created_at": "2023-11-09T12:24:36.000000Z",
                "updated_at": "2023-11-09T12:24:36.000000Z",
                "user": {
                    "id": 24,
                    "name": "viktor",
                    "avatar_url": "storage/avatars/24/1699532297.jpeg",
                    "email": "vitya.ak22071990@gmail.com",
                    "passport_id": null,
                    "passport_token": null,
                    "email_verified_at": null,
                    "created_at": "2023-11-09T12:18:17.000000Z",
                    "updated_at": "2023-11-09T12:18:17.000000Z"
                },
                "parent_comment": {
                    "id": 1,
                    "user_id": 24,
                    "text": "<a>xcxfx</a>",
                    "parent_comment_id": 0,
                    "created_at": "2023-11-09T12:24:03.000000Z",
                    "updated_at": "2023-11-09T12:24:03.000000Z"
                },
                "child_comments": []
            }
        ]
    }
```
##### Приклад неуспішної відповіді:

```json
    {
        "comments": []
    }
```

#### `GET /api/get-user-id`

Вертає всі данні про користувача якщо такий є у системі.

##### Параметри запиту:

- `user_id` - id користувача


##### Приклад успішної відповіді:

```json
    {
        "data": {
            "id": 24,
            "name": "viktor",
            "avatar_url": "storage/avatars/24/1699532297.jpeg",
            "email": "vitya.ak22071990@gmail.com",
            "passport_id": null,
            "passport_token": null,
            "email_verified_at": null,
            "created_at": "2023-11-09T12:18:17.000000Z",
            "updated_at": "2023-11-09T12:18:17.000000Z"
        }
    }
```
##### Приклад неуспішної відповіді:

```json
    {
        "error": 
        "User not found"
    }
```

#### `GET /api/get-column-comment-id`

Вертає один коментар по його id

##### Параметри запиту:

- `id` - id коментаря


##### Приклад успішної відповіді:

```json
    {
        "comment": {
            "id": 1,
            "user_id": 24,
            "text": "<a>xcxfx</a>",
            "parent_comment_id": 0,
            "created_at": "2023-11-09T12:24:03.000000Z",
            "updated_at": "2023-11-09T12:24:03.000000Z",
            "user": {
                "id": 24,
                "name": "viktor",
                "avatar_url": "storage/avatars/24/1699532297.jpeg",
                "email": "vitya.ak22071990@gmail.com",
                "passport_id": null,
                "passport_token": null,
                "email_verified_at": null,
                "created_at": "2023-11-09T12:18:17.000000Z",
                "updated_at": "2023-11-09T12:18:17.000000Z"
            },
            "parent_comment": null,
            "child_comments": [
                {
                    "id": 3,
                    "user_id": 24,
                    "text": "<a>xcxfx</a>",
                    "parent_comment_id": 1,
                    "created_at": "2023-11-09T12:24:36.000000Z",
                    "updated_at": "2023-11-09T12:24:36.000000Z",
                    "user": {
                        "id": 24,
                        "name": "viktor",
                        "avatar_url": "storage/avatars/24/1699532297.jpeg",
                        "email": "vitya.ak22071990@gmail.com",
                        "passport_id": null,
                        "passport_token": null,
                        "email_verified_at": null,
                        "created_at": "2023-11-09T12:18:17.000000Z",
                        "updated_at": "2023-11-09T12:18:17.000000Z"
                    }
                }
            ]
        }
    }
```
##### Приклад неуспішної відповіді:

```json
    {
        "error": "Comment not found"
    }
```

### Тестування здійнювалось в postman.





# Документація GraphQL

Ласкаво просимо до документації GraphQL API для цього проекту. Окрім REST API, наш проект включає кінцеву точку GraphQL, доступну за адресою http://localhost:8082/graphql або http://spa.edu-smart.space/graphql. Тут ви знайдете детальну інформацію про п’ять запитів і мутацій GraphQL, які можна використовувати для взаємодії з системою.

## Мутації

### 1. Створіть коментар

Використовуйте цю мутацію, щоб додати новий коментар.

```graphql
mutation {
  createComment(
    text: "<a>QraphQL</a>"
  ) {
    data
  }
}
```

### 2. Реєстрація користувача

Зареєструйте нового користувача з цією мутацією.

```graphql
mutation {
  registerUser(
    name: "viktor",
    email: "john@example.com",
    password: "securepassword"
  ) {
    token,
    data
  }
}
```

### 3. Автентифікація користувача

Автентифікуйте існуючого користувача з цією мутацією.

```graphql
mutation {
  authUser(
    email: "john@example.com",
    password: "securepassword"
  ) {
    token,
    data
  }
}
```
## Запити

### 1. Отримайте коментар за ідентифікатором

Отримати

```graphql
query {
  comment(id: 5) {
    text
  }
}
```

### 2. Отримати всі коментарі

Отримати всі коментарі з підтримкою розбиття сторінок.

```graphql
query {
  comments(page: 1, perPage: 1) {
    data {
      text
    }
  }
}
```

## Інструменти розробки GraphQL

Для зручного тестування та налагодження ми встановили GraphQL DevTools, доступні за адресою http://localhost:8082/graphiql.

Крім того, усі згадані вище запити GraphQL доступні в [колекції](spa.postman_collection.json) Postman для зручності тестування.
