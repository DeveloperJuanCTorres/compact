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
                    resultados.append('<a style="color:#474342 !important" href="/product/' + producto.slug + '"><li class="list-group-item d-flex"><img class="d-block m-auto px-2" width="70" src="img/defectomaster.jpeg">' + producto.name + '</li></a>');
                });
            } else {
                resultados.append('<li class="list-group-item">No se encontraron productos.</li>');
            }
        }
    });
});