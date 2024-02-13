import React, { Component, useEffect, useState,setState, Fragment } from 'react';
import { connect } from 'react-redux';
import { Badge } from 'react-bootstrap';
import { Container, Row, Col, Image, Button } from 'react-bootstrap';
import agent from "../agent";

import {
    UPDATE_FIELD_AUTH,
    REGISTER,
    CLEAR_ERRORS,
    LOGIN_PAGE_UNLOADED,
} from "../constants/actionTypes";

const mapStateToProps = (state) => ({
    ...state,
    registerSuccess: state.common.registerSuccess,
    registerError: state.common.registerError,
});
const mapDispatchToProps = (dispatch) => ({
    onSubmit: (values) => {
      dispatch({ type: REGISTER, payload: agent.Auth.register(values) });
    },
    clearErrors: () => {
      dispatch({ type: CLEAR_ERRORS });
    }
});

const Register = (props) => {

    const { currentUser,errors, registerError, registerSuccess, clearErrors, loginError, onSubmit, inProgress } = props;

    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [showPassowrd, setShowPassword] = useState(false);
    const [registerErrsss, setRegisterErr] = useState([]);
    const [registerSuccesssss, setRegisterSucces] = useState(null);

    const [state, setState] = useState({
      name: "",
      email: "",
      password: "",
      password_confirmation: ""
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
      setRegisterErr([]);
      setRegisterSucces("");

      clearErrors();
      onSubmit({ name : state.name, email: state.email, password: state.password, password_confirmation: state.password_confirmation});
    };

    useEffect(() => {
      if(registerError) {
        setRegisterErr(registerError);
      }
    }, [registerError])

    useEffect(() => {
      if(registerSuccess) {
        debugger;
        setRegisterSucces(registerSuccess);
      }
    }, [registerSuccess])

   

    return (
      <section className="login-page">
        <div className="container">
          <div className="row justify-content-center">
            <div className="col-sm-6">

                {registerErrsss && Object.keys(registerErrsss).length > 0 ? ( 
                  <ul className="error-messages">
                    {Object.keys(registerErrsss).map((key,value) => {
                      debugger;

                      return (
                        <li key={key}>
                          {registerErrsss[key]}
                        </li>
                      );
                    })}
                  </ul>
                ) : null}
                {registerSuccesssss && registerSuccesssss != "" ? ( 
                  <ul className="success-messages">
                    <li>
                      {registerSuccesssss}
                    </li>
                  </ul>
                ) : null}

              <div className="login-form">
                <h6 className="mb-4">Register</h6>
                <form onSubmit={submitForm}>
                  <div className="form-control">
                    <label>Name</label>
                    <input
                      type="text"
                      name="name"
                      value={state.name}
                      onChange={handleInputChange}
                    />
                  </div>
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
                    <label>Confirm Password</label>
                    <input
                      type="password"
                      name="password_confirmation"
                      value={state.password_confirmation}
                      onChange={handleInputChange}
                    />
                  </div>
                  <div className="form-control">
                    <label></label>
                    <button type="submit">Register</button>
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