<!-- Table -->
<div class="table-responsive w-100">
    
    @if ($users->isNotEmpty())
        <div class="table-entries">
            Showing {{$users->perpage() * ($users->currentpage()-1)}} 
            to {{$users->perpage() * ($users->currentpage()) - 1 }} 
            of {{$users->total()}} entries
        </div>
    @endif
    <table class="table table-hover align-middle">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col"><i class="fas fa-sort"></i>Username</th>
            <th scope="col"><i class="fas fa-sort big-row"></i>Date</th>
            <th scope="col"><i class="fas fa-sort"></i>Banned</th>
            <th scope="col"><i class="fas fa-sort"></i>Role</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr data-user-id="{{$user->id}}">
                    <th>{{$loop->index + $users->perpage() * ($users->currentpage()-1)}}</th>
                    <td>
                        <!-- TODO: get profile image -->
                        <a href="profile.php">
                            <img class="rounded-circle" src="{{asset('images/profile.png')}}" alt="profile icon">
                            <span>{{$user->username}}</span>
                        </a>
                    </td>
                    <td> {{ date('d-m-Y', strtotime($user->getAttribute('signup_date'))) }}</td>
                    @include('partials.management.users.user-actions', ['id' => $user->id, 'role'=> $user->user_role, 'ban'=> $user->ban])
                </tr>
            @endforeach
        </tbody>
    </table>
    @if ($users->isEmpty())
        <span>No username found</span>
    @endif
</div>

<!-- Get pagination -->
{{ $users->links() }}
