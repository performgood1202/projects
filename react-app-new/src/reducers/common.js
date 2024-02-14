import {
  APP_LOAD,
  REDIRECT,
  LOGOUT,
  REGISTER,
  LOGIN,
  FORGOT_PASSWORD,
  RESET_PASSWORD,
  LOGIN_PAGE_UNLOADED,
  REGISTER_PAGE_UNLOADED,
  CURRENT_VIEW,
  CLEAR_LOGOUT,
  PAGE_ATTR,
  ASYNC_END,
  CLEAR_ERRORS
} from "../constants/actionTypes";

const defaultState = {
  pageheading: "Dashboard",
  appName: "vcalc",
  token: null,
  viewChangeCounter: 0,
  dashboardData: [],
  loginSuccess: false,
  redirectTo: false,
  loginError: null,
  appLoaded: false,
  logoutRedirectTo: false,
};

export default (state = defaultState, action) => {


  switch (action.type) {
    case APP_LOAD:
      return {
        ...state,
        appLoaded: true,
        currentUser:
          action.payload && action.payload.data && action.payload.data
            ? action.payload.data
            : null,   
      };
    case REDIRECT:
      return { ...state, redirectTo: "/" };
    case LOGIN:
    case REGISTER:
      return {
        ...state,
        redirectTo: action.payload && action.payload.data && action.payload.data.token ? true : false,
        loginSuccess: action.payload && action.payload.data && action.payload.data.message ? action.payload.data.message : "",
        registerSuccess: action.payload && action.payload.data && action.payload.data.message ? action.payload.data.message : "",
        loginError: action.payload && action.payload.errMessage ? action.payload.errMessage : null,
        registerError: action.payload && action.payload.errMessage ? action.payload.errMessage : null,
        token: action.payload && action.payload.data && action.payload.data.token ? action.payload.data.token: null,
        currentUser: action.payload && action.payload.data && action.payload.data.user ? action.payload.data.user: null,
        clubData: action.payload && action.payload.data && action.payload.data.clubData ? action.payload.data.clubData: null,
      };
    case LOGOUT:
      return { ...state, logoutRedirectTo: true, token: null, currentUser: null, loginSuccess: false };
    case CLEAR_LOGOUT:
      return { ...state, logoutRedirectTo: false,redirectTo: false };
    case CURRENT_VIEW:
      return {
        ...state,
        viewName: action.payload.name,
        viewId: action.payload.id,
      };
    case PAGE_ATTR:
      return {
        ...state,
        pageheading: action.pageheading ? action.pageheading: state.pageheading ,
      };  
    case ASYNC_END:
      return {
        ...state,
        authError: action.promise && action.promise.errMessage && action.promise.errMessage && action.promise.errMessage == "Authetication failed" ? true : false,
      };
    case CLEAR_ERRORS:
      return {
        ...state,
        registerError: null,
        registerSuccess: null,
      };  
             
    default:
      return state;
  }
};
