import React, { Component } from "react";
import { connect,useDispatch, useSelector } from 'react-redux';
import { withRouter } from 'react-router';
import { Link } from "react-router-dom";
import {
    LOGOUT,
    CLEAR_LOGOUT
} from "../../constants/actionTypes";
const mapStateToProps = (state) => ({
  ...state,
  currentUser: state.common.currentUser,
  redirectTo: state.common.redirectTo,
});

const mapDispatchToProps = (dispatch) => ({
   onSignOut: () => { dispatch({ type: LOGOUT }) },
});

const Header = (props) => {

    const { appLoaded, onSignOut, currentUser, onLoad, onAppLoad, redirectTo, emptyRedirect } = props;


    const logout = () => {
      onSignOut();
    };

    return (
        <div>
      <nav className='navbar navbar-expand-lg bg-light'>
        <div className='container-fluid'>
          <a className='navbar-brand' href='/'>
            ChrisDevCode
          </a>
          <button
            className='navbar-toggler'
            type='button'
            data-bs-toggle='collapse'
            data-bs-target='#navbarSupportedContent'
            aria-controls='navbarSupportedContent'
            aria-expanded='false'
            aria-label='Toggle navigation'
          >
            <span className='navbar-toggler-icon' />
          </button>
          <div className='collapse navbar-collapse' id='navbarSupportedContent'>
            <ul className='navbar-nav me-auto mb-2 mb-lg-0'>
              <li className='nav-item'>
                <Link className='nav-link' to="/">Home</Link>
              </li>
              {(!currentUser)?
                (
                  <>
                    <li className='nav-item'>
                      <Link className='nav-link' to="/register">Register</Link>
                    </li>
                    <li className='nav-item'>
                      <Link className='nav-link' to="/login">Login</Link>
                    </li>
                  </>):
                  <> 
                    <li className='nav-item'>
                      <Link className='nav-link' onClickCapture={logout}>Logout</Link>
                    </li>
                  </>
              }
            </ul>
          </div>
        </div>
      </nav>
    </div>
    );
}

export default connect(mapStateToProps,mapDispatchToProps)(Header);