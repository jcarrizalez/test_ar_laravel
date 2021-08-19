## Por Hacer
- Crear un Context para administrar JWT en sesión.
- Terminar Middleware JwtAuth mediante uso del Context y JWT
- Crear un trait Imageable
- Crear un modelo ImageType
- Crear un modelo Image 'imageable' con un belongsTo a ImageType
- Agregar configuración Amazon S3, por ahora solo deje SFTP
- Modificar el BookEloquentJavaScriptSeed para que lea las imágenes del path local y se suban a S3, con su respectiva validación de si existe cada archivo y grabar su url en BD,
- Modificar el servicio BookShowService para que haga el return según la url de S3
- Crear migrations con los cambios necesarios a los procesos ya mencionados
