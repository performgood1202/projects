@extends('layouts.adminLayout')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
            <form class="user" method="POST"  action="{{ route('postFormEditor',array('id'=>$id)) }}">
                @csrf

                <div class="row">

                     <!-- Next -->
                    <div class="col-md-12">
                        <div class="card shadow mb-4">

                           

                            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">

                                <h6 class="m-0 font-weight-bold text-primary">Editor</h6>
                                <div class="field_top">
                                    <a href="{{route('editForm',array('id' => $id))}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
                                    
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <!-- Nested Row within Card Body -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="p-3">
                                           
                                           <div class="editor_ul">
                                              @foreach($form_fields as $form_field)
                                              <span>{<?php echo $form_field->field_name;?>}</span>
                                              @endforeach
                                           </ul>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">


                        
                        

                            <div class="card shadow mb-4">

                                @if(session()->get('errors'))
                                    <div class="pr-5 pt-2">
                                            <div class="alert alert-danger alert-msg">
                                                {{ session()->get('errors')->first() }}
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

                                    <h6 class="m-0 font-weight-bold text-primary"></h6>
                                    <div class="field_top">

                                       <a href="{{route('formPdfPreview',array('id' => $id))}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" target="_blank"><i class="fas fa-arrow-left fa-sm text-white-50"></i> 
                                         PDF Preview
                                       </a>
                                    
                                       <button type="submit" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">Save</button>
                                        
                                    </div>
                                </div>

                                <div class="card-body p-0">
                                    <!-- Nested Row within Card Body -->
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="p-5">

                                               <textarea id="formEditor" name="data_html">{{$form->data_html}}</textarea>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                    </div>
                   
                </div>    
            </form>    

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
    tinymce.init({
        selector: 'textarea#formEditor', // Replace this CSS selector to match the placeholder element for TinyMCE
        plugins: 'fullscreen fullpage powerpaste casechange searchreplace autolink directionality advcode visualblocks visualchars image link media mediaembed codesample table charmap pagebreak nonbreaking anchor tableofcontents insertdatetime advlist lists checklist wordcount tinymcespellchecker editimage help formatpainter permanentpen charmap linkchecker emoticons advtable export autosave',
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table',
        valid_elements : '+*[*]',
        valid_children : "+body[style],+html,+head",
        extended_valid_elements: 'img[class=myclass|src|border:0|alt|title|width|height|style|script|head|html|div|p|span],script[*],style[*],iframe[*],html[*]',
        verify_html : false,
        convert_urls : false,
        height : "800"
    });
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