
        <table>
            <thead>
                <tr >
                    <th>FOLIO</th>
                    <th>TIPO</th>
                    <th>ESTATUS</th>
                    <th>NOMBRE</th>
                    <th>TELÉFONO</th>
                    <th>DIRECCIÓN</th>
                    <th>FECHA</th>
                    <th>DESCRIPCIÓN</th>
                    <th>AREA</th>
                    <th>COLONIA</th>
                </tr>
            </thead>
            <tbody>
                <?php $contador=0;    ?>
                @foreach ($all_consultaReporte_info_pdf as $consultaReporte)
                @if ($contador%2 != 0)
                <?php $color = '#EFBBFF'; ?>
                @else
                <?php $color = '#FFFFFF'; ?>
                @endif
                <tr bgcolor="<?php echo $color; ?>">
                    <td>{{$consultaReporte->folio}}</td>
                    <td>
                        <?php
                $nombre_tipo = DB::select("SELECT nombre FROM tlv_1821_lr WHERE idlistaReportes ='".$consultaReporte->idlistaReportes."'");
                echo $nombre_tipo[0]->nombre;
                ?>
                    </td>
                    <td>{{$consultaReporte->status}}</td>
                    <td>{{$consultaReporte->nombre}}</td>
                    <td>{{$consultaReporte->telefono}}</td>
                    <td>{{$consultaReporte->calle}}</td>
                    <td>{{$consultaReporte->fecha}}</td>
                    <td>{{$consultaReporte->descripcion}}</td>
                    <td><?php
                    $nombre_area= DB::select("SELECT nombre FROM tlv_1821_ar WHERE idarea=(SELECT idarea FROM tlv_1821_lr WHERE idlistaReportes='".$consultaReporte->idlistaReportes."')");
                    echo $nombre_area[0]->nombre;
                    ?>
                    </td>
                    <td>
                        <?php
                        $nombre_colonia= DB::select("SELECT nombre FROM colonia WHERE idcolonia='".$consultaReporte->idcolonia."'");
                        echo $nombre_colonia[0]->nombre;
                        ?>
                    </td>
                </tr>
                <?php $contador++; ?>
                @endforeach
            </tbody>
        </table>
