import Api from '../../src/services/api/api'
import { authGuard } from '@/_helpers/auth-guard'
import Config from './Config'

const Absence = {
    listAbsence : async () => {
    if (authGuard()) {
            try {
                let accessToken = localStorage.getItem('token');

                const response = await Config.get(Api.Absence.listAbsence, {
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
    addAbsence : async (data) => {
        if (authGuard()) {

            try {
                let accessToken = localStorage.getItem('token');

                const response = await Config.post(Api.Absence.addAbsence, data, {
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
    deleteAbsence : async (id) => {
        if (authGuard()) {
            try {
                let accessToken = localStorage.getItem('token');

                const response = await Config.delete(`/api/absence/${id}`, {
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
    AnnulerAbsence : async (id) => {
        if (authGuard()) {
            try {
                let accessToken = localStorage.getItem('token');

                const response = await Config.get(`/api/absence/annuler/${id}`, {
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
    ConfirmAbsence : async (id) => {
        if (authGuard()) {
            try {
                let accessToken = localStorage.getItem('token');

                const response = await Config.get(`/api/absence/confirm/${id}`, {
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
    findAbsence : async (id) => {
        if (authGuard()) {
            try {
                let accessToken = localStorage.getItem('token');

                const response = await Config.get(`/api/absence/${id}`, {
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

export default Absence
