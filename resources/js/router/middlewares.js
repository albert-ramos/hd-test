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
    let authToken = UtilsHelper.session.getLocalToken();
    
    window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

    // TODO: Not working yet
    if (authToken) {
        window.axios.defaults.headers.common['_token'] = authToken;
        
    }
    
    next()
}


export function setPageTitleMiddleware (to, from, next) {
    const pageTitle = to.matched.find(item => item.meta.title)
  
    if (pageTitle) window.document.title = pageTitle.meta.title
    next()
  }




