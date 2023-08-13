import http from './Http'

export default {
  index(page, author_id) {
    return http.get('articles', { params: { author_id: author_id, page } })
  },
  show(id) {
    return http.get(`articles/${id}`)
  },
  store(body){
    return http.post('articles', body)
  },
  update(id, body) {
    return http.put(`articles/${id}`, body)
  }
}
