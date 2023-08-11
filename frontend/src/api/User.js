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
}
