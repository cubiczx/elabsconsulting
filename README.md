# Elabs Consulting - Prueba Técnica

Con esta prueba se trata de evaluar el conocimiento del candidato con la creación de requests en el frontend hecho en vuejs (con laravel mix), una búsqueda en base de datos en el backend, creación de un repositorio de caché y la configuración de una API.

Recursos:

- Proceso de instalación del proyecto con todos los paquetes instalados, laravel con laravel mix
- Base de datos con datos de ejemplo.
- Estructura laravel funcionando con una única página que es la que hay que adaptar para que se muestren los resultados de la API.
- Docker con contenedor de web, bbdd, cache.

Puntos a implementar:

- Se debe crear un repositorio de caché para no hacer peticiones constantes a base de datos, preferiblemente en Redis
- Se debe crear un endpoint que devuelva el item a partir de su ID.
- Se debe crear un endpoint que responda con el precio final del item sumándole un 21% de IVA y los costes que ese IVA suponen.
- Se debe crear una forma de comunicación con la API desde el frontend vue.js que pida los datos necesarios para completar los campos del componente de checkout, el uso de promesas es un extra.
- Se debe crear un repositorio en Bitbucket con el resultado de la prueba y dar acceso a los usuarios adria.colomer@elabsconsulting.com, victor.dorrego@elabsconsulting.com y pablo@elabsconsulting.com

Todo está basado en los estándares de laravel, se puede encontrar la documentación en la siguiente página: https://laravel.com/docs/8.x.

La documentación de la parte frontend la puedes encontrar en: https://vuejs.org/v2/guide/

# Pasos para montar el proyecto

**Sistemas Unix**

- Se debe entrar en la carpeta "docker/dev" y ejecutar el comando: "docker-compose up -d --build"

- Una vez acabe este comando, debemos importar la base de datos ejecutando desde la carpeta "docker/dev/scripts" el comando "sh import-database.sh"

- Cuando este comando termine debemos modificar nuestro archivo /etc/hosts añadiendo la siguiente línea al final: "127.0.0.1 prueba-elabsconsulting.com"

**Windows**

- Eliminamos la siguiente línea de docker/dev/docker-compose.yml
  (- "MYSQL_USER=root")
  
- Entramos en docker/dev y ejecutamos el comando "docker-compose up -d --build" vía powershell

- Cuando acabe de levantar los contenedores, modificamos el archivo C:\Windows\System32\Drivers\etc\hosts añadiendo la siguiente línea al final: "127.0.0.1 prueba-elabsconsulting.com"

- Accedemos a http://prueba-elabsconsulting.com:8184/adminer.php
- Conectamos con las siguientes credenciales:
    - Host: mysql-test-5.7
    - User: root
    - Password: elabstest123
    
- Una vez dentro de adminer, creamos una base de datos con el nombre "elabstest" e importamos el archivo docker/dev/scripts/elabs-test.sql.gz
-------------------------------------------------------------
- Con todos estos pasos ya hechos ahora podemos acceder a http://prueba-elabsconsulting.com:8184 y aquí ya veremos la aplicación montada.

Para cualquier duda o problema te puedes comunicar conmigo enviando un mail a adria.colomer@elabsconsulting.com, victor.dorrego@elabsconsulting.com o pablo@elabsconsulting.com
