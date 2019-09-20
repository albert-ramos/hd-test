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