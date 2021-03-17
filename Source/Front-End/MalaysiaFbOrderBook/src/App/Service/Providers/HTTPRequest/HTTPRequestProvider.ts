import axios from 'axios';
import { API } from '../../../Config/API.Config';
import { AuthProvider } from '../Auth/AuthProvider';

export class HTTPRequestProvider {
    public static async send(type: 'get' | 'post' | 'delete', route: string, config: object, data: object, onSuccess: any = null, onError: any = null) {
        let Axios,
            axiosConfig = {
                headers: {
                    Authorization: `Bearer ${new AuthProvider().getToken()}`,
                    ...config,
                }
            };

        if (type === 'get' || type === 'delete') {
            Axios = axios[type](API.API_ROOT + route, axiosConfig);
        } else {
            Axios = axios.post(API.API_ROOT + route, data, axiosConfig)
        }

        return await Axios.then(({ data }: any) => {
            if (data.success) {
                if (typeof onSuccess === 'function') {
                    onSuccess(data);
                }
            } else {
                alert(data.message);
            }

        }).catch((error) => {

            if (error.response) {
                if (error.response.status === 403) {
                    new AuthProvider().set({
                        isLoggedIn: false,
                        token: '',
                    });

                    return;
                } else {
					alert("Error: " + error.response.data.message);
					return;
				}
            }

            if (typeof onError === 'function') {
                return onError(error);
            }

            alert(error);
        });
    }
}