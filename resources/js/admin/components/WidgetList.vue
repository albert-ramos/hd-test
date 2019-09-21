<template>
    <div id="widget-list" class="widget-grid"
                    v-masonry
                    transition-duration="0.3s" item-selector=".widget-item">

        <widget-item v-for="widget in widgets" 
                    v-bind:data="widget"
                    v-bind:key="widget.id"
                    class="widget-item"
                    v-bind:class="`tpl__${widget.template}`"
                    v-masonry-tile
                    ></widget-item>
    </div>
</template>

<style>
    .widget-item {
            border: 1px solid;
    }
</style>
<script>
    import Vue from 'vue'
    import {VueMasonryPlugin} from 'vue-masonry';

    Vue.use(VueMasonryPlugin)
    
    import WidgetItem from './WidgetItem'
    import UtilsHelper from '../../helpers/utils'

    export default {
        components: {
            WidgetItem
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

            setGrid() {
                let options = {
                    cellHeight: 80,
                    verticalMargin: 10
                }
            },

            onWidgetCreated(data) {
                this.widgets.push(data)
            },
        },

        mounted() {
            let self = this
            if (typeof this.$redrawVueMasonry === 'function') {
                    this.$redrawVueMasonry()
                }
                
            this.getWidgets();
            this.setGrid();

            this.$root.$on('widgetCreated', function(data) {
                self.onWidgetCreated(data)
            })
        },

        created() {
            
        }
    }
</script>