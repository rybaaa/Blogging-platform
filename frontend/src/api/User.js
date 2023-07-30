import http from './Http'

export default{
    async register(params){
        return await http.post('register', params)
    },
}