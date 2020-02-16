<template>
<li class="list-group-item d-flex justify-content-between align-items-center">
    {{ item.name}}
    <div class="list-group list-group-flush">
        <test-component
            v-for="(it, index) in item.children"
            :key="index"
            :item="it"
        ></test-component>
    </div>
    <span class="badge badge-primary badge-pill">14</span>
</li>
</template>

<script>
    export default {
        name: "TestComponent",
        props: {
            item: Object
        },
        data: function () {
            return {
                isOpen: false
            }
        },
        computed: {

        },
        methods: {

        }
    }
</script>
