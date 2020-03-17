const getToken = () => {
    return document.querySelector('meta[name="csrf-token"]').attributes.content.value
}

const setToken = (token) => {
    localStorage.setItem('api_token', token)
}

export  { getToken, setToken }
