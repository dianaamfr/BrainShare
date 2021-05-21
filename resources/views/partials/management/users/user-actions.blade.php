<td class="ban-td">{{$ban == 1 ? 'Banned' : 'Not Banned'}}</td>
<td class="role-td">{{$role == 'RegisteredUser' ? 'Registered User' : $role }}</td>
<td> {{ date('d-m-Y', strtotime($user->getAttribute('signup_date'))) }}</td>
<td>
    @if(Auth::user()->isAdmin() || (Auth::user()->isModerator() && $role == "RegisteredUser"))
        @if (Auth::user()->isAdmin() && Auth::user()->id == $id)
            Sorry, you can't change your own role.
        @else
            <form class="user-actions" data-user-id="{{$id}}">
                @csrf
                <div class="input-group flex-nowrap">
                    <select class="user-action form-select">
                        <option selected disabled value="none">Actions</option>
            
                        @if(Auth::user()->isAdmin() && Auth::user()->id != $id)
                            @if ($role != "Administrator")
                                <option value="admin">Promote to Administrator</option>
                            @else 
                                <option value="moderator">Demote to Moderator</option>
                            @endif
            
                            @if ($role == "RegisteredUser")
                                <option value="moderator">Promote to Moderator</option>
                            @else 
                                <option value="ru">Demote to Registered User</option>
                            @endif

                            @if ($ban == 1) 
                                <option value="unban">Unban</option>
                            @else 
                                <option value="ban">Ban</option>
                            @endif

                        @elseif(Auth::user()->isModerator() && $role == "RegisteredUser")
                            @if ($ban == 1) 
                                <option value="unban">Unban</option>
                            @else 
                                <option value="ban">Ban</option>
                            @endif
            
                        @endif
                    
                    </select>
            
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check"></i>
                    </button>
                </div>
            </form>
        @endif
    @endif
</td>