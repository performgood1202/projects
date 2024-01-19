import React, { useEffect } from "react";
import { connect } from "react-redux";
import MainView from "./MainView";
import "./style.scss";
const Promise = global.Promise;

const mapStateToProps = (state) => ({});

const mapDispatchToProps = (dispatch) => ({});


const Login = (props) => {
  	let mainProps = {}

  	return (
	    <div className="view-container login-view">
	      	<MainView {...mainProps} />
	    </div>
  	);
};

export default connect(mapStateToProps, mapDispatchToProps)(Login);