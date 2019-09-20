<template>
    <div class="widget-item-edit modal" v-bind:class="extraClasses">
        <span class="close" @click="closeModal">&times;</span>
        
        <form>
            <fieldset>
                <label for="titleInput">Title</label>
                <input type="text" v-model="title" placeholder="title" id="titleInput" name="title">
                
                <label for="contentInput">Content</label>
                <input type="text" v-model="content" placeholder="Content" id="contentInput" name="content">

                <label for="backgroundInput">Background color</label>
                <input type="text" v-model="background_color" placeholder="Background color" id="backgroundInput" name="background_color">

                <label for="templateInput">Content</label>
                <input type="text" v-model="template" placeholder="Template" id="templateInput" name="template">

                <button @click="postWidget" class="button-primary" :disabled="!formValid">Save</button>
            </fieldset>
        </form>

    </div>
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
            },

            isUpdatingOrCreating() {
                return ( this.id ) ? 'updating' : 'creating'
            },
        },

        methods: {
            parseWidgetData(data) {
                UtilsHelper.processData.pushDynamicProperties(this, data);
            },

            closeModal() {
                this.extraClasses = '';
            },

            postWidget(e) {
                e.preventDefault();
                
                axios.post(this.getSaveEndpoint(), {
                    title: this.title,
                    content: this.content,
                    background_color: this.background_color,
                    template: this.template,
                })
                .then(({data}) => {
                    this.emitSaveEvent()
                });
                
            },

            emitSaveEvent() {
                let data = {
                    id: this.id,
                    title: this.title,
                    content: this.content
                }

                if(this.isUpdatingOrCreating == 'updating')
                    this.$root.$emit('widgetUpdated', data)
                else
                    this.$root.$emit('widgetCreated', data)
            },

            getSaveEndpoint() {
                return ( this.isUpdatingOrCreating == 'updating') ? 
                    this.updateEndpoint : 
                    this.createEndpoint 
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