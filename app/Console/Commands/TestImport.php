<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Imports\KaryawanImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Karyawan;

class TestImport extends Command
{
    protected $signature = 'test:import';
    protected $description = 'Test import CSV file';

    public function handle()
    {
        $this->info('Starting import test...');

        $file = public_path('Database_Karyawan_2026-01-02.csv');

        if (!file_exists($file)) {
            $this->error('File not found: ' . $file);
            return 1;
        }

        $this->info('File found: ' . $file);
        $this->info('File size: ' . filesize($file) . ' bytes');

        $beforeCount = Karyawan::count();
        $this->info('Records before import: ' . $beforeCount);

        try {
            $import = new KaryawanImport;
            Excel::import($import, $file);

            $afterCount = Karyawan::count();
            $imported = $afterCount - $beforeCount;

            $this->info('Records after import: ' . $afterCount);
            $this->info('Successfully imported: ' . $imported . ' records');

            $failures = $import->failures();
            $errors = $import->errors();

            if (!empty($failures) && count($failures) > 0) {
                $this->warn('Failures: ' . count($failures));
                foreach ($failures as $failure) {
                    $this->error('Row ' . $failure->row() . ': ' . implode(', ', $failure->errors()));
                }
            }

            if (!empty($errors) && count($errors) > 0) {
                $this->warn('Errors: ' . count($errors));
                foreach ($errors as $error) {
                    $this->error($error->getMessage());
                }
            }

            $this->info('Import completed!');
            return 0;

        } catch (\Exception $e) {
            $this->error('Exception: ' . $e->getMessage());
            $this->error('File: ' . $e->getFile());
            $this->error('Line: ' . $e->getLine());
            return 1;
        }
    }
}
