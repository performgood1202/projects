import superagentPromise from "superagent-promise";
import _superagent from "superagent";
import { processUploading } from './actions/actions';


const superagent = superagentPromise(_superagent, global.Promise);
const API_ROOT = '/api/v1';

// response values.
const responseBody = (res) => res.body;
const errorResponseBody = (err) => {
  return 'error'
};

// setting up tokens.
let token = null;
const tokenPlugin = (req) => {
  	if (token) {
    	req.set("authorization", `Bearer ${token}`);
  	}
};

// hitting the api's.
const requests = {
	del: (url) =>
    	superagent.del(`${API_ROOT}${url}`).use(tokenPlugin).then(responseBody),
  	get: (url) =>
    	superagent.get(`${API_ROOT}${url}`).use(tokenPlugin).then(responseBody),
  	put: (url, body) =>
    	superagent
	      	.put(`${API_ROOT}${url}`, body)
	      	.use(tokenPlugin)
	      	.then(responseBody),
  	post: (url, body) =>
    	superagent
	      	.post(`${API_ROOT}${url}`, body)
	      	.use(tokenPlugin)
	      	.then(responseBody),
	filePost: (url, body) =>
    	superagent
	      	.post(`${API_ROOT}${url}`, body)
	      	.use(tokenPlugin)
	      	.on('progress', e => {
		        const { loaded, total } = e;
		        const percentageProgress = Math.floor((loaded/total) * 100)
		        processUploading(percentageProgress)
	      	})
	      	.then(responseBody)
	      	.catch(errorResponseBody),
}

const Auth = {
	current: (formData) => requests.get("/info"),
	login: (formData) => requests.post("/auth/login", formData),
	logout: (formData) => requests.get("/auth/logout", formData),
}

export default {
	Auth,
	setToken: (_token) => {
    	token = _token;
  	},
};