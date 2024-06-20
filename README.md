## Description

-   Book Library Manager

## Requirements

-   Docker
-   Docker-compose

## Installation

```bash
$ docker-compose up -d
$ docker exec -it book_library_manager_app bash -c "php artisan migrate"
$ docker exec -it book_library_manager_app bash -c "php artisan db:seed"
```

## Instructions

-   If you want to use an api client to test, you have the rest-client.json file in the root of the project to import

## Links

-   [API](http://localhost:9000/api)

## Support

-   Author - [Orlando Nascimento](https://www.linkedin.com/in/orlando-correia-do-nascimento/)

## License

[MIT licensed](LICENSE).
