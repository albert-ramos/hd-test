<template>
    <div class="widget-item-edit modal" v-bind:class="extraClasses">
    <span class="close" @click="closeModal">&times;</span>
        
        <!-- <div id="widgetModal">  -->
            <!-- data-iziModal-fullscreen="true"  data-iziModal-title="Welcome"  data-iziModal-subtitle="Subtitle"  data-iziModal-icon="icon-home" -->
            <!-- Modal content -->
            
            <form>
                <fieldset>
                    <label for="titleInput">Title</label>
                    <input type="text" v-model="title" placeholder="title" id="titleInput" name="title">
                    
                    <label for="contentInput">Content</label>
                    <input type="text" v-model="content" placeholder="Content" id="contentInput" name="content">

                    <button @click="postWidget" class="button-primary" :disabled="!formValid">Save</button>
                </fieldset>
            </form>

        </div>

    <!-- </div> -->
</template>

<script>
    import UtilsHelper from '../../helpers/utils'
    

    export default {
        components: {

        },
         data() {
            return {                
                id: '',
                title: '',
                content: '',
                template: '',
                background_color: '',
                extraClasses: '',
            }
        },

        computed: {
            updateEndpoint() {
                return `/api/v1/widgets/${this.id}/update`
            },

            createEndpoint() {
                return `/api/v1/widgets/store`
            },

            formValid() {
                return this.title.length > 0 && this.content.length > 0;
            }
        },

        methods: {
            parseWidgetData(data) {
                UtilsHelper.processData.pushDynamicProperties(this, data);
            },

            closeModal() {
                this.extraClasses = '';
            },

            postWidget(e) {
                // e.preventDefault();
                console.log("ehhee" ,this.getSaveEndpoint());
                // return false;
                
            },

            getSaveEndpoint() {
                return ( !this.id ) ? this.createEndpoint : this.updateEndpoint
            }

        },

        mounted() { },

        created() {
            let self = this
            this.parseWidgetData()
            
            this.$root.$on('openWidgetForm', function(data) {
                self.parseWidgetData(data);
                self.extraClasses = "modal-active"
            })
        }
    }
</script>