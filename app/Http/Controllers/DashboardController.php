<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FileInfo;

class DashboardController extends Controller
{
    public function index()
    {
    	return view('dashboard.dashboard-index');
    }

    public function showFilesTable()
    {
    	$files_list = FileInfo::all();

    	return view('dashboard.dashboard-filestable', compact(['files_list']));
    }

    public function uploadFile(Request $request)
    {

    	$formInput = $request->all();

    	// dd($request->all());
    	$this->validate($request, [
    		'title' => 'required',
    		'file_input' => 'required|mimetypes:application/octet-stream,application/vnd.ms-powerpoint,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf,application/vnd.ms-excel,application/csv,text/plain,text/csv',
    	]);

    	// dd($request->all());
    	$file = $request->file_input;
    	

    	if ($file) {
    		$filename = $file->getClientOriginalName();
    		$file_extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
    		$file->move('files', $filename);

    		FileInfo::create([
    			'title' => $request->title,
    			'filename' => $filename,
    			'uploaded_by' => auth()->user()->name,
    			'file_format' => $file_extension,
    			'file_desc' => $request->file_desc
    		]);

    		return redirect()->route('file.list');

    	}
    }
}
