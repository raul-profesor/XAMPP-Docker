# Intrucciones

1.Clonar repositorio

  `git clone https://github.com/raul-profesor/XAMPP-Docker.git`

2.Levantar los contenedores

  ```
  cd XAMPP-Docker

  docker compose up -d
  ```

3.Acceder a phpmyadmin en el navegador

  `http://localhost:8000`

4.Acceder a aplicación en PHP en el navegador

  `http://localhost:8001`

# Otras configuraciones

Si se desean cambiar los datos de la base de datos, se puede hacer editando las variables de entorno en el archivo `.env`, así como en el código que se utilice para conectarse a la BBDD.

Si se desea alojar una aplicación diferente a la de muestra, basta con sustituir el contenido de la carpeta `web`por el deseado.
