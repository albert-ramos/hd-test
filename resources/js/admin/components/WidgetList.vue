<template>
    <div id="widget-list">
        <p v-for="widget in widgets">{{widget.title}}</p>
    </div>
</template>

<script>
    import UtilsHelper from '../../helpers/utils'

    export default {
         data() {
            return {
                widgets: []
            }
        },
         computed: {},

        methods: {
            getWidgets(e) {            
                axios.get('/api/v1/widgets', {})
                .then(({data}) => {
                    this.widgets = data.data.widgets
                });
            },
        },

        created() {
            this.getWidgets();
        }
    }
</script>