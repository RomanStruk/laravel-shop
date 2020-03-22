<template>
    <div class="mt-5">
        <div class="single-sidebar"
            v-for="attributes in filterGroup" >
        <div class="group-title">
            <h2>{{ attributes.name }}</h2>
        </div>
        <ul class="list-group list-group-flush">
            <li
            v-for="attribute in attributes.all_attributes"
            >
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input"
                           :name="'attribute['+attributes.id+'][]'"
                           :id="'check'+attribute.id "
                           v-model="checkbox"
                           :value="attribute"
                    >
                    <label class="custom-control-label"
                           :for="'check'+ attribute.id"
                    >{{ attribute.value }}
                    </label>
                </div>

            </li>
        </ul>
    </div>
    </div>
</template>

<script>
    export default {
        props:[
            'passCategoryId'                                // отримання від батьківського компонента даних
        ],
        data: function(){
            return {
                filterGroup: [],                            // всі фільтри
                checkbox: [],                               // вибрані фільтри
                is_refresh: false,                          // заглушка під чаз завантаження
                category_id: null                           // вибрана категорія
            }
        },
        watch:{
            // отримання категоріїї
            passCategoryId(){
                this.categoty_id = this.passCategoryId;     // id категорії
                this.filterGroup = [];                      // очистити фільтри
                this.checkbox = [];                         // очистити вибрані фільтри
                this.attributeGroup();                      // завантажити фільтри
                console.log(this.categoty_id);              // debug

            },
            checkbox: function(){
                this.$emit('event-choose-filter', this.checkbox) // подія при слідкуваннні за змінами чекбокса
            }
        },
        mounted() {
            console.log('Filter Component mounted.');       // debug
        },
        methods: {
            attributeGroup: function(){
                this.is_refresh = true;                     // заглушка під чаз завантаження
                axios.get('/filter/get/json',{
                    params: {
                        category: this.categoty_id
                    }
                }).                                         // завантаження даних
                then((response) => {
                    //console.log(response.data);
                    this.filterGroup = response.data;       // обєднання всії завантажених даних
                });
                this.is_refresh = false;                    // кінець заглушки під чаз завантаження
            }
        }
    }
</script>
