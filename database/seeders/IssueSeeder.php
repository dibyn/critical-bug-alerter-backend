<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Issue;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class IssueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $errorMessages = [
            "PHP Parse error: syntax error, unexpected end of file",
            "E_WARNING: Invalid argument supplied for foreach()",
            "QueryException: SQLSTATE[23000]: Integrity constraint violation",
            "QueryException: SQLSTATE[42S22]: Column not found:",
            "GuzzleHttp\Exception\ClientException:Client error",
            "GuzzleHttp\Exception\ServerException: Server error:",
            "QueryException: SQLSTATE[42S02]: Base table or view not found",
            "PDOException: SQLSTATE[HY000] [2002] Connection refused",
            "BadMethodCallException: Call to undefined method",
            "QueryException: SQLSTATE[42000]: Syntax error or access violation"
        ];
        $level = ['trace', 'debug', 'info', 'warn', 'error', 'fatal'];
        $status = ['not resolved', 'in progress', 'acknowledged', 'resolved'];
        $min=1;
        $max=24;
        $addHour = rand($min,$max);
        // $date = "2021-02-24 12:00:00";
        foreach ($errorMessages as $errorMessage) {
            $created_at = Carbon::parse('2021-03-24 12:00:00')->addHour($addHour)->format('Y-m-d H:i:s');
            Issue::create([
                'name' => $errorMessage,
                'level' => Arr::random($level),
                'status' => Arr::random($status),
                'description' => Arr::random($errorMessages),
                'created_at' => $created_at
            ]);
        }
        
        
    }
}
