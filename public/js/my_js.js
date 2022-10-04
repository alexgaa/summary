$(document).ready(function(){

    // Get token for send and get request from forms for Ajax
    let tokenCSRF = $('meta[name="csrf-token"]').attr('content');

    //Add new category
    $('#addCategoryForm').on('submit', addNewCategory);
    //Edit category
    $('.edit-category').click(showModalFormForUpdateCategory);
    $('#editCategoryForm').on('submit', sendModalFormWithUpdatedDataForCategory);
    //delete category
    $('.delete-category').on('submit', deleteCategory);

    //Add new Post Type
    $('#addPostTypeForm').on('submit', addNewPostType);
    //Edit Post Type
     $('.edit-postType').click(showModalFormForUpdatePostType);
     $('#editPostTypeForm').on('submit', sendModalFormWithUpdatedDataForPostType);
    // //delete Post Type
     $('.delete-postType').on('submit', deletePostType);



    //Show Modal form  for update category
    function showModalFormForUpdateCategory(event){
        event.preventDefault();
        let idCategory = $(this).attr('id').replace('edit-category-','');
        $('#editCategoryForm').attr('action', $('#addCategoryForm').attr('action') + '/' + idCategory);
        $('#name-edit').attr('value', $('#category-name-' + idCategory).text());

        $('#official_site-edit').attr('value', $('#category-official_site-' + idCategory).text());
    }

    // Delete Category
    function deleteCategory(event){
        event.preventDefault();
        if(confirm('Do you want to delete this Category?')) {
            let url2 = $(this).attr('action');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': tokenCSRF
                },
                url: url2,
                method: 'DELETE',
                dataType: 'JSON',
                contentType: false,
                processData: false,
                success: function (response) {
                    $('#tr-category-id-' + response.id).detach();
                },
                error: function (response) {
                    alert(response.status);
                }
            });
        }
    }

    //Add new category (for Ajax)
    function addNewCategory(event){
        event.preventDefault();

        let url = $(this).attr('action');

        $('#name_error').text('').removeClass('text-danger');
        $('#name').removeClass('border-danger');
        $('#official_site_error').text('').removeClass('text-danger');
        $('#official_site').removeClass('border-danger');

        $.ajax({
            url: url,
            method: 'POST',
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(response)
            {
                $('#showCategoriesContent').prepend(response.resultInHtml);

                $('#edit-category-'+ response.id).click(showModalFormForUpdateCategory);
                $('#delete-category-'+ response.id).on('submit', deleteCategory);

                $('#messageCategoryNotFound').detach();
                $('#addCategoryForm').trigger("reset");
                $('#addCategoryModal').modal('hide');
            },
            error: function(response) {
                if(response.status === 422) {
                    const {errors} = response.responseJSON;
                    for (let error in errors) {
                        $('#'+ error +'_error').text(errors[error][0]).addClass('text-danger');
                        $('#'+ error).addClass('border-danger');
                    }
                }  else {
                    $('#category_add_error').text("Error add category!").addClass('text-danger');
                }
            }
        });
    }

    // Send Modal form with new data for category(for Ajax)
    function sendModalFormWithUpdatedDataForCategory(event){
        event.preventDefault();

        $('#name_edit_error').text('').removeClass('text-danger');
        $('#name-edit').removeClass('border-danger');
        $('#official_site_edit_error').text('').removeClass('text-danger');
        $('#official_site-edit').removeClass('border-danger');

        let url = $(this).attr('action');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': tokenCSRF
            },
            url: url,
            method: 'POST',
            dataType: 'JSON',
            data :new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                $('#tr-category-id-' + response.id).html(response.resultInHtml);
                $('#edit-category-'+ response.id).click(showModalFormForUpdateCategory);
                $('#delete-category-'+ response.id).on('submit', deleteCategory);

                $('#editCategoryForm').trigger("reset");
                $('#editCategoryModal').modal('hide');
            },
            error: function (response) {
                if(response.status === 422) {
                    const {errors} = response.responseJSON;
                    for (let error in errors) {
                        $('#'+ error +'_edit_error').text(errors[error][0]).addClass('text-danger');
                        $('#'+ error + '-edit').addClass('border-danger');
                    }
                } else {
                    $('#category_edit_error').text("Error update category!").addClass('text-danger');
                }
            }
        });
    }

