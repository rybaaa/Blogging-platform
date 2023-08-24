import http from './Http'

export default {
  register(params) {
    return http.post('register', params)
  },

  login(params) {
    return http.post('auth', params)
  },

  update(id, params) {
    return http.put(`users/${id}`, params)
  },

  me() {
    return http.get('me')
  },

  logout() {
    return http.get('logout')
  },

  makeSubscription(params){
    return http.post('subscriptions', params)
  },

  fetchSubscriptions(){
    return http.get('subscriptions')
  },

  deleteSubscription(id){
    return http.delete(`subscriptions/${id}`)
  },

  downloadInvoice(id){
    return http.get(`subscriptions/${id}/download-invoice`,{
      responseType: 'blob'
    });
  }
}
