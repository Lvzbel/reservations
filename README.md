<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Notes
### Requirements Completed
- Create a new provider
- Create a new client
- Submit available times for reservations
- Retrieve a list of available reservation slots by day
- Clients can reserve an appointment slot
- Allows clients to confirm their reservation
- Clients must confirm their reservation within 30 minutes

### Requirement Not Completed
- When time slots are retrieve, there is no logic to check for block times by reservations already created (ran out of time)
- When creating a reservation there is no logic to check if that time slot is taken (ran out of time)
- Additional feature to reserve 24 hours in advance (ran out of time)

### Observations
- Instead of creating roles of (provider/client) for user I created to different tables for Providers and Client to keep it more simple but this would not work properly in a real world scenario.
- A better file structure, I did not created a file for API V1.
- Naming consistency, being in a hurry cause for some naming consistency across files for example: `$startDate/$startTime` & `$workflowName/$workflow`
- Usage of Mocks in testing, I was having trouble with this new installation of Laravel 11(was just released) and Mock were not working for me.
- Due to time constraints, I was not able to add some validation for example if Provider existed and most importantly the logic to check if time slots where taken. I could have made more progress by avoiding testing but I was not willing to make that compromise.
- I wish I could have written the exercise in .Net but I didn't feel comfortable enough with the time limit.
- Standardize all response data to contain **camelCase** rather than **snake_case** to comply with API standards.
- In the request `Get Time Slots by Day` I made it a `POST` request it should have been a `GET` but realized it to late.

### Before Deployment in a real world.
- Make sure that the logic to determined a time slot is block will have a solid testing suite as is one of the most critical and complex features.
- Learn and implement correctly how Providers/Clients will work to prevent code duplication like I did in this exercise.
- Usage of ORM, I usually prefer to write raw queries but do to time I made heavy use of Laravel's ORM.
- Offer the ability to retrieve multiple days availability.

### Files Worked On
```
    Workflows/Queries/Commands:
    app/
    └── Modules/
    
    Controllers:
    app/
    └── Http/
        └── Controllers/
    
    Models:
    app/
    └── Http/
        └── Models/
    
    Routes:
    routes/
    
    Migration and Factories:
    tests/
    └── Feature/
    └── Unit/
    
    Migration and Factories:
    app/
    └── migrations/
    └── factories/
```
## Installation
### Requirements: **Docker**

Step One:

```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

Step Two: build container

```
./vendor/bin/sail build
```

Step Three:

```
./vendor/bin/sail up -d
```

Step Four: run migrations (sorry didn't have time to seed the database)

```
./vendor/bin/sail artisan migrate:fresh
```

Step Five: check `http://0.0.0.0:80` to see the laravel starting page, if is different you can check the console right after step three.

Step Six: Run testing suite
```
./vendor/bin/sail php artisan test
```


## API Documentation

**-- Get Providers**
----
* **URL**
  `api/v1/providers`

* **Method:**
  `GET`

    * **Success Response:**
    * **Code:** 200 <br />
      **Content:**
        ```json
        [
              {
                  "id": 1,
                  "name": "steve",
                  "email": "steve@example.com"
              },
              {
                  "id": 2,
                  "name": "john",
                  "email": "john@example.com"
              }
          ]
        ```
---
**-- Create Provider**
----
* **URL**
    `api/v1/providers`

* **Method:**
    `POST`
* **Data Params**

  ```json
    {
    "name": "provider",
    "email": "provider@example.com"
    }
    ```
* **Success Response:**
  * **Code:** 200 <br />
    **Content:**
    ```json
    {
    "success": true,
    "data": {
        "name": "provider",
        "email": "provider@example.com",
        "id": 1
      }
    }
    ```
* **Error Response:**
    * **Code:** 400 Bad Request<br />
      **Content:** `{ message : "Error message" }`




---

**-- Get Clients**
----
* **URL**
  `api/v1/clients`

