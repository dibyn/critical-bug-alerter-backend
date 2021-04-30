<?php

namespace App\Http\Controllers\Bug;

use App\Models\Config;
use Exception;
use App\Models\Issue;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Issue\CreateIssueRequest;
use App\Http\Requests\Issue\ChangeIssueStatusRequest;

class BugController extends Controller
{
    use ApiResponser; 

    public function list(Request $request) {
        try {
            $data = Issue::orderBy('created_at', 'desc')->paginate(20, ['id','name','description', 'level', 'status', 'created_at']);
            return $this->success($data);
        } catch (Exception $e) {
            return $this->error('There has been some problem in the server', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function listIssueStatus(Request $request) {
        try {
            $data = [
                [
                    'name' => 'Not Resolved',
                    'value' => 'not resolved'
                ],
                [
                    'name' => 'In Progress',
                    'value' => 'in progress'
                ],
                [
                    'name' => 'Acknowledged',
                    'value' => 'acknowledged'
                ],
                [
                    'name' => 'Resolved',
                    'value' => 'resolved'
                 ]
            ];
            return $this->success($data);
        } catch (Exception $e) {
            return $this->error('There has been some problem in the server', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function changeStatus(ChangeIssueStatusRequest $request, $issueId) {
        try {
            $issue = Issue::find($issueId);
            $issue->status = $request->status;
            $issue->save();
            if($request->status != 'not resolved'){
                NotificationService::stopNotification();
            }
            return $this->success($issue);
        } catch (Exception $e) {
            return $this->error('There has been some problem in the server', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function createIssue(CreateIssueRequest $request){
        try {
            $issue = new Issue();
            $issue->name = $request->name;
            $issue->level = $request->level;
            $issue->description = $request->description;
            if ($request->has('status')) {
                $issue->status = $request->status;
            }
            $issue->save();
            NotificationService::notify();
            return $this->success($issue, Response::HTTP_CREATED);
        } catch (Exception $e) {
            return $this->error('There has been some problem in the server', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function generateIssue(Request $request) {
        try {
            Issue::create([
                'name' => Str::random(40)
            ]);
            $data =  Issue::orderBy('created_at', 'desc')->paginate(20, ['id','name','description', 'status', 'created_at']);
            return $this->success($data);
        } catch (Exception $e) {
            return $this->error('There has been some problem in the server', Response::HTTP_INTERNAL_SERVER_ERROR);

        }
    }

    public function notify(Request $request) {
        try {
//            return NotificationService::notify();
            return NotificationService::stopNotification();
        } catch (Exception $e) {
            return $this->error('There has been some problem in the server', Response::HTTP_INTERNAL_SERVER_ERROR);

        }
    }

    public function getConfig($key) {
        $config = Config::where(['key' => $key])->first();
        if(!empty($config)){
            return $this->success($config->value);
        }
        else{
            return $this->error('Config not found', Response::HTTP_NOT_FOUND);
        }
    }

    public function setConfig(Request $request) {
        if(Config::updateOrCreate(['key' => $request->get('key')], $request->all()))
            return $this->success("Config updated successfully");
    }

    public function getIssueGraphPlot(Request $request) 
    {

        $results = DB::select(DB::raw("SELECT strftime('%H', created_at)  AS hour, count(*) AS count FROM issues Group BY hour
                    ORdER BY hour DESC"));

        $dateTimeXAxis = [];
        $countYAxis = [];
        foreach ($results as $key => $value) {
            array_push($dateTimeXAxis,$value->hour);
            array_push($countYAxis,$value->count);

        }
        $data = [
                "xAxis" => [
                    "type" => 'datetime',
                    "categories" => $dateTimeXAxis,
                    "crosshair" => true
                ],
                "series" => [
                    "data" => $countYAxis
                ]
            ];
        return $this->success($data);
		
    }
}
