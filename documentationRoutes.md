# API

| Routes                | Nom de la route     | Controller | Methods (HTTP) | Méthods      |
| --------------------- | ------------------- | ---------- | -------------- | ------------ |
| /api/movies           | api_movies_get      | Api\Movie  | GET            | readMovies() |
| /api/movies/{id<\d+>} | api_movies_get_item | Api\Movie  | GET            | readMovie()  |
| /api/movies           | api_movies_post     | Api\Movie  | POST           | create()     |
| /api/movies/{id<\d+>} | api_movies_put_item | Api\Movie  | PUT PATCH      | update()     |
| /api/movies/{id<\d+>} | api_movies_by_tags  | Api\Movie  | DELETE         | delete()     |