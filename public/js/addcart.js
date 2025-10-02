$(function() {
    $(document).on('click', '.addcart', function (e) {
        e.preventDefault();
        let token = $('meta[name="csrf-token"]').attr('content');
        var id = this.getAttribute('data-id');  
        var qty = $('#qty').val() || 1;

        // ✅ Detectamos si hay color o talla seleccionados
        var colorInput = $('input[name="color_id"]:checked').val();
        var sizeInput  = $('input[name="size_id"]:checked').val();

        var color_id = colorInput ? colorInput : null;
        var size_id  = sizeInput ? sizeInput : null;

        Swal.fire({
            title: 'Cargando...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading()
            }
        });

        $.ajax({
            url: "/add",
            method: "post",
            dataType: 'json',
            data: {
                _token: token,
                id: id,
                qty: qty,
                color_id: color_id,
                size_id: size_id
            },
            success: function (response) {   
                Swal.close(); // ✅ cerrar el loading

                if (response.status) {
                    // Actualizar contadores
                    $('#cartCount').text(response.count);
                    $('#cartCount1').text(response.count);

                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-start",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    Toast.fire({
                        icon: "success",
                        title: response.msg
                    });               
                } else {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    Toast.fire({
                        icon: "error",
                        title: "Algo salió mal"
                    });
                }
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...!!',
                    text: 'Algo salió mal, Inténtalo más tarde!',
                })
            }
        });
    });
});