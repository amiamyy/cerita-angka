<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dataset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DatasetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $datasets = Dataset::latest()->paginate(15);
        return view('admin.datasets.index', compact('datasets'));
    }

    public function create()
    {
        return view('admin.datasets.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:datasets',
            'description' => 'nullable|string',
            'category' => 'required|string',
            'file' => 'nullable|file|mimes:csv,xlsx,xls,json|max:10240',
            'source' => 'nullable|string',
            'year' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('file')) {
            $validated['file_path'] = $request->file('file')->store('datasets', 'public');
            
            // Parse CSV/Excel jika diperlukan
            $extension = $request->file('file')->getClientOriginalExtension();
            if (in_array($extension, ['csv', 'xlsx', 'xls'])) {
                $validated['data'] = $this->parseDataFile($request->file('file'), $extension);
            }
        }

        Dataset::create($validated);

        return redirect()->route('admin.datasets.index')->with('success', 'Dataset berhasil ditambahkan!');
    }

    public function edit(Dataset $dataset)
    {
        return view('admin.datasets.edit', compact('dataset'));
    }

    public function update(Request $request, Dataset $dataset)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:datasets,slug,' . $dataset->id,
            'description' => 'nullable|string',
            'category' => 'required|string',
            'file' => 'nullable|file|mimes:csv,xlsx,xls,json|max:10240',
            'source' => 'nullable|string',
            'year' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('file')) {
            if ($dataset->file_path) {
                Storage::disk('public')->delete($dataset->file_path);
            }
            $validated['file_path'] = $request->file('file')->store('datasets', 'public');
            
            $extension = $request->file('file')->getClientOriginalExtension();
            if (in_array($extension, ['csv', 'xlsx', 'xls'])) {
                $validated['data'] = $this->parseDataFile($request->file('file'), $extension);
            }
        }

        $dataset->update($validated);

        return redirect()->route('admin.datasets.index')->with('success', 'Dataset berhasil diupdate!');
    }

    public function destroy(Dataset $dataset)
    {
        if ($dataset->file_path) {
            Storage::disk('public')->delete($dataset->file_path);
        }
        
        $dataset->delete();

        return redirect()->route('admin.datasets.index')->with('success', 'Dataset berhasil dihapus!');
    }

    private function parseDataFile($file, $extension)
    {
        // Simplified CSV parsing - untuk production gunakan library seperti PhpSpreadsheet
        if ($extension === 'csv') {
            $data = [];
            if (($handle = fopen($file->getRealPath(), 'r')) !== false) {
                $header = fgetcsv($handle);
                while (($row = fgetcsv($handle)) !== false) {
                    $data[] = array_combine($header, $row);
                }
                fclose($handle);
            }
            return $data;
        }
        
        return null;
    }
}
