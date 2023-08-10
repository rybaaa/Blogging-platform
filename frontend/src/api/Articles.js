import http from './Http'

export default {
  index(author_id) {
    return http.get('articles', { params: { author_id: author_id } })
  },
  show(id) {
    return http.get(`articles/${id}`)
  },
}
