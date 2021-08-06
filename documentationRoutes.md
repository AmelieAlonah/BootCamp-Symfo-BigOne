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