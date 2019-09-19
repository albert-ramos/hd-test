import UtilsHelper from '../helpers/utils'
window.axios = require('axios');

export function isUserLogIn(to, from, next) {
    const isLogged = UtilsHelper.session.checkUserIsLoggedIn()

    if(isLogged) {
        next()
    } else {
        next({name: 'Login'})
    }
    
}

export function injectAuthToken(to, from, next) {
    const isLogged = UtilsHelper.session.checkUserIsLoggedIn()

    // if( !isLogged )
    //     next({name: 'Login'})

    let authToken = UtilsHelper.session.getLocalToken();
    
    window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    if (authToken) {
        window.axios.defaults.headers.common['_token'] = authToken;
    } else {
        console.log("NOT TOKEN FOUND");
    }

    next()
}


export function setPageTitleMiddleware (to, from, next) {
    const pageTitle = to.matched.find(item => item.meta.title)
  
    if (pageTitle) window.document.title = pageTitle.meta.title
    next()
  }




