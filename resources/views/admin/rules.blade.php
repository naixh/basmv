@extends('layout')

@section('content')

<div class="container" align="center">
    <h1>Manage Rules</h1>
</div>

@endsection

@push('scripts')
<script>

    var page = 'rules';

    // initiate datatable
    $("#dtable").DataTable();

    // reset forms
    $('#newDataModal').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
    })
    $('#updateDataModal').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
    })

    // add new function
    $("#newDataForm").submit(function(e){
        e.preventDefault();
        var form = $('#newDataForm')[0];
        var data = new FormData(form);
        data.append('_token', $("meta[name='csrf-token']").attr('content')); //csrf token appending from layout blade
        $.ajax({
            type: "POST",
            url: "{{URL::to('/')}}/admin/"+page+"/create",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                if (data.Status == 'error') {
                    swal(data.Message, "", "error")
                } else if (data.validator) {
                    $.each(data.validator, function (i, val) {
                        swal(val, "", "error");
                    });
                } else {
                    swal("Row Created!", "", "success").then((value) => {
                    window.location.reload();
                    });
                }
            },
        });
    });

    // open update modal
    $(".btnUpdate").click(function(){
        var tr = $(this).closest('tr');
        $("#updateDataID").val(tr.data('id'));
        // $("#updateName").val(tr.data('name'));
        // Fill the rest of the fields

        $("#updateDataModal").modal('show');
    });

    // update function
    $("#updateDataForm").submit(function(e){
        e.preventDefault();
        var form = $('#updateDataForm')[0];
        var data = new FormData(form);
        data.append('_token', $("meta[name='csrf-token']").attr('content'));
        $.ajax({
            type: "POST",
            url: "{{URL::to('/')}}/admin/"+page+"/update",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            
            success:function(response){
                if(response.Status == "error") {
                    swal(response.Message, "", "error")
                } else if(response.Status == "success"){
                    swal("Row Updated!", "", "success").then((value) => {
                        window.location.reload();
                    });
                }
            },
            error:function(response){
                if(response.status == 422){
                    Object.keys(response.responseJSON.errors).forEach(function(key){
                        swal(response.responseJSON.errors[key][0], "", "error")
                    })
                }
            }
        });
    });

    // delete function
    $(".btnDelete").click(function(){
        var id = $(this).closest('tr').data('id');
        var data = new FormData();
        data.append('_token', $("meta[name='csrf-token']").attr('content'));
        data.append('id', id);
        $.ajax({
            type: "POST",
            url: "{{URL::to('/')}}/admin/"+page+"/delete",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                if (data.Status == 'error') {
                    swal(data.Message, "", "error")
                } else if (data.validator) {
                    $.each(data.validator, function (i, val) {
                        swal(val, "", "error");
                    });
                } else {
                    swal("Row Deleted!", "", "success").then((value) => {
                        window.location.reload();
                     });
                }
            },
        });
    });


</script>
@endpush