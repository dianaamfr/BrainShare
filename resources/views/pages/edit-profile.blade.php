@extends('layouts.app')

@section('content')
    <div class="page-margin background-light">
        @php
            if (isset($user->image))
              $image_path = 'storage/'.$user->image;
            else
              $image_path = 'images/profile.png';
        @endphp
        <form method="post" action="{{route('edit-profile')}}" data-toggle="validator" autocomplete="off"
              enctype="multipart/form-data">
            @method('put')
            {{ csrf_field() }}

            <section id="profile-main" class="card grid-profile container-lg">

                <div class="one mr-4">
                    <!-- Nickname and Photo -->
                    <h3 class="nickname mb-4 text-center">{{$user->username}}</h3>
                    <div class="profile-pic col-md mb-4 text-center">
                        <img class="bd-placeholder-img img-thumbnail rounded-circle mb-3" id="register-image"
                             src="{{asset($image_path)}}" alt="profile image">
                    </div>

                    <div class="mb-4">
                        <input type="file" id="register-file" class="form-control-file" name="profile-image">
                        <label for="register-file" class="custom-file-upload btn-link text-center">
                            <i class="fa fa-upload"></i> Profile picture
                        </label>
                        <span id="profile-image-error" class="error">
                        @if ($errors->has('profile-image'))
                                {{ $errors->first('profile-image') }}
                            @endif
                    </span>
                    </div>
                </div>

                <div class="form-edit-profile">
                    <div class="two row">
                        <section class="profile-info col-md mb-4">
                            <h3>Personal</h3>
                            <!-- Name -->
                            <div class="mb-2">
                                <label class="form-label d-block ">Name</label>
                                <div class="input-group mb-0">
                                    <div class="input-group-prepend" title="Name">
                                        <span class="input-group-text"><i class="fas fa-user edit-icon"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="name" value="{{$user->name}}">

                                </div>
                                @if ($errors->has('name'))
                                    <p class="error mt-0">
                                        {{ $errors->first('name') }}
                                    </p>
                                @endif
                            </div>
                            <!-- Email -->
                            <div class="mb-2">
                                <label class="form-label">Email*</label>
                                <div class="input-group mb-0">
                                    <div class="input-group-prepend" title="Email">
                                        <span class="input-group-text"><i class="fas fa-at edit-icon"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="email" value="{{$user->email}}"
                                           required>
                                </div>
                                @if ($errors->has('email'))
                                    <span class="error">
                                        {{ $errors->first('email') }}
                                    </span>
                                @endif
                            </div>

                            <!-- Birthday -->
                            <div class="mb-2">
                                <label class="form-label">Birthday</label>
                                <div class="input-group mb-0">
                                    <div class="input-group-prepend" title="Birthday">
                                    <span class="input-group-text"><i class="fa fa-calendar edit-icon"
                                                                      aria-hidden="true"></i></span>
                                    </div>
                                    <input class="form-control" type="date" name="birthday" value="{{$user->birthday}}">

                                </div>
                                @if ($errors->has('birthday'))
                                    <span class="error">
                                        {{ $errors->first('birthday') }}
                                    </span>
                                @endif
                            </div>

                            <h3 class="mt-4">Change Password</h3>

                            <!-- Password -->
                            <div class="mb-2">
                                <label class="form-label">Password</label>
                                <div class="input-group mb-0">
                                    <div class="input-group-prepend" title="Password">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                                @if ($errors->has('email'))
                                    <span class="error">
                        {{ $errors->first('email') }}
                    </span>
                                @endif
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Password Confirmation</label>
                                <div class="input-group mb-0">
                                    <div class="input-group-prepend" title="Password-Confirmation">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="password" class="form-control" name="password-confirmation" required>
                                </div>
                                @if ($errors->has('email'))
                                    <span class="error">
                                {{ $errors->first('email') }}
                            </span>
                                @endif
                            </div>

                            <div class="mb-2">
                                <label class="form-label">New Password</label>
                                <div class="input-group mb-0">
                                    <div class="input-group-prepend" title="Password-Confirmation">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="password" class="form-control" name="password-confirmation" required>
                                </div>
                                @if ($errors->has('email'))
                                    <span class="error">
                                {{ $errors->first('email') }}
                            </span>
                                @endif
                            </div>


                        </section>
                        <!-- About me -->
                        <section class="profile-about-me col-md mb-4 h-100">
                            <h3>About Me</h3>
                            <div class="mb-3">
                            <textarea class="form-control about-me"
                                      name="description">{{$user->description}}</textarea>
                                <div id="questionBodyHelp" class="form-text">Describe all the details about you!</div>
                            </div>
                            @if ($errors->has('description'))
                                <span class="error">
                                    {{ $errors->first('description') }}
                            </span>
                            @endif
                        </section>

                    </div>
                    <section class="three profile-academic-info">
                        <h3>Academic Information</h3>
                        <!-- Course -->
                        <div class="mb-3">
                            <label for="questionCourseSelect" class="form-label">Course</label>
                            <select id="questionCourseSelect" name="course" class="form-select">
                                <option>None</option>
                                @foreach($courses as $course)
                                    @if(isset($user->course) && $course->name == $user->course->name)
                                        <option selected>{{$course->name}}</option>
                                    @else
                                        <option>{{$course->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @if ($errors->has('course'))
                                <span class="error">
                                        {{ $errors->first('course') }}
                                    </span>
                            @endif
                        </div>

                        <!-- Tags -->
                    @include("partials.add-question.tags")

                    <!-- Toast -->
                        @include("partials.common.toast")

                    </section>

                    <div class="d-md-flex">
                        <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
                        <button type="button" class="btn btn-outline-primary mx-2 mt-3"
                                onclick="window.location='{{URL::route('show-profile', $user->id)}}'">Cancel
                        </button>
                    </div>

                </div>

            </section>
        </form>

        <section id="profile-main" class="card profile-info container-fluid mt-2">

            <h3>Delete account</h3>
            <div class="row">
                <div class="col-lg-5 mt-3">
                    <span>By deleting you account you profile will not be visible anymore.
                    Your questions, answers and comments will still be visible and available at the
                        website, however the author will be identified as anonymous.
                    </span>
                </div>

                <div class="col-lg-7 mt-2">
                    <!-- Password -->
                    <div class="mb-2 w-70">
                        <label class="form-label">Password*</label>
                        <div class="input-group mb-0">
                            <div class="input-group-prepend" title="Password">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        @if ($errors->has('email'))
                            <span class="error">
                        {{ $errors->first('email') }}
                    </span>
                        @endif
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Password Confirmation*</label>
                        <div class="input-group mb-0">
                            <div class="input-group-prepend" title="Password-Confirmation">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" class="form-control" name="password-confirmation" required>
                        </div>
                        @if ($errors->has('email'))
                            <span class="error">
                                {{ $errors->first('email') }}
                            </span>
                        @endif
                    </div>

                    <button type="button" class="btn btn-outline-danger mt-3 ms-md-auto">Delete Account</button>
                </div>
            </div>
        </section>

    </div>

    <script>const max_tags = 2</script>
    <script>const tags = @json($tags);</script>
    <script> const oldTagsList = @json($user->tags); </script>
@endsection
