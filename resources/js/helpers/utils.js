const UtilsHelper = {
    session: {
        checkUserIsLoggedIn() {
            return this.getLocalToken()
        },

        // TODO: Encrypt values
        getLocalToken() {
            let authToken = localStorage.getItem('atkn')
            return (authToken) ? authToken : false
        },

        setLocalToken(token) {
            localStorage.setItem('atkn', token)
        },

        setUserInfo(user) {
            let userString = JSON.stringify(user);
            localStorage.setItem('user', userString)
        },

        getUserInfo() {
            let user = localStorage.getItem('user')
            return (user) ? JSON.parse(user) : false
        }
    },

    processData: {
        pushDynamicProperties(component, data) {
            for(let i in data) {
                component[i] = data[i]
            }
        },
    }
}

export default UtilsHelper