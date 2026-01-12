<?php

use App\Imports\KaryawanImport;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/test-import', function() {
    try {
        $file = public_path('Database_Karyawan_2026-01-02.csv');

        if (!file_exists($file)) {
            return response()->json([
                'error' => 'File tidak ditemukan'
            ]);
        }

        $import = new KaryawanImport;
        Excel::import($import, $file);

        $failures = $import->failures();
        $errors = $import->errors();

        $errorMessages = [];

        if (!empty($failures) && count($failures) > 0) {
            foreach ($failures as $failure) {
                $errorMessages[] = [
                    'row' => $failure->row(),
                    'errors' => $failure->errors(),
                    'values' => $failure->values()
                ];
            }
        }

        if (!empty($errors) && count($errors) > 0) {
            foreach ($errors as $error) {
                $errorMessages[] = $error->getMessage();
            }
        }

        $totalImported = \App\Models\Karyawan::count();

        return response()->json([
            'success' => true,
            'message' => 'Import completed',
            'total_imported' => $totalImported,
            'failures' => $errorMessages,
            'failure_count' => count($errorMessages)
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'error' => $e->getMessage(),
            'line' => $e->getLine(),
            'file' => $e->getFile(),
            'trace' => $e->getTraceAsString()
        ], 500);
    }
});
