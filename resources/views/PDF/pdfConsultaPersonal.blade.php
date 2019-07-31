<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF CONSULTA GENERAL</title>
</head>

<body>
    <main>
        <h2 align="center"><b>PERSONAL</b></h2>
        <table width="100%" border="0.2" cellspacing="1" cellpadding="1" class="table_pdf">
            <thead>
                <tr valign="bottom">
                    <th bgcolor="#CB29FB" align="center" style="color: white"><b>NOMBRE</b></th>
                    <th bgcolor="#CB29FB" align="center" style="color: white"><b>CORREO</b></th>
                    <th bgcolor="#CB29FB" align="center" style="color: white"><b>AREA</b></th>
                    <th bgcolor="#CB29FB" align="center" style="color: white"><b>ESTATUS</b></th>
                    <th bgcolor="#CB29FB" align="center" style="color: white"><b>ROL</b></th>
                    <th bgcolor="#CB29FB" align="center" style="color: white"><b>FECHA REGISTRO</b></th>
                </tr>
            </thead>
            <tbody>
                <?php $contador=0;    ?>
                @foreach ($all_personal_info as $consultaPersonal)
                @if ($contador%2 != 0)
                <?php $color = '#EFBBFF'; ?>
                @else
                <?php $color = '#FFFFFF'; ?>
                @endif
                <tr bgcolor="<?php echo $color; ?>">
                    <td align="center">{{$consultaPersonal->nombre}} {{$consultaPersonal->paterno}}</td>
                    <td align="center">{{$consultaPersonal->correoInstitucional}}</td>
                    <td align="center">
                        <?php
                        $nombre_area= DB::select("SELECT nombre FROM tlv_1821_ar WHERE idarea='$consultaPersonal->idarea'");
                        echo $nombre_area[0]->nombre;
                        ?>
                    </td>
                    <td align="center">{{$consultaPersonal->status}}</td>
                    <td align="center">
                        <?php
                        $nombre_rol= DB::select("SELECT nombre FROM rol WHERE idRol='$consultaPersonal->idRol'");
                        echo $nombre_rol[0]->nombre;
                        ?>
                    </td>
                    <td align="center">
                        {{$consultaPersonal->fechaRegistro}}
                    </td>
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
