@foreach(\App\Http\Controllers\AttributeController::getDataGroup() as $group_attribute)
    <div class="single-sidebar">
        <div class="group-title">
            <h2> --> {{ $group_attribute->name }} <--</h2>
        </div>
        <ul class="list-group list-group-flush">
        @foreach($group_attribute->allAttributes as $attribute)
                    <li>
                        <div class="custom-control custom-checkbox">
                            <input name="radio_{{$group_attribute->id}}" type="checkbox" class="custom-control-input" id="check{{ $attribute->id }}">
                            <label class="custom-control-label" for="check{{ $attribute->id }}">
                                <a href="{{ route('shop_main', ['filter['.$group_attribute->id.'][]' => $attribute->id , 'category' => URL::getRequest()->cat]) }}">{{ $attribute->value }}</a>
                            </label>
                        </div>

                    </li>
        @endforeach
        </ul>
    </div>
@endforeach
