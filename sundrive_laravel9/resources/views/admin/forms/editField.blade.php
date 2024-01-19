<div class="editModel">
    <div class="modal fade" id="modalEditField{{$field->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="user" method="POST"  action="{{ route('updateField',array('form_id' => $id,'id' => $field->id)) }}">
             @csrf
              <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Update Field</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body mx-3">
                <div class="md-form mb-3">
                    <label for="field_label">Field Label</label>
                    <input type="text" id="field_label" value="{{$field->field_label}}" name="field_label" class="form-control validate field_label" required>
                </div>

                <div class="md-form mb-3">
                    <label for="field_name">Field Name</label>
                    <input type="text" id="field_name"  name="field_name" value="{{$field->field_name}}" class="form-control validate field_name" readonly required>
                </div>

                <div class="md-form mb-3">
                    <label for="field_type">Field Type</label>
                    <select class="form-control validate field_type" name="field_type" required>
                        <option value="text" @if($field->field_type == "text") selected @endif>Text</option>
                        <option value="select" @if($field->field_type == "select") selected @endif>Select</option>
                        <option value="checkbox" @if($field->field_type == "checkbox") selected @endif>Checkbox</option>
                        <option value="radio" @if($field->field_type == "radio") selected @endif>Radio button</option>
                        <option value="file" @if($field->field_type == "file") selected @endif>File</option>
                        <option value="textarea" @if($field->field_type == "textarea") selected @endif>Textarea</option>
                    </select>
                </div>

                <div class="md-form mb-3 field_options"  @if($field->field_type == "select" || $field->field_type == "checkbox" || $field->field_type == "radio") @else style="display: none;" @endif>
                    <label for="field_options">Field Options (Please add name with commas( , ) seperate)</label>
                    <textarea class="form-control validate" name="field_options">{{$field->field_options}}</textarea>
                </div>

              </div>
              <div class="modal-footer d-flex justify-content-center">
                <button class="btn btn-primary">Update</button>
              </div>
            </form>  
        </div>
      </div>
    </div>

</div>