<template>
    <v-pagination
        v-model="currentPage"
        :length="lastPage"
        :total-visible="8"
        :disabled="loading"
    ></v-pagination>
</template>

<script>
    export default {
        name: "Pagination",
        data() {
            return {
                loading: false,
            }
        },
        props: ['state', 'commit', 'getList'],

        computed: {
            currentPage: {
                get() {
                    return this.$store.state[this.state].meta.current_page;
                },
                set(value) {
                    return this.$store.commit(this.commit, value);
                }
            },
            lastPage: {
                get() {
                    return this.$store.state[this.state].meta.last_page;
                }
            }
        },
        watch: {
            currentPage(page) {
                this.paginate(page);
            }
        },
        methods: {
            paginate(page) {
                this.loading = true;
                this.$emit('loading', this.loading) // подія
                this.$store.dispatch(this.getList, {page: page})
                    .catch(() => {
                        this.loading = false;
                        this.$emit('loading', this.loading)
                    }).finally(() => {
                        this.loading = false;
                        this.$emit('loading', this.loading)
                    });
            }
        }
    }
</script>
