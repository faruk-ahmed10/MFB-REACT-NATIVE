import {UseNamespace} from "../../../../../App/Functions/UseNamespace/UseNamespace.Funciton";
import { IAuthData } from "../../../Reducers/Global/Auth/Auth.Interface";

const namespace = 'APP/AUTH/';

export const actionTypes: any = {
    SET_AUTH_DATA: UseNamespace(namespace, 'SET_AUTH_DATA'),
};

export function SET_AUTH_DATA(data: IAuthData) {
    return {
        type: actionTypes.SET_AUTH_DATA,
        payload: data,
    }
}
