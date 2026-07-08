=== Plogins Sizer - Size Guide for WooCommerce ===
Contributors: motylanogha
Tags: woocommerce, size guide, size chart, product, fashion
Requires at least: 6.5
Tested up to: 7.0
Requires PHP: 8.1
Stable tag: 1.0.1
Requiere complementos: woocommerce
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Añade guías de tallas y tablas de tallas a sus productos WooCommerce a través de un modo accesible.

== Description ==

Sizer añade un botón "Guía de tallas" a las páginas de sus productos WooCommerce. Los compradores hacen clic en él y se abre una tabla de tallas en un modal, para que puedan verificar las medidas sin salir del producto.

Cada gráfico se crea una vez en el administrador (una tabla etiquetada de columnas y filas, más un título opcional) y se asigna a los productos a los que se aplica. El botón se inyecta justo después del botón Añadir al carrito. Si un producto no tiene ningún gráfico asignado, no se añade nada a la página.

Informes de fuentes y errores disponibles en GitHub: https://github.com/wppoland/plogins-sizer

<strong>Qué hace</strong>

* Cree tablas de tallas como tablas etiquetadas y reutilice la misma tabla en muchos productos.
* Elija una tabla por producto en la pestaña Datos del producto → Guía de tallas.
* Se abre en un elemento nativo `<dialog>` con un encabezado etiquetado, un botón de cierre y soporte para teclado.
* Configure el texto del botón y el encabezado modal desde una pantalla de configuración.
* La hoja de estilo utiliza propiedades personalizadas de CSS (color de acento, radio, colores de diálogo) e incluye un esquema oscuro y una variante de movimiento reducido.
* Sin solicitudes externas ni seguimiento; Los gráficos se almacenan en su propia base de datos.

== Installation ==

1. Cargue el complemento en `/wp-content/plugins/plogins-sizer`, o instálelo a través de Complementos → Añadir nuevo.
2. Actívalo. WooCommerce debe estar activo.
3. Vaya a WooCommerce → Guías de tallas para crear un gráfico y configurar la etiqueta del botón.
4. Asignar una tabla a un producto (Datos del producto → Guía de tallas).

== Frequently Asked Questions ==

= Documentation and links =

* <strong>Documentación</strong> - https://plogins.com/es/plogins-sizer/docs/
* <strong>Página de complementos</strong> - https://plogins.com/es/plogins-sizer/
* <strong>Código fuente</strong> - https://github.com/wppoland/plogins-sizer
* <strong>Informes de errores y solicitudes de funciones</strong> - https://github.com/wppoland/plogins-sizer/issues


= Does it require WooCommerce? =

Sí. Sizer amplía las páginas de productos individuales de WooCommerce.

= Where does the size guide appear? =

En la página de un solo producto, como un botón que se muestra después del botón Añadir al carrito. El botón abre el gráfico en un modo accesible.

= Can I override the styling? =

Sí. Las plantillas se pueden anular desde su tema en una carpeta `sizer/`, y el CSS del escaparate expone propiedades personalizadas que puede cambiar el tema.

= Is the size-guide modal accessible? =

Sí. Utiliza un `<dialog>` nativo con un encabezado etiquetado, botón de cierre, soporte para teclado y respeta `prefiere movimiento reducido`.

= Can one chart apply to many products? =

Sí. Cree un gráfico una vez en WooCommerce → Guías de tallas, luego asígnelo en la pestaña Guía de tallas de cada producto.


= Does this plugin work on WordPress Multisite? =

Sí. Este complemento es compatible con WordPress Multisite. Activarlo en red o activarlo en sitios individuales; Cada sitio mantiene su propia configuración y datos.

== Screenshots ==

1. El modal de guía de tallas en la página de un producto.
2. Crear una tabla de tallas reutilizable en el administrador.

== External Services ==

Sizer no se conecta a ningún servicio externo. No realiza llamadas API y no carga scripts, fuentes ni hojas de estilo remotos. Sus tablas de tallas y configuraciones de botones/encabezados se almacenan en su propia base de datos de WordPress (las opciones `sizer_charts` y `sizer_settings`), y la tabla asignada a cada producto se mantiene en el meta de publicación `_sizer_chart_id` de ese producto. No salen datos de tu sitio y no se realiza ningún seguimiento.

== Changelog ==

= 1.0.1 =
* Primera versión estable.

= 0.1.3 =
* Renombrado a Plogins Sizer para WooCommerce para obtener un nombre de complemento más distintivo.

= 0.1.2 =
* Filtro `sizer/match_size` y servicio `SizeMatcher` para hacer coincidir las medidas del comprador con las filas del gráfico.
* Filtro `sizer/chart` en datos de gráficos resueltos antes de renderizar.

= 0.1.1 =
* Filtro `sizer/chart_units` y acción `sizer/chart_controls` para cambiar la unidad PRO en gráficos renderizados.

= 0.1.0 =
* Lanzamiento inicial: tablas de tallas reutilizables, asignación por producto y un modal accesible que se muestra después del botón Añadir al carrito.
