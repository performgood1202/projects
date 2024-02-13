import React, { Component } from "react";
import { connect } from 'react-redux';
import { withRouter } from 'react-router';
import Header from './header'
import Footer from './footer'


const Layout = ({ children }) => {
    return (
      <>
        <Header/>
           <main>{children}</main>
        <Footer />
      </>
    );
}
export default Layout