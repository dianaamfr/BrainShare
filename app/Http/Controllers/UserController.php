<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Tag;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{

    public function showProfile($id)
    {

        if (!Auth::check()) return redirect('/login');
        $user = User::find($id);
        $questions = $user->questions()->simplePaginate(3);
        $answers = $user->answers()->simplePaginate(3);

        return view('/pages.profile', ['user' => $user, 'questions' => $questions, 'answers' => $answers]);
    }

    public function showEditProfile()
    {
        if (!Auth::check()) return redirect('/login');

        $id = Auth::id();
        $user = User::find($id);
        $courses = Course::all();
        $tags = Tag::all();

        $this->authorize('editUserProfile', $user);

        return view('/pages.edit-profile', ['user' => $user, 'courses' => $courses, 'tags' => $tags]);

    }

    public function editProfile(Request $request)
    {
        if (!Auth::check()) return redirect('/login');

        //TODO: make the validation.

        $id = Auth::id();
        $user = User::find($id);


        $this->authorize('editUserProfile', $user);
        $result = DB::transaction(function () use ($request) {
            $id = Auth::id();
            $user = User::find($id);
            if (isset($request->name) && !is_null($request->name))
                $user->name = $request->name;
            if (isset($request->email) && !is_null($request->email))
                $user->email = $request->email;
            if (isset($request->birthday) && !is_null($request->birthday))
                $user->birthday = DateTime::createFromFormat('Y-m-d', $request->get('birthday'))->format('Y-m-d');
            if (isset($request->description) && !is_null($request->description))
                $user->description = $request->description;

            $tags = $request->get('tagList');
            if ($tags != null) {
                $user->tags()->detach();
                foreach ($tags as $tag) {
                    $user->tags()->attach($tag);
                }
            }

            $course = $request->course;
            if ($course != null && $course != "None") {
                $courseId = DB::table('course')->where('name', $course)->first()->id;
                $user->course()->associate($courseId);
            }

            if($request->hasFile('profile-image')){

                if (request()->file('profile-image')->isValid()) {
                    $fileName = "profile" . strval($user->id) . "." . $request['profile-image']->getClientOriginalExtension();
                    $path = request()->file('profile-image')->storePubliclyAs('profiles', $fileName, 'public');
                    $user->image = $path;
                }
                else{
                    throw ValidationException::withMessages(['profile-image' => ['Invalid image.']]);
                }
            }

            $user->save();
            return $user;
        });


        return redirect()->route('show-profile', ['id' => $user->id]);
    }

    public function paginateQuestions(Request $request, $id)
    {

        $user = User::find($id);
        $questions = $user->questions();

        if ($request->input('profile-search')) {
            $stripSearch = htmlentities(trim(str_replace(['\'', '"'], "", $request->input('profile-search'))));

            if ($stripSearch != '') {
                $search = str_replace(' ', ' | ', $stripSearch);
                $questions = $questions->whereRaw("search @@ to_tsquery('simple',?)", [$search])
                    ->orderByRaw("ts_rank(search,to_tsquery('simple',?)) DESC", [$search]);
            }
        }

        $response = view('partials.profile.question', ['questions' => $questions->simplePaginate(3)])->render();
        return response()->json(array('success' => true, 'html' => $response));
    }

    public function paginateAnswers(Request $request, $id)
    {
        $user = User::find($id);
        $answers = $user->answers();

        if ($request->input('profile-search')) {
            $stripSearch = htmlentities(trim(str_replace(['\'', '"'], "", $request->input('profile-search'))));

            if ($stripSearch != '') {
                $search = str_replace(' ', ' | ', $stripSearch);
                $answers = $answers->whereRaw("search @@ to_tsquery('simple',?)", [$search])
                    ->orderByRaw("ts_rank(search,to_tsquery('simple',?)) DESC", [$search]);
            }
        }

        $response = view('partials.profile.answer', ['answers' => $answers->simplePaginate(3)])->render();
        return response()->json(array('success' => true, 'html' => $response));
    }

    public function deleteUser($id)
    {

        $user = User::find($id);

        // if you are not the user, you cannot delete your profile
        if (Auth::user()->id != $id) return redirect('/user/{' . $id . '}');

        $user->delete();

        return view('/home');
    }

}
