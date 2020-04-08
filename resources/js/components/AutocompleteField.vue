<template>
    <div class="autocomplete">
        <input type="text" class="input-group"
               :name="inputName"
               v-model="text"
               @focus="[isActive=true, selected=false]"
               autocomplete="off"
        >
        <ul class="info-autocomplete"
            v-bind:style="isActive ? 'display: block' : 'display: none'"
        >
            <li v-for="(value,key) in list" @click="choose(key, value.name)">{{value.description}}</li>
        </ul>

    </div>

</template>

<script>
    export default {
        name: "AutocompleteField",
        data: function(){
            return {
                text: '',
                isActive: false,
                selected: false,
                sendData:{
                    key:'',
                    value:''
                }
            }
        },
        props:[
            'inputName',
            'default-value',
            'list'        // отримання від батьківського компонента даних
        ],
        mounted() {
            this.text = this.defaultValue;
        },
        watch: {
            // якщо не вибраний елемент то відправляти строку для пошуку
            text: function () {
                if (!this.selected){
                    this.$emit('search-text', this.text);
                }

                // console.log(this.text);                                  // debug
            },
        },
        methods:{

            choose: function (key, text) {
                this.selected = true;
                this.isActive = false;

                this.sendData.value = text;
                this.sendData.key = key;
                this.text = text;

                this.$emit('enter-text', this.sendData);

                // console.log(this.sendData);                       // debug
            },
        }
    }
</script>

<style>
    .autocomplete{
        position: relative;
        display: block;
    }
    .info-autocomplete {
        position: absolute;
        top: 100%;
        left: 0;
        z-index: 1000;
        display: none;
        float: left;
        min-width: 160px;
        margin: 0;
        padding: 2px;
        list-style: none;
        font-size: 14px;
        text-align: left;
        background-color: #ffffff;
        border: 1px solid rgba(0, 0, 0, 0.15);
        border-radius: 0 0 4px 4px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
        background-clip: padding-box;
        width: 100%;
    }

    .info-autocomplete > li {
        display: block;
        padding: 3px 10px;
        clear: both;
        font-weight: normal;
        line-height: 1.42857143;
        color: #333333;
        white-space: nowrap;
    }
    .info-autocomplete > li:hover{
        background-color: lightgrey;
        cursor: pointer;
    }

</style>
