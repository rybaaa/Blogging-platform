import http from './Http'

export default{
    async register(params){
        return await http.post('register', params)
    },

    async login(params){
        return await http.post('auth', params)
    }
}