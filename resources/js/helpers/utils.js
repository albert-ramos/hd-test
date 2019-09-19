const UtilsHelper = {
    session: {
        checkUserIsLoggedIn() {
            return this.getLocalToken()
        },

        getLocalToken() {
            let authToken = localStorage.getItem('atkn')
            return (authToken) ? authToken : false
        },

        setLocalToken(token) {
            localStorage.setItem('atkn', token)
        }
    }
}

export default UtilsHelper