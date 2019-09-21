<template>
    <div class="login-box">
        <form>
            <fieldset>
                <label for="mailInput">Name</label>
                <input type="text" v-model="mail" placeholder="E-mail" id="mailInput" name="mail">
                
                <label for="passwdInput">Password</label>
                <input type="password" v-model="passwd" placeholder="Password" id="passwdInput" name="passwd">

                <input @click="postLogin" class="button-primary" type="submit" value="Login" :disabled="!formValid">
            </fieldset>
        </form>
    </div>
</template>

<script>
    import UtilsHelper from '../../helpers/utils'

    export default {
         data() {
            return {
                mail: '',
                passwd: ''
            }
        },
         computed: {
            formValid() {
                return (this.mail.length > 0 && this.passwd.length > 0);
            }
        },

        methods: {
            postLogin(e) {
                e.preventDefault();
            
                axios.post('/api/v1/login', {
                    mail: this.mail,
                    passwd: this.passwd
                })
                .then(({data}) => {
                    let user = data.data.user
                    let token = data.data.token

                    // TODO: Refactor to proceed with one call setter
                    UtilsHelper.session.setLocalToken(token);
                    UtilsHelper.session.setUserInfo(user);
                    this.$router.push({name: 'AdminHome'})
                    this.$root.$emit('loginSuccess', user)
                });
            },
        }
    }
</script>