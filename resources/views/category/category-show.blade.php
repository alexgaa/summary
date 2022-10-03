    <td> {{$category->id}}</td>
    <td id="category-name-{{$category->id}}"><b>{{$category->name}}</b></td>
    <td id="category-official_site-{{$category->id}}">{{$category->official_site}}</td>
    <td>
        <a id='edit-category-{{$category->id}}' href=""
           class="btn btn-info btn-sm ms-3 btn-min-width edit-category"
           data-bs-toggle="modal" data-bs-target="#editCategoryModal"
        >
            <i class="fas fa-pencil-alt text-light"> Edit</i>
        </a>
        <form id='delete-category-{{$category->id}}' action="{{route('category.destroy', ['category' => $category->id])}}"
              method="post" class="float-end mb-0 delete-category" enctype="multipart/form-data">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-danger btn-sm btn-min-width">
                <i class="fas fa-trash-alt"></i>
                Delete
            </button>
        </form>
    </td>

