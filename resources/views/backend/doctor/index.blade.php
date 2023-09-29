@extends('backend.master')

@section('title','Manage Doctor')

@section('content')
    <div class="container-slider px-4 py-4">
        <div class="row g-4">
            <div class="col-12">
                <h1 class="text-center">Manage Doctor</h1>
                @if (Session::get('msg'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ Session::get('msg') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">Sl </th>
                        <th scope="col">Name</th>
                        <th scope="col">Department</th>
                        <th scope="col">Speciality</th>
                        <th scope="col">Description</th>
                        <th scope="col">Image</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($doctors as $doctor)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$doctor->name}}</td>
                            <td>{{$doctor->department->name}}</td>
                            <td>{{$doctor->speciality}}</td>
                            <td>{{$doctor->desc}}</td>
                            <td>{{$doctor->status == 1 ? 'Active' : 'Inactive'}}</td>
                            <td><img src="{{asset($doctor->image)}}" alt="" height="50" width="50"></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{route('doctors.edit',$doctor->id)}}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{route('doctors.destroy',$doctor->id)}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                          </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
@endsection
