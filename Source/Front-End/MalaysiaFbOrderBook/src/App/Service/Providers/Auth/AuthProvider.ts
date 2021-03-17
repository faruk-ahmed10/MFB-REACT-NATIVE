import { StorageProvider } from "../Storage/StorageProvider";
import { Store } from "../../../../Global/Data/Store/Store";
import { SET_AUTH_DATA } from "../../../../Global/Data/Actions/Global/Auth/Auth.Action";
import { IAuthData } from "../../../../Global/Data/Reducers/Global/Auth/Auth.Interface";

export class AuthProvider {
    private __identifier: string;

    constructor() {
        this.__identifier = '__auth';
    }

    public initialize() {
        /**
         * Set auth data to the store
         */
        StorageProvider.getData(this.__identifier).then((r: string) => {
            const authData: IAuthData = {
                isLoggedIn: false,
                token: '',
            };

            if ((typeof r !== 'undefined' && r !== null && r !== '')) {
                const __data = JSON.parse(r);

                const token = (typeof __data.token !== 'undefined' && __data.token !== null && __data.token !== '') ? __data.token : '';

                authData.isLoggedIn = token !== '' ? true : false;
                authData.token = token;
            }
            
            /**
             * Update store with auth data
             */
            Store.dispatch(SET_AUTH_DATA(authData));
            
        }).catch((error) => {
            alert(error);
        });
    }

    public async set(authData: IAuthData): Promise<any> {
        return await StorageProvider.store(this.__identifier, JSON.stringify(authData)).then(() => {
            Store.dispatch(SET_AUTH_DATA(authData));
            return true;
        }).catch((error: any) => {
            return error;
        });
    }

    public check(): boolean {
        return Store.getState().AUTH.isLoggedIn;
    }

    public getToken(): string {
        return Store.getState().AUTH.token;
    }
}
