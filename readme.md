# Delegation management project

The aim of this project is to provide a solution for managing user delegations.

## Technologies used

- Symfony 6.2
- PHP 8.2
- Docker
- MySQL
- Rector
- ECS

## Requirements

Docker-compose v2 or higher.

## How to run

1. Clone the project from https://github.com/Pablossoo/delegation
2. Run the command `docker-compose up -d` in the main folder.
3. Run  `docker compose exec php bash`
4. In container inside: `Run composer install`
5. Run `bin/console doctrine:migrations:migrate`
6. The project should be available at http://127.0.0.1/

## Quality tools:

### rector:

dry-run: `vendor/bin/rector process src --dry-run`

fix: `vendor/bin/rector process`

### ecs:

dry-run: `vendor/bin/ecs check`

fix: `vendor/bin/ecs check --fix`

## Available endpoints

1. Add user

   Adds a new user to the database.

   URL: http://127.0.0.1/user [POST]

   Input: None

   Output:

```json
   {
  "message": "user has been created !",
  "id": 4
}
```

2. Get delegations for user

   Retrieves a collection of delegations for a specified user.

   URL: http://127.0.0.1/delegations/{user_id} [GET]

   Input:

   User ID

   Output:

```json
   [
  [
    {
      "start": "2023-04-10 08:00:00",
      "end": "2023-04-24 16:00:00",
      "country": "PL",
      "amount_due": 150,
      "currency": "PLN"
    },
    {
      "start": "2023-05-22 05:20:00",
      "end": "2023-05-27 13:30:00",
      "country": "GB",
      "amount_due": 375,
      "currency": "FUNT"
    },
    {
      "start": "2023-06-05 05:20:00",
      "end": "2023-06-12 13:30:00",
      "country": "PL",
      "amount_due": 60,
      "currency": "PLN"
    },
    {
      "start": "2023-09-20 06:20:00",
      "end": "2023-09-22 13:30:00",
      "country": "DE",
      "amount_due": 100,
      "currency": "EUR"
    }
  ]
]
```

3. Add delegation for user

   Adds a new delegation for a specified user.

   URL: http://127.0.0.1/delegation [POST]

   Input:
4. ```json
   {
   "country":"PL",
   "startDelegation": "2023-04-10 05:20:00",
   "endDelegation": "2023-06-24 13:30:00",
   "user": 1
   }
    ```

### Output:

#### Error:

```json
   {
  "message": "bad request",
  "code": 400
}
```

#### success:

```json
   {
  "message": "delegation created",
  "code": 200
}
   ```

## Roadmap

- Unit tests
