
    <a href="{{ route('farmers.edit', $id) }}" class="btn btn-success btn-sm">
        <i class="fa fa-edit"></i>
        {{ __('user.edit') }}
    </a>



    <form action="{{ route('farmers.destroy', $id) }}" class="my-1 my-xl-0" method="post" style="display: inline-block;">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-danger btn-sm " onclick="confirm('{{ __('site.Warning') }}') ? this.parentElement.submit() : ''">
            <i class="fa fa-trash"></i>
            {{ __('user.delete') }}
        </button>
    </form>

