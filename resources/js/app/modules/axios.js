import axios from 'axios'
import { getToken } from './apiToken'

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.headers.common['Authorization'] = 'Bearer ' + getToken();
export default axios;

