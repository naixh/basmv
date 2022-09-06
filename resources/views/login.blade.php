@extends('layout')

@section('content')

<div class="container" align="center">
    
    <form id = "loginForm" style="max-width:500px">
        <div class="latestForm">
            <div class="form-group"> 
                <label class="form-control-placeholder" for="lastName">Email</label>
                <input type="text" name="Email" id="Email" class="form-control" value="" required> 
                <i class="fa fa-user-o iconSet" aria-hidden="true"></i>
            </div>
            <div class="form-group"> 
                <label class="form-control-placeholder" for="password">Password</label> 
                <input type="password" name="Password" id="Password" class="form-control" value="" required> 
                <i class="fa fa-lock iconSet" aria-hidden="true"></i>
            </div> 
             
        </div> 
        <input type="submit" name="submit" class="btn btn-primary btn-block" style="margin-bottom: 10px !important" id="register" value="Login">
    </form>	
</div>

@endsection

@push('scripts')
<script>


    $("#loginForm").submit(function(e){
            e.preventDefault();
            var form = $('#loginForm')[0];
            var data = new FormData(form);
            $.ajax({
            type:"POST",
            url: "<?php echo e(URL::to('/')); ?>/login",
            data:{
                email: $("#Email").val(),
                password: $("#Password").val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success:function(response){
                if(response.Status == "error") {
                    alert(response.message)
                } else if(response.Status == "success"){
                    window.location.replace("<?php echo e(URL::to('/')); ?>")
                }
            },
            error:function(response){
                if(response.status == 422){
                    Object.keys(response.responseJSON.errors).forEach(function(key){
                        alert(response.responseJSON.errors[key][0])
                    })
                }
            }
        });

    });

</script>
@endpush