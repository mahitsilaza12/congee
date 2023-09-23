import Api from '../../src/services/api/api'
import { authGuard } from '@/_helpers/auth-guard'
import Config from './Config'

const userService = {
    getProfil : async () => {
    if (authGuard()) {
            try {
                let accessToken = localStorage.getItem('token');

                const response = await Config.get(Api.user.profil, {
                    headers: {
                        'Authorization' : `Bearer ${accessToken}`,
                        'Content-Type': 'application/json'
                    },
                    method: 'GET'
                });
                return response.data
            } catch (error) {
                console.log(error)
            }
        }
    },
    userList : async () => {
        if (authGuard()) {
                try {
                    let accessToken = localStorage.getItem('token');
    
                    const response = await Config.get(Api.user.userList, {
                        headers: {
                            'Authorization' : `Bearer ${accessToken}`,
                            'Content-Type': 'application/json'
                        },
                        method: 'GET'
                    });
                    return response
                } catch (error) {
                    console.log(error)
                }
            }
        },
    updateUser : async (data) => {
        if (authGuard()) {

            try {
                let accessToken = localStorage.getItem('token');

                const response = await Config.put(Api.user.updateProfil, data, {
                    headers: {
                        'Authorization' : `Bearer ${accessToken}`,
                        'Content-Type': 'application/json'
                    },
                    method: 'POST'
                });
                console.log(response)
                return response
                } catch (error) {
                    console.log(error)
                }
            }
    },
    addUser : async (data) => {
        if (authGuard()) {

            try {
                let accessToken = localStorage.getItem('token');

                const response = await Config.post(Api.user.addUser, data, {
                    headers: {
                        'Authorization' : `Bearer ${accessToken}`,
                        'Content-Type': 'application/json'
                    },
                    method: 'POST'
                });
                console.log(response)
                return response
                } catch (error) {
                    console.log(error)
                }
            }
    },
    getUser : async (id) => {
        if (authGuard()) {
            try {
                const response = await Config.get(`/api/getpersonnel/${id}`, {
                    headers: {
                        'Authorization' : `Bearer ${accessToken}`,
                        'Content-Type': 'application/json'
                    },
                    method: 'DELETE'
                });
                return response
                } catch (error) {
                    console.log(error)
                }
            }
        },
    editUser : async (id,data) => {
        if (authGuard()) {
            try {
                const response = await Config.get(`/api/edit_personnel/${id}`, data, {
                    headers: {
                        'Authorization' : `Bearer ${accessToken}`,
                        'Content-Type': 'application/json'
                    },
                    method: 'DELETE'
                });
                return response
                } catch (error) {
                    console.log(error)
                }
            }
        }
}

export default userService
