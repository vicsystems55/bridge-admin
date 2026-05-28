<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Imports\RanchesImport;
use App\Models\Ranch;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RanchController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => true,
            'data' => Ranch::latest()->get(),
        ]);
    }

    public function mapPoints()
    {
        return response()->json([
            'status' => true,
            'data' => Ranch::select([
                'id',
                'name',
                'state',
                'lga',
                'owner_name',
                'phone',
                'capacity',
                'latitude',
                'longitude',
                'status',
            ])->get(),
        ]);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:xlsx,xls,csv'],
        ]);

        $import = new RanchesImport();

        Excel::import($import, $request->file('file'));

        return response()->json([
            'status' => true,
            'message' => 'Ranch data imported successfully.',
            'summary' => [
                'created' => $import->created,
                'updated' => $import->updated,
                'skipped' => $import->skipped,
            ],
        ]);
    }

    public function show(Ranch $ranch)
    {
        return response()->json([
            'status' => true,
            'data' => $ranch,
        ]);
    }

    public function destroy(Ranch $ranch)
    {
        $ranch->delete();

        return response()->json([
            'status' => true,
            'message' => 'Ranch deleted successfully.',
        ]);
    }
}
