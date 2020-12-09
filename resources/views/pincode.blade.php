@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Check Pincode</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('check_pincode') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Pincode</label>

                            <div class="col-md-6">
                                <input id="pincode" maxlength="6" type="text" class="form-control" name="pincode" value="">
                                <div class="text-danger" style="display:none;"></div>
                                <div class="text-success" style="display:none;"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
        $('#pincode').blur(function(){
        var pincode =    $(this).val();
        $.ajax({
        url: '{{ URL::to("pincode")}}',
        type: "POST",
        data: {pincode:pincode, "_token":"{{ csrf_token() }}"},
        success: function (result) {
            if(result.success){
                $('.text-success').show().html(result.success);
                $('.text-danger').hide().html(result.error);
            }else{
                $('.text-danger').show().html(result.error);
                $('.text-success').hide().html(result.success);
            }
        }    
        });
});
});
</script>
@endsection
