# API

| Routes                | Route's name        | Controller | Methods (HTTP) | Méthods      |
| --------------------- | ------------------- | ---------- | -------------- | ------------ |
| /api/movies           | api_movies_get      | Api\Movie  | GET            | readMovies() |
| /api/movies/{id<\d+>} | api_movies_get_item | Api\Movie  | GET            | readMovie()  |
| /api/movies           | api_movies_post     | Api\Movie  | POST           | create()     |
| /api/movies/{id<\d+>} | api_movies_put_item | Api\Movie  | PUT PATCH      | update()     |
| /api/movies/{id<\d+>} | api_movies_delete   | Api\Movie  | DELETE         | delete()     |

# BACK-OFFICE

## MovieController

| Routes                       | Route's name      | Controller | Methods (HTTP) | Méthods      |
| ---------------------------- | ----------------- | ---------- | -------------- | ------------ |
| /back/movies                 | back_movies_read  | Back\Movie | GET            | readMovies() |
| /back/movie/read/{id<\d+>}   | back_movie_read   | Back\Movie | GET            | readMovie()  |
| /back/movie/create           | back_movie_create | Back\Movie | GET POST       | create()     |
| /back/movie/update/{id<\d+>} | back_movie_update | Back\Movie | GET POST       | update()     |
| /back/movie/delete/{id<\d+>} | back_movie_delete | Back\Movie | DELETE         | delete()     |

## UserController

| Routes                      | Route's name     | Controller | Methods (HTTP) | Méthods     |
| --------------------------- | ---------------- | ---------- | -------------- | ----------- |
| /back/users                 | back_users_read  | Back\User  | GET            | readUsers() |
| /back/user/read/{id<\d+>}   | back_user_read   | Back\User  | GET            | readUser()  |
| /back/user/create           | back_user_create | Back\User  | GET POST       | create()    |
| /back/user/update/{id<\d+>} | back_user_update | Back\User  | GET POST       | update()    |
| /back/user/delete/{id<\d+>} | back_user_delete | Back\User  | DELETE         | delete()    |

## JobController

| Routes                     | Route's name    | Controller | Methods (HTTP) | Méthods    |
| -------------------------- | --------------- | ---------- | -------------- | ---------- |
| /back/jobs                 | back_jobs_read  | Back\Job   | GET            | readJobs() |
| /back/job/read/{id<\d+>}   | back_job_read   | Back\Job   | GET            | readJob()  |
| /back/job/create           | back_job_create | Back\Job   | GET POST       | create()   |
| /back/job/update/{id<\d+>} | back_job_update | Back\Job   | GET POST       | update()   |
| /back/job/delete/{id<\d+>} | back_job_delete | Back\Job   | DELETE         | delete()   |

# FRONT-OFFICE

## MainController

| Routes                                    | Route's name        | Controller | Methods (HTTP) | Méthods     |
| ----------------------------------------- | ------------------- | ---------- | -------------- | ----------- |
| /                                         | home                | Front\Main | GET            | home()      |
| /movie/{slug/^[a-z0-9]+(?:-[a-z0-9]+)*$/} | movie_read          | Front\Main | GET            | readMovie() |
| /movie/{id<\d+>}/create/review            | movie_create_review | Front\Main | GET POST       | create()    |

## SecurityController

| Routes | Route's name | Controller     | Methods (HTTP) | Méthods |
| ------ | ------------ | -------------- | -------------- | ------- |
| /login | login        | Front\Security | GET            | login() |