# **IMPORTANTE**

**Actualizacion 17/11/2023**

**Cambios en la BD:**

Se agregaron las siguientes tablas:

1. Tabla **_transaccion\_formulas_**

2. Tabla **_formulas_**

Se añadió el campo **_categoria\_producto_** a la tabla **_almacen_**

## PENDIENTE

Falta agregar la opción para crear "n" cantidad de alimento en base a las fórmulas.

---

**Actualizacion 14/11/2023**

Cambios en la BD:

1. Tabla compras: Se cambio a float la columna precio_compra

2. Tabla transaccion_compras: Se cambio a float la columna total_compras

3. Tabla ventas: Se cambio a float la columna precio_venta

4. Tabla transaccion_ventas: Se cambio a float la columna total_ventas

### Una enorme disculpa, tarde un poco en subir los cambios porque ayer estuve ocupado hasta tarde.

---

Abre la terminal de git bash en la carpeta alicum y ejecuta el comando:
> git pull

Cualquier duda ya sabes 😉

---

> Cuando tengas tiempo puedes descargar el proyecto y probarlo, cualquier duda estaré al pendiente.
>
> Si encuentras algún error en el sistema por favor hazmelo saber para corregirlo. 
>
> Igual y si quieres que cambie algo o agregue otra funcionalidad no dudes en decirme.

---

# IMPORTANTE

## Para acceder al sistema usar las credenciales (inicio de sesión)

> | Campo       | Credenciales |
> |-------------|--------------|
> | Usuario     | admin        |
> | Contraseña  | admin        |

Estos son los datos de acceso por defecto, puedes agregar nuevos usuarios administradores como gustes una vez estando dentro del sistema.

---

# Modificaciones a la Base de Datos

Se realizaron modificaciones sobre las siguientes tablas:

- usuarios
- transaccion_venta
- almacen
- ventas
- compras

Para poder usar el sistema es necesario que importes en tu phpmyadmin una de las bases de datos que deje en la carpeta "_databases_", igual ahi deje una nota.

---

### NOTA:
Usar el siguiente comando para descargar la versión más reciente del proyecto   
`git pull`  
> **IMPORTANTE:** Si tienes avances en local es recomendable hacer un respaldo antes de ejecutar el comando anterior, ya que las diferentes versiones ocasionan "_conflictos_" que se tienen que solucionar de forma manual.


Igual dejo el enlace de descarga directo por si no quieres usar comandos.

