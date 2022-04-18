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
    <title>Centro de Costos</title>
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
        <div>
            <h1 class="titulo">Centro de Costo</h1>
            <h3 class="titulo">{{$entidad->nombre}}</h3><br>
            <div>
                <p>Sub Entidades: <b>{{$subEnts->count()}}</b></p>
            </div>
            <div name="divDETALLE">
                @php
                    $cont=1;$cantidadPC=0; $totalEnt=0.00;
                @endphp
                @foreach ($subEnts as $subEnt)
                    <p>0{{$cont++}} - <b>{{strtoupper($subEnt->nombre)}}</b></p>
                    <p>N° PCs: <b>{{$subEnt->num_pc}}</b></p>
                    @php $cantidadPC=$cantidadPC+$subEnt->num_pc; @endphp
                    
                    <h4 class="titulo" >Detalle de las peticiones de Software de {{$subEnt->nombre}}</h4>
                    <table class="tab">
                        <thead>
                            <tr>
                                <th class="titulo the">N°</th>
                                <th class="the">Descripción</th>
                                <th class="the">Cant. Licencias</th>
                                <th class="the">Cotización</th>
                                <th class="the">Licencia</th>
                                <th class="the">Periodo</th>
                                <th class="the">P. Unit Ref.</th>
                                <th class="the">Sub total</th>
                            </tr>
                        </thead>
                        <tbody>
                                @php
                                    $cont1=1; $total=0.00;$subtotal=0.00;
                                @endphp
                                @foreach ($sftGenerales as $sftGeneral)
                                    <tr>
                                        <td class="titulo the align-V">{{$cont1++}}</td>
                                        <td class="the align-V align-V">{{$sftGeneral->nombre}}</td>
                                        <td class="titulo the align-V">{{$subEnt->num_pc}}</td>
                                        <td class="the align-V"><a class="dis-in" href="#"></a></td>
                                        <td class="the align-V">{{$sftGeneral->tipo}}</td>
                                        <td class="the align-V">{{$sftGeneral->periodo}}</td>
                                        <td class="right the align-V">{{$sftGeneral->precio_referencial}}</td>@php
                                            $subtotal=$subEnt->num_pc*$sftGeneral->precio_referencial;
                                        @endphp
                                        <td class="right the align-V">{{number_format($subtotal,2)}}</td>@php
                                            $total=$total+$subtotal;
                                        @endphp
                                    </tr>
                                @endforeach
                                @foreach ($detalles as $detalle)
                                    @if ($subEnt->nombre==$detalle->subenti)
                                        <tr>
                                            <td class="titulo the align-V">{{$cont1++}}</td>
                                            <td class="the align-V">{{$detalle->nombre}}</td>
                                            <td class="titulo the align-V">{{$detalle->cantidad}}</td>
                                            <td class="the align-V"><a class="dis-in" 
                                                href="http://inventarioti.unasam.edu.pe/{{(!is_null($detalle->cotizacion)?$detalle->cotizacion:'#')}}" target="_blank">
                                                {{(!is_null($detalle->cotizacion)?'Ver Cotización':'')}} </a></td>
                                            <td class="the align-V">{{$detalle->tipo}}</td>
                                            <td class="the align-V">{{$detalle->periodo}}</td>
                                            <td class="right the align-V">{{$detalle->precio_referencial}}</td>@php
                                                $subtotal=$detalle->cantidad*$detalle->precio_referencial;
                                            @endphp
                                            <td class="right the align-V">{{number_format($subtotal,2)}}</td>@php
                                                $total=$total+$subtotal;
                                            @endphp
                                        </tr>   
                                    @endif
                                @endforeach 
                        </tbody>
                        <tfoot>
                            <tr> 
                                <th class="right the align-V" colspan="7">Total  </th>
                                <td class="right the align-V">{{number_format($total,2)}}</td>
                                @php
                                    $totalEnt=$totalEnt+$total;
                                @endphp
                            </tr>
                        </tfoot>
                    </table><br><br>
                @endforeach
            </div>
            <div>
                <p><b>Monto Total</b> para la adquisición de Softwares de la <b>{{$entidad->nombre}}</b> asciende a <b>S/. {{number_format($totalEnt,2)}}</b></p>
            </div>
            <br><br>
            <div class="Row titulo">
                <div class="Column titulo">
                    <p class="titulo dis-in">________________________________________</p><br>
                    <p class="titulo dis-in"><b>{{(!is_null($encargados))?strtoupper($encargados->nombres.' '.$encargados->apell_pat.' '.$encargados->apell_mat):''}}</b></p><br>
                    <p class="titulo dis-in">DNI N° <b>{{(!is_null($encargados))?$encargados->DNI:''}}</b></p><br>
                    <div class="Column titulo dis-in anc-1"><p class="titulo dis-in">{{strtoupper('Encargado de la '.$entidad->nombre)}}</p><br></div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
