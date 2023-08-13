import http from './Http'

export default {
  index() {
    return http.get('tags')
  }
}