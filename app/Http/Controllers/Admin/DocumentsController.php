<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class DocumentsController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Documents/Index', [
            'documents' => Document::with('user')->paginate(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:102400'
        ], [
            'max' => 'File cannot be larger than 100MBs'
        ]);

        $file = $request->file('file');
        $string = Str::random();

        $document = Document::create([
            'user_id' => auth()->id(),
            'display_name' => $file->getClientOriginalName(),
            'original_name' => $string,
            'doctype' => $file->getMimeType(),
            'docsize' => $this->formatBytes($file->getSize()),
            'url' => env('APP_URL', 'http://127.0.0.1:8000/') . '/storage/documents/' . $string,
        ]);

        $directory = "documents/{$document->created_at->format('Y/m/d')}/{$document->id}";
        $file->storeAs($directory, $document->display_name, 'public');
    }

    private function formatBytes($bytes, $precision = 2) { 
        $units = array('B', 'KB', 'MB', 'GB', 'TB'); 
    
        $bytes = max($bytes, 0); 
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
        $pow = min($pow, count($units) - 1); 
        // $bytes /= pow(1024, $pow);
        $bytes /= (1 << (10 * $pow)); 
    
        return round($bytes, $precision) . ' ' . $units[$pow]; 
    } 
}
