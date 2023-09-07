const $nombre = document.querySelector("#nombre"),
    $descripcion = document.querySelector("#descripcion"),
    $precio = document.querySelector("#precio"),
    $btnGuardar = document.querySelector("#btnGuardar");

// Una global para establecerla al rellenar el formulario y leerla al enviarlo
let idProducto;

const rellenarFormulario = async () => {

    // https://parzibyte.me/blog/2020/08/14/extraer-parametros-url-javascript/
    const urlSearchParams = new URLSearchParams(window.location.search);
    idProducto = urlSearchParams.get("id"); // <-- Actualizar el ID global
    console.log(idProducto);
    // Obtener el producto desde PHP
/*     const respuestaRaw = await fetch(`./obtener_producto_por_id.php?id=${idProducto}`);
    const producto = await respuestaRaw.json();
    // Rellenar formulario
    $nombre.value = producto.nombre;
    $descripcion.value = producto.descripcion;
    $precio.value = producto.precio; */
};

// Al incluir este script, llamar a la función inmediatamente
rellenarFormulario();