import { createStore } from 'redux';
import { RootReducer } from "../Reducers/RootReducer";
 

declare global {
    interface Window {
        __REDUX_DEVTOOLS_EXTENSION__: any,
    }
}

export const Store: any = createStore(RootReducer, window.__REDUX_DEVTOOLS_EXTENSION__ && window.__REDUX_DEVTOOLS_EXTENSION__());
