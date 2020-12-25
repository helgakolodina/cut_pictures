@extends('main')

@section('content')
		<table class="table">
                <tr>  
					<td colspan="3" align="center">Картинка - {{ $pictures->name }}</td>               
                </tr>
                <tr>               
                    <td colspan="3" align="center"><img src="{{ asset($pictures->path) }}"> </td>
                </tr>
                <tr>               
                    <td colspan="3" align="center">Части</td>
                </tr>
                <tr>  
					<th>Id части картинки</th>               
                    <th>Картинка</th>
					<th>Ссылка на часть картинки</th>
                </tr>
	        @foreach($slices as $slice)               
                <tr>  
					<td>{{ $slice->id }}</td>               
                    <td><img src="{{ asset($slice->path) }}"> </td>
					<td><a href="/image_slice/{{ $pictures->id }}/{{ $slice->id }}">Перейти к части картинки</a></td>
                </tr>
            @endforeach
		</table>
@endsection