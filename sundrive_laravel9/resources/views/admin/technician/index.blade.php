@extends('layouts.adminLayout')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Technicians</h6>
                            <a href="{{route('addTechnician')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-user fa-sm text-white-50"></i> Add technician</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="technicians" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Managers</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($technicians as $technician)
                                            <tr>
                                                <td>{{$technician->name}}</td>
                                                <td>{{$technician->email}}</td>
                                                <td>
                                                    <?php 
                                                        $managerss = array();
                                                        foreach($technician->assignManagers as $manager){
                                                               $managerss[] = $manager->manager->name;
                                                        }
                                                        $managerss = implode(", <br>", $managerss);
                                                        echo $managerss;
                                                    ?>
                                                </td>
                                                <td>

                                                    <div class="d-flex table_action">

                                                         <a class="btn btn-primary assign_manager" href="{{route('assignManager',array('id' => $technician->id))}}">Assign manager</a>

                                                        <a href="{{route('editTechnician',array('id' => $technician->id))}}"><i class="fa fa-edit"></i></a>
                                                        <form  action="{{route('deleteTechnician',array('id' => $technician->id))}}" method="post">
                                                             @csrf
                                                             @method('DELETE')
                                                            <a href="javascript:void(0)" class="deleteTechnician"><i class="fa fa-trash"></i></a>
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
          
          $('.deleteTechnician').click(function(){
            $(this).parent().submit();
          });
    });

  </script>
@endpush