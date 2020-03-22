
<div class="form-group row">
    <label class="col-sm-2 col-form-label" for="category-name">Категорія</label>
    <div class="col-sm-10">
        <input name="name" id="category-name" value="{{ $category->name ?? '' }}"
               class="form-control">
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label" for="category-slug">Слоган</label>
    <div class="col-sm-10">
        <input name="slug" id="category-slug" value="{{ $category->slug ?? '' }}" class="form-control">
        <small class="text-muted">Вкажіть унікальну назву, або залиште пустим</small>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label" for="category-parent">Батьківська категорія</label>
    <div class="col-sm-10">
        <select id="category-parent" name="parent_id" class="form-control">
            <option value="0">-- без батьківської категорії --</option>
            @include('admin.category._categories')
        </select>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label" for="input-description">Опис</label>
    <div class="col-sm-10">
        <textarea rows="5" name="description" id="input-description" class="form-control">{{ $category->description ?? '' }}</textarea>
    </div>
</div>
<hr>

<button type="submit" class="btn btn-primary">Зберегти</button>
