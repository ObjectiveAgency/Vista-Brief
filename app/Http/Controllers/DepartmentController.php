<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Department;
use App\Attachment;

use Storage;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

use App\Http\Requests\StoreDepartmentRequest;


class DepartmentController extends Controller
{
  public function index() {
  	$departments = Department::all();

    foreach ($departments as $department) {
      if (empty($department->email)) continue;
      $arr_emails = explode(',', $department->email);

      $department->emails = $arr_emails;

      if (count($department->attachment)) {
        if ($department->attachment->file_ext) {
          $classNames = app('App\Http\Controllers\FileTypeIconController')->getIconClassNames($department->attachment->file_ext);
          $department->attachment->classNames = $classNames;
        }
      }
    }

  	return view ('departments.index', compact('departments'));
  }

  public function formNewDepartment()
  {
    return view('departments.newdepartment');
  }

  public function formEditDepartment($id) 
  {
    return view('departments.editdepartment');
  }

  public function postNewDepartment(StoreDepartmentRequest $request) 
  {
    $name = $request->input('name');
    $arr_emails = array_filter($request->input('email'));
    $arr_emails = array_unique($arr_emails);
    $emails = implode(',', $arr_emails);

    $department = new Department();
    $department->name = $name;
    $department->email = $emails;
    $department->save();

    $file = $request->file('attachment');
    if ( !empty($file) ) {
      //$filename = $file->getClientOriginalName();
      $filetype = $file->getClientMimeType();
      $file_ext = $file->extension();
      $filename = "$name file.$file_ext";

      $attachments = new Attachment();
      $attachments->user_id = $request->user()->id;
      $attachments->department_ids = $department->id;
      $attachments->filename = $filename;
      $attachments->filetype = $filetype;
      $attachments->file_ext = $file_ext;
      $attachments->disk = 'local';
      $attachments->directory = 'department-'.$department->id.'/';
      $attachments->save();

      Storage::disk('local')->put($attachments->directory.$filename, file_get_contents($file));
    }

    return redirect()->route('departments')->with('new_department_success', $name.' had been successfully added.');
  }



  public function postDeleteDepartment(Request $request)
  {
    if ( $department = Department::find($request->input('id')) ) {
      $department->delete();
    }        

    return 'success';
  }
}




    // public function postNewDepartment(Request $request)
    // {

    //  $messages = [
    //         'email'     =>  'The email you entered is not real.',
    //     ];

    //     $validator = Validator::make($request->all(),[
    //         'name'      =>  'bail|required|unique:departments,name',
    //         'email'     =>  'bail|required|email|unique:departments,email',
    //     ], $messages);

    //     if ($validator->fails()) {
    //         $errors = $validator->errors();
    //         $errors = json_decode($errors);

    //         return response()->json([
    //             'success'   => false,
    //             'message'   => $errors
    //         ], 422);
    //     }
        
    //     $department = new Department();
    //     $department->name = $request->input('name');
    //     $department->email = $request->input('email');
    //     $department->save();

    //     return 'success';
    // }

    // public function postEditDepartment(Request $request)
    // {
    //     $messages = [
    //         'email'     =>  'The email you entered is not real.',
    //     ];

    //     $validator = Validator::make($request->all(),[
    //         'name'      =>  'bail|required|unique:departments,name,'.$request->input('id'),
    //         'email'     =>  'bail|required|email|unique:departments,email,'.$request->input('id'),
    //     ], $messages);

    //     if ($validator->fails()) {
    //         $errors = $validator->errors();
    //         $errors = json_decode($errors);

    //         return response()->json([
    //             'success'   => false,
    //             'message'   => $errors
    //         ], 422);
    //     }
        
    //     $department = Department::find($request->input('id'));
    //     $department->name = $request->name;
    //     $department->email = $request->email;
    //     $department->save();

    //     return 'success';
    // }