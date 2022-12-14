function deleteData(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            document.getElementById('delete-form-' + id).submit();
        }
    })
}

function resetForm(formId) {
    document.getElementById(formId).reset();
}

$(document).ready(function() {
    // Datatable
    // $("#datatable").DataTable();

    // Summernote config
    // $('.summernote').summernote({
    //     tabsize: 2,
    //     height: 400
    // });

    // Dropify
    $('.dropify').dropify();

    // Select2
    $('.select').each(function () {
        $(this).select2();
    });
    // Nestable
    // $('.dd').nestable({ /* config options */ });
});
