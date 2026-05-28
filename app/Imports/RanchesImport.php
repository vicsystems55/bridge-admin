<?php
namespace App\Imports;

use App\Models\Ranch;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RanchesImport implements ToCollection, WithHeadingRow
{
    public int $created = 0;
    public int $updated = 0;
    public int $skipped = 0;

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $name = $row['name'] ?? $row['ranch_name'] ?? null;
            $lat = $row['latitude'] ?? $row['lat'] ?? null;
            $lng = $row['longitude'] ?? $row['lng'] ?? $row['long'] ?? null;

            if (!$name || !$lat || !$lng) {
                $this->skipped++;
                continue;
            }

            $data = [
                'name' => trim($name),
                'state' => $row['state'] ?? null,
                'lga' => $row['lga'] ?? null,
                'owner_name' => $row['owner_name'] ?? $row['owner'] ?? null,
                'phone' => $row['phone'] ?? null,
                'capacity' => $row['capacity'] ?? null,
                'latitude' => $lat,
                'longitude' => $lng,
                'status' => $row['status'] ?? 'active',
                'metadata' => $row->toArray(),
            ];

            $ranch = Ranch::updateOrCreate(
                [
                    'name' => trim($name),
                    'latitude' => $lat,
                    'longitude' => $lng,
                ],
                $data
            );

            $ranch->wasRecentlyCreated
                ? $this->created++
                : $this->updated++;
        }
    }
}
