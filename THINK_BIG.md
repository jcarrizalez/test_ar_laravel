# Piensa en grande:

Imagine que tiene de 2 a 3 meses completos para desarrollar la solución, ¿tomaría un enfoque diferente? Piense en cómo aumentar la relevancia de los resultados, la escalabilidad, el rendimiento y la seguridad del contenido. Descríbalo con todos los detalles que considere oportunos.

La solución debe presentarse por escrito, un archivo de rebajas en el repositorio es más que suficiente. Puede incluir un diagrama o cualquier cosa que considere útil.

# Propuesta:

Para realizar este proyecto con un plazo de 2 a 3 meses, si tomaría un enfoque distinto que describen bien los puntos más importante de todo sistema y solo tomando como enfoque la parte del desarrollo backend:

## Requerimientos:

- Buscar dentro de un libro.
- Lista de páginas con coincidencias con fragmentos de información.
- Recuperar página seleccionada.

## Solución a vista del cliente:

#### - paso1

	endpoint: GET:books
	descripción: lista de todos los libros disponibles en la plataforma
	queryparams: ?page:int, ?count:int, ?search:string
	request:null
	headers: authorization:string
	response:array[
		{
			name: string,        # Eloquent JavaScript
			slug: string,        # eloquent-javascript
			descripcion: string, # Descripcion del libro 
			image: string        # url_cdn de la imagen portada
		}
	]

#### - paso2

	endpoint: GET:books/{book}/content
	descripción: paginado del libro con filtro
	queryparams: ?page:int, ?count:int, ?search:string
	request:null
	headers: authorization:string
	response:array[
		{
			page:int,            # numero de pagina
			text:string,         # texto de la pagina
			image:string         # url_cdn de la imagen pagina
		}
	]

#### - paso3

	endpoint: POST:tracker
	descripción: registro de actividad dentro del frontend vía socket io
	queryparams: null
	headers: authorization:string
	request:object{
		type:string                  # tipo de evento, ejemplo "search_book"
		metadata:{
		}
	}
	response:null

#### - paso4

	endpoint: POST:auth
	descripcion: validación de la aplicación que consume los recursos
	queryparams: null
	headers: null
	request:{
		api_key:string               # key de la app
	}
	response:{
		authorization:string         # authorization cambiante en cada petición via headers
	}

## Solución backend laravel:

#### - paso1

- no es requerido, pero es necesario ya que la idea es poder subir más libros via seeders.
- uso de cache por queryparams, así no hacer uso constante de la BD.

#### - paso2

- uso de url extendida con "content", debido que si a futuro se requiere mostrar la información del libro ya queda reservado el endpoint books/{book} para esto
- uso de cache por queryparams, asi no hacer uso constante de la BD.

#### - paso3

- uso tracker como class única, básicamente se le enviaran las búsquedas que hagan los usuarios tanto de libros como dentro de un libro, queda como único endpoint ya que si desean a futuro registrar más eventos como tiempo de lectura y pagina mas vista el endpoint lo permita.
- tabla de registro de eventos "trackers" clasificadas por tipo de evento.

#### - paso4

- uso de Middleware JwtAuth para todos los endpoints, exceptuando "auth", en cada petición se le devuelve al cliente un nuevo token para la siguiente petición, el token anterior queda vencido.

#### - paso5 o pasos complementarios

- migrations con tablas requeridas para este proyecto.
- seeder para la carga de un libro desde path local, dicha carga subirá a un bucket **S3** o **CDN** que se quiera usar para almacenar las imágenes y luego registrar en BD la metadata de esto "todo con su debida validación de existencia de datos"
- uso de interfaces para cada uno de los servicios o repositorios a usar.
- modelar diagrama UML de lo antes planteado para tener una perspectiva del proyecto de modo gráfico

#### - relevancia de los resultados:

- es paso el 3, ponderado según cantidad y tipos de eventos registrados.

#### - rendimiento:

- el uso de cache y almacenaje de imágenes en cdn bastará para el consumo de este tipo de servicios.
- es posible pasar SELECT de BD a una réplica pero queda opcional.

#### - escalabilidad:

- implementando interfaces y repositorios para cada proceso bastará para no limitar el sistema y poder seguir creciendo a destiempo.
- no trabajar ningun metodo magico de laravel que no este detras de un Trait o Class asi no hacemos que el domain del proyecto esté atado a un frameworks específico

#### - seguridad del contenido:

- la api con jwt renovable via headers  y cookies alcanza para este proyecto.
- usar S3 Authorization para las imágenes.

## Solución backend node:

- **socket io** que mantenga los eventos en caché y sea autónomo, es decir, cada X registro almacenados son enviados a la api para su registro en BD y lo mismo aplica cada cierto tiempo si no se cumple la cantidad de registros esperados, esta solución es un solo archivo node.js el cual estará escuchando los eventos en el frontend, sin importar la lógica de eventos.