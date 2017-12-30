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
        $file = $request->file('file'.$n);
        $path = $file->store($dir);
        $array = explode('/', $path,2);
        $newfilename = "/file".$n.".pdf";
        $newfilepath = $dir . $newfilename;
        if(Storage::disk('local')->exists($dir.$newfilename)){
            Storage::delete($newfilepath);

        }
        $filename = substr($array[1], strlen('/files/process_' . $process->id));
        Storage::move($dir . "/" . $filename, $newfilepath);
        //return $newfilepath;
        return $newfilepath;
    }



    public function uploadFiles(Request $request)
    {
        $process = Process::find(1);
        if ($request->file1 or $request->file2 or $request->file3 or $request->file4 or $request->file5 or $request->file6) {
            $dir = 'public/files/process_' . $process->id;
            if (Storage::disk('local')->exists($dir)) {
            } else {
                Storage::makeDirectory($dir);
            }
            $files = $process->file;
            $filesarr = explode('"-"', $files);
            if ($request->file1) {
                $file = $this->addFiles($request, '1', $dir, $process);
                $filesarr[0]=$file;
            }
            if ($request->file2) {
                $file = $this->addFiles($request, '2', $dir, $process);
                $filearr[1] = $file;
            }
            if ($request->file3) {
                $file = $this->addFiles($request, '3', $dir, $process);
                $filearr[2] = $file;
            }
            if ($request->file4) {
                $file = $this->addFiles($request, '4', $dir, $process);
                $filearr[3] = $file;
            }
            if ($request->file5) {
                $file = $this->addFiles($request, '5', $dir, $process);
                $filearr[4] = $file;
            }
            if ($request->file6) {
                $file = $this->addFiles($request, '6', $dir, $process);
                $filearr[5] = $file;
            }
            $fileaux = "";
            foreach ($filesarr as $file)
                if ($fileaux == "") {
                    $fileaux = $file;
                } else {
                    $fileaux = $fileaux . '"-"' . $file;
                }
            $process->file = $fileaux;
            $process->save();

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
}
