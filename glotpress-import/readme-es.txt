=== Plogins Sizer - Size Guide for WooCommerce ===
Contributors: motylanogha
Tags: woocommerce, size guide, size chart, product, fashion
Requires at least: 6.5
Tested up to: 7.0
Requires PHP: 8.1
Stable tag: 1.0.2
Requires Plugins: woocommerce
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Añade guías de tallas y tablas de tallas a tus productos de WooCommerce mediante una ventana modal accesible.

== Description ==

Sizer añade un botón «Guía de tallas» a las páginas de producto de WooCommerce. Los compradores hacen clic en él y una tabla de tallas se abre en una ventana modal, para que puedan comprobar las medidas sin salir del producto.

Cada tabla se crea una vez en la administración (una tabla etiquetada de columnas y filas, más un título opcional) y se asigna a los productos a los que corresponde. El botón se inserta justo después del botón de añadir al carrito. Si un producto no tiene ninguna tabla asignada, no se añade nada a la página.

El código fuente y los informes de errores están en GitHub: https://github.com/wppoland/plogins-sizer

<strong>Qué hace</strong>

* Crea tablas de tallas como tablas etiquetadas y reutiliza la misma tabla en muchos productos.
* Elige una tabla por producto en la pestaña Datos del producto → Guía de tallas.
* Se abre en un elemento nativo `<dialog>` con un encabezado etiquetado, un botón de cierre y compatibilidad con el teclado.
* Define el texto del botón y el encabezado de la ventana modal desde una única pantalla de ajustes.
* La hoja de estilos usa propiedades personalizadas de CSS (color de acento, radio, colores del diálogo) e incluye una variante para esquema oscuro y movimiento reducido.
* Sin peticiones externas ni seguimiento; las tablas se almacenan en tu propia base de datos.

== Installation ==

1. Sube el plugin a `/wp-content/plugins/plogins-sizer` o instálalo desde Plugins → Añadir nuevo.
2. Actívalo. WooCommerce debe estar activo.
3. Ve a WooCommerce → Guías de tallas para crear una tabla y definir la etiqueta del botón.
4. Asigna una tabla a un producto (Datos del producto → Guía de tallas).

== Frequently Asked Questions ==

= Documentation and links =

* <strong>Documentación</strong> - https://plogins.com/es/plogins-sizer/docs/
* <strong>Página del plugin</strong> - https://plogins.com/es/plogins-sizer/
* <strong>Código fuente</strong> - https://github.com/wppoland/plogins-sizer
* <strong>Informes de errores y peticiones de funciones</strong> - https://github.com/wppoland/plogins-sizer/issues


= Does it require WooCommerce? =

Sí. Sizer amplía las páginas de producto individuales de WooCommerce.

= Where does the size guide appear? =

En la página de producto individual, como un botón que se muestra después del botón de añadir al carrito. El botón abre la tabla en una ventana modal accesible.

= Can I override the styling? =

Sí. Las plantillas se pueden sobrescribir desde tu tema en una carpeta `sizer/`, y el CSS de la tienda expone propiedades personalizadas que puedes adaptar a tu tema.

= Is the size-guide modal accessible? =

Sí. Utiliza un `<dialog>` nativo con un encabezado etiquetado, botón de cierre y compatibilidad con el teclado, y respeta `prefers-reduced-motion`.

= Can one chart apply to many products? =

Sí. Crea una tabla una vez en WooCommerce → Guías de tallas y luego asígnala en la pestaña Guía de tallas de cada producto.


= Does this plugin work on WordPress Multisite? =

Sí. Este plugin es compatible con WordPress Multisite. Actívalo para toda la red o en sitios concretos; cada sitio conserva sus propios ajustes y datos.

== Screenshots ==

1. La ventana modal de la guía de tallas en la página de un producto.
2. Creación de una tabla de tallas reutilizable en la administración.

== External Services ==

Sizer no se conecta a ningún servicio externo. No hace llamadas a la API y no carga scripts, fuentes ni hojas de estilos remotos. Tus tablas de tallas y los ajustes de botón/encabezado se almacenan en tu propia base de datos de WordPress (las opciones `sizer_charts` y `sizer_settings`), y la tabla asignada a cada producto se guarda en la metainformación de entrada `_sizer_chart_id` de ese producto. Ningún dato sale de tu sitio y no se hace ningún seguimiento.

== Translations ==

Plogins Sizer incluye traducciones al polaco, al alemán y al español para la interfaz del plugin. El dominio de texto es `plogins-sizer`, por lo que los paquetes de idioma de WordPress.org también pueden sustituir o ampliar estas traducciones incluidas.

== Changelog ==

= 1.0.2 =
* Se han añadido traducciones incluidas al polaco, al alemán y al español para la interfaz del plugin.

= 1.0.1 =
* Primera versión estable.

= 0.1.3 =
* Renombrado a Plogins Sizer for WooCommerce para tener un nombre de plugin más distintivo.

= 0.1.2 =
* Filtro `sizer/match_size` y servicio `SizeMatcher` para hacer coincidir las medidas del comprador con las filas de la tabla.
* Filtro `sizer/chart` sobre los datos de la tabla resueltos antes del renderizado.

= 0.1.1 =
* Filtro `sizer/chart_units` y acción `sizer/chart_controls` para el cambio de unidades PRO en las tablas renderizadas.

= 0.1.0 =
* Versión inicial: tablas de tallas reutilizables, asignación por producto y una ventana modal accesible que se muestra después del botón de añadir al carrito.
