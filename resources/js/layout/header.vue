<template>
    <header>
        <div class="container">
            <div class="row">

                <div class="column">
                    Lumen & Vue
                </div>

                <div class="column text-center">
                    <p v-if="userDataAvailable">Hello {{user.name}}</p>
                </div>

                <div class="column text-right">
                    <widget-add-item-button v-if="userDataAvailable"></widget-add-item-button>  
                </div>
            </div>
        </div>
    </header>
</template>

<script>
import UtilsHelper from '../helpers/utils'
import WidgetAddItemButton from '../admin/components/WidgetAddItemButton'

export default {

    components: {
        WidgetAddItemButton
    },

    data() {
        return {
            user: '',
            userDataReady: false
        }
    },

    computed: {
        userDataAvailable() {
            return this.userDataReady
        }
    },

    methods: {
        setUser: function() {
            this.user = UtilsHelper.session.getUserInfo();
            if(Object.keys(this.user).length) this.userDataReady = true;
        }
    },

    // TODO: User setters
    mounted() {
        let self = this;
        this.$root.$on('loginSuccess', function(user) {
            self.user = user
            self.userDataReady = true;
        });
    },

    created() {
        this.setUser()
    }
}
</script>