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
                        <button class="btn btn-primary" style="margin-bottom: 20px" data-toggle="collapse" data-target="#form-company" aria-expanded="false" aria-controls="form-company">
                            Create New
                        </button>
                        @if ($action == 'edit')
                        <div class="collapse show" id="form-company" style="margin-bottom: 20px">
                        @else
                        <div class="collapse" id="form-company" style="margin-bottom: 20px">
                        @endif
                            <div class="card card-body">
                                @if ($action == 'edit')
                                <form action='{{ url("company/update-data",$data['id']) }}' method="POST" enctype="multipart/form-data">
                                @else
                                <form action="{{ url('company/save-data') }}" method="POST" enctype="multipart/form-data">
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
                                            <label for="logo">logo</label>
                                            <input type="file" class="form-control" value="{{ ($action == 'create') ? "" : $data['logo'] }}" name="logo" id="logo" placeholder="Input Logo">
                                        </div>
                                        @if ($action == 'edit')
                                        <div class="card col-md-6">
                                            <img src='{{ url("storage/app/company", $data['logo']) }}' alt="" srcset="" height="100" width="100">
                                        </div>
                                        @endif

                                        <div class="form-group">
                                            <label for="website">website</label>
                                            <input type="text" class="form-control" value="{{ ($action == 'create') ? "" : $data['website'] }}" name="website" id="website" placeholder="Input Website Name">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <button type="button" class="btn btn-danger" data-toggle="collapse" data-target="#form-company" aria-expanded="false" aria-controls="form-company">Cancel</button>
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
                                    <th>Logo</th>
                                    <th>Website</th>
                                    <th class="text-right" style="width: 20px;">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($company as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>
                                                <img src='{{ url("storage/app/company", $item->logo) }}' alt="{{$item->logo}}" srcset="" width="100" height="100">
                                            </td>
                                            <td>{{ $item->website }}</td>
                                            <td>
                                                <div class='dropdown dropdown-right'>
                                                    <a href='#' data-toggle='dropdown' class='btn btn-success' aria-expanded='true'>Action</a>
                                                    <ul class='dropdown-menu'>
                                                        <li>
                                                            <a href='{{ url("company/edit/$item->id" )}}' class='btn btn-warning edit'>
                                                                Edit
                                                            </a>
                                                            <a href='{{ url("company/delete/$item->id" )}}' class='btn btn-danger delete'>
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
                            {{ $company->links() }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('.link-company').click(function(){
            $('#container-company').show();
            $('#container-employee').hide();
        })

        $('.link-employee').click(function(){
            $('#container-company').hide();
            $('#container-employee').show();
        })
    })


</script>

@endsection
