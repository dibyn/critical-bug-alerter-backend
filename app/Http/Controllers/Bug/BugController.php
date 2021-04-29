<?php

namespace App\Http\Controllers\Bug;

use Exception;
use App\Models\Issue;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Issue\CreateIssueRequest;

class BugController extends Controller
{
    use ApiResponser; 

    public function list(Request $request) {
        try {
            $data = Issue::paginate(20);
            return $this->success($data);
        } catch (Exception $e) {
            return $this->error('There has been some problem in the server', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function changeStatus(Request $request, $issueId) {
        try {
            $issue = Issue::find($issueId);
            $issue->status = !$issue->status;
            $issue->save();
            return $this->success($issue);
        } catch (Exception $e) {
            return $this->error('There has been some problem in the server', Response::HTTP_INTERNAL_SERVER_ERROR);

        }
    }

    public function createIssue(CreateIssueRequest $request){
        try {
            $issue = new Issue();
            $issue->name = $request->name;
            $issue->description = $request->description;
            $issue->save();
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
            $data = Issue::paginate(20);
            return $this->success($data);
        } catch (Exception $e) {
            return $this->error('There has been some problem in the server', Response::HTTP_INTERNAL_SERVER_ERROR);

        }
    }
}
