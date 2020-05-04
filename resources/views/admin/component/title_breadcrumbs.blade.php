<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-auto">
                <h1 class="m-0 text-dark">{{$title}}</h1>
            </div><!-- /.col -->
            <div class="col">
                @if (! empty($actions))
                    <div class="row">
                        @isset($actions['create'])
                            <div class="col-auto p-1">
                                <a href="{{$actions['create']}}" title="Створити" class="btn btn-primary">
                                    <i class="icon fas fa-plus" aria-hidden="true"></i>
                                </a>
                            </div>
                        @endisset
                        @isset($actions['edit'])
                            <div class="col-auto p-1">
                                <a href="{{$actions['edit']}}" title="Редагувати" class="btn btn-primary">
                                    <i class="fa fas fa-edit"></i>
                                </a>
                            </div>
                        @endisset

                            @isset($actions['print'])
                                <div class="col-auto p-1">
                                    <a class="btn btn-info" href="{{$actions['print']}}" title="Print">
                                        <i class="fa fas fa-print"></i>
                                    </a>
                                </div>
                            @endisset
                        @isset($actions['delete'])
                            <div class="col-auto p-1">
                                <form method="POST" action="{{$actions['delete']}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" value="submit" type="submit" title="Delete">
                                        <i class="fa fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        @endisset
                    </div>
                @endif
            </div>
            <div class="col">
                @if (! empty($breadcrumbs))
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard.index') }}">Home</a>
                        </li>
                        @foreach ($breadcrumbs as $label => $link)
                            @if (is_int($label) && ! is_int($link))
                                <li class="breadcrumb-item active" aria-current="page">{{ $link }}</li>
                            @else
                                <li class="breadcrumb-item"><a href="{{ $link }}">{{ $label }}</a></li>
                            @endif
                        @endforeach
                    </ol>
                @endif
            </div>
        </div>
    </div>
</div>
