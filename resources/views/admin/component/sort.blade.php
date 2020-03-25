<div class="row mb-2">
    <div class="col bg-light">
        <form action="{{$route}}" method="get" id="sort">
            <div class="row justify-content-between align-items-center">
                <div class="col">
                    @isset($limit)
                    <div class="float-left form-inline">
                        <label>Відображати по
                            <select class="custom-select custom-select-sm ml-1 mr-1" style="width: auto" name="limit">
                                <option value="-1">All</option>
                                <option value="5" @if(session()->get('limit') == 5) selected @endif>5</option>
                                <option value="10" @if(session()->get('limit') == 10) selected @endif>10</option>
                                <option value="20" @if(session()->get('limit') == 20) selected @endif>20</option>
                            </select> елементів
                        </label>

                    </div>
                    @endisset
                </div>
                @isset($category)
                    <div class="col-auto">
                        <div class="float-right form-inline">
                            <label for="category" class="btn btn-light" title="Select order by Date">
                                <i aria-hidden="true" class="fa fa-list-alt"></i>
                            </label>
                            <select id="category" class="custom-select custom-select-sm ml-1 mr-1" style="width: auto" name="category">
                                <option value="-1"
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
                @endisset
                @isset($status)
                    <div class="col-auto">
                        <div class="float-right form-inline">
                            <label for="status" class="btn btn-light" title="Select order by Date">
                                <i aria-hidden="true" class="fa fa-history"></i>
                            </label>
                            <select id="status" class="custom-select custom-select-sm ml-1 mr-1" style="width: auto" name="status">
                                <option value="-1"
                                        @if(request()->get('status') < 0 or request()->get('status') == null) selected @endif
                                >All</option>
                            @foreach ($status as $value => $title)
                                <option value="{{$value}}"
                                        @if(request()->get('status') === (string)$value) selected @endif
                                >{{$title}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                @endisset
                @isset($dateAdded)
                <div class="col-auto">
                    <div class="float-right form-inline">
                        <label for="input-date-added" class="btn btn-light" title="Select order by Date">
                            <i aria-hidden="true" class="fa fa-calendar"></i>
                        </label>
                        <input type="date" name="date_added" value="{{request()->get('date_added')}}" placeholder="Date Added" data-date-format="YYYY-MM-DD" id="input-date-added" class="form-control">
                    </div>
                </div>
                @endisset
                @isset($search)
                <div class="col-auto">
                    <div class="float-right">
                        <label for="search">
                            <i aria-hidden="true" class="fa fa-search"></i>
                        </label>
                        <input type="text" name="search" id="search" value="{{request()->get('search')}}">
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
                                        Показати видалені
                                    </label>
                                </div>
                        </div>
                    </div>
                @endisset
                <div class="col-auto">
                    <div class="float-right mt-1">
                        <button type="button" class="btn btn-primary" onclick="$(':input').val('');">
                            <i aria-hidden="true" class="fa fa-recycle"></i>
                        </button>
                        <button type="submit" class="btn btn-danger">Go</button>
                    </div>
                </div>
            </div>

        </form>
    </div>

</div>
