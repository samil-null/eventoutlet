const getToken = () => {
    return localStorage.getItem('api_token');
}

const setToken = (token) => {
    localStorage.setItem('api_token', token)
}

export  { getToken, setToken }