* **Method:**
  `GET`

    * **Success Response:**
    * **Code:** 200 <br />
      **Content:**
        ```json
        [
              {
                  "id": 1,
                  "name": "steve",
                  "email": "steve@example.com"
              },
              {
                  "id": 2,
                  "name": "john",
                  "email": "john@example.com"
              }
          ]
        ```
---
**-- Create Client**
----
* **URL**
  `api/v1/clients`

* **Method:**
  `POST`
* **Data Params**

  ```json
    {
    "name": "provider",
    "email": "provider@example.com"
    }
    ```
* **Success Response:**
    * **Code:** 200 <br />
      **Content:**
      ```json
      {
      "success": true,
      "data": {
          "name": "provider",
          "email": "provider@example.com",
          "id": 1
        }
      }
      ```
* **Error Response:**
    * **Code:** 400 Bad Request<br />
      **Content:** `{ message : "Error message" }`




---

**-- Submit Available Times**
----
* **URL**
  `api/v1/times`

* **Method:**
  `POST`
  * **Data Params**

    ```json
      {
          "providerId": 1,
          "startDate": "2024-04-01 08:00:00", //8am
          "endDate": "2024-04-01 17:00:00" // 5pm
      }
      ```
    * **Success Response:**
  * **Code:** 200 <br />
    **Content:**
    ```json
      {
          "success": true,
          "data": {
          "provider_id": 1,
          "start_time": "2024-04-01T08:00:00.000000Z",
          "end_time": "2024-04-01T17:00:00.000000Z",
          "updated_at": "2024-03-24T23:09:46.000000Z",
          "created_at": "2024-03-24T23:09:46.000000Z",
          "id": 1
          }
      }
    ```
* **Error Response:**
    * **Code:** 400 Bad Request<br />
      **Content:** `{ message : "Failed to create available time." }`




---

**-- Get Time Slots by Day**
----
* **URL**
  `api/v1/times/slots`

  * **Method:**
    `POST`
      * **Data Params**

        ```json
          {
              "providerId": 1,
              "date": "2024-04-01"
          }
          ```
      * **Success Response:**
      * **Code:** 200 <br />
        **Content:**
        ```json
          {
              "success": true,
              "data": [
                        [
                            {
                                "providerId": 1,
                                "startTime": "2024-04-01 08:00:00",
                                "endTime": "2024-04-01 08:15:00"
                            }
                        ],
                        [
                            {
                                "providerId": 1,
                                "startTime": "2024-04-01 08:15:00",
                                "endTime": "2024-04-01 08:30:00"
                            }
                        ]
              ]         
          }
        ```



---

**-- Create Reservation**
----
* **URL**
  `api/v1/reservations`

  * **Method:**
    `POST`
      * **Data Params**

        ```json
          {
              "providerId": 1,
              "clientId": 1,
              "startTime": "2024-04-01 08:00:00", // 8:00am
              "endTime": "2024-04-01 08:15:00" // 8:15am
          }
          ```
      * **Success Response:**
      * **Code:** 200 <br />
        **Content:**
        ```json
        {
            "success": true,
            "data": {
            "provider_id": 1,
            "client_id": 1,
            "start_time": "2024-04-01T17:00:00.000000Z",
            "end_time": "2024-04-01T17:15:00.000000Z",
            "id": 4
            }
        }
        ```
* **Error Response:**
    * **Code:** 400 Bad Request<br />
      **Content:** `{ message : "Failed to create reservation." }`




---

**-- Confirm Reservation**
----
* **URL**
  `api/v1/reservations/confirm`

    * **Method:**
      `POST`
        * **Data Params**

          ```json
            {
                "reservationId": 1
            }
            ```
        * **Success Response:**
        * **Code:** 200 <br />
          **Content:**
          ```json
            {
                "success": true,
                "data": {
                "id": 4,
                "provider_id": 1,
                "client_id": 1,
                "start_time": "2024-04-01T17:00:00.000000Z",
                "end_time": "2024-04-01T17:15:00.000000Z",
                "is_confirmed": true
                }
            }
          ```
* **Error Response:**
    * **Code:** 400 Bad Request<br />
      **Content:** `{ message : "Failed to confirm reservation." }`



