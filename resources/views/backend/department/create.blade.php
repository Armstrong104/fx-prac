@extends('backend.master')

@section('title','Add Department')

@section('content')
    <div class="container-fluid px-4 py-4">
        <div class="row g-4">
            <div class="col-12 col-sm-8 offset-sm-2">
                <h1 class="text-center">Add Department</h1>
                @if (Session::get('msg'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{Session::get('msg')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
                <form action="{{route('departments.store')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                      <label class="form-label">Name</label>
                      <input type="text" class="form-control" name="name">
                    </div>
                    @error('name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                    <button type="submit" class="btn btn-primary">Add Department</button>
                  </form>
            </div>
        </div>
    </div>
@endsection
