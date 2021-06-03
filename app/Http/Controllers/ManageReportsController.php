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
        
        $this->authorize('show', Report::class);

        $reports = $this->getReports($request);
        return view('pages.manage-reports', ['reports' => $reports]);
    }   
    
    public function search(Request $request) {

        $this->authorize('show', Report::class);

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
        // Filter based on Admin/Moderator permissions
        else if (Auth::user()->isAdmin()) {
            $reports = $this->excludeOwnReports($reports, $request);
        } else {
            $reports = $this->registeredUserReports($reports, $request);
        }

        return $reports->orderBy('report.id', 'DESC')->paginate(10);

    }

    public function discard(Request $request) {
        
        $report = Report::find($request->input('id'));
        $this->authorize('update', $report);

        $report->update(['viewed' => true]);

        $reports = $this->getReports($request);

        return response()->json([
            'success'=> 'The report was successfully discarded and marked as "handled".',
            'html' => view('partials.management.reports.reports-table', ['reports' => $reports])->render()
        ]);
    }

    public function undiscard(Request $request) {
        
        $report = Report::find($request->input('id'));
        $this->authorize('update', $report);

        $report->update(['viewed' => false]);

        $reports = $this->getReports($request);

        return response()->json([
            'success'=> 'The report was successfully marked as "pending".',
            'html' => view('partials.management.reports.reports-table', ['reports' => $reports])->render()
        ]);
    }


    public function delete(Request $request){

        $report = Report::find($request->input('id'));
        $this->authorize('update', $report);

        // Delete Reported Content
        if(!is_null($report->question_id)){
            $type = 'Question';
            Question::find($report->question_id)->update(['deleted' => true]);
        }
        else if(!is_null($report->answer_id)){
            $type = 'Answer';
            Answer::find($report->answer_id)->update(['deleted' => true]);
        }
        else if(!is_null($report->comment_id)){
            $type = 'Comment';
            Comment::find($report->comment_id)->update(['deleted' => true]);
        }
        else{
            $type = 'User';
            $user = User::find($report->reported_id);
            $user->update(['ban' => true]);
        }

        // Now the trigger will discard all reports associated with the deleted content

        $reports = $this->getReports($request);

        return response()->json([
            'success'=> 'The ' . $type . '<strong>' . (isset($user) ? ' ' . $user->username : '') . '</strong> was successfully ' . (isset($user) ? 'banned' : 'deleted'). '.' ,
            'html' => view('partials.management.reports.reports-table', ['reports' => $reports])->render()
        ]);
    }

    public function revert(Request $request){

        $report = Report::find($request->input('id'));
        $this->authorize('update', $report);

        // Recover Deleted Content
        if(!is_null($report->question_id)){
            $type = "Question";
            Question::find($report->question_id)->update(['deleted' => false]);
        }
        else if(!is_null($report->answer_id)){
            $type = "Answer";
            Answer::find($report->answer_id)->update(['deleted' => false]);
        }
        else if(!is_null($report->comment_id)){
            $type = "Comment";
            Comment::find($report->comment_id)->update(['deleted' => false]);
        }
        else{
            $type = "User";
            $user = User::find($report->reported_id);
            $user->update(['ban' => false]);
        }

        $reports = $this->getReports($request);

        return response()->json([
            'success'=> 'The ' . $type . '<strong>' . (isset($user) ? ' ' . $user->username : '') . '</strong> was successfully ' . (isset($user)  ? 'banned' : 'deleted'). '.' ,
            'html' => view('partials.management.reports.reports-table', ['reports' => $reports])->render()
        ]);
    }

    private function excludeOwnReports($reports){
        return $reports->where(function($query){
                $query->whereHas('reported', function($query) {
                    $query->where('reported_id', '!=', Auth::user()->id);
                })
                ->orWhereHas('question', function ($query){
                    $query->where('question_owner_id', '!=', Auth::user()->id);
                })
                ->orWhereHas('answer', function ($query){
                    $query->where('answer_owner_id', '!=', Auth::user()->id);
                })
                ->orWhereHas('comment', function ($query){
                    $query->where('comment_owner_id', '!=', Auth::user()->id);
                }); 
            });
        
    }

    private function registeredUserReports($reports){
        return $reports->where(function($query){
            $query->whereHas('reported', function ($query){
                $query->where('user_role', '=', 'RegisteredUser');
            })
            ->orWhereHas('question', function ($query){
                $query->whereHas('owner', function ($query){
                    $query->where('user_role', '=', 'RegisteredUser');
                });
            })
            ->orWhereHas('answer', function ($query){
                $query->whereHas('owner', function ($query){
                    $query->where('user_role', '=', 'RegisteredUser');
                });
            })
            ->orWhereHas('comment', function ($query) {
                $query->whereHas('owner', function ($query){
                    $query->where('user_role', '=', 'RegisteredUser');
                });
            }); 
        }); 
    }

    private function filterReportsByOwner($reports, Request $request){
            
        return $reports->where(function($query) use ($request){
            $query->whereHas('reported', function ($query) use ($request){
                $query->where('id', '!=', Auth::user()->id)
                ->where('username', 'ILIKE', $request->input('search-username') . '%');

                if(Auth::user()->isModerator())
                    $query = $query->where('user_role', '=', 'RegisteredUser');
                
            })
            ->orWhereHas('question', function ($query) use ($request){
                $query->where('question_owner_id', '!=', Auth::user()->id)
                ->whereHas('owner', function ($query) use ($request){
                    $query->where('username', 'ILIKE', $request->input('search-username') . '%');

                    if(Auth::user()->isModerator())
                        $query = $query->where('user_role', '=', 'RegisteredUser');
                });
            })
            ->orWhereHas('answer', function ($query) use ($request){
                $query->where('answer_owner_id', '!=', Auth::user()->id)
                ->whereHas('owner', function ($query) use ($request){
                    $query->where('username', 'ILIKE', $request->input('search-username') . '%');

                    if(Auth::user()->isModerator())
                        $query = $query->where('user_role', '=', 'RegisteredUser');
                });
            })
            ->orWhereHas('comment', function ($query) use ($request){
                $query->where('comment_owner_id', '!=', Auth::user()->id)
                ->whereHas('owner', function ($query) use ($request){
                    $query->where('username', 'ILIKE', $request->input('search-username') . '%');

                    if(Auth::user()->isModerator())
                        $query = $query->where('user_role', '=', 'RegisteredUser');
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
