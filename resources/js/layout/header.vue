<template>
    <header>
        <div class="container">
            <div class="row">

                <div class="column">
                    Lumen & Vue
                </div>

                <div class="column">
                    <p v-if="userDataAvailable">Hello {{user.name}}</p>
                </div>

                <div class="column">
                    <p v-if="userDataAvailable">add widget</p>
                </div>
            </div>
        </div>
    </header>
</template>

<script>
import UtilsHelper from '../helpers/utils'

export default {

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
            this.userDataReady = true;
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