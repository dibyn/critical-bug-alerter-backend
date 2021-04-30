<?php

namespace Database\Seeders;

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
        foreach ($errorMessages as $errorMessage) {
            Issue::create([
                'name' => $errorMessage,
                'level' => Arr::random($level),
                'status' => Arr::random($status),
                'description' => Arr::random($errorMessages)
            ]);
        }
        
        
    }
}
