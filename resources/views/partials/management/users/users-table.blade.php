<!-- Table -->
<div class="table-responsive w-100">
    
    @if (!empty($users))
        <div class="table-entries">
            Showing {{$users->perpage() * ($users->currentpage()-1) + 1}} 
            to {{$users->perpage() * ($users->currentpage()-1) + $users->count()}} 
            of {{$users->total()}} entries
        </div>
    @endif
    <table class="table table-hover align-middle">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Banned</th>
                <th scope="col">Role</th>
                <th scope="col">Date</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr data-user-id="{{$user->id}}">
                    <th>{{$loop->index + 1 + $users->perpage() * ($users->currentpage()-1)}}</th>
                    <td>
                        <a href="/user/{{$user->id}}/profile">
                            <img src="{{ $user->image ? asset('storage/' . $user->image) : asset('images/profile.png')}}" alt="profile picture" class="rounded-circle">
                            <span>{{$user->username}}</span>
                        </a>
                    </td>
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
