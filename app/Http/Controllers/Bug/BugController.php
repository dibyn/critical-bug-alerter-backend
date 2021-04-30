<?php

namespace App\Http\Controllers\Bug;

use Exception;
use App\Models\Issue;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
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
            $data = Issue::orderBy('created_at', 'desc')->paginate(20, ['id','name','description', 'status', 'created_at']);
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
            return $this->success($issue);
        } catch (Exception $e) {
            print_r($e->getMessage());
            return $this->error('There has been some problem in the server', Response::HTTP_INTERNAL_SERVER_ERROR);

        }
    }

    public function createIssue(CreateIssueRequest $request){
        try {
            $issue = new Issue();
            $issue->name = $request->name;
            $issue->description = $request->description;
            if ($request->has('status')) {
                $issue->status = $request->status;
            }
            $issue->save();
            return $this->success($issue, Response::HTTP_CREATED);
        } catch (Exception $e) {
            print_r($e->getMessage());
            die;
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
            NotificationService::notifyToIOTDevice();
        } catch (Exception $e) {
            return $this->error('There has been some problem in the server', Response::HTTP_INTERNAL_SERVER_ERROR);

        }
    }
}
