<template>
    <div id="widget-list">
        <widget-item v-for="widget in widgets" 
                    v-bind:data="widget"
                    v-bind:key="widget.id">></widget-item>
    </div>
</template>

<script>
    import UtilsHelper from '../../helpers/utils'
    import WidgetItem from './WidgetItem'

    export default {
        components: {
            WidgetItem,
        },
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