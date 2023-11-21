<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use View;
use Route;

class UploadMultipleFilesController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        $view = View::make('multiple-uploads.index');
        if ($this->request->ajax()) {
            $sections = $view->renderSections();
            if ($this->request->input('page') && intval($this->request->input('page')) > 1) {
                return $sections['pagination'];
            } else {
                return $sections['content'];
            }
        }
        return $view;
    }

    public function multipleUploadsCreate()
    {
        $view = View::make('multiple-uploads.create');
        if ($this->request->ajax()) {
            $sections = $view->renderSections();
            if ($this->request->input('page') && intval($this->request->input('page')) > 1) {
                return $sections['pagination'];
            } else {
                return $sections['content'];
            }
        }
        return $view;
    }

    public function multipleUploads(Request $request)
    {
        $request->validate([
            'musicFiles.*' => 'required|mimes:mp3,wav',
            'author' => 'required|string|max:255',
        ]);

        $author = $request->input('author');

        foreach ($request->file('musicFiles') as $index => $file) {
            // Handle each uploaded file, e.g., save it to storage
            $fileName = $file->getClientOriginalName();
            $filePath = $file->storeAs('music', $fileName);

            // Here you can associate the file with the author in your database, if applicable.
            // Example: FileModel::create(['author' => $author, 'file_name' => $fileName, 'file_path' => $filePath]);
        }

        return response()->json(['message' => 'Files uploaded successfully']);
    }
}
