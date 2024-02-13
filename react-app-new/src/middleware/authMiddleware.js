import React from 'react';

import agent from "../agent";
import { APP_LOAD, LOGIN, REGISTER, LOGOUT } from './../constants/actionTypes';

const emptyStoredValues = async () => {
	localStorage.setItem("isLoggedIn", "false");
	localStorage.setItem("email", "");
	if(localStorage.getItem('token')) { localStorage.setItem("token", ""); }
	localStorage.setItem("LSLT", "");
	localStorage.setItem("OSTL", "");
	agent.setToken(null);
}

const setStoredValues = async (payload) => {
	localStorage.setItem("token", payload.token);
	localStorage.setItem("LSLT", new Date().getTime());
	agent.setToken(payload.token);
}

const authMiddleware = (store) => (next) => (action) => {
	if (action.type === LOGIN || action.type === REGISTER) {
		if (action && !action.error && action.payload && action.payload.data) {
			setStoredValues(action.payload.data)
		}
	} else if (action.type === LOGOUT) {
		emptyStoredValues()
	} else if (action.type === APP_LOAD) {
		if (action.error) {
			emptyStoredValues();
		}
		if(action.payload == null && action.token == "") {
			emptyStoredValues();
		}
	}

	next(action);
}

export default authMiddleware;