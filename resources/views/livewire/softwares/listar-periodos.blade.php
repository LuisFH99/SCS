<div>
    @if (!is_null($periodos))
        <ul>
            @foreach ($periodos as $periodo)
                <li>{{$periodo->periodo}}</li>
            @endforeach
        </ul>
    @endif
</div>