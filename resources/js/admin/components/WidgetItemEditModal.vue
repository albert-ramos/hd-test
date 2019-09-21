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

                <label for="templateInput">Template</label>
                <select v-model="template" id="templateInput" name="template">
                    <option value="small" selected="selected">Small</option>
                    <option value="medium">Medium</option>
                    <option value="large">Large</option>
                </select>

                <button @click="postWidget" class="button button-outline" :disabled="!formValid">Save</button>
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
                template: 'small',
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
                this.parseWidgetData({
                    id: '',
                    title: '',
                    content: '',
                    template: 'small',
                    background_color: '',
                })
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
                    this.emitSaveEvent(data)
                    this.closeModal()
                })
                .catch(({e}) => {
                    console.log(e)
                });
                
            },

            emitSaveEvent(data) {
                let widget = data.data.widget;

                // console.log(widget)

                if(this.isUpdatingOrCreating == 'updating')
                    this.$root.$emit('widgetUpdated', widget)
                else
                    this.$root.$emit('widgetCreated', widget)
            },

            getSaveEndpoint() {
                return ( this.isUpdatingOrCreating == 'updating') ? 
                    this.updateEndpoint : 
                    this.createEndpoint 
            },

            setShortcuts() {
                let self = this;
                
                document.addEventListener('keyup', function (evt) {
                    if (evt.keyCode === 27) self.closeModal()
                });
            }
        },

        mounted() { 
        },

        created() {
            let self = this
            this.parseWidgetData()
            this.setShortcuts();
            
            this.$root.$on('openWidgetForm', function(data) {
                self.parseWidgetData(data);
                self.extraClasses = "modal-active"
            })

        }
    }
</script>