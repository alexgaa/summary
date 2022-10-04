@extends('template.mainTemplate')

@section('menu-left')
    <div class="container">
        <div class="row g-2 m-2 border-bottom">
            <div class="col-8">
                <h2><strong>Categories</strong></h2>
            </div>
            <div class="col-4 text-end">
                <a class="center-block" href="{{route('category.index')}}">
                    <i class="fa fa-wrench"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row g-2 m-2 border-bottom">
            <div class="col-8">
                <h2><strong>Posts Type </strong></h2>
            </div>
            <div class="col-4 text-end">
                <a class="center-block" href="{{route('post-type.index')}}">
                    <i class="fa fa-wrench"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="text-center p-2">
        <a href="" class="btn btn-sm btn-warning border-secondary text-bold"
           data-bs-toggle="modal" data-bs-target="#addCategoryModal"
        >Create new Category</a>
    </div>
@endsection

@section('content')
    <div class="flex-shrink-0 p-3 block-min-height">
        <table  class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Official site</th>
                <th class="th-width-action text-center">Action</th>
            </tr>
            </thead>
            <tbody id='showCategoriesContent'>
        @if(count($categories))
            @foreach($categories as $category)
                @include('category.store')
            @endforeach
        @endif
        </tbody>
        </table>

        @if(!count($categories))
            <div id='messageCategoryNotFound' class="card-body pt-1">
                <h1 class="text-success text-center">
                    Category not found!
                </h1>
            </div>
        @endif


    </div>

    <!-- Modal added new Category-->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('category.store')}}" method="post" class="form-group" enctype="multipart/form-data" id="addCategoryForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCategoryModalLabel">Create new Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="text-center ms-4"><strong id="category_add_error" class="h3"></strong></div>
                    <div class="modal-body">
                        @csrf
                        <label for="name" class="form-label text-primary"><b>Name category:</b></label>
                        <input name="name" type="text" id="name" class="form-control">
                        <span id="name_error" ></span>
                        <br>
                        <label for="official_site" class="form-label text-primary"><b>Official Site:</b></label>
                        <input name='official_site' type="text" id="official_site" class="form-control">
                        <span id="official_site_error"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary me-4" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"> Save </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Category-->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="" method="post" class="form-group" enctype="multipart/form-data" id="editCategoryForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="text-center ms-4"><strong id="category_edit_error" class="h3"></strong></div>

                    <div class="modal-body">
                        @method('PUT')
                        @csrf
                        <label for="name-edit" class="form-label text-primary"><b>Name category:</b></label>
                        <input name="name" type="text" id="name-edit" class="form-control">
                        <span id="name_edit_error" ></span>
                        <br>
                        <label for="official_site" class="form-label text-primary"><b>Official Site:</b></label>
                        <input name='official_site' type="text" id="official_site-edit" class="form-control">
                        <span id="official_site_edit_error"></span>
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
