@extends('layouts.app')

@section('content')
<div class="page-margin background-light">
    <section id="profile-main" class="card grid-profile container-lg">
        <div class="one">
            <!-- Nickname and Photo -->
            <h3 class="nickname mb-4">joaquina123</h3>
            <div class="profile-pic col-md mb-4">
                <img class="rounded-circle img-thumbnail" src="{{asset('images/profile.png')}}" alt="Profile Image">
            </div>
        </div>
        <div class="form-edit-profile">
            <form>
                <div class="two row">
                    <section class="profile-info col-md mb-4">
                        <h3>Personal</h3>
                        <!-- Name -->
                        <label class="form-label d-block ">Name</label>
                        <div class="input-group">
                            <div class="input-group-prepend" title="Name">
                                <span class="input-group-text"><i class="fas fa-user edit-icon"></i></span>
                            </div>
                            <input type="text" class="form-control" value="Maria Joaquina">
                        </div>
                        <!-- Email -->
                        <label class="form-label">Email*</label>
                        <div class="input-group">
                            <div class="input-group-prepend" title="Email">
                                <span class="input-group-text"><i class="fas fa-at edit-icon"></i></span>
                            </div>
                            <input type="text" class="form-control" value="up201806230@fe.up.pt" required>
                        </div>

                        <!-- Birthday -->
                        <label class="form-label">Birthday</label>
                        <div class="input-group">
                            <div class="input-group-prepend" title="Birthday">
                                <span class="input-group-text"><i class="fa fa-calendar edit-icon" aria-hidden="true"></i></span>
                            </div>
                            <input class="form-control" type="date" value="2011-08-19">
                        </div>
                    </section>

                <!-- About me -->
                <section class="profile-about-me col-md mb-4">
                    <h3>About Me</h3>
                        <div class="mb-3">
                            <textarea class="form-control about-me">Hello! It's Joaquina! I'm currently studying Informatic Engineering (MIEIC) at FEUP. My dream is to work at google and become a great software engineer. I love dogs and cats, I hope I love you too.</textarea>
                            <div id="questionBodyHelp" class="form-text">Describe all the details about you!</div>
                        </div>
                    </section>

                </div>
                <section class="three profile-academic-info">
                    <h3>Academic Information</h3>
                    <!-- Course -->
                    <div class="mb-3">
                        <label for="questionCourseSelect" class="form-label">Course</label>
                        <select id="questionCourseSelect" class="form-select">
                            <option selected>No Course</option>
                        </select>
                    </div>

                    <!-- Tags -->
                    <div class="mb-3">
                        <label class="form-label">Tags</label>
                        <input type="text" class="form-control" placeholder="Associate Tags here">
                    </div>
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
@endsection
