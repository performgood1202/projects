@extends('layouts.adminLayout')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Managers</h6>
                            <a href="{{route('addManager')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-user fa-sm text-white-50"></i> Add manager</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="managers" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @foreach($managers as $manager)
                                            <tr>
                                                <td>{{$manager->name}}</td>
                                                <td>{{$manager->email}}</td>
                                                <td>
                                                    <div class="d-flex gap-12">
                                                        <a href="{{route('editManager',array('id' => $manager->id))}}"><i class="fa fa-edit"></i></a>
                                                        <form  action="{{route('deleteManager',array('id' => $manager->id))}}" method="post">
                                                             @csrf
                                                             @method('DELETE')
                                                            <a href="javascript:void(0)" class="deleteManager"><i class="fa fa-trash"></i></a>
                                                        </form>
                                                       
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

</div>
@endsection

@push("js")
  <script type="text/javascript">
    $(document).ready(function() {
          $('#managers').DataTable();
          
          $('.deleteManager').click(function(){
            $(this).parent().submit();
          });
    });

  </script>
@endpush