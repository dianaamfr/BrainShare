<?php


namespace App\Http\Controllers;


use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController
{
    function reportQuestion(Request $request, $id){
        $reportQuestion = new Report([
            'content' => $request->get('content'),
            'question_id' => $id,
            'user_id' => Auth::user()->id,
            'date' => Carbon::now(),
        ]);
        $reportQuestion->save();
        return response()->json(array('success' => true, 'id' => $id, 'content'=>$request->get('content')));
    }

    function reportAnswer(Request $request, $id){

    }

    function reportComment(Request $request, $id){

    }
}
