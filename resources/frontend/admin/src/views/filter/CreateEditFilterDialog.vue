<template>
    <v-dialog v-model="dialog" max-width="1000px">
        <template v-slot:activator="{ on, attrs }">
            <v-btn
                color="primary"
                dark
                class="mb-2"
                v-bind="attrs"
                v-on="on"
            >New Item
            </v-btn>
        </template>
        <v-card>
            <v-card-title>
                <span class="headline">Create/Edit</span>

            </v-card-title>
            <v-card-text>
                <v-text-field
                    label="Назва групи фільтрів"
                    single-line
                    outlined
                ></v-text-field>
                <v-list>
                    <v-list-item v-for="item in items" :key="item.text">
                        <v-text-field
                            v-if="editing === item"
                            v-model="editing.text"
                            autofocus
                            flat
                            background-color="transparent"
                            hide-details
                            solo
                            @keyup.enter="edit(index, item)"
                        ></v-text-field>
                        <v-chip
                            v-else
                            :color="`${item.color} lighten-3`"
                            dark
                            label
                            small
                        >
                            {{ item.text }}
                        </v-chip>
                        <v-spacer></v-spacer>
                        <v-list-item-action @click.stop>
                            <v-btn
                                icon
                                @click.stop.prevent="edit(index, item)"
                            >
                                <v-icon>{{ editing !== item ? 'mdi-pencil' : 'mdi-check' }}</v-icon>
                            </v-btn>
                        </v-list-item-action>
                        <v-list-item-action @click.stop>
                            <v-btn
                                icon
                                @click.stop.prevent="destroy(index)"
                            >
                                <v-icon>mdi-trash-can</v-icon>
                            </v-btn>
                        </v-list-item-action>
                    </v-list-item>
                    <v-list-item>
                        <v-text-field
                            flat
                            background-color="transparent"
                            hide-details
                            label="Варіант"
                        ></v-text-field>
                        <v-list-item-action @click.stop>
                            <v-btn
                                icon
                                @click.stop.prevent="add()"
                            >
                                <v-icon>mdi-plus-box</v-icon>
                            </v-btn>
                        </v-list-item-action>
                    </v-list-item>
                </v-list>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>

<script>
    export default {
        name: "CreateEditFilterDialog",
        data: () => ({
            valid: true,
            dialog: false,
            isLoading: false,

            activator: null,
            colors: ['green', 'purple', 'indigo', 'cyan', 'teal', 'orange'],
            editing: null,
            index: -1,
            items: [
                {
                    text: 'Foo',
                    color: 'blue',
                },
                {
                    text: 'Bar',
                    color: 'red',
                },
            ],
        }),
        watch: {
        },

        methods: {
            edit(index, item) {
                if (!this.editing) {
                    this.editing = item
                    this.index = index
                } else {
                    this.editing = null
                    this.index = -1
                }
            },
            add(){

            },
            destroy(index){
                this.items.splice(index, 1)
            }
        },
    }
</script>

<style scoped>

</style>
