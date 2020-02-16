<div class="single-sidebar">
    <div class="group-title">
        <h2>категорії</h2>
    </div>
    <ul>
        @foreach(\App\Http\Controllers\CategoriesController::getDataCategories() as $category)
        <li><a href="{{url('/shop/category/'. $category['slug'])}}">{{$category['name']}} ({{$category['count_products']}})</a></li>
        @endforeach
    </ul>
</div>