// PostType -----------------------------------------------------------------------------------------------


    //Show Modal form  for update PostType
    function showModalFormForUpdatePostType(event){
        event.preventDefault();
        let idPostType = $(this).attr('id').replace('edit-postType-','');

        $('#editPostTypeForm').attr('action', $('#addPostTypeForm').attr('action') + '/' + idPostType);
        $('#name-edit').attr('value', $('#postType-name-' + idPostType).text());

        let categoryName = $('#postType-category_name-' + idPostType).text();
        $('#category_id-edit :contains(' + categoryName + ')').attr('selected', 'selected');

    }

    // Delete PostType
    function deletePostType(event){
        event.preventDefault();
        if(confirm('Do you want to delete this Post Type?')) {
            let url2 = $(this).attr('action');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': tokenCSRF
                },
                url: url2,
                method: 'DELETE',
                dataType: 'JSON',
                contentType: false,
                processData: false,
                success: function (response) {
                    $('#tr-postType-id-' + response.id).detach();
                },
                error: function (response) {
                    alert(response.status);
                }
            });
        }
    }

    //Add new postType (for Ajax)
    function addNewPostType(event){
        event.preventDefault();

        let url = $(this).attr('action');

        $('#name_error').text('').removeClass('text-danger');
        $('#name').removeClass('border-danger');
        $('#category_id_error').text('').removeClass('text-danger');
        $('#category_id').removeClass('border-danger');

        $.ajax({
            url: url,
            method: 'POST',
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(response)
            {
                $('#showPostTypesContent').prepend(response.resultInHtml);
                 $('#edit-postType-'+ response.id).click(showModalFormForUpdatePostType);
                 $('#delete-postType-'+ response.id).on('submit', deletePostType);

                $('#messagePostTypeNotFound').detach();
                $('#addPostTypeForm').trigger("reset");
                $('#addPostTypeModal').modal('hide');
            },
            error: function(response) {
                if(response.status === 422) {
                    const {errors} = response.responseJSON;
                    for (let error in errors) {
                        $('#'+ error +'_error').text(errors[error][0]).addClass('text-danger');
                        $('#'+ error).addClass('border-danger');
                    }
                }  else {
                    $('#post-type_add_error').text("Error add category!").addClass('text-danger');
                }
            }
        });
    }


    // Send Modal form with new data for post type(for Ajax)
    function sendModalFormWithUpdatedDataForPostType(event){
        event.preventDefault();
        $('#name_edit_error').text('').removeClass('text-danger');
        $('#name-edit').removeClass('border-danger');
        $('#category_edit_error').text('').removeClass('text-danger');
        $('#category_id-edit').removeClass('border-danger');

        let url = $(this).attr('action');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': tokenCSRF
            },
            url: url,
            method: 'POST',
            dataType: 'JSON',
            data :new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                $('#tr-postType-id-' + response.id).html(response.resultInHtml);
                $('#edit-postType-'+ response.id).click(showModalFormForUpdatePostType);
                $('#delete-postType-'+ response.id).on('submit', deletePostType);

                $('#editPostTypeForm').trigger("reset");
                $('#editPostTypeModal').modal('hide');
            },
            error: function (response) {
                if(response.status === 422) {
                    const {errors} = response.responseJSON;
                    for (let error in errors) {
                        $('#'+ error +'_edit_error').text(errors[error][0]).addClass('text-danger');
                        $('#'+ error + '-edit').addClass('border-danger');
                    }
                } else {
                    $('#post-type_edit_error').text("Error update Post type!").addClass('text-danger');
                }
            }
        });
    }

});
