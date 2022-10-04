@extends('template.mainTemplate')

@section('menu-left')
    <div class="container">
        <div class="row g-2 m-2 border-bottom">
            <div class="col-8">
                <h2><strong>Posts Type</strong></h2>
            </div>
            <div class="col-4 text-end">
                <a class="center-block" href="{{route('post-type.index')}}">
                    <i class="fa fa-wrench"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="text-center p-2">
        <a href="" class="btn btn-sm btn-warning border-secondary text-bold new-postType"
           data-bs-toggle="modal" data-bs-target="#addPostTypeModal"
        >Create new Post type</a>
    </div>
@endsection

@section('content')
    <div class="flex-shrink-0 p-3 block-min-height">
        <table  class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th class="th-width-action text-center">Action</th>
            </tr>
            </thead>
            <tbody id='showPostTypesContent'>
        @if(count($postTypes))
            @foreach($postTypes as $postType)
                @include('postType.store')
            @endforeach
        @endif
        </tbody>
        </table>

        @if(!count($postTypes))
            <div id='messagePostTypeNotFound' class="card-body pt-1">
                <h1 class="text-success text-center">
                    Post Type not found!
                </h1>
            </div>
        @endif


    </div>

    <!-- Modal added new PostType-->
    <div class="modal fade" id="addPostTypeModal" tabindex="-1" aria-labelledby="addPostTypeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('post-type.store')}}" method="post" class="form-group" enctype="multipart/form-data" id="addPostTypeForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPostTypeModalLabel">Create new Post Type</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="text-center ms-4"><strong id="post-type_add_error" class="h3"></strong></div>
                    <div class="modal-body">
                        @csrf
                        <label for="name" class="form-label text-primary"><b>Name Post Type:</b></label>
                        <input name="name" type="text" id="name" class="form-control">
                        <span id="name_error" ></span>
                        <br>

                        <label for="category_id" class="form-label text-primary"><b>Category:</b></label>
                        <select name='category_id' id="category_id" class="form-control">
                            <option value="" disabled selected>Select category ...</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
{{--                        <input name='category_id' type="text" id="category_id" class="form-control">--}}
                        <span id="category_id_error"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary me-4" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"> Save </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit PostType-->
    <div class="modal fade" id="editPostTypeModal" tabindex="-1" aria-labelledby="editPostTypeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="" method="post" class="form-group" enctype="multipart/form-data" id="editPostTypeForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editPostTypeModalLabel">Edit Post Type</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="text-center ms-4"><strong id="post-type_edit_error" class="h3"></strong></div>

                    <div class="modal-body">
                        @method('PUT')
                        @csrf
                        <label for="name-edit" class="form-label text-primary"><b>Name Post Type:</b></label>
                        <input name="name" type="text" id="name-edit" class="form-control">
                        <span id="name_edit_error" ></span>
                        <br>
                        <label for="category_id" class="form-label text-primary"><b>Category:</b></label>
                        <select name='category_id' id="category_id-edit" class="form-control">
{{--                            <option value="" disabled selected>Select category ...</option>--}}
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>


{{--                        <label for="category" class="form-label text-primary"><b>Category:</b></label>--}}
{{--                        <input name='category' type="text" id="category_name" class="form-control">--}}
                        <span id="category_edit_error"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary me-4" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"> Save </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
