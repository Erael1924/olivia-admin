<?php

namespace App\Repositories;

use App\Interfaces\SettingRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\Settings;

class SettingRepository implements SettingRepositoryInterface
{
    public function update($request){
        // Prepare the SQL update query
        $caseStatements = [];
        $inPlaceholders = [];
        $bindings = [];

        foreach ($request as $fieldName => $value) {
            \Illuminate\Support\Facades\Log::debug("fieldName", [$fieldName]);
            $caseStatements[] = "WHEN ? THEN ?";
            $bindings[] = $fieldName;
            $bindings[] = $value;
            $inPlaceholders[] = "?";
        }

        // Prepare the final SQL query
        $sql = "UPDATE settings
                SET value = CASE field_name " . implode(" ", $caseStatements) . " END
                WHERE field_name IN (" . implode(", ", $inPlaceholders) . ")";
        \Illuminate\Support\Facades\Log::debug("AA", [$sql]);
        // Execute the query
        // Bind parameters for the IN clause
        $bindings = array_merge($bindings, array_keys($request));

        // Execute the query
        DB::statement($sql, $bindings);

    }
}
