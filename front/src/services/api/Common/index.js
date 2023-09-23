import env from "../../../../env.js"
const base_url = env.API_BASE_URL + "/api";

export default  {
    login_check     :   `${base_url}/login_check`,
    token_check     :   `${base_url}/user/token/check`,
    register        :   `${base_url}/register`,
    logout          :   `${base_url}/logout`
}