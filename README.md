# MOVIES API
Una API REST que permite manejar un CRUD de peliculas y traer su informacion de manera ordenada,paginada y a traves de filtros

# Importar base de datos
Importar desde PHPMyAdmin(o derivados) database/db_movies.sql

# Pruebas desde PostMan o cualquier plataforma de APIS
Para probar desde postman o cualquier plataforma distinta,se debe ingresar como endpoint de la API:
  http://localhost/carpetaDondeEstaElProyecto/api/movies



# Obtener Peliculas

TRAER TODAS
method: GET
Para obtener todas los registros: http://localhost/carpetaDondeEstaElProyecto/api/movies

TRAER TODAS POR UN ORDEN
method: GET
Para obtner todas los registros pero ordenados por un campos de forma ascendiente o descendiente,se debe agregar a la URI el parametro ?sort=(campo a ordenar)&order=(asc o desc),por ejemplo si quisieramos ordenar las peliculas por su autor de forma ascendente la URI seria:
http://localhost/carpetaDondeEstaElProyecto/api/movies/?sort=author&order=asc

*posibles campos:"id_movie","title","description","author","premiere_date","id_gender_fk","image"

TRAER LAS PELICULAS DE FORMA PAGINADA
method: GET
Para obtener los registros de forma paginada se agrega en la URI el parametro ?page=(paginaRequerida) que indica que pagina se quiere traer,tambien se agrega el parametro &limit=(cantidad de registros maxima por pagina) que indica el maximo de registro que se quiere por pagina.Ejemplo:Si quisieramos traer registros de forma paginada y quisieramos que por pagina solo hubiera 10 la URI seria: http://localhost/carpetaDondeEstaElProyecto/api/movies/?page=1&limit=10

FILTRAR LAS PELICULAS
method: GET
Para obtener los registros a traves de un filtro se agrega a la URI el parametro ?filter={campoAFiltrar}&value={valorDeseado},que trae todos
los registros que en el campo indicado tengan el valor dado.