<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
        <section id="wrapper">
                <div class="contenido">
                    @foreach ($infoReportes_pdf as $info_reportes)
                    <div id="formulario2">
                            <div>
                                <h1 style="text-align:center;" class="titulo_reportes"> CONSULTA DEL REPORTE CIUDADANO</h1>
                            </div>
                            <div>

                                <label class="titulo_reportes">Folio:</label>
                                <label class="form-Nombres2">{{$info_reportes->folio}}</label>
                            </div><br>

                            <div>
                                    <label  class="titulo_reportes">Tipo de reporte:</label>
                                    <label class="form-Nombres2">
                                            <?php
                                            $nombre_tipo = DB::select("SELECT nombre FROM tlv_1821_lr WHERE idlistaReportes ='".$info_reportes->idlistaReportes."'");
                                            echo $nombre_tipo[0]->nombre;
                                            ?>
                                    </label>
                                </div><br>

                            <div>
                                <label for="destinatario" class="titulo_reportes">Nombre:</label>
                                <label class="form-Nombres2">
                                        {{$info_reportes->nombre}} {{$info_reportes->paterno}}
                                </label>
                            </div><br>
                            <div>
                                <label for="tiempoRespuesta" class="titulo_reportes">Telefono:</label>
                                <label class="form-Nombres2">
                                        {{$info_reportes->telefono}}
                                </label>
                            </div><br>

                            <div>
                                <label for="vigencia" class="titulo_reportes">Correo: </label>
                                <label class="form-Nombres2">{{$info_reportes->correo}}</label>
                            </div><br>

                            <div>
                                <label for="requisitos" class="titulo_reportes">Descripcion: </label>
                                <label class="form-Nombres2">{{$info_reportes->descripcion}}</label>
                            </div><br>

                            <div>
                                <label for="costo" class="titulo_reportes">Calle: </label>
                                <label class="form-Nombres2">{{$info_reportes->calle}}</label>
                            </div><br>

                            <div>
                                    <label for="formato" class="titulo_reportes">Colonia: </label>
                                    <label class="form-Nombres2"><?php
                                        $nombre_colonia= DB::select("SELECT nombre FROM colonia WHERE idcolonia='".$info_reportes->idcolonia."'");
                                        echo $nombre_colonia[0]->nombre;
                                        ?>  </label>
                                </div><br>

                            <div>
                                <label for="costo" class="titulo_reportes">Referencia: </label>
                                <label class="form-Nombres2">{{$info_reportes->referencia}}</label>
                            </div><br>

                            <div>
                                <label for="costo" class="titulo_reportes">Localidad: </label>
                                <label class="form-Nombres2">{{$info_reportes->localidad}}</label>
                            </div><br>

                            <div>
                                <label for="costo" class="titulo_reportes">Fecha: </label>
                                <label class="form-Nombres2">{{$info_reportes->fecha}}</label>
                            </div><br>

                            <div>
                                <label for="costo" class="titulo_reportes">Estatus: </label>
                                <label class="form-Nombres2">{{$info_reportes->status}}</label>
                            </div><br>

                            <div>
                                <label for="formato" class="titulo_reportes">Fecha de solucion: </label>
                                <label class="form-Nombres2">{{$info_reportes->fechaSolucion}}</label>
                            </div><br><br>

                            <div>
                                <label for="costo" class="titulo_reportes">Comentario: </label>
                                <label class="form-Nombres2">{{$info_reportes->comentario}}</label>
                            </div><br>

                        </div>
                    @endforeach
                </div>
            </section>
</body>

<style>
.contenido{
    border: 1px #486da1;
}

.titulo_reportes{
    color: darkorchid;
}

</style>
</html>
