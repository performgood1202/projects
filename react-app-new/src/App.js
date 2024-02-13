import Home from "./Pages/Home";
import Register from "./Pages/Register";
import Login from "./Pages/Login";
import Layout from "./Pages/Layout/";
import { BrowserRouter, Routes, Switch, Route, withRouter } from "react-router-dom";

function App() {
  return (
      <BrowserRouter>
        <Layout>
          <Routes>
              <Route path="/">
                <Route index element={<Home />} />
                <Route path="/register" element={<Register />} />
                <Route path="/login" element={<Login />} />
              </Route>
          </Routes>
        </Layout>
      </BrowserRouter>
  );
}

export default App;
