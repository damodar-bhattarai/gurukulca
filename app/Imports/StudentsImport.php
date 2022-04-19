<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Batch;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Spatie\Permission\Models\Role;

class StudentsImport implements ToCollection, SkipsEmptyRows, WithHeadingRow
{
    use Importable;

    public function headingRow(): int
    {
        return 2;
    }

    public function collection(Collection $rows)
    {

        Validator::make($rows->toArray(), [
            '*.name' => 'required',
            '*.email' => 'required',
            '*.phone' => 'required|digits:10|unique:users,phone',
            '*.parent_phone' => 'required|digits:10',
            '*.batch' => 'required',
        ])->validate();

        $allBatches = Batch::select('id', 'name')->get();

        foreach ($rows as $row) {
            $batch = $allBatches->where('name', trim($row['batch']))->first();

            $user = User::create([
                'name'     => $row['name'],
                'email'    => $row['email'],
                'phone' => $row['phone'],
                'parent_phone' => $row['parent_phone'],
                'password' => bcrypt($row['phone']),
                'batch_id' => $batch ? $batch->id : null,
            ]);
            $role = Role::where('name', 'student')->first();
            $user->assignRole($role);
        }
    }
}
