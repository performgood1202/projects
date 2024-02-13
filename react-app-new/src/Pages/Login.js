import React, { Component, useEffect, useState,setState, Fragment } from 'react';
import { connect } from 'react-redux';
import { Badge } from 'react-bootstrap';
import { Container, Row, Col, Image, Button } from 'react-bootstrap';
import agent from "../agent";
import { useNavigate  } from 'react-router-dom';


import {
    UPDATE_FIELD_AUTH,
    LOGIN,
    CLEAR_ERRORS,
    LOGIN_PAGE_UNLOADED,
} from "../constants/actionTypes";

const mapStateToProps = (state) => ({
    ...state,
    loginSuccess: state.common.loginSuccess,
    loginError: state.common.loginError,
});
const mapDispatchToProps = (dispatch) => ({
    onSubmit: (values) => {
      dispatch({ type: LOGIN, payload: agent.Auth.login(values) });
    },
    clearErrors: () => {
      dispatch({ type: CLEAR_ERRORS });
    }
});

const Register = (props) => {
    const navigate = useNavigate();

    const { currentUser,errors, loginError, loginSuccess, clearErrors, onSubmit, inProgress, history } = props;

    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [showPassowrd, setShowPassword] = useState(false);
    const [loginErrsss, setLoginErr] = useState([]);
    const [loginSuccesssss, setLoginSucces] = useState(null);

    const [state, setState] = useState({
      email: "",
      password: "",
    });

    const handleInputChange = (event) => {
      const { name, value } = event.target;
      setState((prevProps) => ({
        ...prevProps,
        [name]: value
      }));
    };

    const submitForm = (e) => {
      e.preventDefault();
      setLoginErr([]);
      setLoginSucces("");

      clearErrors();
      onSubmit({ email: state.email, password: state.password});
    };

    useEffect(() => {
      if(loginError) {
        setLoginErr(loginError);
      }
    }, [loginError])

    useEffect(() => {
      if(loginSuccess) {
        navigate('/home');
        setLoginSucces(loginSuccess);
      }
    }, [loginSuccess])

   

    return (
      <section className="login-page">
        <div className="container">
          <div className="row justify-content-center">
            <div className="col-sm-6">

                {loginErrsss && Object.keys(loginErrsss).length > 0 ? ( 
                  <ul className="error-messages">
                    {Object.keys(loginErrsss).map((key,value) => {
                      debugger;

                      return (
                        <li key={key}>
                          {loginErrsss[key]}
                        </li>
                      );
                    })}
                  </ul>
                ) : null}
                {loginSuccesssss && loginSuccesssss != "" ? ( 
                  <ul className="success-messages">
                    <li>
                      {loginSuccesssss}
                    </li>
                  </ul>
                ) : null}

              <div className="login-form">
                <h6 className="mb-4">Login</h6>
                <form onSubmit={submitForm}>
                  
                  <div className="form-control">
                    <label>Email</label>
                    <input
                      type="text"
                      name="email"
                      value={state.email}
                      onChange={handleInputChange}
                    />
                  </div>
                  <div className="form-control">
                    <label>Password</label>
                    <input
                      type="password"
                      name="password"
                      value={state.password}
                      onChange={handleInputChange}
                    />
                  </div>
                  
                  <div className="form-control">
                    <label></label>
                    <button type="submit">Login</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
    )
}



export default connect(mapStateToProps,mapDispatchToProps)(Register);