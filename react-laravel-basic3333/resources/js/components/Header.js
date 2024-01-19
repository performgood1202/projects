import React, { useEffect, useState } from "react";
import { connect } from "react-redux";
import { useNavigate, Link } from "react-router-dom";
import { Navbar, Nav, Container, NavDropdown } from 'react-bootstrap';

import { LOGOUT } from '../constants/type'

import logo from '../assets/images/logo.svg';
import apis from "../apis";

const mapStateToProps = (state) => ({});

const mapDispatchToProps = (dispatch) => ({
	logout: (token) => dispatch({ type: LOGOUT, payload: apis.Auth.logout() }),
});


const Header = (props) => {
	const { currentUser, logout } = props;

  	return (
	    <React.Fragment>
	    	<Navbar bg="light" expand="lg" className="custom-headers">
				<Container>
					<Link path="/" to="/"><Navbar.Brand><img src={logo} /></Navbar.Brand></Link>
					<Navbar.Toggle aria-controls="basic-navbar-nav" />
					<Navbar.Collapse id="basic-navbar-nav">
						<Nav className="me-auto link-options">
							<Nav.Link><Link path="/about" to="/about">About</Link></Nav.Link>
							{currentUser ? (
								<React.Fragment>
									<Nav.Link><Link path="/dashboard" to="/dashboard">Dashboard</Link></Nav.Link>
									<NavDropdown title="Dropdown" id="basic-nav-dropdown">
										<NavDropdown.Item><Link path="/profile" to="/profile">Profile</Link></NavDropdown.Item>
										<NavDropdown.Item onClick={logout}>Logout</NavDropdown.Item>
									</NavDropdown>
								</React.Fragment>
							) : (
								<React.Fragment>
									<Nav.Link><Link path="/login" to="/login">Login</Link></Nav.Link>
								</React.Fragment>
							)}
						</Nav>
					</Navbar.Collapse>
				</Container>
			</Navbar>
	    </React.Fragment>
  	);
};

export default connect(mapStateToProps, mapDispatchToProps)(Header);