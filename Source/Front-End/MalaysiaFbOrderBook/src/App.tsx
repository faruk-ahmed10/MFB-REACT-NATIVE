import * as React from 'react';
import Routes from './Routes/Routes';
import {APP} from "./App/Init/AppProvider";
import {Provider} from "react-redux";
import {Store} from "./Global/Data/Store/Store";

/**
 * Run the startup services
 */
APP.SERVICES.STARTUP.INIT();

/**
 * Root Component of the app to bind all the components and service providers
 * @constructor
 */
function App() {
    return (
        <Provider store={Store}>
            <Routes />
        </Provider>
    );
}

export default App;
