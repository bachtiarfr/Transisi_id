@extends('layouts.app')

@section('content')
<div class="container" id="container-company">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
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
                            {{ session()->get('success') }}
                        </div>
                    @endif

                     {{--DATATABLE--}}
                     <div class="col-md-12" style="padding:10px">
                        <button class="btn btn-primary" style="margin-bottom: 20px" data-toggle="collapse" data-target="#form-employee" aria-expanded="false" aria-controls="form-employee">
                            Create New
                        </button>
                        @if ($action == 'edit')
                        <div class="collapse show" id="form-employee" style="margin-bottom: 20px">
                        @else
                        <div class="collapse" id="form-employee" style="margin-bottom: 20px">
                        @endif
                            <div class="card card-body">
                                @if ($action == 'edit')
                                <form action='{{ url("employee/update-data",$data['id']) }}' method="POST" enctype="multipart/form-data">
                                @else
                                <form action="{{ url('employee/save-data') }}" method="POST" enctype="multipart/form-data">
                                @endif
                                    {{csrf_field()}}
                                    <div class="card card-body" style="border:none">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" value="{{ ($action == 'create') ? "" : $data['name'] }}" name="name" id="name" placeholder="Input Name">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" value="{{ ($action == 'create') ? "" : $data['email'] }}" name="email" id="email" placeholder="Input Email">
                                        </div>
                                        <div class="form-group">
                                            <label for="company">company</label>
                                            @if ($action == 'edit')
                                                <select class="form-control" name="company" id="">
                                                    <option value="{{$data['company']}}" selected>{{ $company_name->name }}</option>
                                                    @foreach ($company as $item)
                                                    <option value="{{ $item->id }}"> {{ $item->name }} </option>
                                                    @endforeach
    
                                                </select>
                                            @endif
                                            @if ($action == 'create')
                                            <select class="form-control" name="company" id="company">
                                                @foreach ($company as $item)
                                                <option value="{{ $item->id }}"> {{ $item->name }} </option>
                                                @endforeach
                                            </select>
                                                
                                            @endif
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <button type="button" class="btn btn-danger" data-toggle="collapse" data-target="#form-employee" aria-expanded="false" aria-controls="form-employee">Cancel</button>
                                </form>
                            </div>
                        </div>
                        @if ($action == 'create')
                        <div class="tab-content">
                            <table id="table-data-entry" class="table table-striped" style="width:100%;">
                                <thead>
                                <tr style="background: silver;">
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Company</th>
                                    <th class="text-right" style="width: 20px;">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employee as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->company }}</td>
                                            <td>
                                                <div class='dropdown dropdown-right'>
                                                    <a href='#' data-toggle='dropdown' class='btn btn-success' aria-expanded='true'>Action</a>
                                                    <ul class='dropdown-menu'>
                                                        <li>
                                                            <a href='{{ url("employee/edit/$item->id" )}}' class='btn btn-warning edit'>
                                                                Edit
                                                            </a>
                                                            <a href='{{ url("employee/delete/$item->id" )}}' class='btn btn-danger delete'>
                                                                Delete
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="float-right">
                            {{ $employee->links() }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
