<template>
    <div>
        <div class="widget-add-item">
            
            <button @click="openForm">+ new</button>

        </div>
    </div>
</template>

<script>
    export default {
        computed: {

        },

        methods: {
            openForm() {
                this.$root.$emit('openWidgetForm', {});
            },
        },

        // TODO: Maybe some animation?
        mounted() {

        },

        created() {

        }
    }
</script>