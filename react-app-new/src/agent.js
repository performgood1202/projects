import superagentPromise from "superagent-promise";
import _superagent from "superagent";

const superagent = superagentPromise(_superagent, global.Promise);

const API_ROOT = "http://127.0.0.1:8000/api";

let token = null;
const tokenPlugin = (req) => {
	req.set("Content-Type", `application/json`);
	req.set("accept", `application/json`);
  	if (token) {
    	req.set("Authorization", `Bearer ${token}`);
  	}
};

const responseBody = (res) => res.body;


const requests = {
	del: (url) =>
		superagent.del(`${API_ROOT}${url}`)
			.use(tokenPlugin)
			.then(responseBody),
	get: (url) =>	
		superagent.get(`${API_ROOT}${url}`)
			.use(tokenPlugin)
			.then(responseBody),
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
}

const Auth = {
	current: () => requests.get("/auth/info"),
	login: (formData) => requests.post("/auth/login", formData),
	register: (formData) => requests.post("/auth/register", formData),
	ForgotPassword: (formData) => requests.post("/auth/ForgotPassword", formData),
	ResetPassword: (formData) => requests.post("/auth/ResetPassword", formData),
}


export default {
	Auth,
	setToken: (_token) => {
    	token = _token;
  	},
};