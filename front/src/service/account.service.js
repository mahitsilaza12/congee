import Axios from './call.service'
import router from "@/router"

let login = (Credential) =>  {
    return Axios.post('/api/login_check', Credential)
                .then(res => {
                    res.data
                    saveToken(res.data.token)
                })
                .catch(err => {
                    console.log(err)
                })
}

let logout = () => {
    localStorage.removeItem('token')
    router.push('/login')
}

let saveToken = (token) => {
    localStorage.setItem('token', token)
}

let isLogged = () => {
    let token = localStorage.getItem('token')

    return !!token
}

let getToken = () => {
    return localStorage.getItem('token')
}

let register = (user) => {
    return Axios.post('/api/register', user)
                .then(response => {
                    router.push('/login')
                    return response
                })
                .catch(error => {
                    return error
                })
}

export const accountService = {
    login,
    logout,
    saveToken,
    isLogged,
    register,
    getToken
}