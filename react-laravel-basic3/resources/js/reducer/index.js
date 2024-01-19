import { combineReducers } from "redux";
import { routerReducer } from "react-router-redux";

import auth from "./auth";
import common from "./common";

export default combineReducers({
    auth,
    common,
    router: routerReducer,
});
