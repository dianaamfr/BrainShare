<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
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

    public function getReports(Request $request){

        // Filter Reports by Content Type
        if(!is_null($request->input('type-filter')) && !empty($request->input('type-filter'))){
            switch($request->input('type-filter')) {
                case 'questions':
                    $sub = Report::selectRaw('question_id, COUNT(report.id) as number_reports')
                    ->whereRaw('viewed = false')
                    ->groupBy('question_id');

                    $reports = DB::table(DB::raw("({$sub->toSql()}) as report_stats"))
                        ->join('question', 'question.id', '=', 'report_stats.question_id');
                    
                    // Filter Reports by Content Owner
                    if(!is_null($request->input('search-username')) && !empty($request->input('search-username'))){
                        $reports = $reports->leftJoin('user as question_user', 'question_user.id', '=', 'question.question_owner_id')
                            ->where('question_user.username', 'ILIKE', $request->input('search-username') . '%');
                    }

                    return $reports->selectRaw('report_stats.question_id, title, question.content as question_content, number_reports')
                        ->orderBy('number_reports', 'DESC')->paginate(10);

                case 'answers':
                    $sub = Report::selectRaw('answer_id, COUNT(report.id) as number_reports')
                    ->whereRaw('viewed = false')
                    ->groupBy('answer_id');

                    $reports = DB::table(DB::raw("({$sub->toSql()}) as report_stats"))
                        ->join('answer', 'answer.id', '=', 'report_stats.answer_id');

                    // Filter Reports by Content Owner
                    if(!is_null($request->input('search-username')) && !empty($request->input('search-username'))){
                        $reports = $reports->leftJoin('user as answer_user', 'answer_user.id', '=', 'answer.answer_owner_id') 
                            ->where('answer_user.username', 'ILIKE', $request->input('search-username') . '%');
                    }

                    return $reports->selectRaw('report_stats.answer_id, answer.content as answer_content, 
                        answer.question_id as answer_question_id, number_reports')
                        ->orderBy('number_reports', 'DESC')->paginate(10);

                case 'comments':
                    $sub = Report::selectRaw('comment_id, COUNT(report.id) as number_reports')
                    ->whereRaw('viewed = false')
                    ->groupBy('comment_id');

                    $reports = DB::table(DB::raw("({$sub->toSql()}) as report_stats"))
                        ->join('comment', 'comment.id', '=', 'report_stats.comment_id')
                        ->join('answer', 'answer.id', '=', 'comment.answer_id');

                    // Filter Reports by Content Owner
                    if(!is_null($request->input('search-username')) && !empty($request->input('search-username'))){
                        $reports = $reports->leftJoin('user as comment_user', 'comment_user.id', '=', 'comment.comment_owner_id')
                            ->where('comment_user.username', 'ILIKE', $request->input('search-username') . '%');
                    }

                    return $reports->selectRaw('report_stats.comment_id, comment.content as comment_content,                                             
                        comment.answer_id as comment_answer_id, answer.question_id as comment_question_id, number_reports')
                        ->orderBy('number_reports', 'DESC')->paginate(10);

                case 'users':
                    $sub = Report::selectRaw('reported_id, COUNT(report.id) as number_reports')
                    ->whereRaw('viewed = false')
                    ->groupBy('reported_id');

                    $reports = DB::table(DB::raw("({$sub->toSql()}) as report_stats"))
                        ->join('user', 'user.id', '=', 'report_stats.reported_id');

                    // Filter Reports by Content Owner
                    if(!is_null($request->input('search-username')) && !empty($request->input('search-username'))){
                        $reports = $reports->where('user.username', 'ILIKE', $request->input('search-username') . '%');
                    }

                    return $reports->selectRaw('reported_id, username, number_reports')
                        ->orderBy('number_reports', 'DESC')->paginate(10);
                default:
                    break;
            }
        }

        // Get all reported content with total of reports
        
        $sub = Report::selectRaw('reported_id, question_id, answer_id, comment_id, COUNT(report.id) as number_reports')
        ->whereRaw('viewed = false')
        ->groupBy('question_id','answer_id','comment_id','reported_id');

       $reports = DB::table(DB::raw("({$sub->toSql()}) as report_stats"))
        ->leftJoin('user', 'user.id', '=', 'report_stats.reported_id')
        ->leftJoin('question', 'question.id', '=', 'report_stats.question_id')
        ->leftJoin('answer', 'answer.id', 'report_stats.answer_id')
        ->leftJoin('comment', 'comment.id', 'report_stats.comment_id')
        ->leftJoin('answer as answer2', 'answer2.id', 'comment.answer_id');

        // Filter Reports by Content Owner
        if(!is_null($request->input('search-username')) && !empty($request->input('search-username'))){
            $reports = $this->filterReportsByOwner($reports, $request);
        }

        return $reports->selectRaw('report_stats.question_id, title, question.content as question_content, 
        report_stats.answer_id, answer.content as answer_content, answer.question_id as answer_question_id, 
        report_stats.comment_id, comment.content as comment_content,                                             
        comment.answer_id as comment_answer_id, answer2.question_id as comment_question_id,   
        reported_id, "user".username, number_reports')
        ->orderBy('number_reports', 'DESC')->paginate(10);

    }

    public function discard(Request $request) {

        switch($request->input('type')) {
            case 'question':
                Report::where('question_id', '=', $request->input('id'))->update(['viewed' => true]);
                break;
            case 'answer':
                Report::where('answer_id', '=', $request->input('id'))->update(['viewed' => true]);
                break;
            case 'comment':
                Report::where('comment_id', '=', $request->input('id'))->update(['viewed' => true]);
                break;
            case 'user':
                Report::where('reported_id', '=', $request->input('id'))->update(['viewed' => true]);
                break;
            default:
                // TODO
                break;
        }
        
        $reports = $this->getReports($request);

        return response()->json([
            'html' => view('partials.management.reports.reports-table', ['reports' => $reports])->render()
        ]);
    }

    public function search(Request $request) {
        $reports = $this->getReports($request);

        return response()->json([
            'html' => view('partials.management.reports.reports-table', ['reports' => $reports])->render()
        ]);
    }

    public function filterReportsByOwner($reports, Request $request){
        return $reports->leftJoin('user as question_user', 'question_user.id', '=', 'question.question_owner_id')
                ->leftJoin('user as answer_user', 'answer_user.id', '=', 'answer.answer_owner_id')
                ->leftJoin('user as comment_user', 'comment_user.id', '=', 'comment.comment_owner_id')
                ->where('user.username', 'ILIKE', $request->input('search-username') . '%')
                ->orWhere('question_user.username', 'ILIKE', $request->input('search-username') . '%')
                ->orWhere('answer_user.username', 'ILIKE', $request->input('search-username') . '%')
                ->orWhere('comment_user.username', 'ILIKE', $request->input('search-username') . '%');
    }

}
