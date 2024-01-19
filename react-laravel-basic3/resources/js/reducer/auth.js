import {
	LOGIN,
  ASYNC_START
} from '../constants/type';

export default (state = {}, action) => {
	switch (action.type) {
  	case LOGIN:
    	return {
          ...state,
        	loginSuccess: true
    	}
      break;
    case ASYNC_START:
      if (action.subtype === LOGIN) {
          return { ...state, inProgress: true };
      }
      break;
  	default:
  		return state;
	}

  return state;
};
