@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h5 class="card-header">
                    <a href="{{ route('todo.index') }}" class="btn btn-sm btn-outline-primary"><i class="fa fa-arrow-left"></i> Go Back</a>
                </h5>


                <div class="card-header">
                   <h4> Title: {{ $todolist->title }} </h4>
                </div>
                
                <div class="card-body">


                     <div class="form-group row">
                            <label for="description" class="col-form-label text-md-right">Description</label>

                                <textarea cols="30" rows="10" class="form-control @error('password') is-invalid @enderror" readonly>{{ $todolist->description }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                    <div class="form-group row">
                            <div class="">
                                <div class="form-check">
                                    @if ($todolist->completed)
                                        <input class="form-check-input" type="checkbox" value="{{ $todolist->completed }}" checked onclick="return false;">
                                    @else
                                        <input class="form-check-input" type="checkbox" value="{{ $todolist->completed }}" onclick="return false;">
                                    @endif

                                    <label class="form-check-label" for="completed">
                                        Completed
                                    </label>
                                </div>
                            </div>
                        </div>

                      
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection