@extends('layouts.adminLayout')

@section('content')
<div class="container-fluid">
    <!-- DataTales Example -->
    <form class="user" method="POST"  action="{{ route('postAssignManager',array('user_id'=>$id)) }}">
    @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Assign manager</h6>
                <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Submit</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="technicians" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Manager</th>
                                <th>Assign</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($managers as $manager)
                                <tr>
                                    <td>{{$manager->name}} ({{$manager->email}})</td>
                                    <td>

                                        <div class="d-flex table_action">
                                           
                                           <input type="checkbox" name="users[]" value="{{$manager->id}}" @if(in_array($manager->id,$TechnicianManagers)) checked @endif>
                                           
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>    

</div>
@endsection

@push("js")
  <script type="text/javascript">
  </script>
@endpush