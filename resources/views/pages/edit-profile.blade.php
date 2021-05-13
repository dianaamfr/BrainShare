@extends('layouts.app')

@section('content')
    <div class="page-margin background-light">
        <section id="profile-main" class="card grid-profile container-lg">
            <div class="one mr-4">
                <!-- Nickname and Photo -->
                <h3 class="nickname mb-4 text-center">{{$user->username}}</h3>
                <div class="profile-pic col-md mb-4 text-center">
                    <img class="rounded-circle img-thumbnail" src="{{asset('images/profile.png')}}" alt="Profile Image">
                </div>
            </div>
            <div class="form-edit-profile">
                <form method="post" action="{{route('edit-profile')}}" class="text-start" data-toggle="validator" autocomplete="off">
                    @method('put')
                    @csrf

                    <div class="two row">
                        <section class="profile-info col-md mb-4">
                            <h3>Personal</h3>
                            <!-- Name -->
                            <label class="form-label d-block ">Name</label>
                            <div class="input-group">
                                <div class="input-group-prepend" title="Name">
                                    <span class="input-group-text"><i class="fas fa-user edit-icon"></i></span>
                                </div>
                                <input type="text" class="form-control" name="name" value="{{$user->name}}">
                            </div>
                            <!-- Email -->
                            <label class="form-label">Email*</label>
                            <div class="input-group">
                                <div class="input-group-prepend" title="Email">
                                    <span class="input-group-text"><i class="fas fa-at edit-icon"></i></span>
                                </div>
                                <input type="text" class="form-control" name="email" value="{{$user->email}}" required>
                            </div>

                            <!-- Birthday -->
                            <label class="form-label">Birthday</label>
                            <div class="input-group">
                                <div class="input-group-prepend" title="Birthday">
                                    <span class="input-group-text"><i class="fa fa-calendar edit-icon"
                                                                      aria-hidden="true"></i></span>
                                </div>
                                <input class="form-control" type="date" name="birthday" value="{{$user->birthday}}">
                            </div>
                        </section>

                        <!-- About me -->
                        <section class="profile-about-me col-md mb-4">
                            <h3>About Me</h3>
                            <div class="mb-3">
                                <textarea class="form-control about-me" name="description">{{$user->description}}</textarea>
                                <div id="questionBodyHelp" class="form-text">Describe all the details about you!</div>
                            </div>
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
                                    @if($course->name == $user->course->name)
                                        <option selected>{{$course->name}}</option>
                                    @else
                                        <option>{{$course->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <!-- Tags -->
                        @include("partials.add-question.tags")

                        <!-- Toast -->
                        @include("partials.common.toast")

                    </section>

                    <div class="d-md-flex">
                        <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
                        <button type="submit" class="btn btn-outline-primary mx-2 mt-3">Cancel</button>
                        <button type="submit" class="btn btn-outline-danger mt-3 ms-md-auto">Delete Account</button>
                    </div>
                </form>

            </div>
        </section>
    </div>

<script>const tags = @json($tags);</script>
<script> const oldTagsList = @json($user->tags); </script>
@endsection
