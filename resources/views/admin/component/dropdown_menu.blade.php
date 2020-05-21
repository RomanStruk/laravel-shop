@if (! empty($show))
    <a class="btn btn-primary btn-sm" href="{{ $show }}" title="View">
        <i class="fas fa-eye"></i>
    </a>
@endif
@if (! empty($edit))
    <a class="btn btn-info btn-sm" href="{{$edit}}" title="Edit">
        <i class="fas fa-pencil-alt"></i>
    </a>
@endif
@if (! empty($delete))
    <form method="POST" class="d-inline" action="{{$delete}}">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger btn-sm" value="submit" type="submit" title="Видалити" onclick="return confirm('Видалити?');">
            <i class="fa fa-trash"></i>
        </button>
    </form>
@endif
@if (! empty($forceDelete))
    <form method="POST"
          action="{{$forceDelete}}">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger btn-sm" value="submit" type="submit" onclick="return  confirm('Видалити?');"><i class="fa fa-trash"></i>
            Видалити назавжди
        </button>
    </form>
@endif
