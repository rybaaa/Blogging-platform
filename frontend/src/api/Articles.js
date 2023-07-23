import http from './Http'


export default{
    async index(){
        return await http.get('articles')
    },
    async show(id){
        return await http.get(`articles/${id}`)
    }
}