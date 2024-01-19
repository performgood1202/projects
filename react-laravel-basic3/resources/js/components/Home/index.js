import React, { useEffect } from "react";
import { connect } from "react-redux";
import MainView from "./MainView";
import "./style.scss";

const mapStateToProps = (state) => ({});

const mapDispatchToProps = (dispatch) => ({});


const Home = (props) => {
  	let mainProps = {}

  	return (
	    <div className="view-container home-view">
	      	<MainView {...mainProps} />
	    </div>
  	);
};

export default connect(mapStateToProps, mapDispatchToProps)(Home);