<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

        if ($request->file('file')->isValid()) {
            $path = $request->file('file')->storePublicly("documents/". Carbon::now()->format('Y/M'), ['disk' => config('filesystems.documents_disk', 'public')]);
        }

        Document::create([
            'user_id' => auth()->id(),
            'display_name' => $request->file('file')->getClientOriginalName(),
            'original_name' => $path,
            'doctype' => $request->file('file')->getMimeType(),
            'docsize' => $this->formatBytes($request->file('file')->getSize()),
            'url' => env('APP_URL', 'http://127.0.0.1:8000/storage/') . $path,
        ]);

        return response('Ok');
    }

    public function delete(Document $document)
    {
        if(Storage::disk(config('filesystems.documents_disk', 'public'))->delete($document->original_name ))
        {
            $document->delete();
    
            return back()->with('message', [
                'type' => 'success',
                'message' => 'Document Has Been Deleted Successfully'
            ]);
        }
        return back()->with('message', [
            'type' => 'error',
            'message' => "We Couldn't Process Your Request. Please Try Again Later"
        ]);
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
