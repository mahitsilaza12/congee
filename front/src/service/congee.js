import Api from '../../src/services/api/api'
import { authGuard } from '@/_helpers/auth-guard'
import Config from './Config'

const Congee = {
    listCongee : async (page) => {
    if (authGuard()) {
            try {
                let accessToken = localStorage.getItem('token');

                const response = await Config.get(Api.congee.listCongee, {
                    params: { page },
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
    addCongee : async (data) => {
        if (authGuard()) {

            try {
                let accessToken = localStorage.getItem('token');

                const response = await Config.post(Api.congee.addCongee, data, {
                    headers: {
                        'Authorization' : `Bearer ${accessToken}`,
                        'Content-Type': 'application/json'
                    },
                    method: 'POST'
                });
                console.log(response.data.datas)
                return response.data.datas
                } catch (error) {
                    console.log(error)
                }
            }
    },
    deleteCongee : async (id) => {
        if (authGuard()) {
            try {
                let accessToken = localStorage.getItem('token');

                const response = await Config.delete(`/api/congee/delete/${id}`, {
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
    AnnulerCongee : async (id) => {
        if (authGuard()) {
            try {
                let accessToken = localStorage.getItem('token');
                const response = await Config.get(`/api/congee/annuler/${id}`, {
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
    ConfirmCongee : async (id) => {
        if (authGuard()) {
            try {
                let accessToken = localStorage.getItem('token');

                const response = await Config.get(`/api/congee/confirme/${id}`, {
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
    findCongee : async (id) => {
        if (authGuard()) {
            try {
                let accessToken = localStorage.getItem('token');

                const response = await Config.get(`/api/congee/${id}`, {
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
        }
}

export default Congee
