import { API } from "../Config/API.Config";
import { COLORS } from "../Config/Colors.Config";
import { IsNullOrUndefined } from "../Functions/IsNullOrUndefined/IsNullOrUndefined";
import { UseNamespace } from "../Functions/UseNamespace/UseNamespace.Funciton";
import { AuthProvider } from "../Service/Providers/Auth/AuthProvider";
import { HTTPRequestProvider } from "../Service/Providers/HTTPRequest/HTTPRequestProvider";
import { StorageProvider } from "../Service/Providers/Storage/StorageProvider";
import { Startup } from "./Startup";

const AppProvider = {
    CONFIG: {
        COLORS: COLORS,
        API: API,
    },

    FUNCTIONS: {
        USE_NAMESPANCE: UseNamespace,
        IS_NULL_OR_UNDEFINED: IsNullOrUndefined,
    },

    SERVICES: {
        STARTUP: {
            INIT: Startup,
        },
        STORAGE: StorageProvider,
        AUTH: AuthProvider,
        HTTPRequest: HTTPRequestProvider,
    }
};

export { AppProvider as APP };
