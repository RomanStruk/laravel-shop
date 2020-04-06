<template>
    <div class="main-shop-page pb-60">
        <div class="container">
            <!-- Row End -->
            <div class="row">
                <!-- Sidebar Shopping Option Start -->
                <div class="col-lg-3  order-2">
                    <div class="sidebar white-bg">

                        <!-- Categories Start -->
                        <category-component
                            @event-choose-category="processEventChooseCategory"
                        />
                        <filter-component
                            v-bind:pass-category-id="category_id"
                            @event-choose-filter="processEventChooseFilter"
                        />

                    </div>
                </div>
                <!-- Product Categorie List Start -->
                <div class="col-lg-9 order-lg-2">
                    <!-- Grid & List View Start -->
                    <div class="grid-list-top border-default universal-padding fix mb-30">
                        <div class="grid-list-view f-left">
                            <ul class="list-inline nav">
                                <li><a  class="active" data-toggle="tab" href="#grid-view"><i class="fa fa-th"/></a></li>
                                <li><a data-toggle="tab" href="#list-view"><i class="fa fa-list-ul"/></a></li>
                                <li><span class="grid-item-list"> Items {{pages_from}}-{{pages_to}} of {{pages_total}}</span></li>
                            </ul>
                        </div>
                        <!-- Toolbar Short Area Start -->
                        <div class="main-toolbar-sorter f-right">
                            <div class="toolbar-sorter">
                                <form>
                                    <label>Сортировка
                                        <select class="sorter" name="sorter"
                                                v-model="sortingProducts"
                                        >
                                            <option value="price_asc">от дешевых к дорогим</option>
                                            <option value="price_desc">от дорогих к дешевым</option>
                                            <option value="rating" selected="selected">по рейтингу</option>
                                            <option value="novelty">новинки</option>
                                            <option value="popular">популярные</option>
                                        </select>
                                    </label>
                                </form>
                            </div>
                        </div>
                        <!-- Toolbar Short Area End -->
                    </div>
                    <!-- Grid & List View End -->
                    <div class="main-categorie">
                        <!-- Grid & List Main Area End -->
                        <div class="tab-content fix">
                            <div id="grid-view" class="tab-pane active">
                                <div class="row">
                                    <!-- Single Product Start -->
                                    <div class="col-lg-4 col-sm-6" v-for="(product, index_product) in resultData" ><!-- TODO foreach $products-->
                                        <div class="single-product">
                                            <!-- Product Image Start -->
                                            <div class="pro-img">
                                                <a :href="'/product/' + product.alias">
                                                    <img class="primary-img" :src="product.media[0].url" alt="single-product">
                                                    <img class="secondary-img" :src="product.media[0].url" alt="single-product">
                                                </a>
                                            </div>
                                            <!-- Product Image End -->
                                            <!-- Product Content Start -->
                                            <div class="pro-content">
                                                <div class="rating">
                                                    <i class="fa " v-for="n in 5"
                                                       v-bind:class="[(product.average_rating < n) ? 'fa-star-o' : 'fa-star']"
                                                    ></i>
                                                </div>
                                                <h4><a :href="'/product/' + product.alias">{{ product.title }}</a></h4>
                                                <p><span class="price">${{ product.price}}</span>
                                                    <del v-if="product.old_price>product.price" class="prev-price">${{ product.old_price}}</del></p>
                                                <div class="pro-actions">
                                                    <div class="actions-secondary">
                                                        <a href="wishlist.html" data-toggle="tooltip" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
                                                        <a class="add-cart" data-toggle="tooltip" title="Add to Cart"
                                                            @click="onBasketList(index_product)"
                                                        >Add To Cart</a>
                                                        <a href="compare.html" data-toggle="tooltip" title="Add to Compare"><i class="fa fa-signal"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Product Content End -->
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6"
                                         v-if="(current_page < last_page)"
                                    >
                                        <div class="single-product">
                                            <div class="mx-auto load " @click="loadNextPage"></div>
                                        </div>
                                    </div>
                                    <!-- Single Product End -->
                                </div>
                            </div>
                            <div id="list-view" class="tab-pane ">
                                <!-- Single Product Start -->
                                <div class="single-product" v-for="(product, index_product) in resultData">
                                    <!-- Product Image Start -->
                                    <div class="pro-img">
                                        <a :href="'/product/' + product.alias">
                                            <img class="primary-img" :src="product.media[0].url" alt="single-product">
                                            <img class="secondary-img" :src="product.media[0].url" alt="single-product">
                                        </a>
                                    </div>
                                    <!-- Product Image End -->
                                    <!-- Product Content Start -->
                                    <div class="pro-content">
                                        <div class="rating">
                                            <i class="fa " v-for="n in 5"
                                               v-bind:class="[(product.average_rating < n) ? 'fa-star-o' : 'fa-star']"
                                            ></i>
                                        </div>
                                        <h4><a :href="'/product/' + product.alias">{{product.title}}</a></h4>
                                        <p>
                                            <span class="price">${{product.price}}</span>
                                            <del v-if="product.old_price>product.price" class="prev-price">${{product.old_price}}</del>
                                        </p>
                                        <p>{{product.description}}</p>
                                        <div class="pro-actions">
                                            <div class="actions-secondary">
                                                <a href="/wishlist" data-toggle="tooltip" title="Add to Wishlist">
                                                    <i class="fa fa-heart"/></a>
                                                <a class="add-cart" href="/cart" data-toggle="tooltip" title="Add to Cart"
                                                    @click="onBasketList(index_product)"
                                                >Add To Cart</a>
                                                <a href="/compare" data-toggle="tooltip" title="Add to Compare">
                                                    <i class="fa fa-signal"/>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Product Content End -->
                                </div>
                                <div class="row"
                                    v-if="(current_page < last_page)"
                                >
                                    <div class="mx-auto load " @click="loadNextPage"></div>
                                </div>
                                <!-- Single Product End -->
                            </div>
                            <!-- #list view End -->
                        </div>
                        <!-- Grid & List Main Area End -->


                    </div>
                </div>
                <!-- product Categorie List End -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>

