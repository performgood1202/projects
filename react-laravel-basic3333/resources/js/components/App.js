import React, { Suspense, useEffect } from "react";
import { connect } from "react-redux";
import { Route, Routes, Redirect, useLocation, useNavigate } from "react-router-dom";
import { deviceType, osName, withOrientationChange } from "react-device-detect";
import { Container } from 'react-bootstrap';

import {
  	APP_LOAD,
  	INFO,
  	REMOVE_REDIRECT
} from "../constants/type";

import apis from "../apis";
import Header from './Header';

import Login from "./Login";
import Home from "./Home";
import Dashboard from "./Dashboard";
import Profile from "./Profile";

const mapStateToProps = (state) => ({
	appLoaded: state.common.appLoaded,
	currentUser: state.common.currentUser,
	redirectTo: state.common.redirectTo,
});

const mapDispatchToProps = (dispatch) => ({
	onLoad: (token) => dispatch({ type: APP_LOAD, payload: apis.Auth.current(), token, skipTracking: true }),
	emptyRedirect: () => dispatch({ type: REMOVE_REDIRECT }),
});

const AppComponent = (props) => {
	const { appLoaded, currentUser, onLoad, redirectTo, emptyRedirect } = props;
	const navigate = useNavigate();

	useEffect(() => {
		const token = window.localStorage.getItem("jwt");
		if (token) {
      		apis.setToken(token);
    	}
    	if(!currentUser) {
    		onLoad(token);
    	}
	}, [currentUser]);

	useEffect(() => {
		if (redirectTo) {
      		navigate(redirectTo, { replace: true });
      		emptyRedirect()
    	}
	}, [redirectTo]);

	let headerProps = {
		currentUser
	}

	return (
		<React.Fragment>
			{appLoaded ? (
				<React.Fragment>
					<Header {...headerProps} />
					<Container>
						<Routes>
							<Route exact path="/" element={<Home />} />
							{currentUser ? (
								<React.Fragment>
									<Route path="/dashboard" element={<Dashboard />} />
									<Route path="/profile" element={<Profile />} />
								</React.Fragment>
							) : (
								<React.Fragment>
									<Route path="/login" element={<Login />} />
								</React.Fragment>
							)}

							<Route path="*" element={<Home />} />
						</Routes>
					</Container>
				</React.Fragment>
			) : (
				<div className="loading-spinner" />
			)}
		</React.Fragment>
  	);
};

const App = withOrientationChange(AppComponent);

export default connect(mapStateToProps, mapDispatchToProps)(App);