# Coyo-Forms :speech_balloon: :busts_in_silhouette:
## Equipo Peculiarmente Organizado de las Coyo Encuestas (E.P.O.C.E.)
### :computer: :zap: Conformado por: 
- **Gutiérrez Tafoya Jorge -** Administrador de Encuestas y Archivos.
- **Muriel González Diego -** Administrador de Diseño y Maquetado.
- **Ríos Lira Jaasiel -** Administrador de Seguridad y Permisos.
- **Rosales Olguín Ana Paula -** Administradora de Registros y Usuarios.
- **Ruíz González Julio Maximiliano -** Administrador de la Base de Datos y Coordinador.

## Guía de instalación :cd:
1. Tener instalado XAMPP (version actual).
2. Descargar el repositorio Coyo-Forms desde la rama master del mismo.
3. Guardar todos los archivos del repositorio en la carpeta _directorio-raíz_/xampp/htdocs/
4. El respaldo de la BD se instalará en _directorio-raíz_/xampp/mysql/bin/
5. Tener los servidores Apache y MYSQL dentro del panel de control de XAMPP encendidos.

## Guía de configuración :wrench:
1. Ingresar a terminal con el comando _windows_+_r_.
2. Escribir los comandos _cd /xampp/mysql/bin/_ para situarte en la carpeta mysql, y _mysql -u root_ para igresar a **Maria DB** nuestro servidor MYSQL de XAMPP.
3. Crear base de datos llamada _**p6_opina**_.
4. Bajar respaldo **BD_Coyo_Forms** dentro de la base previamente creada.
5. Desde la base de datos llamada **mysql** crear el usuario _'Administrador'@'localhost'_ con la contraseña _'c0Y0op1n10nE$pR3p@6&'_ , otorgarle todos los privilegios de todas las tablas de la base _**p6_opina**_ con el comando _GRANT ALL PRIVILEGES ON **p6_opina**.**\*** TO 'Administrador'@'localhost'_.
6. Posteriormente, salir de **Maria DB** con el comando _exit_, y volver a ingresar con el comando _mysql -u Administrador -p_ seguido de esto pedirá que ingreses la contraseña del usuario que creamos anteriormente.

## Características :page_with_curl:
- Coyo Forms es una página en la que es posible tanto la creación, manipulación y reutilización de encuestas, como la posibilidad de responderlas. Cuenta con una validación de usuarios, con la cual se regulan las acciones que pueden realizar cada tipo de usuario. Es posible que un usuario ingrese ya sea con su RFC(profesor) o Número de Cuenta(alumno), o con su correo electrónico.
- La página Coyo Forms es versátil, ya que es visible de manera agradable en casi todos los dispositivos electrónicos.

## Comentarios :loudspeaker:
- El PIN para ingresar como admin dentro de la página es el mismo que se utiliza para ingresar a **Maria DB** como _Administrador_.
- Es posible la consulta de los resultados de las preguntas de encuestas, a futuro se agregará la graficación de dichos resultados.:heavy_check_mark:
- Se puede ver el perfil del usuario, pero su funcionalidad se piensa será implementada.:heavy_check_mark:
