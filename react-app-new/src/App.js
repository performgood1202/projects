import React, { Suspense, useEffect } from "react";
import { BrowserRouter, Routes, Switch, Route, withRouter } from "react-router-dom";
import { connect } from 'react-redux';
import Home from "./Pages/Home";
import Register from "./Pages/Register";
import Login from "./Pages/Login";
import Layout from "./Pages/Layout/";
import agent from "./agent";

import {
    APP_LOAD,
    CLEAR_LOGOUT
} from "./constants/actionTypes";

const mapStateToProps = (state) => ({
  ...state,
  appLoaded: state.common.appLoaded,
  currentUser: state.common.currentUser,
  redirectTo: state.common.redirectTo,
});

const mapDispatchToProps = (dispatch) => ({
  onAppLoad: (payload, token) => dispatch({ type: APP_LOAD, payload, token, skipTracking: true }),
});

const AppComponent = (props) => {
  const { appLoaded, currentUser, onLoad, onAppLoad, redirectTo, emptyRedirect } = props;
  useEffect(() => {
    let token = null, _payload = null;

    if(localStorage.getItem('token')) {
      token = localStorage.getItem('token');
      agent.setToken(token);
      _payload = agent.Auth.current();
    }

    onAppLoad(_payload, token);
  }, []);


  return (
      <BrowserRouter>
        {appLoaded ?
          (<Layout>
            <Routes>
                <Route path="/">
                  <Route index element={<Home />} />
                  <Route path="/register" element={<Register />} />
                  <Route path="/login" element={<Login />} />
                </Route>
            </Routes>
          </Layout>):''}

      </BrowserRouter>
  );
}

export default connect(mapStateToProps,mapDispatchToProps)(AppComponent);
