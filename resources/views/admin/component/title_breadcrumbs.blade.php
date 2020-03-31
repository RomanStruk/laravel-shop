<div class="row">
    <div class="col-auto">
        <h2>{{$title}}</i></h2>
    </div>
    <div class="col">
        @if (! empty($actions))
            <div class="row">
                @isset($actions['create'])
                    <div class="col-auto p-1">
                        <a href="{{$actions['create']}}" title="Створити" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i></a>
                    </div>
                @endisset
                @isset($actions['edit'])
                <div class="col-auto p-1">
                    <a href="{{$actions['edit']}}" title="Редагувати" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                </div>
                @endisset

                @isset($actions['delete'])
                <div class="col-auto p-1">
                    <form method="POST" action="{{$actions['delete']}}" >
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" value="submit" type="submit" title="Delete"><i class="fa fa-trash-o"></i></button>
                    </form>
                </div>
            @endisset
            </div>
        @endif
    </div>
    <div class="col">
        <div class="float-right">
        @if (! empty($breadcrumbs))
            <nav aria-label="breadcrumb">

                <ol class="breadcrumb bg-light">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard.index') }}">Home</a>
                    </li>
                    @foreach ($breadcrumbs as $label => $link)
                        @if (is_int($label) && ! is_int($link))
                            <li class="breadcrumb-item active" aria-current="page">{{ $link }}</li>
                        @else
                            <li class="breadcrumb-item"><a href="{{ $link }}" >{{ $label }}</a></li>
                        @endif
                    @endforeach
                </ol>
            </nav>
        @endif
        </div>
    </div>
</div>
