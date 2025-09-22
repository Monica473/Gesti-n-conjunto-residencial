Sistema Web de Gestión de Accesos para Conjunto Residencial
Resumen del Proyecto
Este proyecto es una aplicación web integral diseñada para optimizar el registro y control de entradas y salidas en un conjunto residencial. La aplicación permite a diferentes roles (Administrador, Guardia de Seguridad, Residente y Trabajador de Aseo) gestionar y consultar registros de manera eficiente, mejorando la seguridad y la organización del conjunto.

El proyecto fue desarrollado como parte de la actividad GA11-220501098-AA2-EV01 del programa de Análisis y Desarrollo de Software del SENA.

Características y Funcionalidades
Gestión de Usuarios por Roles: Sistema de autenticación y autorización para Administradores, Guardias, Residentes y Trabajadores.

Registro de Entradas y Salidas: Funcionalidad para registrar con precisión los movimientos de personas y vehículos.

Generación de Informes: Creación de reportes personalizados y filtrados por fechas y roles.

Gestión de Perfiles: Los usuarios pueden subir y gestionar su foto de perfil.

Sistema de Notificaciones: Envío de notificaciones automáticas para eventos importantes.

Seguridad: Implementación de prácticas de seguridad para proteger los datos de usuario y prevenir accesos no autorizados.

Tecnologías Utilizadas
El proyecto está construido con una arquitectura de software robusta, utilizando las siguientes tecnologías:

Frontend:

HTML: Estructura de la interfaz de usuario.

CSS: Estilos y diseño visual.

JavaScript: Lógica del lado del cliente.

React: Secciones del código desarrolladas con este framework para interfaces dinámicas.

Backend:

PHP: Lógica del lado del servidor.

Base de Datos:

MySQL: Sistema de gestión de bases de datos relacionales para la persistencia de datos, administrado a través de PhpMyAdmin.

Herramientas de Desarrollo:

Visual Studio Code: Entorno de desarrollo.

XAMPP: Servidor web local para ejecutar el código PHP y la base de datos MySQL.

Git: Sistema de control de versiones utilizado para el seguimiento del proyecto.

Estructura del Proyecto
El código está organizado siguiendo el patrón de diseño Modelo-Vista-Controlador (MVC) para garantizar una separación clara de las responsabilidades:

src/controllers/: Contiene los controladores que manejan la lógica de negocio.

src/models/: Contiene los modelos que interactúan con la base de datos.

src/views/: Contiene las vistas que presentan la interfaz de usuario.

public/: Contiene archivos estáticos (CSS, imágenes) y los puntos de entrada de la aplicación.

config/: Archivos de configuración, como la conexión a la base de datos.

Agradecimientos
Este proyecto fue posible gracias a la orientación y los recursos proporcionados por el programa Análisis y Desarrollo de Software del SENA.
