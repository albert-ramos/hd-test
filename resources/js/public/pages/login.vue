<template>
    <section id="login-page">
        
        <div class="container">

            <div class="row">
                <div class="column column-50 column-offset-25">

                    <login-box></login-box>

                </div>
            </div>

        </div>

    </section>
</template>

<script>
    import LoginBox from '../components/LoginBox'

    export default {
        components: {
            LoginBox,
        }
    }
</script>
