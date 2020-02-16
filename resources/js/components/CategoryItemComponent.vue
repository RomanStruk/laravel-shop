<template>
    <div
        @mouseover="toggle"
        @mouseout="toggle">
        <div
            @click="$emit('emit-choose-category', item.id)"
        >
            <div
                :class="{'bold': isFolder}"
                class="list-group list-group-flush d-flex flex-row align-items-baseline"
                @dblclick="makeFolder"
            >
                <span class="">{{ item.name }}</span>
                <span class="p-2" v-if="isFolder">[{{ isOpen ? '-' : '+' }}]</span>
                <span class="badge badge-pill badge-primary ml-auto p-2">{{item.count_products}}</span>
            </div>

        </div>
        <div v-show="isOpen" v-if="isFolder" class="list-group list-group-flush ">
            <Category-item-component
                class="list-group-item list-group-item-action  pl-2 pb-0 pt-0"
                v-for="(child, index) in item.children"
                :key="child.id"
                :item="child"
                @make-folder="$emit('make-folder', $event)"
                @add-item="$emit('add-item', $event)"
                @emit-choose-category="$emit('emit-choose-category', child.id)"
            ></Category-item-component>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CategoryItemComponent",
        props: {
            item: Object
        },
        data: function () {
            return {
                isOpen: false
            }
        },
        computed: {
            isFolder: function () {
                return this.item.children &&
                    this.item.children.length
            }
        },
        methods: {
            toggle: function () {
                if (this.isFolder) {
                    this.isOpen = !this.isOpen
                }
            },
            makeFolder: function () {
                if (!this.isFolder) {
                    this.$emit('make-folder', this.item)
                    this.isOpen = true
                }
            }
        }
    }

</script>
<style scoped>
    .bold {
        font-weight: bold;
    }
</style>
