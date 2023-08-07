import http from './Http'

export default{
    async store(params){
        return await http.post('comments', params)
    },
}