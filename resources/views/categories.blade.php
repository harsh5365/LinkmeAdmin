@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add Category</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form method="post" action="{{ url('add_category') }}" name="addCategory">
                        <div class="form-group">
                            <input type="text" name="category" id="category" class="form-control input-default " placeholder="Add Categories">
                        </div>
                        <button type="button" class="btn btn-primary mb-2" id="add_btn">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row" id="table-div">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Categories</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example3" class="display min-w850">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['current_categories'] as $key => $category)
                            <tr>
                                <td>{{ $category->category }}</td>
                                <td>
                                    <div class="d-flex">
                                        {{-- <a href="#" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a> --}}
                                        <a href="{{ url("delete_category/$category->id") }}" class="btn btn-danger shadow btn-xs sharp sweet-confirm"><i class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@section('javascript')
    <script src="{{asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/plugins-init/datatables.init.js')}}"></script>
    <script>
        $(function () {
            $('#add_btn').on('click', function () {
                category = $('#category').val();
                $.ajax({
                    type: "get",
                    url: base_url+"add_categories",
                    data: {category: category},
                    dataType: "json",
                    success: function (response) {
                        $('#table-div' ).load(window.location.href+ ' #table-div');
                        setTimeout(() => {
                            $('#example3').DataTable();
                        }, 2000);
                    }
                });
            });
        });
    </script>
@endsection
@endsection
