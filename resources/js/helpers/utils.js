const UtilsHelper = {
    session: {
        checkUserIsLoggedIn() {
            return this.getLocalToken()
        },

        getLocalToken() {
            let authToken = localStorage.getItem('atkn')
            return (authToken) ? true : false
        },

        setLocalToken(token) {
            localStorage.setItem('atkn', token)
        }
    }
}

export default UtilsHelper