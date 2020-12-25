@extends('main')

@section('content')
	<form action="{{ route('save') }}" enctype="multipart/form-data" method="POST">
		{{ csrf_field() }} 
		
		@if ($errors->any())
		  <div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
				  <li >{{ $error }}</li>
				@endforeach
			</ul>
		  </div><br />
		@endif
			<h3>Добавьте картинку</h3>

			<input type="text" name="name" placeholder="Название картинки">
		
			<input type="file" multiple name="file">

			<button type="submit">Отправить форму</button>

	</form>
@endsection