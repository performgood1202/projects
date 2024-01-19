import apis from "../apis";

import {
	LOGIN,
	LOGOUT,
	ASYNC_START,
	ASYNC_END,
	APP_LOAD,
} from "../constants/type";

const promiseMiddleware = (store) => (next) => (action) => {
	if (isPromise(action.payload)) {
		store.dispatch({ type: ASYNC_START, subtype: action.type });
		// window.localStorage.setItem("LASTCALL", new Date().getTime());
		const currentView = store.getState().viewChangeCounter;
		const skipTracking = action.skipTracking;

		action.payload.then((res) => {
			const currentState = store.getState();
			if (!skipTracking && currentState.viewChangeCounter !== currentView) {
				return;
			}
			// console.log("RESULT", res);
			action.payload = res;
			store.dispatch({ type: ASYNC_END, promise: action.payload });
			store.dispatch(action);
		}, (error) => {
			const currentState = store.getState();
			if (!skipTracking && currentState.viewChangeCounter !== currentView) {
				return;
			}
			// console.log("ERROR", error);
			action.error = true;
			action.payload = error && error.response && error.response.body
				? error.response.body
				: error.response || error;
			if (!action.skipTracking) {
				store.dispatch({ type: ASYNC_END, promise: action.payload });
			}
			store.dispatch(action);
		});

		return;
	}

	next(action);
};

const localStorageMiddleware = (store) => (next) => (action) => {
	if (action.type === LOGIN) {
		
		if (!action.error && action.payload && action.payload.token) {
			window.localStorage.setItem("jwt", action.payload.token);
			window.localStorage.setItem("LSLT", new Date().getTime());
			apis.setToken(action.payload.token);
		}
	} else if (action.type === LOGOUT) {
		window.localStorage.clear();
		apis.setToken(null);
	} else if (action.type === APP_LOAD) {
		if (action.error) {
			window.localStorage.clear();
			apis.setToken(null);
		}
	}

	next(action);
};

function isPromise(v) {
	return v && typeof v.then === "function";
}

export {
	promiseMiddleware,
	localStorageMiddleware,
};
