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

Step Four: (seed db)

```
./vendor/bin/sail artisan migrate:fresh
```
