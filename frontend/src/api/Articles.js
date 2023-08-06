import http from './Http'


export default{
    async index(author_id){
        return await http.get('articles', {params:{author_id: author_id}})
    },
    async show(id){
        return await http.get(`articles/${id}`)
    }
}