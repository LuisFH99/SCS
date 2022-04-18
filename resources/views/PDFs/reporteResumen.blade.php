<!DOCTYPE html>
<html lang="es">
<head>
    @php
        function devolverFecha($dt){
            $año=implode('-', array_slice(explode('-', $dt),0,1));
            $mes=implode('-', array_slice(explode('-', $dt),1,1));
            $dia=implode('-', array_slice(explode('-', $dt),2,1));
            $nMes=array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Nombiembre','Diciembre');
            return $dia.' de '.$nMes[$mes-1].' de '.$año;
        }
    @endphp
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Resumen de Centro de Costos</title>
    <style>
        .titulo{
            text-align: center !important;
        }
        .right{
            text-align: right !important;
        }
        .Row {
            display: table;
            width: 100%; /*Optional*/
            table-layout: fixed; /*Optional*/
            border-spacing: 10px; /*Optional*/
        }
        .Column {   
            display: table-cell;
            /*background-color: red; Optional*/
        }
        .dis-in {
            display: inline;
        }
        .mr-1{
            margin-right: 10%;
        }
        .tab {
            width: 100%;
            border: 1px solid #000;
            border-spacing: 0;
        }
        .the{
            vertical-align: top;
            border: 1px solid #000;
            border-collapse: collapse;
            padding: 0.1em;
            caption-side: bottom;
            border-spacing: 0;
        }
        .cap {
            padding: 0.3em;
        }
        .anc-1{
            width:250px;
        }
        /** 
                Establezca los márgenes de la página en 0, por lo que el pie de página y el encabezado
                puede ser de altura y anchura completas.
             **/
             @page {
                margin: 0cm 2cm;
            }

            /** Defina ahora los márgenes reales de cada página en el PDF **/
            body {
                margin-top: 3.8cm;
                margin-left: 1cm;
                margin-right: 1cm;
                margin-bottom: 3cm;
            }

            /** Definir las reglas del encabezado **/
            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 1cm;
            }

            /** Definir las reglas del pie de página **/
            footer {
                position: fixed; 
                bottom: 0cm; 
                left: 0cm; 
                right: 0cm;
                height: 1.5cm;
            }
            .align-V {
                vertical-align: middle !important;
            }
    </style>
</head>
<body>
    <!-- Defina bloques de encabezado y pie de página antes de su contenido -->
    <header class="titulo">
        <img src="images/Membrete General_001.jpg" width="700">
    </header>
    <footer class="titulo">
        <hr>
        OGTISE Copyright &copy; 2022 
    </footer>
    <!-- Envuelva el contenido de su PDF dentro de una etiqueta principal -->
    <main>
        @php
            $contT=1;$cantidadPCT=0; $cont1=1;$cantidadPC=0;$totalEnt=0.00;$totalEntT=0.00;$cont=1;$total=0.00;$cont1=1; $subtotal=0.00; 
        @endphp
       
            <div>
                <h1 class="titulo">Resumen del Centro de Costo</h1>
                {{-- <h3 class="titulo">{{$entidad->nombre}}</h3><br> --}}
                <table class="tab">
                    <thead>
                        <tr>
                            <th class="titulo the align-V">N°</th>
                            <th class="titulo the align-V">Entidad</th>
                            <th class="titulo the align-V">N° total de PCs</th>
                            <th class="titulo the align-V">Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($entidades as $entidad)
                        <tr>
                            <td class="titulo the align-V">{{$cont++}}</td>
                            <td class="the align-V align-V">{{$entidad->nombre}}</td>
                            <td class="titulo the align-V">
                                @php
                                    $total=0.00;
                                @endphp
                                    @foreach ($subEnts as $subEnt)
                                        @if ($subEnt->entidad_id==$entidad->id)
                                                @php $cantidadPC=$cantidadPC+$subEnt->num_pc; 
                                                    $cantidadPCT=$cantidadPCT+$subEnt->num_pc;
                                                    
                                                @endphp
                                                @foreach ($sftGenerales as $sftGeneral)
                                                    @php
                                                        $subtotal=$subEnt->num_pc*$sftGeneral->precio_referencial;
                                                        $total=$total+$subtotal;
                                                    @endphp
                                                @endforeach
                                                @foreach ($detalles as $detalle)
                                                    @if ($subEnt->nombre==$detalle->subenti&&$detalle->idEntidad==$entidad->id)
                                                        @php
                                                            $subtotal=$detalle->cantidad*$detalle->precio_referencial;
                                                            $total=$total+$subtotal;
                                                        @endphp 
                                                    @endif
                                                @endforeach 
                                        @endif
                                    @endforeach
                                    {{$cantidadPC}}
                                    @php
                                        $cantidadPC=0;$cont1=1;
                                    @endphp
                            </td>
                            <td class="right the align-V">{{number_format($total,2)}}</td>
                            @php
                                $totalEnt=$totalEnt+$total;
                            @endphp
                        </tr>
                        @endforeach
                        @php
                            
                        @endphp
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="right the align-V" colspan="3">Total </th>
                            <th class="right the align-V">{{number_format($totalEnt,2)}}</th>
                        </tr>
                    </tfoot>
                </table>
            </div><br>
        <div>
            <p>El <b>Monto Total</b> para la adquisición de Softwares asciende a <b>S/. {{number_format($totalEnt,2)}}</b></p>
            <p>El <b>Número total de Computadoras</b> es <b>{{$cantidadPCT}}</b></p>
        </div>
    </main>
</body>
</html>
