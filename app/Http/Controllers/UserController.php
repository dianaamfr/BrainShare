<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Tag;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    
    public function showProfile($id){
  
      if (!Auth::check()) return redirect('/login');

      $user = User::find($id);
      $this->authorize('show', $user);
      
      $questions = $user->questions()->simplePaginate(3);
      $answers = $user->answers()->simplePaginate(3);
      
      return view('/pages.profile', ['user' => $user, 'questions' => $questions, 'answers' => $answers]);
    }


    public function showEditProfile($id)
    {
        if (!Auth::check()) return redirect('/login');
        $user = User::find($id);
        $this->authorize('showEditUserProfile', $user);

        $courses = Course::all();
        $tags = Tag::all();

        $this->authorize('editUserProfile', $user);

        return view('/pages.edit-profile', ['id'=> $user->id, 'user' => $user, 'courses' => $courses, 'tags' => $tags]);

    }

    public function editProfile(Request $request, $id)
    {
        if (!Auth::check()) return redirect('/login');

        // TODO : erro de commit. Auth.
        $user = User::find($id);
        $this->authorize('editUserProfile', $user);

        $request->validate([
            'name' => 'sometimes|nullable|string|max:255',
            'tagList' => 'max:2',
            'tagList.*' => 'sometimes|distinct|max:100|string',
                'birthday' => 'sometimes|nullable|date|before:today',
            'email' => [
                'required',
                'string',
                'max:255',
                'email',
                Rule::unique('user')->ignore($user->id),
            ],
            'profile-image' => 'sometimes|nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'sometimes|nullable|string|max:1000'
        ]);

        // Check if it's to also change the password.
        if ($request->get('current_password') != null || $request->get('current_password') != null) {
            $request->validate([
                'current_password' => ['required', function ($attribute, $value, $fail) {
                    if (!Hash::check($value, Auth::user()->password))
                        return $fail(__('The current password does not match the original.'));
                }],
                'new_password' => 'required|string|min:6|different:current_password',
                'new_password_confirm' => 'required|same:new_password'
            ]);
        }

        $result = DB::transaction(function () use ($request) {
            $id = Auth::id();       // TODO: aldready have the id.
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

            if ($request->get('current_password')) {
                $user->password = Hash::make($request->get('new_password'));
            }

            $course = $request->course;
            if ($course != null && $course != "None") {
                $courseId = DB::table('course')->where('name', $course)->first()->id;
                $user->course()->associate($courseId);
            }

            if ($request->hasFile('profile-image')) {

                if (request()->file('profile-image')->isValid()) {
                    $fileName = "profile" . strval($user->id) . "." . $request['profile-image']->getClientOriginalExtension();
                    $path = request()->file('profile-image')->storePubliclyAs('profiles', $fileName, 'public');
                    $user->image = $path;
                } else {
                    throw ValidationException::withMessages(['profile-image' => ['Invalid image.']]);
                }
            }

            $user->save();
            return $user;
        });


        return redirect()->route('show-profile', ['id' => $id]);
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

    public function deleteUserOnProfile(Request $request, $toDeleteId)
    {

        $deleted = User::find($toDeleteId);
        $this->authorize('delete', $deleted);

        // Check if it's to also change the password.
        $request->validate([
            'password' => ['required', 'string', function($attribute, $value, $fail){
                if (!Hash::check($value, Auth::user()->password)){
                    return $fail(__("The password given doest not match the original."));
                }
            }],
            'password_confirmation' => 'required|string|same:password',
        ]);

        $deleted->delete();
        return redirect()->route('home');

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
