@extends('layouts.header')
@section('contenido')

<main>

    <section id="wrapper">
        <div class="contenido">
            @foreach ($infoReportes as $info_reportes)
            <div id="formulario2">
                    <div>
                        <h1 class="titulo2"> CONSULTA DEL REPORTE CIUDADANO</h1>
                    </div>
                    <div>

                        <br><label for="nombre" class="titulo2">Folio: {{$info_reportes->folio}}</label>
                        <label class="form-Nombres2"></label>


                    </div><br>

                    <div>
                            <label  class="titulo2">Tipo de reporte: <?php
                                $nombre_tipo = DB::select("SELECT nombre FROM tlv_1821_lr WHERE idlistaReportes ='".$info_reportes->idlistaReportes."'");
                                echo $nombre_tipo[0]->nombre;
                                ?></label>
                            <label class="form-Nombres2"></label>
                        </div><br>

                    <div>
                        <label for="destinatario" class="titulo2">Nombre: {{$info_reportes->nombre}} {{$info_reportes->paterno}} </label>
                        <label
                            class="form-Nombres2"></label>
                    </div><br>
                    <div>
                        <label for="tiempoRespuesta" class="titulo2">Telefono: {{$info_reportes->telefono}}</label>
                        <label class="form-Nombres2"></label>
                    </div><br>

                    <div>
                        <label for="vigencia" class="titulo2">Correo: {{$info_reportes->correo}}</label>
                        <label class="form-Nombres2"></label>
                    </div><br>

                    <div>
                        <label for="requisitos" class="titulo2">Descripcion: {{$info_reportes->descripcion}}</label>
                        <label class="form-Nombres2"></label>
                    </div><br>

                    <div>
                        <label for="costo" class="titulo2">Calle: {{$info_reportes->calle}}</label>
                        <label class="form-Nombres2"></label>
                    </div><br>

                    <div>
                            <label for="formato" class="titulo2">Colonia: <?php
                                $nombre_colonia= DB::select("SELECT nombre FROM colonia WHERE idcolonia='".$info_reportes->idcolonia."'");
                                echo $nombre_colonia[0]->nombre;
                                ?>  </label>
                            <label class="form-Nombres2"></label>
                        </div><br>

                    <div>
                        <label for="costo" class="titulo2">Referencia: {{$info_reportes->referencia}}</label>
                        <label class="form-Nombres2"></label>
                    </div><br>

                    <div>
                        <label for="costo" class="titulo2">Localidad: {{$info_reportes->localidad}}</label>
                        <label class="form-Nombres2"></label>
                    </div><br>

                    <div>
                        <label for="costo" class="titulo2">Fecha: {{$info_reportes->fecha}}</label>
                        <label class="form-Nombres2"></label>
                    </div><br>

                    <div>
                        <label for="costo" class="titulo2">Estatus: {{$info_reportes->status}}</label>
                        <label class="form-Nombres2"></label>
                    </div><br>

                    <div>
                        <label for="formato" class="titulo2">Fecha de solucion: {{$info_reportes->fechaSolucion}}</label>
                        <label class="form-Nombres2"></label>
                    </div><br><br>

                    <div>
                        <label for="costo" class="titulo2">Comentario: </label>
                        <label class="form-Nombres2"></label>
                    </div><br>

                    <button> <a href="../view/consultaIndividualR.php" type="submit"
                            class="boton-Personalizado">Volver</a></button>

                        <form action="{{url('verMasReportes/PdfTabla')}}" target="_blank"  method="post">
                        <button onclick="setTimeout(function(){window.location.href='{{URL::to('/consultareporte')}}'},100)" class="boton-Personalizado" style='border:#ffffff; background-color:red; width:120px; height:40px' type="submit"></a><span class="mif-file-pdf "></span> PDF</button>
                                {{ csrf_field() }}
                                <br> <br>
                        </form>



                </div>
            @endforeach
        </div>
    </section>
</main>

@endsection
