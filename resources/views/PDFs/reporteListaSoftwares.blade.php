<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Softwares</title>
    <style>
        @page {
            margin: 0cm 0cm;
        }

        body {
            margin-top: 2.5cm;
            margin-left: 2cm;
            margin-right: 2cm;
            margin-bottom: 2cm;
        }

        header {
            position: fixed;
            top: 0.2cm;
            left: 0cm;
            right: 0cm;
            text-align: center;
        }

        footer {
            position: fixed;
            bottom: 0.3cm;
            left: 0cm;
            right: 0cm;
            text-align: center;
            /* height: 1.5cm; */

        }

        #titulo {
            text-align: center;
        }

        #table {
            border-collapse: collapse;
            width: 100%;
        }

        #table td,
        #table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #table th {
            padding-top: 3px;
            padding-bottom: 3px;
            background-color: #003E78;
            color: #ffff;
            font-size: 13px;
        }

        #table td {
            font-size: 12px;
        }

    </style>
</head>

<body>
    <header>
        {{-- <img src="{{ asset('/images/Membrete General_001.jpg') }}" width="700"> --}}
        <img src="images/Encabezado Reporte.jpg">
    </header>
    <div>
        <h3 id="titulo">Lista General de Softwares Requeridos</h3>
        <table id="tableIden">
            <thead>
                <tr>
                    <th>Numero Total de PC's Registrados:</th>
                    <th>{{ $totalpc }}</th>
                </tr>
            </thead>
        </table>
        <br>
        <table id="table">
            <thead>
                <tr>
                    <th colspan="5">Softwares requeridos</th>
                </tr>
                <tr>
                    <th>N°</th>
                    <th>Nombre de Software</th>
                    <th>Tipo de Licencia</th>
                    <th>Perido</th>
                    <th>Cantidad</th>
                </tr>

            </thead>
            <tbody>
                @php
                    $num = 1;
                @endphp
                @foreach ($sftpredeterminado as $item)
                    <tr>
                        <td style="text-align: center;">
                            {{ $num++ }}.</td>
                        <td>{{ $item->nombre }}</td>
                        <td style="text-align: center;">{{ $item->licencia->tipo }}
                        </td>
                        <td style="text-align: center;"><small
                                class="badge badge-primary">{{ $item->periodo->periodo }}</small>
                        </td>
                        <td style="text-align: center;">
                            {{ $totalpc }}</td>
                    </tr>
                @endforeach
                @if (count($requerimientos) > 0)
                    @foreach ($requerimientos as $requerimiento)
                        <tr>
                            <td style="text-align: center;">{{ $num++ }}.</td>
                            <td>{{ $requerimiento->detallelicencia->software->nombre }}</td>
                            <td style="text-align: center;"><small
                                    class="badge badge-secondary">{{ $requerimiento->detallelicencia->tipolicencia->tipo }}</small>
                            </td>
                            <td style="text-align: center;"><small
                                    class="badge badge-primary">{{ $requerimiento->detalleperiodo->periodo->periodo }}</small>
                            </td>
                            <td style="text-align: center;">
                                {{ $requerimiento->cantidad }}</td>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <footer>
        <img src="images/Footer.jpg">
    </footer>
    {{-- <div class="footer" style="background-color: #003E78">
        <img src="images/Footer.jpg" >
    </div> --}}

</body>

</html>
