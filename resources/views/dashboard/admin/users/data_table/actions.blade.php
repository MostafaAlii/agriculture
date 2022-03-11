
    <a href="{{ route('users.edit', $id) }}" class="btn btn-success btn-sm">
        <i class="fa fa-edit"></i>
        {{ __('Admin/site.edit') }}
    </a>



    <form action="{{ route('users.destroy', $id) }}" class="my-1 my-xl-0" method="post" style="display: inline-block;">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-danger btn-sm " onclick="confirm('{{ __('Admin/site.Warning') }}') ? this.parentElement.submit() : ''">
            <i class="fa fa-trash"></i>
            {{ __('Admin/site.delete') }}
        </button>
    </form>

