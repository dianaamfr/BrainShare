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

        // Filter Reports by Content Type
        if(!is_null($request->input('type-filter')) && !empty($request->input('type-filter'))){

            switch($request->input('type-filter')) {
                case 'questions':
                    return $this->getReportedQuestions($request);
                case 'answers':
                    return $this->getReportedAnswers($request);
                case 'comments':
                    return $this->getReportedComments($request);
                case 'users':
                    return $this->getReportedUsers($request);
                default:
                    break;
            }
        }

        // Get all Report Types
        
        // TODO: check state filter and make whereRaw vary depending on it
        $sub = Report::selectRaw('reported_id, question_id, answer_id, comment_id, COUNT(report.id) as number_reports')
            ->whereRaw('viewed = false')
            ->groupBy('question_id','answer_id','comment_id','reported_id');

       $reports = DB::table(DB::raw("({$sub->toSql()}) as report_stats"))
        ->leftJoin('user', 'user.id', '=', 'report_stats.reported_id')
        ->leftJoin('question', 'question.id', '=', 'report_stats.question_id')
        ->leftJoin('answer', 'answer.id', 'report_stats.answer_id')
        ->leftJoin('comment', 'comment.id', 'report_stats.comment_id')
        ->leftJoin('answer as answer2', 'answer2.id', 'comment.answer_id')
        ->leftJoin('user as question_user', 'question_user.id', '=', 'question.question_owner_id')
        ->leftJoin('user as answer_user', 'answer_user.id', '=', 'answer.answer_owner_id')
        ->leftJoin('user as comment_user', 'comment_user.id', '=', 'comment.comment_owner_id');

        // Filter Reports by Content Owner
        if(!is_null($request->input('search-username')) && !empty($request->input('search-username'))){
            $reports = $this->filterReportsByOwner($reports, $request);
        }

        return $reports->selectRaw('report_stats.question_id, title, question.content as question_content, 
        question.question_owner_id, question_user.username as question_owner_username,
        report_stats.answer_id, answer.content as answer_content, answer.question_id as answer_question_id,
        answer.answer_owner_id, answer_user.username as answer_owner_username, 
        report_stats.comment_id, comment.content as comment_content,                                             
        comment.answer_id as comment_answer_id, answer2.question_id as comment_question_id, 
        comment.comment_owner_id, comment_user.username as comment_owner_username,   
        reported_id, "user".username, number_reports')
        ->orderBy('number_reports', 'DESC')->paginate(10);

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

    public function filterReportsByOwner($reports, Request $request){
        return $reports->where('user.username', 'ILIKE', $request->input('search-username') . '%')
                ->orWhere('question_user.username', 'ILIKE', $request->input('search-username') . '%')
                ->orWhere('answer_user.username', 'ILIKE', $request->input('search-username') . '%')
                ->orWhere('comment_user.username', 'ILIKE', $request->input('search-username') . '%');
    }

    public function getReportedQuestions(Request $request){
        // TODO: check state filter and make whereRaw vary depending on it
        $sub = Report::selectRaw('question_id, COUNT(report.id) as number_reports')
            ->whereRaw('viewed = false')
            ->groupBy('question_id');

        $reports = DB::table(DB::raw("({$sub->toSql()}) as report_stats"))
            ->join('question', 'question.id', '=', 'report_stats.question_id')
            ->join('user as question_user', 'question_user.id', '=', 'question.question_owner_id');
        
        // Filter Reports by Question Owner
        if(!is_null($request->input('search-username')) && !empty($request->input('search-username'))){
            $reports = $reports->where('question_user.username', 'ILIKE', $request->input('search-username') . '%');
        }

        return $reports->selectRaw('report_stats.question_id, title, question.content as question_content, number_reports, 
            question.question_owner_id, question_user.username as question_owner_username')
            ->orderBy('number_reports', 'DESC')->paginate(10);
    }

    public function getReportedAnswers(Request $request){
        // TODO: check state filter and make whereRaw vary depending on it
        $sub = Report::selectRaw('answer_id, COUNT(report.id) as number_reports')
        ->whereRaw('viewed = false')
        ->groupBy('answer_id');

        $reports = DB::table(DB::raw("({$sub->toSql()}) as report_stats"))
            ->join('answer', 'answer.id', '=', 'report_stats.answer_id')
            ->join('user as answer_user', 'answer_user.id', '=', 'answer.answer_owner_id');

        // Filter Reports by Answer Owner
        if(!is_null($request->input('search-username')) && !empty($request->input('search-username'))){
            $reports = $reports->where('answer_user.username', 'ILIKE', $request->input('search-username') . '%');
        }

        return $reports->selectRaw('report_stats.answer_id, answer.content as answer_content,
            answer.question_id as answer_question_id, number_reports, answer.answer_owner_id, answer_user.username as answer_owner_username')
            ->orderBy('number_reports', 'DESC')->paginate(10);
    }

    public function getReportedComments(Request $request){
        // TODO: check state filter and make whereRaw vary depending on it
        $sub = Report::selectRaw('comment_id, COUNT(report.id) as number_reports')
        ->whereRaw('viewed = false')
        ->groupBy('comment_id');

        $reports = DB::table(DB::raw("({$sub->toSql()}) as report_stats"))
            ->join('comment', 'comment.id', '=', 'report_stats.comment_id')
            ->join('answer', 'answer.id', '=', 'comment.answer_id')
            ->join('user as comment_user', 'comment_user.id', '=', 'comment.comment_owner_id');

        // Filter Reports by Comment Owner
        if(!is_null($request->input('search-username')) && !empty($request->input('search-username'))){
            $reports = $reports->where('comment_user.username', 'ILIKE', $request->input('search-username') . '%');
        }

        return $reports->selectRaw('report_stats.comment_id, comment.content as comment_content,                                             
            comment.answer_id as comment_answer_id, answer.question_id as comment_question_id, number_reports, comment_owner_id,
            comment.comment_owner_id, comment_user.username as comment_owner_username')
            ->orderBy('number_reports', 'DESC')->paginate(10);
    }

    private function getReportedUsers(Request $request){
        // TODO: check state filter and make whereRaw vary depending on it
        $sub = Report::selectRaw('reported_id, COUNT(report.id) as number_reports')
        ->whereRaw('viewed = false')
        ->groupBy('reported_id');

        $reports = DB::table(DB::raw("({$sub->toSql()}) as report_stats"))
            ->join('user', 'user.id', '=', 'report_stats.reported_id');

        // Filter Reports by Reported User
        if(!is_null($request->input('search-username')) && !empty($request->input('search-username'))){
            $reports = $reports->where('user.username', 'ILIKE', $request->input('search-username') . '%');
        }

        return $reports->selectRaw('reported_id, username, number_reports')
            ->orderBy('number_reports', 'DESC')->paginate(10);
    }

}
