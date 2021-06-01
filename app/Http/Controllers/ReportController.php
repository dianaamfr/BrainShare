<?php


namespace App\Http\Controllers;


use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ReportController
{

    /**
     * Checks if the person has already reported  a question.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */


    function reportQuestion(Request $request, $questionId)
    {
        $validReport = $this->validateReport("question", $questionId, $request);
        if ($validReport != null) return $validReport;

        $reportQuestion = new Report([
            'content' => $request->get('content'),
            'question_id' => $questionId,
            'user_id' => Auth::user()->id,
            'date' => Carbon::now(),
        ]);
        $reportQuestion->save();

        return response()->json(array('success' => true));
    }

    function reportAnswer(Request $request, $answerId)
    {

        $validReport = $this->validateReport("answer", $answerId, $request);
        if ($validReport != null) return $validReport;

        $reportAnswer = new Report([
            'content' => $request->get('content'),
            'answer_id' => $answerId,
            'user_id' => Auth::user()->id,
            'date' => Carbon::now(),
        ]);
        $reportAnswer->save();

        return response()->json(array('success' => true));
    }

    function reportComment(Request $request, $commentId)
    {

        $validReport = $this->validateReport("comment", $commentId, $request);
        if ($validReport != null) return $validReport;

        $reportComment= new Report([
            'content' => $request->get('content'),
            'comment_id' => $commentId,
            'user_id' => Auth::user()->id,
            'date' => Carbon::now(),
        ]);
        $reportComment->save();

        return response()->json(array('success' => true));

    }

    function reportUser(Request $request, $userId){
        $validReport = $this->validateReport("reported", $userId, $request);
        if ($validReport != null) return $validReport;

        $reportQuestion = new Report([
            'content' => $request->get('content'),
            'reported_id' => $userId,
            'user_id' => Auth::user()->id,
            'date' => Carbon::now(),
        ]);
        $reportQuestion->save();

        return response()->json(array('success' => true));
    }

    function validateReport($type, $id, $request){

        if (!Auth::check())
            return response()->json(array('success' => false, 'error' => 'Must be logged to report'));

        $rules = [
            'content' => 'string|min:100|max:500|required'
        ];

        $alreadyReported = DB::table('report')
            ->where($type.'_id', $id)
            ->where('user_id', Auth::user()->id)->get();

        if (sizeof($alreadyReported) >= 1)
            return response()->json(array('success' => false, 'error' => 'This question has already been reported'));


        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(array('success' => false, 'error' => 'The text is required and min:100 and max:500'));
        }
        return null;
    }

    function isReported(Request $request)
    {
        $alreadyReported = DB::table('report')
            ->where($request->reportType.'_id', $request->id)
            ->where('user_id', Auth::user()->id)->get();

        if (sizeof($alreadyReported) >= 1)
            return response()->json(array('isReported' => true));

        return response()->json(array('isReported' => false));
    }


}
