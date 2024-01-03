import axiosClient from "../axios.js";
// export function getUser({commit}){
//     return axiosClient.get('/user')
//         .then({response}=>{
//             debugger;
//             commit('setUser',response.data)
//             return response;
//         })
// }
export function getUser({commit},data){
    return axiosClient.get('/user',data)
        .then(({data})=>{
            // debugger;
            commit('setUser',data)
            return data;
        })
}
export function login({commit},data) {
    return axiosClient.post('/login',data)
        .then(({data})=>{commit('setUser',data.user);
            commit('setToken',data.token);
            return data;
        })
}
export function logout({commit}){
    return axiosClient.post('/logout')
        .then((response)=>{
            commit('setToken',null)
            return response;
        })
}
