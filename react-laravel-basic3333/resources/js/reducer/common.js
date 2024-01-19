import {
  	INFO,
  	APP_LOAD,
  	LOGIN,
  	LOGOUT,
  	REMOVE_REDIRECT
} from '../constants/type';

export default (state = {}, action) => {
  	switch (action.type) {
    	case INFO:
	      	return {
	        	auth: true,
	      	}
	      	break;
	    case APP_LOAD:
	      	return {
		        ...state,
		        appLoaded: true,
		        currentUser: action.payload && action.payload.user
		            ? action.payload.user
		            : null,
	        }
	        break;
	    case REMOVE_REDIRECT: 
	    	return {
	    		...state,
	    		redirectTo: null
	    	}
	    	break;
      	case LOGIN:
      		return {
		        ...state,
		        redirectTo: null,
		        loginSuccess: action.error ? false : true,
		        token: action.error ? null : action.payload.token,
		        currentUser: action.error ? null : action.payload.user,
      		};
      		break;
      	case LOGOUT:
      		return { ...state, redirectTo: "/login", token: null, currentUser: null, loginSuccess: false };
      		break;
    	default:
    		return state;
  	}

  return state;
};
