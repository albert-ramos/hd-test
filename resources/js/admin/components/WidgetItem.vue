<template>
    <div  class="widget-item" v-bind:class="templateClass">
        <div class="widget-item-container">
            
            <div class="widget-item-content">
                
                <div class="row">

                    <div class="column">
                        <p class="widget-title">{{title}}</p>
                    </div>

                    <div class="column">
                        <button @click="openForm" class="widget-edit">edit</button>
                        <button @click="postRemove" class="widget-remove">X</button>
                    </div>

                </div>

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
            },

            deleteEndpoint() {
                return `/api/v1/widgets/${this.id}/delete`
            },
            templateClass() {
                return `tpl__${this.template}`
            }
        },

        methods: {
            postRemove() {
                axios.delete(this.deleteEndpoint, {})
                .then(({data}) => {
                    this.$parent.onWidgetDeleted(this)
                })
                .catch(({e}) => {
                    console.log(e)
                });

                
            },

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

                // this.$parent.
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