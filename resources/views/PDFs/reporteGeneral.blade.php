<!DOCTYPE html>
<html lang="en">
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
    <title>Solicitud</title>
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
            <h3 class="titulo">{{$encargados->nombre}}</h3><br>
            <div>
                <p>CARRERAS PROFESIONALES: <b>{{$subEnts->count()-1}}</b></p>
                <p>N° LABORATORIOS: <b>{{$areas->count()}}</p>  
            </div>
            <div name="divDETALLE">
                @php
                    $cont=1; 
                @endphp
                @foreach ($subEnts as $subEnt)
                    <p>0{{$cont++}} - <b>{{$subEnt->nombre}}</b></p>
                    <table class="titulo">
                        <tbody>
                            <tr>
                                @if (($areas->count()) > ($cont-1))
                                    <th>{{$labs[0]->nom_tip}}: </th>
                                @endif
                                @if (($areas->count()) == ($cont-1))
                                    <th>{{$labs[1]->nom_tip}}: </th>
                                @endif
                                @foreach ($areas as $area)
                                    @if ($subEnt->nombre==$area->sub)
                                        <td>{{$area->codigo}}</td>
                                    @endif
                                @endforeach
                            </tr>
                            <tr>
                                @php
                                    $cantidadPC=0;
                                @endphp
                                <th>N° PCs: </th>
                                @foreach ($areas as $area)
                                @if ($subEnt->nombre==$area->sub)<td>{{$area->num_pc}}@php
                                    $cantidadPC=$cantidadPC+$area->num_pc;
                                @endphp</td>@endif
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                    <p><b>Observaciones: </b>___________________________________</p>
                    <h4 class="titulo" >Detalle de las peticiones de Software de {{$subEnt->nombre}}</h4>
                    <table class="tab">
                        <thead>
                            <tr>
                                <th class="titulo the">N°</th>
                                <th class="the">Descripción</th>
                                <th class="the">Cant. Licencias</th>
                                <th class="the">Cotización</th>
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
                                        <td class="titulo the">{{$cont1++}}</td>
                                        <td class="the">{{$sftGeneral->nombre}}</td>
                                        <td class="titulo the">{{$cantidadPC}}</td>
                                        <td class="the"><a class="dis-in" href="#">Cotizacion Adjunta</a></td>
                                        <td class="right the">{{$sftGeneral->precio_referencial}}</td>@php
                                            $subtotal=$cantidadPC*$sftGeneral->precio_referencial;
                                        @endphp
                                        <td class="right the">{{$subtotal}}</td>@php
                                            $total=$total+$subtotal;
                                        @endphp
                                    </tr>
                                @endforeach
                                @foreach ($detalles as $detalle)
                                    @if ($subEnt->nombre==$detalle->subenti)
                                        <tr>
                                            <td class="titulo the">{{$cont1++}}</td>
                                            <td class="the">{{$detalle->nombre}}</td>
                                            <td class="titulo the">{{$detalle->cantidad}}</td>
                                            <td class="the"><a class="dis-in" href="{{(!is_null($detalle->cotizacion)?$detalle->cotizacion:'#')}}">Cotizacion Adjunta</a></td>
                                            <td class="right the">{{$detalle->precio_referencial}}</td>@php
                                                $subtotal=$detalle->cantidad*$detalle->precio_referencial;
                                            @endphp
                                            <td class="right the">{{$subtotal}}</td>@php
                                                $total=$total+$subtotal;
                                            @endphp
                                        </tr>   
                                    @endif
                                @endforeach 
                            
                        </tbody>
                        <tfoot>
                            <tr> 
                                <th class="right the" colspan="5">Total  </th>
                                <td class="right the">{{$total}}</td>
                            </tr>
                        </tfoot>
                    </table>
                @endforeach
            </div><br><br>
            <div class="Row titulo">
                <div class="Column titulo">
                    <p class="titulo dis-in">________________________________________</p><br>
                    <p class="titulo dis-in"><b>{{strtoupper($encargados->nombres.' '.$encargados->apell_pat.' '.$encargados->apell_mat)}}</b></p><br>
                    <p class="titulo dis-in">DNI N° <b>{{$encargados->DNI}}</b></p>
                </div>
                <div class="Column titulo">
                    <p class="titulo dis-in">________________________________________</p><br>
                    <p class="titulo dis-in"><b>{{strtoupper('OGTISE')}}</b></p><br>
                    <p class="titulo dis-in">DNI N° <b>{{'85231472'}}</b></p>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
