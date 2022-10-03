$(document).ready(function(){

    // Get token for send and get request from forms for Ajax
    let tokenCSRF = $('meta[name="csrf-token"]').attr('content');

    //Add new category
    $('#addCategoryForm').on('submit', addNewCategory);
    //Edit category
    $('.edit-category').click(showModalFormForUpdateCategory);
    $('#editCategoryForm').on('submit', sendModalFormWithNewDataForCategory);
    //delete category
    $('.delete-category').on('submit', deleteCategory);


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
    function sendModalFormWithNewDataForCategory(event){
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

});
