@extends('layouts.app')

@section('content')

	<div class="container">
		
		<form action="{{ url('/articles/add') }}" method="POST">

			@if($errors->any())

				<div class="alert alert-warning">
					
					<ol class="m-0">
						@foreach($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ol>

				</div>

			@endif
			
			@csrf

			<div class="form-group">
				<label for="title">Title</label>
				<input type="text" name="title" class="form-control">
				@error('title')
					<div class="alert alert-warning text-xs-left">
						{{ $message }}
					</div>
				@enderror
			</div>

			<div class="form-group">
				<label for="body">Body</label>
				<textarea name="body" id="body" class="form-control"></textarea>
				@error('body')
					<div class="alert alert-warning text-xs-left">
						{{ $message }}
					</div>
				@enderror
			</div>

			<div class="form-group">
				<label for="category">Category</label>
				<select name="category_id" id="category" class="form-control">
					@foreach($categories as $category)
						<option value="{{ $category['id'] }}">
							{{ $category['name'] }}
						</option>
					@endforeach
				</select>
				@error('category_id')
					<div class="alert alert-warning text-xs-left">
						{{ $message }}
					</div>
				@enderror
			</div>

			<input type="submit" value="Add Article" class="btn btn-primary">

		</form>

	</div>

@endsection