</template>



<script>
    import CategoryComponent from "./CategoryComponent";
    import FilterComponent from "./FilterComponent";
    export default {
        data: function(){
            return {
                is_refresh: false,                                  // заглушка під чаз завантаження
                resultData: [],                                     //
                url: 'url',                                         //
                pages_total: 1,                                     //
                pages_from: 1,                                      //
                pages_to: 1,                                        //
                current_page: 0,
                last_page: 1,

                basket_list: [],                                    // кощик до купівлі
                sortingProducts: 'popular',                              // сортування

                //get
                attribute:[],
                filter: [],
                page: 1,
                category_id: null,

            }
        },
        components: {
            CategoryComponent,
            'component-category': CategoryComponent,
            FilterComponent,
            'component-filter': FilterComponent
        },
        mounted() {
            console.log('Shop Component mounted.');
            this.prepareToLoad();                                   // підготовка до завантаження
        },
        created(){

        },
        watch:{
            sortingProducts(){
                this.prepareToLoad();
            }
        },
        methods: {
                                                                    // function додавання в корзину
            onBasketList(index){
                this.localStorage.basket_list.push({
                    id: this.resultData[index].id,                  // додати індитифікатор
                    count:1,                                        // кількість
                    title:this.resultData[index].title,             // назва
                    price: this.resultData[index].price,            // ціна
                    img: this.resultData[index].img,                // зображення
                    url: this.resultData[index].alias               // скороч назва
                });
                this.localStorage.basket_list_sum += this.resultData[index].price;
            },
                                                                    // function подія піля вибору фільтрів
            processEventChooseFilter: function(checkbox){
                this.filter = checkbox;                             // збереження вибраних фільтрів
                this.prepareToLoad();                               // підготовка до завантаження

            },
                                                                    // function подія піля вибору категорії
                                                                    // автомат виклик подія вибору фільтрів
            processEventChooseCategory(id){
                this.category_id = id;                              // збереження вибраної категрії
                //this.prepareToLoad();                               // підготовка до завантаження
            },
                                                                    // function підготовка до завантаження
            prepareToLoad: function(){
                this.page = 1;                                      // обнуляємо сторінки
                this.resultData = [];                               // обнуляємо завантажені дані
                this.loadProducts();                                // завантажуємо
            },
                                                                    // function кнопка завантаження наступної сторінки
            loadNextPage: function(){
                this.loadProducts();                                // завантажуємо

            },
                                                                    // function завантаження продуктів
            loadProducts: function(){
                // console.log(checkbox);
                this.is_refresh = true;                             // заглушка під чаз завантаження
                axios.get('/api/v1/product/index', {
                    params: {
                        filter: this.filter,
                        category: this.category_id,
                        sorter: this.sortingProducts,
                        page: this.page,

                    },
                    paramsSerializer: function(params) {
                        let tmp = [];
                        params.filter.forEach(item => {
                            tmp.push(`attribute[${item.filter_id}][]=${item.id}`)
                        });
                        if (params.category) {
                            tmp.push(`category=${params.category}`);
                        }
                        if (params.sorter === 'price_asc') {
                            tmp.push(`price=asc`);
                        }
                        if (params.sorter === 'price_desc') {
                            tmp.push(`price=desc`);
                        }else {
                            tmp.push(`${params.sorter}`);
                        }
                        tmp.push(`page=${params.page}`);
                        return tmp.join('&');
                    },
                }).then((response) => {
                    this.pages_total = response.data.total;                         // скільки всього елементів
                    this.page++;                                                    // збільшити номер ст яку грузим
                    this.pages_to = response.data.to;                               // скільки завантажено
                    this.resultData = this.resultData.concat(response.data.data);   // обєднання всії завантажених даних
                    this.current_page = response.data.current_page;
                    this.last_page = response.data.last_page;

                    console.log('Успіщний запит з фільтром');                       // debug
                    console.log(response.data);                                  // debug
                }).catch(function (error) {
                    console.log(error);                             // debug error
                });
                this.is_refresh = false;                            // кінець заглушки під чаз завантаження
            }
        }
    }
</script>
<style scoped>
    .load{
        background-image: url("/img/load.png");
        height: 64px;
        width: 64px;
        background-repeat: no-repeat;
        background-size: 100%;
        cursor: pointer;
    }
</style>
