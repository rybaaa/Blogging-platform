import http from './Http'

export default {
  store(params) {
    return http.post('comments', params)
  },
}
