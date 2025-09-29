<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Libro de Reclamaciones</title>
    </head>
    <body>

        <table width='700' height='222' border='0' align='center' cellpadding='5' cellspacing='0'>
            <tr>
                <td width='700' align='center' valign='middle'>
                    <img src="https://compactseguridad.com/img/compact.png" width='420' height='160' />
                </td>
            </tr>
            <tr>
                <td align='center' valign='middle' style='color:#000; font-size:18px; font-weight:bold'>Se realizó un reclamo desde la Web..</td>
            </tr>
            <tr>
                <td align='center' valign='middle'>&nbsp;</td>
            </tr>
        </table>

        <table width='700' border='1' cellpadding='8' cellspacing='0' align='center'>
            <tr>
                <td align='center' colspan="1" style='font-weight:bold'>Fecha de Nacimiento</td>
                <td align='center' >{{$reclamo['fechanac']}}</td>
            </tr>
            <tr>
                <td align='center' colspan="1" style='font-weight:bold'>Tipo de documento</td>
                <td align='center' >{{$reclamo['tipodoc']}}</td>
            </tr>
            <tr>
                <td align='center' colspan="1" style='font-weight:bold'>Numero de documento</td>
                <td align='center'>{{$reclamo['numerodoc']}}</td>
            </tr>
            <tr>
                <td align='center' colspan="1" style='font-weight:bold'>Nombres</td>
                <td align='center'>{{$reclamo['nombres']}}</td>
            </tr>
            <tr>
                <td align='center' colspan="1" style='font-weight:bold'>Apellido Paterno</td>
                <td align='center'>{{$reclamo['apellidopat']}}</td>
            </tr>
            <tr>
                <td align='center' colspan="1" style='font-weight:bold'>Apellido Materno</td>
                <td align='center'>{{$reclamo['apellidomat']}}</td>
            </tr>
            <tr>
                <td align='center' colspan="1" style='font-weight:bold'>Email</td>
                <td align='center'>{{$reclamo['email']}}</td>
            </tr>
            <tr>
                <td align='center' colspan="1" style='font-weight:bold'>Teléfono</td>
                <td align='center'>{{$reclamo['telefono']}}</td>
            </tr>
            <tr>
                <td align='center' colspan="1" style='font-weight:bold'>Departamento</td>
                <td align='center'>{{$reclamo['departamento']}}</td>
            </tr>
            <tr>
                <td align='center' colspan="1" style='font-weight:bold'>Provincia</td>
                <td align='center'>{{$reclamo['provincia']}}</td>
            </tr>
            <tr>
                <td align='center' colspan="1" style='font-weight:bold'>Distrito</td>
                <td align='center'>{{$reclamo['distrito']}}</td>
            </tr>
            <tr>
                <td align='center' colspan="1" style='font-weight:bold'>Dirección</td>
                <td align='center'>{{$reclamo['direccion']}}</td>
            </tr>
            <tr>
                <td align='center' colspan="1" style='font-weight:bold'>Orden de Compra</td>
                <td align='center'>{{$reclamo['ordencompra']}}</td>
            </tr>
            <tr>
                <td align='center' colspan="1" style='font-weight:bold'>Monto del producto/servicio</td>
                <td align='center'>{{$reclamo['monto']}}</td>
            </tr>
            <tr>
                <td align='center' colspan="1" style='font-weight:bold'>Detalle del reclamo</td>
                <td align='center'>{{$reclamo['reclamo']}}</td>
            </tr>
            <tr>
                <td align='center' colspan="1" style='font-weight:bold'>Pedido</td>
                <td align='center'>{{$reclamo['pedido']}}</td>
            </tr>
        </table>

    </body>
</html>