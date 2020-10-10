{{-- @extends('Admin.index')
@section('content') --}}
<div class="container" id="main">
    <h1 class="h3 mb-2 text-gray-800">sua người dùng</h1>
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
        <form class="col-6 fa-border" action="{{ route('user.update',['user'=>$user['id']]) }} " method="post">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" class="form-control" name="name" value="{{ $user['name'] }}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" name="email" value="{{ $user['email'] }}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" name="password" value="{{ $user['password'] }}">
            </div>
            {{-- <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div> --}}
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
{{-- @endsection --}}