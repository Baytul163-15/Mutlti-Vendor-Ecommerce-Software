<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use Session; 

class SectionController extends Controller
{
    public function sections(){
        Session::put('page','sections');
        $sections = Section::get()->toArray();
        // dd($sections);
        return view('admin.sections.section')->with(compact('sections'));
    }

    # admin/superadmin update all vendor active status.
    public function UpdateSectionStatus(Request $request){
        if ($request->ajax()) {
            $data= $request->all();
            // echo "<pre>"; print_r($data); die;

            if ($data['status']== "Active") {
                $status = 0;
            }else{
                $status = 1;
            }
            Section::where('id',$data['section_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'section_id'=>$data['section_id']]);
        }
    }

    # Delete Section 
    public function DeleteSection($id){
        Section::where('id',$id)->delete();
        $message = "Section has been deleted successfully";
        return redirect()->back()->with('success_message',$message);
    }

    #Edit Section
    public function AddEditSection(Request $request,$id=null){
        Session::put('page','sections');
        if ($id=="") {
            $title = "Add section";
            $section = new Section;
            $message = "Section added successfully!";
        }else{
            $title = "Edit Section";
            $section = Section::find($id);
            $message = "Section updated successfully!";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $rules = [
                'sections_name' => 'required|regex:/^[\pL\s\-]+$/u',
            ];

            $customMessage = [
                'sections_name.required' => 'Section Name is Requried',
                'sections_name.regex' => 'Valid Section Name is Requried',
            ];

            $this->validate($request, $rules, $customMessage);

            $section->section_name = $data['sections_name'];
            $section->status = 1;
            $section->save();
            return redirect('admin/sections')->with('success_message',$message);
        }

        return view('admin.sections.section_edit')->with(compact('title','section','message'));
    }
}
