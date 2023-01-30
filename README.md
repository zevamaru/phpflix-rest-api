# PHPflix REST API

This project started as a challenge for a job interview, and despite that I knew I was lacking some knowledge to do it, I decided to try hard, and I ended up [learning a LOT](#what-i-learned-with-this-little-project) in the process.

## Steps for testing

- Configure your envoriroment file, or rename .env.example to .env
- Run the Docker container with `./vendor/bin/sail up -d` (Linux or Mac)
- Run `php artisan migrate:fresh --seed` to migrate all tables and seeders for testing
- Use [Postman](https://www.postman.com/) or your preferred software for API testing

You can enter `localhost:8001` to access phpMyAdmin and see how database works.

## Endpoints

### Exposed endpoints:

- `/api/register/` `POST` (name, email, password)
```json
{
    "user": [{user}],
    "access_token": "{token}",
    "token_type": "Bearer"
}
```
- `/api/login/` `POST` (email, password)
```json
{
    "message": "Welcome {name}",
    "access_token": "{token}",
    "token_type": "Bearer"
}
```
	  
### Authenticated endpoints:

In order to access these endpoints, you need add an authorization header (Bearer Token) with the token recieved at `/api/login/`. Please note that the token will expire after 15 minutes.

- `/api/logout/` `GET`
```json
{
    "message": "Token successfully destroyed for {name}.",
}
```
- `/api/refresh/` `GET`
```json
{
    "message": "{name} has a new token.",
    "access_token": "{token}",
    "token_type": "Bearer"
}
```

#### Movie endpoints

- `/api/movies/{movie_id}/` `GET` returns data of a movie
```json
{
    "id": "{id}",
    "movie": "{name}",
    "genre": "{genre}",
    "director": "{director_name}",
    "actors": [{movie_actors}]
}
```
- `/api/movies/` `GET` returns all movies
- `/api/movies/search/{q}` `GET` returns movies matching the query with name
- `/api/movies/filter/` `POST` (filter, q) returns movies matching the query with name or genre
- `/api/movies/` `POST` (name, genre, director_id) add a new movie
```json
{
    "message": "Movie added: {name} directed by {director_name}",
    "movie": [{movie}]
}
```
- `/api/movies/actor/` `POST` (movie_id, actor_id) attach an actor to a movie
```json
{
    "message": "Actor {actor_name} added to movie {movie_name}.",
    "actor": [{actor}]
}
```

#### TV show endpoints

- `/api/tvshows/{tvshow_id}/` `GET` returns data of a TV show
```json
{
    "id": "{id}",
    "tvshow": "{name}",
    "genre": "{genre}",
    "seasons": [{seasons}],
    "actors": [{tvshow_actors}]
}
```
- `/api/tvshows/` `GET` returns all TV shows
- `/api/tvshows/search/{q}` `GET` returns TV shows matching the query with name
- `/api/tvshows/filter/` `POST: (filter, q) returns TV shows matching the query with name or genre
- `/api/tvshows/` `POST` (name, genre, director_id) add a new TV show
- `/api/tvshows/actor/` `POST` (tvshow_id, actor_id) attach an actor to a TV show
```json
{
    "message": "Actor {actor_name} added to the TV show {tvshow_name}.",
    "actor": [{actor}]
}
```
- `/api/seasons/{season_id}/` `GET` returns all episodes of a season
```json
{
    "season": "{number}",
    "tvshow": "{name}",
    "episodes": "[{season_episodes}]"
}
```
- `/api/seasons/` `POST` (number, tvshow_id) adds a number of seasons to a TV show
```json
{
    "message": "{number} seasons added to {tvshow_name}."
}
```
- `/api/episodes/{episode_id}/` `GET` returns data of a episode
```json
{
    "number": "{number}",
    "name": "{name}",
    "season": "{season_number}",
    "tvshow": "{tvshow_name}",
    "director": "{tvshow_name}"
}
```
- `/api/episodes/` `POST` (name, number, season_id) adds an episode to a season
```json
{
    "message": "Episode {number}. {name} added to {tvshow_name} (Season {season_number})"
}
```

#### Actor endpoints

- `/api/actors/` `GET` returns all actors
```json
{
    "id": "{id}",
    "name": "{name}",
}
```
- `/api/actors/` `POST` (name) add a new actor

#### Director endpoints

- `/api/directors/` `GET` returns all directors
```json
{
    "id": "{id}",
    "name": "{name}",
}
```
- `/api/directors/` `POST` (name) add a new director

  
## What I learned with this little project

### Laravel
I have never used Laravel before, and I'm impressed with its power and its number of built-in tools. For this project I use:

- [Sanctum](https://laravel.com/docs/9.x/sanctum): Provides an authentication system for token based APIs. Pretty powerful and easy to configure.
- [Eloquent](https://laravel.com/docs/9.x/eloquent): An ORM to interact with database. I didn't have to write a single line of SQL on this project, which is awesome.
- [Sail](https://laravel.com/docs/9.x/sail): A command-line interface for interacting with Docker. I have set up a container with PHP, MySQL and phpMyAdmin.
- [Artisan](https://laravel.com/docs/9.x/artisan): A command-line interface to assist me while I build the application.
- [Pint](https://laravel.com/docs/9.x/pint): A linting to ensure that my code style stays clean and consistent.

### REST API architecture
Although I've worked with APIs before this is my first time designing an API from scratch.

### Object Relational Mapping
First time working with an ORM, and I'm really excited to have added this knowledge to my skillset. It makes a more fluid interactiong with database, and combined with [Seeding](https://laravel.com/docs/9.x/seeding), it allows me to design and setup a database environment very easily and quickly. 

### Linux (WSL2)
I had to install an Ubuntu terminal (22.04) on my Windows machine in order to work with Laravel Sail and Docker, and use a bunch of commands to navigate and configure the environment.
