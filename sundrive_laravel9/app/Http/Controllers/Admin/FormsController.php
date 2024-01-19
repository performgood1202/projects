<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Form;
use App\Models\FormFields;
use PDF;



class FormsController extends Controller
{
   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('isAdmin');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $forms = Form::get();

        return view('admin.forms.index',compact("forms"));
    }

     /* add Form */
    public function addForm()
    {
        return view('admin.forms.add');
    }
    /* add technician */
    public function editForm($id)
    {
        $form = Form::where("id",$id)->first();
        $form_fields = FormFields::where("form_id",$id)->get();
        return view('admin.forms.edit',compact("form","form_fields","id"));
    }
    /* delete Form */
    public function deleteForm($id)
    {
        $form = Form::where( "id", $id );
        $form->delete();
        return redirect()->back()->with('message', 'Successfully delete!');
    }


    /* post add Form */
    public function postAddForm(Request $request)
    {

        $validator =  $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);



        Form::create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('message', 'Successfully saved!');
    }

    /* post add Form */
    public function updateForm(Request $request,$id)
    {

        $validator =  $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $form = Form::find($id);

        $form->name = $request['name'];

        $form->save();

        return redirect()->back()->with('message', 'Successfully update!');
    }

    /* post add field */
    public function postAddField(Request $request,$form_id)
    {

        

        $validator =  $request->validate([
            'field_name' => ['required'],
            'field_label' => ['required'],
            'field_type' => ['required'],
        ]);

        $field_exist = FormFields::where("field_name", $request->field_name)->where("form_id", $form_id)->count();

        if($field_exist > 0){
            return redirect()->back()->with('message_error_field', 'Field name already exist!');
        }

        FormFields::create([
            'form_id' => $form_id,
            'field_name' => $request->field_name,
            'field_label' => $request->field_label,
            'field_type' => $request->field_type,
            'field_options' => $request->field_options,
        ]);

        return redirect()->back()->with('message_field', 'Successfully created!');
    }

     /* post update field */
    public function updateField(Request $request,$form_id,$id)
    {

        $validator =  $request->validate([
            'field_name' => ['required'],
            'field_label' => ['required'],
            'field_type' => ['required'],
        ]);

        $FormFields = FormFields::where("id",$id)->where("form_id",$form_id);

        if($request->field_type == "select" || $request->field_type == "checkbox" || $request->field_type == "radio"){
          $field_options = $request->field_options;
        }else{
          $field_options = "";
        }

        $FormFields->update([
            'field_name' => $request->field_name,
            'field_label' => $request->field_label,
            'field_type' => $request->field_type,
            'field_options' => $field_options,
        ]);

        return redirect()->back()->with('message_field', 'Successfully update!');
    }

    /* delete Field */
    public function deleteField(Request $request,$id)
    {
        $FormFields = FormFields::where( "id", $id )->where( "form_id", $request->form_id );
        $FormFields->delete();
        return redirect()->back()->with('message_field', 'Successfully delete!');
    }

    /* formEditor  */
    public function formEditor($id)
    {
        $form = Form::where("id",$id)->first();
        $form_fields = FormFields::where("form_id",$id)->get();
        return view('admin.forms.formEditor',compact("form","form_fields","id"));
    }

     /* post formEditor */
    public function postFormEditor(Request $request,$id)
    {

        $Form = Form::where("id",$id);


        $Form->update([
            'data_html' => $request->data_html,
        ]);

        return redirect()->back()->with('message_field', 'Successfully update!');
    }
    public function formPdfPreview(Request $request,$id)
    {
       $Form = Form::where("id",$id)->first();
       $pdf = app()->make('dompdf.wrapper');
       $htmll = str_replace("{client}", "sdkshjd skdhskjd skdjhsjd skdjhsjd skdjhsjd sd", $Form->data_html);



     /*  $htmll = str_replace("{client}", "sdkshjd skdhskjd skdjhsjd skdjhsjd skdjhsjd sd", $Form->data_html);
       $htmll = str_replace("{site}", "sdkshjd skdhskjd skdjhsjd skdjhsjd skdjhsjd sd", $htmll);
       $htmll = str_replace("{equipment-tag-no}", "sdkshjd skdhskjd skdjhsjd skdjhsjd skdjhsjd sd", $htmll);
       $htmll = str_replace("{description}", "sdkshjd skdhskjd skdjhsjd skdjhsjd skdjhsjd sd", $htmll);
       $htmll = str_replace("{vsd-model-no}", "sdkshjd skdhskjd skdjhsjd skdjhsjd skdjhsjd sd", $htmll);
       $htmll = str_replace("{physical-inspection}", "sdkshjd skdhskjd skdjhsjd skdjhsjd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd ", $htmll);
       $htmll = str_replace("{check-vsd-enclosure-cooling-fans-foroperation-noise-if-applicable}", "sdkshjd skdhskjd skdjhsjd skdjhsjd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd ", $htmll);
       $htmll = str_replace("{check-tension-of-control-cableterminals}", "sdkshjd skdhskjd skdjhsjd skdjhsjd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd ", $htmll);
       $htmll = str_replace("{check-tension-of-input-cable-terminals}", "sdkshjd skdhskjd skdjhsjd skdjhsjd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd ", $htmll);
       $htmll = str_replace("{inspect-vsd-for-physical-damage}", "sdkshjd skdhskjd skdjhsjd skdjhsjd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sd skdjhsjd sdskdjhsjd sdskdjhsjd sdskdjhsjd sdskdjhsjd sdskdjhsjd sdskdjhsjd sdskdjhsjd sdskdjhsjd sdskdjhsjd ", $htmll);*/

       // echo "<pre>"; print_r($htmll); die;

       $pdf->loadView("pdf.editorPdf",array("data" => $htmll))->set_option('isHtml5ParserEnabled', true)->setPaper('A4', 'portrait');
       $pdf->getDomPDF()->setHttpContext(
            stream_context_create([
                'ssl' => [
                    'allow_self_signed'=> TRUE,
                    'verify_peer' => FALSE,
                    'verify_peer_name' => FALSE,
                ]
            ])
        );
       return $pdf->stream();
    }

}
