# BACKEND

## Por Hacer
- Crear un Context para administrar JWT en sesión.
- Terminar Middleware JwtAuth mediante uso del Context y JWT
- Crear endpoint auth que será el encargado de validar la aplicación que consume esta api y dar los permisos necesarios
- Crear un trait Imageable
- Crear un modelo ImageType
- Crear un modelo Image 'imageable' con un belongsTo a ImageType
- Agregar configuración Amazon S3, por ahora solo deje SFTP
- Modificar el BookEloquentJavaScriptSeed para que lea las imágenes del path local y se suban a S3, con su respectiva validación de si existe cada archivo y grabar su url en BD,
- Modificar el servicio BookShowService para que haga el return según la url de S3
- Crear migrations con los cambios necesarios a los procesos ya mencionados
- Crear Tabla de búsquedas para cuantificar qué es lo que más buscan los usuarios.
- Crear Progress de lectura, este punto lo agrego aca, pero depende de las políticas de la empresa, este progress sería un servicio que almacene data del usuario al estoy google analytics, pero yo montaria un servicio con socker que sea la web que envie la data cada 30seg a ese servicio y el servicio almacene en memoria cada hasta tener 100 registro o se cumpla el tiempo máximo para volcar en BD por lotes dichos registros, ejemplo: {
	pagina, 
	date_desde,
	date_hasta,
	user
}

##Test
no esta listos, deje solo un archivo, pero me dio falla con la versión y es algo a revisar, me fucionan en php7.2 y phpunit/phpunit 7.0.
```bash
./vendor/bin/phpunit
```
# FRONTEND

## Codigo Fuente
	[GIT_TEST_REACT_JS](https://github.com/jcarrizalez/test_ar_react_js) 


## Execute
- En el proyecto BACKEND No Modifique su docker-composer, para no complicar las cosas en tiempo, pero deje una carpeta llamada "build_reactjs", por lo que con su php local basta para ver la web corriendo en un navegador, así que con cd PATH del proyecto y un php -S alcanza.
```bash
php -S localhost:8881 -t ./build_reactjs/
```


## Por Hacer
- El maquetado le falta mucho, levante cualquier cosa que fuera rápido porque la intención era consumir la api
- Crear una paginas de error, modals etc.
- Terminar el ScrollViewBook que es cuando llegas al final del div, cargue otro seguido a ese div.
- Yo uso un archivo de endpoints y me guindo de eventos redux para su consumo, esto permite manejar caché de resquest, no lo agregue en esta prueba y consumi la api directamente desde los componente por ser una prueba, pero yo haria eso para un sistema más grande, esto permite separar las cosas, y él quedan archivos más chicos, ya que rutas es algo que se configura y no se toca más,
- separar la lógica de los useEffect en funciones aparte, los deje asi por la rapidez, casi siempre los hago asi y luego hago la separación en los archivos necesarios.

