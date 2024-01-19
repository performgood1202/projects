@extends('layouts.adminLayout')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 formEditField">

                        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">

                            <form class="user" method="POST"  action="{{ route('updateForm',array('id'=>$id)) }}">
                                @csrf
                                <div class="editField">
                                    <input id="name" type="text" class="form-control form-control-user1 @error('name') is-invalid @enderror" name="name" value="{{ $form['name'] }}" required autocomplete="name" autofocus placeholder="Name">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                     <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                
                                </div>
                                @if(session()->has('message'))
                                    <div class="pr-5 pt-2">
                                            <div class="alert alert-success alert-msg">
                                                {{ session()->get('message') }}
                                            </div>
                                    </div>
                                @endif
                                
                            </form>
                            <div class="lastEditFormTop">
                                
                                <a href="{{route('forms')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mb-4">

                        @if(session()->get('errors'))
                            <div class="pr-5 pt-2">
                                    <div class="alert alert-danger alert-msg">
                                        {{ session()->get('errors')->first() }}
                                    </div>
                            </div>
                        @endif

                        @if(session()->has('message_error_field'))
                            <div class="pr-5 pt-2">
                                    <div class="alert alert-danger alert-msg">
                                        {{ session()->get('message_error_field') }}
                                    </div>
                            </div>
                        @endif

                        @if(session()->has('message_field'))
                            <div class="pr-5 pt-2">
                                    <div class="alert alert-success alert-msg">
                                        {{ session()->get('message_field') }}
                                    </div>
                            </div>
                        @endif

                        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">

                            <h6 class="m-0 font-weight-bold text-primary">Fields</h6>
                            <div class="field_top">
                                <a href="{{route('formEditor',array('id'=>$id))}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Form editor</a>
                                 <a href="{{route('forms')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"  data-toggle="modal" data-target="#modalAddField"><i class="fas fa-plus fa-sm text-white-50"></i> Add field</a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="p-5">

                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="technicians" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Field label</th>
                                                        <th>Field name</th>
                                                        <th>Field Type</th>
                                                        <th>Field Options</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($form_fields as $field)
                                                        <tr>
                                                            <td>{{$field->field_label}}</td>
                                                            <td>{{$field->field_name}}</td>
                                                            <td>{{$field->field_type}}</td>
                                                            <td>{{$field->field_options}}</td>
                                                            <td>

                                                                <div class="d-flex table_action">
                                                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#modalEditField{{$field->id}}"><i class="fa fa-edit"></i></a>
                                                                    <form  action="{{route('deleteField',array('id' => $field->id))}}" method="post">
                                                                         @csrf
                                                                         @method('DELETE')
                                                                         <input type="hidden" name="form_id" value="{{$id}}">
                                                                        <a href="javascript:void(0)" class="deleteField"><i class="fa fa-trash"></i></a>
                                                                    </form>
                                                                   
                                                                </div>
                                                                @include('admin.forms.editField')

                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                   
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

</div>
<div class="addModel">
    <div class="modal fade" id="modalAddField" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="user" method="POST"  action="{{ route('postAddField',array('form_id' => $id)) }}">
             @csrf
              <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Add Field</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body mx-3">
                <div class="md-form mb-3">
                    <label for="field_label">Field Label</label>
                    <input type="text" id="field_label"  name="field_label" class="form-control validate field_label" required>
                </div>

                <div class="md-form mb-3">
                    <label for="field_name">Field Name</label>
                    <input type="text" id="field_name"  name="field_name" class="form-control validate field_name" readonly required>
                </div>

                <div class="md-form mb-3">
                    <label for="field_type">Field Type</label>
                    <select class="form-control validate field_type" name="field_type" required>
                        <option value="text">Text</option>
                        <option value="select">Select</option>
                        <option value="checkbox">Checkbox</option>
                        <option value="radio">Radio button</option>
                        <option value="file">File</option>
                        <option value="textarea">Textarea</option>
                    </select>
                </div>

                <div class="md-form mb-3 field_options" style="display: none;">
                    <label for="field_options">Field Options (Please add name with commas( , ) seperate)</label>
                    <textarea class="form-control validate" name="field_options"></textarea>
                </div>

              </div>
              <div class="modal-footer d-flex justify-content-center">
                <button class="btn btn-primary">Submit</button>
              </div>
            </form>  
        </div>
      </div>
    </div>

</div>
@endsection

@push("js")
  <script type="text/javascript">
    setTimeout(function(){
        jQuery(".alert-msg").hide();
    },3000)
    $('.deleteField').click(function(){
        if(confirm("Are you sure?")){
          $(this).parent().submit();
        }
    });
    jQuery('.field_type').change(function(){
        if(this.value == "select" || this.value == "checkbox" || this.value == "radio"){

            jQuery(".field_options").show();

        }else{
            jQuery(".field_options").hide();
        }
    })

    jQuery('.field_label').keyup(function(event){
        let textt = this.value;
        const slugify = textt
            .toLowerCase()
            .trim()
            .replace(/[^\w\s-]/g, '')
            .replace(/[\s_-]+/g, '-')
            .replace(/^-+|-+$/g, '');

        jQuery(".field_name").val(slugify)    
    })
  </script>
@endpush