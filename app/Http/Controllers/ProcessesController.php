<?php

namespace App\Http\Controllers;

use App\Process;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProcessesController extends Controller
{
    public function Add(Request $request){
        $process = new Process;
        $process->description = $request->description;
        $process->active = 1;
        $process->candidate_id = $request->candidate_id;
        $process->manager_id = $request->manager_id;
        $process->save();
        return $process->id;
    }

    public function Remove(Request $request){
        Process::where('id',$request->id)->delete();
    }

    public function Index(Request $request){

    }
    public function addFiles(Request $request,$n,$dir,$process){
        $type = "/pdf/";

        $file = $request->file('file'.$n);
        if(preg_match($type,$file->getMimeType())) {
            $path = $file->store($dir);
            $array = explode('/', $path, 2);
            $newfilename = "/file" . $n . ".pdf";
            $newfilepath = $dir . $newfilename;
            if (Storage::disk('local')->exists($dir . $newfilename)) {
                Storage::delete($newfilepath);

            }
            $filename = substr($array[1], strlen('/files/process_' . $process->id));
            Storage::move($dir . "/" . $filename, $newfilepath);
            //return $newfilepath;
            return $newfilepath;
        } else {
            return $newfilepath = False;
        }
    }



    public function uploadFiles(Request $request)
    {
        $process = Process::find(1);

        if ($request->file1 or $request->file2 or $request->file3 or $request->file4 or $request->file5 or $request->file6) {
            $dir='public/files';
            if (Storage::disk('local')->exists($dir)){
            }
            else {
                Storage::makeDirectory($dir);
            }
            $dir = $dir.'/process_' . $process->id;
            if (Storage::disk('local')->exists($dir)) {
            } else {
                Storage::makeDirectory($dir);
            }
            $files = $process->file;
            $filesindb = explode('"-"', $files);


            if ($request->file1) {
                $file[0] = $this->addFiles($request, '1', $dir, $process);
            }
            if ($request->file2) {
                $file[1] = $this->addFiles($request, '2', $dir, $process);
            }
            if ($request->file3) {
                $file[2] = $this->addFiles($request, '3', $dir, $process);
            }
            if ($request->file4) {
                $file[3] = $this->addFiles($request, '4', $dir, $process);
            }
            if ($request->file5) {
                $file[4] = $this->addFiles($request, '5', $dir, $process);
            }
            if ($request->file6) {
                $file[5] = $this->addFiles($request, '6', $dir, $process);
            }

            $fileaux = array();

            foreach ($file as $f) {
                if($f != False) {
                    if (in_array($f, $fileaux)) {
                    } else {
                        array_push($fileaux, $f);
                    }
                } else {
                    return redirect ('/uploadfiles')->with('notPDF',True);
                }
            }

            foreach ($filesindb as $fa) {
                if (in_array($fa, $fileaux)) {
                } else {
                    array_push($fileaux, $fa);
                }
            }

            sort($fileaux);
            $files = "";
            foreach ($fileaux as $file) {
                if ($files == "") {
                    $files = $file;
                } else {
                    if($file != null) {
                        $files = $files . '"-"' . $file;
                    } else {
                        $files = $files;
                    }
                }

            }

            $process->file = $files;
            $process->save();
            return $files;
        }


    }
    public function ChangeProperty(Request $request){
        $property = $request->change;
        $process = Process::where('id',$request->id)->get();
        if($property == "name"){
            $process->name=$request->name;
        }else{
            $process->active = $request->active;
        }
    }

    public function downloadFile(Request $request){
        $process = Process::find(1);
        $files = $process->file;
        $filesarr = explode('"-"', $files);


        $var = '/public\//';
        $files = array();
        foreach ($filesarr as $file) {
            if(preg_match($var,$file)){
                array_push($files,preg_replace($var,'storage/',$file));
            }
        }
        sort($files);


        return view('downloadfiles',compact('files'));
    }
}
