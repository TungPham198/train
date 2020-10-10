{{-- @extends('Admin.index')
@section('content') --}}
<div class="container" id="main">
    <h1 class="h3 mb-2 text-gray-800">Thêm người dùng mới</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row d-flex justify-content-center">
        {{-- <form class="col-6 fa-border" action="{{ route('user.store') }} " method="post"> --}}
            {{-- <form class="col-6 fa-border" action=""> --}}
            {{-- @csrf --}}
            <div class="col-6 fa-border">
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input id="name" type="text" class="form-control" name="name" placeholder="Enter name">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input  id="email" type="email" class="form-control" name="email" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                </div>
                {{-- <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div> --}}
                <button onclick="store()" type="submit" class="btn btn-primary">Submit</button>
            </div>
        {{-- </form> --}}
    </div>
</div>
<script>
    function store(){
        // alert($('#name').val()); 
        $.ajax({
            url:"{{ route('user.store') }}",
            data:{
                name : $('#name').val(),
                email : $('#email').val(),
                password : $('#password').val(),
                _token: '{{csrf_token()}}'
            },
            type:"POST",
            success: function(data){
                if($.isEmptyObject(data.error)){
                    //alert(data.success);
                    //window.history.back();
                    // window.location({{ route('user.index') }});
                    $('#main').html(data);
                }else{
                    // let er = data.each();
                    // var a = '';
                    // console.log(data.error.length);
                    // $.each(data.error, function( index, value ) {
                    //     a+=value;
                    // });
                    alert("đã có lỗi trong quá trình nhập, vui lòng kiểm tra lại.");
                }
            }
        });
    }
</script>
{{-- @endsection --}}