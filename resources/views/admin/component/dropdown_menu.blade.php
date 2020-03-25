<div class="btn-group">
    @if (! empty($show))
        <a
            href="{{ $show }}"
            data-toggle="tooltip" title="" class="btn btn-primary"
            data-original-title="View">
            <i class="fa fa-eye"></i>
        </a>
    @endif
    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static" >
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <div class="dropdown-menu  dropdown-menu-lg-right">
        @if (! empty($edit))
            <a class="dropdown-item"
               href="{{$edit}}"><i
                    class="fa fa-pencil"></i> Редагувати</a>
        @endif
        @if (! empty($delete))
            <form method="POST"
                  action="{{$delete}}">
                @csrf
                @method('DELETE')
                <button class="dropdown-item" value="submit" type="submit"><i class="fa fa-trash-o"></i>
                    Видалити
                </button>
            </form>
        @endif
        @if (! empty($forceDelete))
            <form method="POST"
                  action="{{$forceDelete}}">
                @csrf
                @method('DELETE')
                <button class="dropdown-item" value="submit" type="submit"><i class="fa fa-trash-o"></i>
                    Видалити назавжди
                </button>
            </form>
        @endif
    </div>
</div>
