# BosquesUrbanos
<!-- 
Descripción de este proyecto:
Se trabaja en un proyecto front donde se tiene la administración de todos los parques de Guadalajara, en el cual encontrarás funciones como:
# Visualización
# Búsqueda por ID
# Eliminación
# Actualización

Cómo iniciar:
Dirígete al archivo en la raíz con nombre .env
Debajo de APP_DEBUG=true agrega lo siguiente:

(Solo agrega lo que esté con #)

URL base:
#AMBU_API_BASE=https://azuritaa33.sg-host.com/api/web/v1 # Dirección de la API

Claves de API:
#AMBU_PUBLIC_KEY=AMBU-T-sb1mV21u9qhGkySo-50377249-5pLqkV # API key para acceso público
#AMBU_PRIVATE_KEY=AMBU-3yFzfnT0hYNq8pq0zZMIH8WXGidZwWco4M5adoRD55GjuqAZ-riAfldmDWfJAoPtj-T # API key privada para acceso a la base

En la carpeta "app" crearemos una carpeta llamada "Services".  
Dentro se generará un archivo .php en el cual crearemos la autenticación y cabecera para realizar nuestras peticiones.


Diseño
Se usa Tailwind CSS.

Cómo instalar Tailwind
Ejecuta este comando en la terminal, en la raíz del proyecto:

npm install tailwindcss @tailwindcss/vite


Configura el plugin de Vite
Debe verse así:

import { defineConfig } from 'vite'
import tailwindcss from '@tailwindcss/vite'

export default defineConfig({
  plugins: [
    tailwindcss(),
  ],
})


Importa Tailwind en el CSS
Coloca la siguiente línea de código:

@import "tailwindcss";


Inicializa Tailwind
En la terminal del proyecto, ejecuta:

npm run dev


Incluye los assets con Vite
Si tienes un Blade base, o en cada una de las vistas HTML, agrega esta línea:

@vite(['resources/css/app.css', 'resources/js/app.js'])
-->
