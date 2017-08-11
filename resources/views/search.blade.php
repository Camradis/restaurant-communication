@foreach ($results as $result)
    <p>{{ $result->name }}</p>
@endforeach
{{$results->render()}}