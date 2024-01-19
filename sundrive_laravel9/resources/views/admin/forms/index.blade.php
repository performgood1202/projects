@extends('layouts.adminLayout')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Forms</h6>
                            <a href="{{route('addForm')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-user fa-sm text-white-50"></i> Add form</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="technicians" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Form name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($forms as $form)
                                            <tr>
                                                <td>{{$form->name}}</td>
                                                <td>@if($form->status == "1") Active @else Inactive @endif</td>
                                                <td>

                                                    <div class="d-flex table_action">

                                                        <!--  <a class="btn btn-primary assign_manager" href="{{route('assignManager',array('id' => $form->id))}}">Assign manager</a> -->

                                                        <a href="{{route('editForm',array('id' => $form->id))}}"><i class="fa fa-edit"></i></a>
                                                        <form  action="{{route('deleteForm',array('id' => $form->id))}}" method="post">
                                                             @csrf
                                                             @method('DELETE')
                                                            <a href="javascript:void(0)" class="deleteForm"><i class="fa fa-trash"></i></a>
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
          $('#technicians').DataTable({
            "ordering": false
          });
          
          $('.deleteForm').click(function(){
            if(confirm("Are you sure?")){
              $(this).parent().submit();
            }
          });
    });

  </script>
@endpush