<?php

namespace App\Imports;

use App\Models\SeatConfig;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SeatConfigImport implements ToModel, WithHeadingRow
{
    /**
     * @param  array  $row
     *
     * @return Model|SeatConfig|null
     */
    public function model(array $row): Model|SeatConfig|null
    {
        return new SeatConfig([
            'bus_id' => $row['bus_id'],
            'code' => $row['code'],
            'status' => $row['status'],
        ]);
    }
}