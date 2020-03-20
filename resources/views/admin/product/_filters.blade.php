<form method="GET" action="{{route('admin.product.index')}}">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-filter"></i> Filter</h3>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label class="control-label" for="input-product-id">Product ID</label>
                <input type="text" name="id" value="{{request('id')}}" placeholder="Order ID"
                       id="input-product-id"
                       class="form-control">
            </div>
            <div class="form-group">
                <label class="control-label" for="input-product-category">Order Category</label>
                <select id="input-product-category" name="category" class="form-control">
                    <option value="">-- Категорія не вибрана --</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}"
                                @if (request('category') == $category->id) selected @endif
                        >{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="control-label" for="input-product-status">Order Status</label>
                <select name="status" id="input-product-status" class="form-control">
                    <option value="" @empty(request('status')) selected @endempty>Всі</option>
                    <option value="0" @if (request('status') == '0') selected @endif>Скриті</option>
                    <option value="1" @if (request('status') == '1') selected @endif>Активні</option>
                </select>
            </div>
            <div class="form-group">
                <label class="control-label" for="input-date-added">Date Added</label>
                <div class="input-group date">
                    <input type="date" name="added" value="{{request('added')}}" placeholder="Date Added"
                           data-date-format="YYYY-MM-DD" id="input-date-added" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label" for="input-date-modified">Date Modified</label>
                <div class="input-group date">
                    <input type="date" name="modified" value="{{request('modified')}}"
                           placeholder="Date Modified"
                           data-date-format="YYYY-MM-DD" id="input-date-modified" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="custom-control custom-switch">
                    <input name="trashed" type="checkbox" id="customSwitch1"
                           value="1"
                           class="custom-control-input">
                    <label for="customSwitch1" class="custom-control-label">Показати видалені</label>
                </div>
            </div>
            <div class="form-group text-right">
                <button type="submit" id="button-filter" class="btn btn-default"><i
                        class="fa fa-filter"></i>
                    Filter
                </button>
            </div>
        </div>
    </div>
</form>
