<template>
    <!-- Reviews Start -->
    <div class="review">
        <div class="group-title">
            <h2>customer review</h2>
        </div>
        <div
            v-if="commentsData.length">

            <div class="review-list"
                 v-for="comment in commentsData"
            >
                <div class="row">
                    <p class="review-mini-title m-3">{{comment.user.name}}</p>
                    <div class="m-3">
                        <i class="fa " v-for="n in 5"
                           v-bind:class="[(comment.rating < n) ? 'fa-star-o' : 'fa-star']"
                        ></i>
                    </div>
                </div>
                <div>
                    {{comment.text}}
                </div>
            </div>
        </div>
        <div class="review-list" v-else>Коментарів ще нема!</div>
    </div>
    <!-- Reviews End -->

</template>

<script>
    export default {
        name: "Comments",
        data: function () {
            return {
                is_refresh: false,
                commentsData: [],
            }
        },
        mounted() {
            this.comments();
            console.log('Comments Component mounted.');
        },
        methods: {
            comments: function () {
                this.is_refresh = true;
                axios.get('/api/comments', {
                    params: {
                        product_id: document.querySelector('#id_product').getAttribute('value')
                    }
                }).then((response) => {
                    this.commentsData = response.data; // обєднання всії завантажених даних
                });
                this.is_refresh = false;
            }
        }
    }
</script>

<style scoped>

</style>
