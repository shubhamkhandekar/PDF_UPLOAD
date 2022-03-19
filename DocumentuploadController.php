<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Document;
use Illuminate\Support\Facades\Validator;
class DocumentuploadController extends Controller
{
    
    public function index(){
        $data = Document::all();
        return view('upload_doc',compact('data'));
    }

    public function store(Request $req){

            $validator=Validator::make($req->all(),[
                'pdf_file'=>'required',
            ]);
            if($validator->fails()){
                return response()->json(['success'=>false,'msg'=>$validator->errors()],400);
            }else{
                try {
                $file = $req->pdf_file;
                $name = time().$file->getClientOriginalName();
                //$storepath = Storage::disk('public')->path("document/");
                $storepath='/document/';
                $destinationPath = $_SERVER['DOCUMENT_ROOT'] .$storepath;
                $file->move($destinationPath, $name);
                $url = $storepath.$name;
                $res = Document::create(['name'=>$name,'url'=>$url]);

                return response()->json(['success'=>true,'msg'=>'file uploaded successfully'],200);
            } catch (\Exception $e) {
                return response()->json(['success'=>false,'msg'=>'something went wrong'],400);
            }
            }
            
    }
}
