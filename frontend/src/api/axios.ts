import axios from 'axios'

const axiosInstance = axios.create({
    baseURL: import.meta.env.VITE_API_BASE_URL,  // Accessing the env variable for baseURL
    timeout: Number(import.meta.env.VITE_API_TIMEOUT),  // Accessing the env variable for timeout
})

axiosInstance.defaults.headers.common['Content-Type'] = 'application/json'
axiosInstance.defaults.headers.common['Accept'] = 'application/json'

// Add a request interceptor
axiosInstance.interceptors.request.use(
    (config) => {
        const token = localStorage.getItem('token')
        if (token && config.headers) {
            // Ensure the Authorization header is set for every request
            config.headers['Authorization'] = `Bearer ${token}`
        }
        return config
    },
    (error) => {
        return Promise.reject(error)
    },
)

// Add a response interceptor to handle 401 errors
axiosInstance.interceptors.response.use(
    (response) => response,
    async (error) => {
        if (error.response?.status === 401) {
            // Clear token and redirect to login if unauthorized
            localStorage.removeItem('token')
            window.location.href = '/'
        }
        return Promise.reject(error)
    },
)

export default axiosInstance