>  [Click aquí](https://github.com/karen10monjaras/alicum/archive/refs/heads/main.zip "Alicum")

Igual aquí abajo te dejo la guía básica para trabajar con GIT por si en algún futuro quieres usarlo 🔽. 

---

## Guía básica para trabajar con GIT

> Paso 1: Entrar a la carpeta donde se encuentra el proyecto donde vamos a utilizar GIT y abrir la terminal GIT BASH.

> Paso 2: Usar el comando:  
**`git init`**  
Para inicializar el proyecto (esto se hace una única vez) y le dice a GIT que empiece a "_seguir_" cada acción que realicemos al proyecto. GIT detecta cuando los archivos se crean/modifican/eliminan. 

> Paso 3: Con el comando:  
**`git add .`**  
Le decimos a GIT que pase al "_área de preparación_" los archivos con los que hayamos trabajado. Es útil y necesario usar este comando para preparar nuestra nueva versión del proyecto con los cambios que hayamos realizado.

> Paso 4 (Este paso es opcional): Con el comando:  
**`git status`**  
Podemos comprobar el estado actual de nuestro proyecto, es útil para saber que nos falta agregar al "_área de preparación_" o si tenemos cambios por guardar (como una nueva versión).

> Paso 5: Usar el comando:  
**`git commit -m "Mensaje de la nueva versión"`**  
Este comando se usa para guardar una nueva versión de nuestro programa, esta nueva versión se almacena con un nombre descriptivo (lo que va dentro de comillas)
que especifica que cambios realizamos sobre dicha versión, por ejemplo: si en mi proyecto creo un "inicio de sesión" y quiero guardar esa versión porque es algo importante se puede usar un comando como el siguiente: **`git commit -m "Se añadió el inicio de sesión"`** de esta forma cuando revisemos las diferentes versiones del proyecto aparecerá dicho mensaje para ayudarnos a recordar que fue lo que se implemento en ese momento. Lo que va dentro de comillas es a decisión propia (de preferencia un mensaje descriptivo). Este comando toma todos los datos que fueron almacenados en el "_área de preparación_" visto en el paso 3 y lo restaura.

> Paso 6: Crear un repositorio en una plataforma de alojamiento de código, una de las más usadas es GitHub.com. Esto también solo se hace una única vez por proyecto.

> Paso 7: Usa el comando:   
**`git remote add origin https://github.com/nombre_usuario/ejemplo_repo.git`**  
Este comando configura hacia que repositorio se va a subir nuestro proyecto y los cambios que realicemos a futuro. Para este ejemplo tenemos la url "**_`https://github.com/nombre_usuario/ejemplo_repo.git`_**" donde debemos de reemplazar "_nombre_usuario_" por nuestro usuario de GitHub y "_ejemplo_repo_" es el nombre que le asignamos al repositorio en el paso anterior, al final del repositorio se agrega "_.git_". Este comando se utiliza una única vez por cada proyecto que queramos subir a la nube.

> Paso 8: Con el comando:  
**`git push -u origin main`**  
Le decimos a GIT que queremos enviar nuestros cambios de la rama "_main_" a origin (el repositorio que configuramos con el comando anterior). La rama "_main_" en su defecto es donde tenemos nuestros archivos con los que trabajamos y esos cambios son los que subimos a la nube. Cabe mencionar que el comando completo es: `git push -u origin main` y se ejecuta una única vez a menos que cambiemos el lugar de alojamiento (repositorio) de nuestro proyecto, si no lo cambiamos (el repositorio) para los posteriores envios solo se utiliza: **`git push`**.

> Paso 9: Usar el siguiente comando:  
**`git pull`**  
Para descargar todos los nuevos cambios que se han subido al repositorio remoto (en la nube), este comando es útil cuando se trabaja con múltiples desarrolladores y estos suben constantes cambios al proyecto, entonces utilizamos dicho comando para obtener la versión más actualizada del proyecto (con los cambios que suban los demás desarrolladores).

> Paso 10 (Este paso es opcional): Con el comando:  
**`git log`**  
Se puede revisar el historial de versiones de nuestro proyecto, una versión más usada es: **`git log --oneline`** (para mostrar las versiones de forma corta/simplificada) o **`git log --oneline --graph`** (para mostrar un gráfico).

> Paso 11 (Este paso es opcional): Usar el comando:
**`git clone https://github.com/nombre_usuario/ejemplo_repo.git`**  
Este comando se usa para descargar una copia exacta del repositorio descrito en la url. Todo el historial de versiones que se suben a la nube se mantienen intactos, así que no hay problema en borrar los archivos locales, siempre se pueden volver a descargar usando el comando descrito en este paso.

> Nota: Es importante que dos o más desarrolladores no modifiquen el mismo archivo antes de subirlos a la nube, esto porque luego se generan "_Conflictos_" que tiene que solventar el dueño del repositorio. La resolución de un conflicto implica seleccionar que cambios se quieren aplicar de las diferentes modificaciones de los desarrolladores.

> Sientete libre de modificar los archivos que quieras, GIT nos permite "**_viajar en el tiempo_**" para consultar todas las versiones disponibles y ver el código que estaba escrito en dicha versión. En caso de que el proyecto presente errores se puede regresar a una versión donde no existía dichos errores.

---

# PROYECTO DE RESIDENCIA PROFESIONAL _**PUNTO DE VENTA ALICUM**_

## DESCRIPCIÓN DEL PROYECTO
>
> PUNTO DE VENTA PARA LA EMPRESA **ALICUM**
>

## RESIDENTE
>
> **NOMBRE:** KAREN YAMILET MONJARAS HERNÁNDEZ
>
> **MATRÍCULA:** 19180052
>
> **CARRERA:** INGENIERÍA EN SISTEMAS COMPUTACIONALES
>
> **ESPECIALIDAD:** INGENIERÍA DE SOFTWARE
>
> **SEMESTRE:** 9
>