import { applyMiddleware, createStore } from "redux";
import { createLogger } from "redux-logger";
import { composeWithDevTools } from 'redux-devtools-extension/developmentOnly';
import reducer from "./reducer";

import { routerMiddleware, push } from "react-router-redux";
import { createBrowserHistory } from "history";

import { promiseMiddleware, localStorageMiddleware } from "./middlewares/middleware";

export const history = createBrowserHistory();

// Build the middleware for intercepting and dispatching navigation actions
const myRouterMiddleware = routerMiddleware(history);

const getMiddleware = () => {
  	return applyMiddleware(
  		promiseMiddleware,
  		myRouterMiddleware,
  		localStorageMiddleware,
  		// createLogger()
  	);
};

export const store = createStore(reducer, composeWithDevTools(getMiddleware()));