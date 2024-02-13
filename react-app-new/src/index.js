import React from 'react';
import ReactDOM from 'react-dom/client';
import { Provider } from 'react-redux';
import { BrowserRouter as Router } from 'react-router-dom';
import { createBrowserHistory } from "history";
import App from './App';
import { store } from './store';
import reportWebVitals from './reportWebVitals';
import 'bootstrap/dist/css/bootstrap.min.css'; 

console.warn = function (...args) {
    console.log(...args);
};
console.info = function (...args) {
    console.log(...args);
};

const history = createBrowserHistory({ window });

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
    <Provider store={store}>
        <App history={history} />
    </Provider>
);
reportWebVitals();