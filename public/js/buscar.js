$('#buscar').on('keyup', function () {
    let query = $(this).val();

    $.ajax({
        url: "/buscar",
        type: "GET",
        data: { nombre: query },
        success: function (data) {
            let resultados = $('#resultados');
            resultados.empty();

            if (query == '') {
                return
            }
            
            if (data.length > 0) {
                data.forEach(function (producto) {
                    let imagenes = JSON.parse(producto.images);
                    let primeraImagen = imagenes[0];
                    resultados.append('<a style="color:#474342 !important" href="/product/' + producto.slug + '"><li class="list-group-item d-flex"><img class="d-block px-2" width="70" src="storage/' + primeraImagen + '"><span style="margin: auto 0;">' + producto.name + '</span></li></a>');
                });
            } else {
                resultados.append('<li class="list-group-item">No se encontraron productos.</li>');
            }
        }
    });
});