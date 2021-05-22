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
        switch($request->input('report-type')) {
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
        
        $report = Report::find($request->input('id'))->update(['viewed' => true]);

        $reports = $this->getReports($request);

        return response()->json([
            'success'=> 'Your request was completed',
            'html' => view('partials.management.reports.reports-table', ['reports' => $reports])->render()
        ]);
    }

    public function delete(Request $request){

        $report = Report::find($request->input('id'));

        // Delete Reported Content
        if(!is_null($report->question_id)){
            Question::find($report->question_id)->update(['deleted' => true]);
        }
        else if(!is_null($report->answer_id)){
            Answer::find($report->answer_id)->update(['deleted' => true]);
        }
        else if(!is_null($report->comment_id)){
            Comment::find($report->comment_id)->update(['deleted' => true]);
        }
        else{
            User::find($report->reported_id)->update(['ban' => true]);
        }

        // Now the trigger will discard all reports associated with the deleted content

        $reports = $this->getReports($request);

        return response()->json([
            'success'=> 'Your request was completed',
            'html' => view('partials.management.reports.reports-table', ['reports' => $reports])->render()
        ]);
    }

    private function filterReportsByOwner($reports, Request $request){

        return $reports->where(function($query) use ($request){
            $query->whereHas('reported', function ($query) use ($request){
                $query->where('username', 'ILIKE', $request->input('search-username') . '%');
            })
            ->orWhereHas('question', function ($query) use ($request){
                $query->whereHas('owner', function ($query) use ($request){
                    $query->where('username', 'ILIKE', $request->input('search-username') . '%');
                });
            })
            ->orWhereHas('answer', function ($query) use ($request){
                $query->whereHas('owner', function ($query) use ($request){
                    $query->where('username', 'ILIKE', $request->input('search-username') . '%');
                });
            })
            ->orWhereHas('comment', function ($query) use ($request){
                $query->whereHas('owner', function ($query) use ($request){
                    $query->where('username', 'ILIKE', $request->input('search-username') . '%');
                });
            }); 
        });
        
    }

    private function getReportsByState(Request $request){
        switch($request->input('report-state')){
            case 'all':
                return new Report();
            case 'handled':
                return Report::where('viewed', '=', true);
            default:
                return Report::where('viewed', '=', false);
        }
    }

}
