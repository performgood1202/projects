import React, { useEffect } from "react";
import { connect } from "react-redux";
import apis from "../../apis";
import { LOGIN } from "../../constants/type";

const mapStateToProps = (state) => ({
	loginSuccess: state.common.loginSuccess
});

const mapDispatchToProps = (dispatch) => ({
	updateOrgsList: (data) => dispatch({ type: LOGIN, payload: apis.auth.login(data) }),
});


const MainView = (props) => {
  	let mainProps = {}

  	return (
	    <div>
	      	Home Page
	    </div>
  	);
};

export default connect(mapStateToProps, mapDispatchToProps)(MainView);