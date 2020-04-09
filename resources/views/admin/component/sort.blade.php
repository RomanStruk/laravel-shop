<div class="card">
    <div class="card-body pt-2 pb-2">
        <form action="{{$route}}" method="get" id="sort">
            <div class="row justify-content-between align-items-center">
                <div class="col">
                    @isset($limit)
                        <div class="float-left form-inline">

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-pager"></i></span>
                                </div>

                                <select class="custom-select custom-select-sm" name="limit" title="Відобразики кількість елементів на сторінку">
                                    <option value="">All</option>
                                    <option value="5" @if(session()->get('limit') == 5) selected @endif>5</option>
                                    <option value="10" @if(session()->get('limit') == 10) selected @endif>10</option>
                                    <option value="20" @if(session()->get('limit') == 20) selected @endif>20</option>
                                </select>
                            </div>
                        </div>
                    @endisset
                </div>
                @isset($category)
                    <div class="col-auto">
                        <div class="float-right form-inline">

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-list-alt"></i></span>
                                </div>
                                <select id="category" class="custom-select custom-select-sm" style="width: auto" name="category" title="Select order by Category">
                                    <option value=""
                                            @if(request()->get('category') < 0 or request()->get('category') == null) selected @endif
                                    >Всі категорії</option>
                                    @foreach ($category as $cat)
                                        <option value="{{$cat->id}}"
                                                @if(request()->get('category') === (string)$cat->id) selected @endif
                                        >{{$cat->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                @endisset
                @isset($status)
                    <div class="col-auto">
                        <div class="float-right form-inline">

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-history"></i></span>
                                </div>
                                <select id="status" class="custom-select custom-select-sm" style="width: auto" name="status" title="Статус">
                                    <option value=""
                                            @if(request()->get('status') < 0 or request()->get('status') == null) selected @endif
                                    >Статус</option>
                                    @foreach ($status as $value => $title)
                                        <option value="{{$value}}"
                                                @if(request()->get('status') === (string)$value) selected @endif
                                        >{{$title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                @endisset
                @isset($dateAdded)
                    <div class="col-auto">
                        <div class="float-right form-inline">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i aria-hidden="true" class="fa fa-calendar"></i></span>
                                </div>

                                <input type="date" name="date_added" class="form-control form-control-sm" value="{{request()->get('date_added')}}" placeholder="Date Added" data-date-format="YYYY-MM-DD" id="input-date-added" class="form-control">
                            </div>
                        </div>
                    </div>
                @endisset
                @isset($search)
                    <div class="col-auto">
                        <div class="float-right">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                                <input type="text" name="search" class="form-control form-control-sm" placeholder="Search" value="{{request()->get('search')}}">
                            </div>
                        </div>
                    </div>
                @endisset
                @isset($trashed)
                    <div class="col">
                        <div class="float-right">
                            <div class="custom-control custom-switch">
                                <input name="trashed" type="checkbox" id="customSwitch1"
                                       value="1"
                                       class="custom-control-input"
                                       @if(request()->has('trashed')) checked @endif
                                >
                                <label for="customSwitch1" class="custom-control-label" title="Показати видалені">
                                    Видалені
                                </label>
                            </div>
                        </div>
                    </div>
                @endisset
                <div class="col-auto">
                    <div class="float-right mt-1">
                        <button type="button" class="btn btn-dark btn-sm" onclick="$(':input').val('');">
                            <i aria-hidden="true" class="fa fa-recycle"></i>
                        </button>
                        <button type="submit" class="btn btn-primary btn-sm">Go</button>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
