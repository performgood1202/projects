import React from 'react';
const ThemeContext = React.createContext();


// custom hook for dispatch trigger;
function CustomHook() {
	
   		const changeOrderCount = (request, progress) => {}

   		return { changeOrderCount };
}

export default CustomHook;