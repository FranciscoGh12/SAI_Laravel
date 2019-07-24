<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF CONSULTA TIPO DE REPORTES</title>
</head>

<body>
    <main>
        <h2 align="center"><b>LISTADO DE REPORTES</b></h2>
        <table width="100%" border="0.2" cellspacing="1" cellpadding="1" class="table_pdf">
            <thead>
                <tr valign="bottom">
                        <th bgcolor="#CB29FB" align="center" style="color: white"><b>TIPO DE REPORTE</b></th>
                    <th bgcolor="#CB29FB" align="center" style="color: white"><b>NOMBRE</b></th>
                    <th bgcolor="#CB29FB" align="center" style="color: white"><b>CORREO</b></th>
                    <th bgcolor="#CB29FB" align="center" style="color: white"><b>AREA</b></th>
                    <th bgcolor="#CB29FB" align="center" style="color: white"><b>FECHA DE CREACION</b></th>
                    <th bgcolor="#CB29FB" align="center" style="color: white"><b>OBSERVACIONES</b></th>
                    <th bgcolor="#CB29FB" align="center" style="color: white"><b>ESTATUS</b></th>
                    <th bgcolor="#CB29FB" align="center" style="color: white"><b>PERIODO</b></th>
                </tr>
            </thead>
            <tbody>
                <?php $contador=0;    ?>
                @foreach ($all_listaReporte_info_pdf as $consultaTipoReporte)
                @if ($contador%2 != 0)
                <?php $color = '#EFBBFF'; ?>
                @else
                <?php $color = '#FFFFFF'; ?>
                @endif
                <tr bgcolor="<?php echo $color; ?>">
                    <td>{{$consultaTipoReporte->nombre}}</td>
                    <td>
                        <?php
                        $nombre_user = DB::select("SELECT CONCAT(nombre,' ',paterno) as nombreCompleto FROM tlv_1821_u WHERE correoInstitucional = '$consultaTipoReporte->correoInstitucional' ");
                        echo $nombre_user[0]->nombreCompleto;
                        ?>
                    </td>
                    <td>{{$consultaTipoReporte->correoInstitucional}}</td>
                    <td><?php
                        $nombre_area= DB::select("SELECT nombre FROM tlv_1821_ar WHERE idarea='$consultaTipoReporte->idarea'");
                        echo $nombre_area[0]->nombre;
                        ?>
                        </td>
                    <td>{{$consultaTipoReporte->fechaCreacion}}</td>
                    <td>{{$consultaTipoReporte->observaciones}}</td>
                    <td>{{$consultaTipoReporte->status}}</td>
                    <td>{{$consultaTipoReporte->periodoAtencion}}</td>
                </tr>
                <?php $contador++; ?>
                @endforeach
            </tbody>
        </table>
        <h4 align="right">TOTAL DE REPORTES: {{$contador}}</h4>
    </main>
</body>

<style type="text/css">
    .table_pdf {
        table-layout: auto;
        padding: 5px;

    }
</style>

</html>
