<template>
    <div>
        <div class="widget-item">
            <p @click="openForm">{{title}}</p>
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
            postUpdate(e) {    
                axios.get(this.updateEndpoint, {})
                .then(({data}) => {

                });
            },

            openForm() {
                this.$root.$emit('openWidgetForm', this.$attrs.data);
            },

            parseWidgetData() {
                UtilsHelper.processData.pushDynamicProperties(this, this.$attrs.data);
            }
        },

        mounted() {
            this.parseWidgetData();
        },

        created() {

        }
    }
</script>