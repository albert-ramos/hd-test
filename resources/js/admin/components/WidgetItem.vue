<template>
    <div>
        <div @click="openForm" class="widget-item-container">
            
            <div class="widget-item-content">
                <p>{{title}}</p>
            </div>

        </div>
    </div>
</template>

<script>
    
    import Vue from 'vue'
    import vmodal from 'vue-js-modal'
    import UtilsHelper from '../../helpers/utils'

    export default {
         data() {
            return {
                id: '',
                title: '',
                content: '',
                template: '',
                background_color: '',
            }
        },

        computed: {
            updateEndpoint() {
                return `/api/v1/widgets/${this.id}/update`
            }
        },

        methods: {
            openForm() {
                this.$root.$emit('openWidgetForm', this.$attrs.data);
            },

            parseWidgetData(externalData) {
                let data = {};

                if( !externalData )
                    data = this.$attrs.data
                else
                    data = externalData
                    
                UtilsHelper.processData.pushDynamicProperties(this, data);
            },

            setListeners() {
                let self = this;

                this.$root.$on('widgetUpdated', function(data) {
                    self.onWidgetUpdated(data)
                })
            },


            onWidgetUpdated(data) {
                // THAT'S NOT OK, TEMPORARY FIX
                if(data.id != this.id)
                    return false

                this.setProperties(data)
            },

            setProperties(data) {
                this.parseWidgetData(data)
            } 
        },

        mounted() {
            this.parseWidgetData();
            this.setListeners();
        },

        created() {

        }
    }
</script>