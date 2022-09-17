<?php

namespace App\Exports;

use App\Models\Task;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TaskExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * (Implemented method from interface FromCollection)
     * 
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return auth()->user()->tasks()->get();
    }

    /**
     * Return an array with headings.
     *  
     * (Implemented method from interface WithHeadings)
     * 
     * @return array
     */
    public function headings(): array
    {
        return [
            'Id',
            'User',
            'Task',
            'Deadline',
            'Created_at',
            'Updated_at'
        ];
    }

    /**
     * (Implemented method from interface WithMapping)
     * 
     * @param  mixed $row
     * @return array
     */
    public function map($row): array
    {
        return [
            $row->id,
            $row->user->name,
            $row->task,
            date('d/m/Y', strtotime($row->deadline)),
            date('d/m/Y - H:i:s', strtotime($row->created_at)),
            date('d/m/Y - H:i:s', strtotime($row->updated_at))
        ];
    }
}
