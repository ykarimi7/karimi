<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use View;
use Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\Filesystem;
use Carbon\Carbon;
use App\Models\MediaManaUser;
use App\Models\User;
class UploadMultipleFilesController extends Controller
{
    private $request;
    private $user;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->user = User::find(28);  
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


    public function multipleUploads(Request $request, Filesystem $filesystem)
    {
        $uploadedFiles = [];
        // dd($request->all());
    
        if ($request->hasFile('musics')) {
            // dd('jhkjgjgjk');
            foreach ($request->file('musics') as $index => $file) {
                list($filePath, $fileName) = $this->fileHandler($file, $filesystem);
                $this->storeFile($filePath, $fileName, $file);
    
                $uploadedFiles[] = $filePath . '/' . $fileName;
            }
        }
    
        return response()->json([
            'message' => 'Files uploaded successfully',
            'files' => $uploadedFiles,
        ]);
    }
    
    public function fileHandler($music, $filesystem): array
    {
        $file = $music;
        $filePath = "{$this->user->name}/{$this->user->id}";
        $fileName = $this->generateFileName($file, $filePath, $filesystem);
        return [$filePath, $fileName];
    }
    
    private function generateFileName($file, $path, $filesystem): string
    {
        $fileName = $file->getClientOriginalName();
        if ($filesystem->exists(public_path("{$path}/{$fileName}"))) {
            $fileName = Carbon::now()->timestamp . "-{$fileName}";
        }
        return $fileName;
    }
    
    private function storeFile($path, $fileName, $file): void
    {
        Storage::disk('musics')->putFileAs($path, $file, $fileName);
    }
}