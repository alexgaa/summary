    <td> {{$postType->id}}</td>
    <td id="postType-name-{{$postType->id}}"><b>{{$postType->name}}</b></td>
    <td id="postType-category_name-{{$postType->id}}">{{$postType->category->name}}</td>
    <td>
        <a id='edit-postType-{{$postType->id}}' href=""
           class="btn btn-info btn-sm ms-3 btn-min-width edit-postType"
           data-bs-toggle="modal" data-bs-target="#editPostTypeModal">
            <i class="fas fa-pencil-alt text-light"> Edit</i>
        </a>
        <form id='delete-postType-{{$postType->id}}' action="{{route('post-type.destroy', ['post_type' => $postType->id])}}"
              method="post" class="float-end mb-0 delete-postType" enctype="multipart/form-data">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-danger btn-sm btn-min-width">
                <i class="fas fa-trash-alt"></i>
                Delete
            </button>
        </form>
    </td>

