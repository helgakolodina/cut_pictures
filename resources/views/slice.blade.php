@extends('main')

@section('content')
		<table class="table">
                <tr>  
					<td colspan="3" align="center">Картинка части- {{ $slice->id }}</td>               
                </tr>
                <tr>               
                    <td colspan="3" align="center"><img src="{{ asset($slice->path) }}"> </td>
                </tr>
                <tr>               
                    <td colspan="3" align="center"><a href="{{ asset($slice->path) }}" download>скачать картинку</a> </td>
                </tr>
		</table>
@endsection