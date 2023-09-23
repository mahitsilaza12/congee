import axios from 'axios'
const Config = axios.create({
    baseURL: 'http://localhost:8000'
});

export default Config;