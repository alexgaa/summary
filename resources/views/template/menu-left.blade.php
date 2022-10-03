@section('menu-left')
            <div class="container">
                <div class="row g-2  m-2">
                    <div class="col-6">
                        <h2><strong>Categories</strong></h2>
                    </div>
                    <div class="col-6 text-end">
                        <a class="center-block" href="{{route('category.index')}}">
                            <i class="fa fa-wrench"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="list-group">
                @foreach($categories as $category)
                    <a href="{{route('category.show', ['category' => $category->id])}}"
                       class="list-group-item list-group-item-action">
                        {{$category->name}}
                    </a>
                @endforeach
            </div>
@endsection
