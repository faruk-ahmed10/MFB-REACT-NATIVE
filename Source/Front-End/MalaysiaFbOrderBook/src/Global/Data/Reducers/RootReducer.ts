import {combineReducers} from "redux";
import {AUTH} from "./Global/Auth/Auth.Reducer";

export const RootReducer: any = combineReducers({
    AUTH,
});
