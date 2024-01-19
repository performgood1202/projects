import React, { useEffect, useState } from "react";
import { connect } from "react-redux";
import { useNavigate } from "react-router-dom";
import apis from "../../apis";
import { LOGIN } from "../../constants/type";

const mapStateToProps = (state) => ({
	loginSuccess: state.common.loginSuccess
});

const mapDispatchToProps = (dispatch) => ({
	submitLogin: (data) => dispatch({ type: LOGIN, payload: apis.Auth.login(data) }),
});


const MainView = (props) => {
	const { submitLogin, loginSuccess, tokenVal } = props;
	const history = useNavigate();

  	const [processing, setProcessing] = useState(false);
  	const [email, setEmail] = useState('');
  	const [password, setPassword] = useState('');

  	const handleSubmit = async (e) => {
  		e.preventDefault();
  		setProcessing(true)
  		await submitLogin({email, password});
  	}

  	useEffect(() => {
  		if(loginSuccess) {
  			history('/dashboard', { replace: true });
  		} 
  		setProcessing(false);
  	}, [loginSuccess])

  	return (
	    <div className="login-page">
	    	<h3>Login</h3>
	      	<div className="form-container">
	      		<form className="login" onSubmit={handleSubmit}>
	              	<fieldset>
	              		<div className="form-group row">
		              		<div className="col-md-12 mb-2">
	                        	<label className="required">Email</label>
		                        <input
		                          	name="email"
		                          	className="form-control form-control-md"
		                          	type="email"
		                          	value={email}
		                          	onChange={(e) => {
			                            setEmail(e.currentTarget.value);
		                          	}}
		                          	autoComplete={"off"}
		                        />
	                      	</div>
	                      	<div className="col-md-12 mb-2">
	                        	<label className="required">Password</label>
		                        <input
		                          	name="password"
		                          	className="form-control form-control-md"
		                          	type="password"
		                          	value={password}
		                          	onChange={(e) => {
			                            setPassword(e.currentTarget.value);
		                          	}}
		                          	autoComplete={"off"}
		                        />
	                      	</div>
	                    
		                    <div className="col-md-12 mb-2 button-div">
			                    <button
			                    	type="submit"
			                    	disabled={processing}
					                className="btn btn-primary ml-4"
				              	>
				                	Login {processing ? ( <span /> ) : ( <React.Fragment /> )}
				              	</button>
			              	</div>
		              	</div>
	              	</fieldset>
              	</form>
	      	</div>
	    </div>
  	);
};

export default connect(mapStateToProps, mapDispatchToProps)(MainView);