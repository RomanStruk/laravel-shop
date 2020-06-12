<template>
    <v-row
        align="center"
        justify="center"
    >
        <v-col cols="10">
            <v-card>
                <v-card-text>
                   Some text 2
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn text>Cancel</v-btn>
                    <v-btn
                        text
                        color="primary"
                    >Submit
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-col>
    </v-row>
</template>

<script>
    export default {
        name: "Dashboard",

    }
</script>

<style scoped>

</style>
