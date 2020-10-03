@extends('Admin.index')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tables User   <a class="btn btn-primary" href="{{ route('user.create') }}" role="button">Thêm nguời dùng</a></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables User</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          @if (session('success'))
            <div class="alert alert-success">
              {{ session('success') }}
            </div>
          @endif
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>EMAIL</th>
                <th>ACTION</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user['id'] }}</td>
                    <td>{{ $user['name'] }}</td>
                    <td>{{ $user['email'] }}</td>
                    <td class="justify-center row">
                        <a class="btn btn-info" href="{{ route('user.edit',['user'=>$user['id']]) }}" role="button">Sửa</a>
                        <form action="{{ route('user.destroy', ['user' => $user['id']]) }}" method="post">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="submit" value="Xoá" class="btn btn-danger">
                        </form>
                    </td>
                  </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
  <!-- /.container-fluid -->

<!-- End of Main Content -->
@endsection