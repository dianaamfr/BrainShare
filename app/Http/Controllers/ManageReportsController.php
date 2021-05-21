<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Comment;
use App\Models\Report;

class ManageReportsController extends Controller {

    /**
     * Shows the manage reports page
     */
    public function show(Request $request){
        
        //$this->authorize('showManageReports', Report::class);

        $reports = $this->getReports($request);
        return view('pages.manage-reports', ['reports' => $reports]);
    }   
    
    public function search(Request $request) {
        $reports = $this->getReports($request);

        return response()->json([
            'html' => view('partials.management.reports.reports-table', ['reports' => $reports])->render()
        ]);
    }

    public function getReports(Request $request){

        $reports = $this->getReportsByState($request);

        // Filter Reports by Content Type
        switch($request->input('type-filter')) {
            case 'questions':
                $reports = $reports->whereNotNull('question_id');
                break;
            case 'answers':
                $reports = $reports->whereNotNull('answer_id');
                break;
            case 'comments':
                $reports = $reports->whereNotNull('comment_id');
                break;
            case 'users':
                $reports = $reports->whereNotNull('reported_id');
                break;
            default:
                break;
        }

        // Filter Reports by Content Owner
        if(!is_null($request->input('search-username')) && !empty($request->input('search-username'))){
            $reports = $this->filterReportsByOwner($reports, $request);
        }

        return $reports->orderBy('report.date', 'DESC')->paginate(10);

    }

    public function discard(Request $request) {

        switch($request->input('type')) {
            case 'question':
                $report = Report::where('question_id', '=', $request->input('id'));
                break;
            case 'answer':
                $report = Report::where('answer_id', '=', $request->input('id'));
                break;
            case 'comment':
                $report = Report::where('comment_id', '=', $request->input('id'));
                break;
            case 'user':
                $report = Report::where('reported_id', '=', $request->input('id'));
                break;
            default:
                break;
        }

        if(isset($report)){
            $report->update(['viewed' => true]);
        }
        
        $reports = $this->getReports($request);

        return response()->json([
            'html' => view('partials.management.reports.reports-table', ['reports' => $reports])->render()
        ]);
    }

    public function delete(Request $request){
    
        switch($request->input('type')) {
            case 'question':
                Question::find($request->input('id'))->update(['deleted' => true]);
                break;
            case 'answer':
                Answer::find($request->input('id'))->update(['deleted' => true, ]);
                break;
            case 'comment':
                Comment::find($request->input('id'))->update(['deleted' => true]);
                break;
            case 'user':
                // TODO: DISCUSS THIS
                User::find($request->input('id'))->update(['ban' => true]);
                break;
            default:
                break;
        }

        return $this->discard($request);
    }

    private function filterReportsByOwner($reports, Request $request){

        return $reports->whereHas('reported', function ($query) use ($request){
            $query->where('username', 'ILIKE', $request->input('search-username') . '%');
        })->orWhereHas('question', function ($query) use ($request){
            $query->whereHas('owner', function ($query2) use ($request){
                $query2->where('username', 'ILIKE', $request->input('search-username') . '%');
            });
        })->orWhereHas('answer', function ($query) use ($request){
            $query->whereHas('owner', function ($query2) use ($request){
                $query2->where('username', 'ILIKE', $request->input('search-username') . '%');
            });
        })->orWhereHas('comment', function ($query) use ($request){
            $query->whereHas('owner', function ($query2) use ($request){
                $query2->where('username', 'ILIKE', $request->input('search-username') . '%');
            });
        }); 
        
    }

    private function getReportsByState(Request $request){
        switch($request->input('state-filter')){
            case 'all':
                return new Report();
            case 'handled':
                return Report::where('viewed', '=', true);
            default:
                return Report::where('viewed', '=', false);
        }
    }

}
