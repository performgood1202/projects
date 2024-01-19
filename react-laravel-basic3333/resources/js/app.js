import ReactDOM from 'react-dom';
import { Provider } from 'react-redux';
import React from 'react';
import { store, history } from './store';
import { Route, Routes, BrowserRouter } from 'react-router-dom';

import App from './components/App';
import './assets/scss/style.scss';

console.log = function (...args) {
  	console.dir(...args);
};
console.error = function (...args) {
  	console.log(...args);
};
console.warn = function (...args) {
  	console.log(...args);
};
console.info = function (...args) {
  	console.log(...args);
};

ReactDOM.render((
	<React.StrictMode>
	  	<Provider store={store}>
		    <BrowserRouter history={history}>
		      	<App />
		    </BrowserRouter>
	  	</Provider>
	</React.StrictMode>

), document.getElementById('root'));
