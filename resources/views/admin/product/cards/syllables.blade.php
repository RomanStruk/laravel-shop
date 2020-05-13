<div class="card">
    <div class="card-header">
        <h3 class="card-title">Склад</h3>
    </div>
    <div class="card-body">
        @isset($product)
            <p><b>Кількість товарів на складі: </b>{{$product->quality()}}</p>
            <ul>
                @forelse($product->syllable as $syllable)
                    <li>
                        <a class="" href="{{route('admin.supplier.show', $syllable->supplier)}}">
                            {{$syllable->supplier->name}}
                        </a>
                        <span class="badge badge-primary">{{$syllable->imported}}</span>
                        <span class="badge badge-success">{{$syllable->remains}}</span>
                        <span class="badge badge-info">{{$syllable->processed}}</span>
                    </li>
                @empty
                    <li>Нема даних</li>
                @endforelse
            </ul>
        @endisset
            <div class="form-group">
                <label class="col-form-label">Поставка товару</label>
                <div class="form-row">
                    <div class="col-8">
                        <select name="supplier" id="supplier" class="form-control">
                            <option value="">-- Не вибрано --</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{$supplier->id}}"
                                    @if($supplier->id == old('supplier')) selected @endif
                                >{{$supplier->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">шт.</div>
                            </div>
                            <input name="imported" type="number" class="form-control" id="imported" value="{{old('imported')}}">
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
