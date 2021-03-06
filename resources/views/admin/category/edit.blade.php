
@extends('admin.admin_layouts')

@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Category Update</h5>
            </div><!-- sl-page-title -->
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Category Update </h6>
                <br>
                <div class="table-wrapper">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{url('update/category/'.$category->id)}}" method="post">
                        @csrf
                        <div class="modal-body pd-20">
                            <div class="form-group">
{{--                                <input type="hidden" name="id" value="{{$category_id}}">--}}
                                <label for="exampleInputEmail1">Category Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                       value="{{$category->category_name}}" name="category_name">
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div><!-- modal-body -->
                    </form>
                </div><!-- table-wrapper -->
            </div><!-- card -->
        </div>
        <!-- ########## END: MAIN PANEL ########## -->
@endsection
