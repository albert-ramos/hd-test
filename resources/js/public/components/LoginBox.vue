<template>
    <div class="login-box">
        <form>
            <fieldset>
                <label for="mailInput">Name</label>
                <input type="text" v-model="mail" placeholder="E-mail" id="mailInput" name="mail">
                
                <label for="passwdInput">Password</label>
                <input type="password" v-model="passwd" placeholder="Password" id="passwdInput" name="passwd">

                <input @click="postLogin" class="button-primary" type="submit" value="Login">
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
            isInputEmpty() {
                return this.mail.length > 0;
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
                    UtilsHelper.session.setLocalToken(data.data.token);
                    this.$router.push({name: 'AdminHome'})
                });
            },
        }
    }
</script>