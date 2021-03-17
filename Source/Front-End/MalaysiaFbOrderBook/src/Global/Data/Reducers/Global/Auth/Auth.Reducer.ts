import {actionTypes} from "../../../Actions/Global/Auth/Auth.Action";
import { IAuthData as IState } from "./Auth.Interface";

const initialState: Required<IState> = {
    isLoggedIn: 'SERVICE_PREPARATION',
    token: '',
};

export function AUTH(state: IState = initialState, action: { type: string, payload: IState }) {
    switch (action.type) {
        case actionTypes.SET_AUTH_DATA:
            return {
                ...state,
                isLoggedIn: action.payload.isLoggedIn,
                token: action.payload.token,
            };

        default:
            return state;
    }
}
