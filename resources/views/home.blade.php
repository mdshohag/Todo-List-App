@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
         
        <div class="col-lg-4 col-4">

            <div class="small-box bg-info">
                <div class="inner">
                    <h3> {{ $todolists->count() }}</h3>
                    <p>Total Task</p>
                </div>
                <div class="icon">
                   <i class="fa fa-envelope fa-5x"></i>
                </div>
               
            </div>
        </div>
         <div class="col-lg-4 col-4">

            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $posts_pending->count() }}</h3>
                    <p>Total Task Pending</p>
                </div>
                <div class="icon">
                    <i class="fa fa-newspaper-o fa-5x"></i>
                </div>
               
            </div>
        </div>
         <div class="col-lg-4 col-4">

            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $posts->count() }}</h3>
                    <p>Total Task Complete</p>
                </div>
                <div class="icon">
                    <i class="fa fa-pie-chart fa-5x"></i>
                </div>
               
            </div>
        </div>


    </div>

  <div class="row">
        <div class="col-md-12">
            <div class="card">
               
                <h5 class="card-header">
                    <a href="{{ route('todo.create') }}" class="btn btn-sm btn-outline-primary">Add Task</a>
                </h5>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    <table class="table table-border table-hover">
                        <thead>
                          <tr>
                            <th scope="col">Task List</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse ($todolists as $todo)
                                <tr>
                                    @if ($todo->completed)
                                        <td scope="row"><a href="{{ route('todo.show', $todo->id) }}" style="color: black"><s>{{ $todo->title }}</s></a></td>
                                    @else
                                        <td scope="row"><a href="{{ route('todo.show', $todo->id) }}" style="color: black">{{ $todo->title }}</a></td>
                                    @endif
                                    <td>
                                         <a href="{{ route('todo.show', $todo->id) }}" class="btn btn-sm btn-outline-success"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('todo.edit', $todo->id) }}" class="btn btn-sm btn-outline-success"><i class="fa fa-pencil-square-o"></i></a>
                                         <a href="{{ url('delete/'.$todo->id) }}" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></a>
                                                


                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    No Items Added!
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection