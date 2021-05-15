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

        $sub = Report::selectRaw('reported_id, question_id, answer_id, comment_id, COUNT(report.id) as number_reports')
            ->groupBy('question_id','answer_id','comment_id','reported_id');
        
        $reports = 
            DB::table(DB::raw("({$sub->toSql()}) as report_stats"))
            ->leftJoin('user', 'user.id', '=', 'report_stats.reported_id')
            ->leftJoin('question', 'question.id', '=', 'report_stats.question_id')
            ->leftJoin('answer', 'answer.id', 'report_stats.answer_id')
            ->leftJoin('comment', 'comment.id', 'report_stats.comment_id')
            ->leftJoin('answer as answer2', 'answer2.id', 'comment.answer_id')
            ->selectRaw('report_stats.question_id, title, question.content as question_content, 
            report_stats.answer_id, answer.content as answer_content, answer.question_id as answer_question_id, 
            report_stats.comment_id, comment.content as comment_content,                                             
            comment.answer_id as comment_answer_id, answer2.question_id as comment_question_id,   
            reported_id, username, number_reports')
            ->orderBy('number_reports', 'DESC');

            //dd($reports->get());

        return view('pages.manage-reports', ['reports' => $reports->paginate(10)]);
    }
}