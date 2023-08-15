import http from './Http'

export default {
  index(search) {
    return http.get('tags', { params: { search }})
  }
}