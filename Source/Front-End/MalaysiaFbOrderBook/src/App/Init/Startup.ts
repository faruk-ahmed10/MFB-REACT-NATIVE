import {AuthProvider} from "../Service/Providers/Auth/AuthProvider";

/**
 * Register all the startup services here
 * @constructor
 */
export function Startup() {
    new AuthProvider().initialize(); 
}
