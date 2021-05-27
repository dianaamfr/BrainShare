<section id="profile-main" class="card grid-profile container-lg">
    <div class="one text-center mb-5">
        <h3 class="nickname mb-4">{{ $user->username }}</h3>
        <div class="profile-pic col-md mb-4">
            <img class="rounded-circle img-thumbnail"
                    src="{{ $user->image ? asset('storage/' . $user->image) : asset('images/profile.png')}}"
                    alt="Profile Image">
        </div>
        <p><span class="score">User Score:</span> <span class="points">{{ $user->score }}</span></p>
    </div>
    <div class="two row">
        <section class="profile-info col-md mb-4">
            <h3>Personal</h3>
            <p id="profile-id" hidden>{{ $user->id }}</p>
            <p><span class="profile-small-title"><i class="fas fa-user"></i> Name:</span> {{ $user->name }}</p>
            <p><span class="profile-small-title"><i class="fas fa-at"></i> E-mail:</span> {{ $user->email }}</p>
            <p><span class="profile-small-title"><i class="fa fa-calendar"
                                                    aria-hidden="true"></i> Birthday:</span> {{ $user->birthday }}
            </p>
        </section>

        <section class="profile-about-me col-md mb-4">
            <h3>About Me</h3>
            <p> {{ $user->description }}</p>
        </section>
    </div>
    <section class="three profile-academic-info">
        <div class="row">
            <div class="col-md mb-4">
                <h3>Academic Information</h3>
                <p><span class="profile-small-title"><i
                            class="fas fa-graduation-cap"></i> Course:</span> {{ $user->course ? $user->course->name : ''}}
                </p>
                <div>
                    <p><span class="profile-small-title"><i class="fas fa-tags"></i>Tags:</span>
                        @foreach ($user->tags as $tag)
                            <span class="category tag badge bg-secondary">
                                <i class="fas fa-hashtag"></i>
                                {{$tag->name}}
                            </span>
                        @endforeach
                    </p>
                </div>
            </div>

            @if (Auth::id() == $user->id)
                <div class="col-md d-flex justify-content-end align-items-end">
                    <a class="btn btn-primary my-2" href="{{route('show-edit-profile', $user->id)}}">Edit
                        Profile</a>
                </div>
            @else
                <div>
                    @include('partials.common.report', ['type'=> 'reported', 'margin' => '', 'id'=>$user->id])
                </div>
            @endif
        </div>
    </section>
</section>