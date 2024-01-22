<td>
    <form action="{{ route('misUsersManagementResource.destroy', $user->user_id) }}" role="alert" method="post"
        alert-title="Delete Campus" alert-text="Do you really want to delete this record?" alert-btn-cancel="Cancel"
        alert-btn-yes="Yes">
        <div class="text-center">
            @csrf
            @method('DELETE')
            <a class="btn btn-warning" href="/edit/users/{{ $user->user_id }}">
                <i class="fa-solid fa-pen-to-square"></i> </a>
            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i> </button>
        </div>
    </form>
</td>
