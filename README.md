# ENDPOINT
http://localhost/carpetaDondeEstaElProyecto/api/resource

# OBTENER TODAS LAS PELICULAS
GET api/movies

# OBTENER TODAS LAS PELICULAS POR UN ORDEN
GET api/movies?sort={{campoAOrdenar}}&order={{ASC||DESC}}(ascendente o descendente)
POSIBLE CAMPOS A ORDENAR(id_movie,title,description,author,premiere_date,id_gender_fk)

# OBTENER UNA PELICULA
GET api/movies/movieID

# CREAR PELICULA
POST api/movies (Se necesita token)

# EDITAR PELICULA
PUT api/movies/movieID (Se necesita token)

# BORRAR PELICULA
DELETE api/movies/movieID