import axiosClient from "../axios.js";
// export function getUser({commit}){
//     return axiosClient.get('/user')
//         .then({response}=>{
//             debugger;
//             commit('setUser',response.data)
//             return response;
//         })
// }
export function getUser({commit}, data) {
    return axiosClient.get('/user', data)
        .then(({data}) => {
            // debugger;
            commit('setUser', data)
            return data;
        })
}

export function login({commit}, data) {
    return axiosClient.post('/login', data)
        .then(({data}) => {
            commit('setUser', data.user);
            commit('setToken', data.token);
            return data;
        })
}

export function logout({commit}) {
    return axiosClient.post('/logout')
        .then((response) => {
            commit('setToken', null)
            return response;
        })
}

// export  function getProducts({commit}) {
//     commit('setProducts',[true]);
//     return axiosClient.get('product')
//         .then(res =>{
//             commit('setProducts',[false, res.data])
//         })
//         .catch(()=>{
//             commit('setProducts',[false])
//         })
// }
export function getProducts({commit}, {url = null, search = '', perPage = 10, sort_field, sort_direction} = {}) {
    commit('setProducts', [true]);
    url = url || '/products';
    return axiosClient.get(url, {
        params: {
            search,
            per_page: perPage,
            sort_field,
            sort_direction
        }
    })
        .then(res => {
            commit('setProducts', [false, res.data])
        })
        .catch(() => {
            commit('setProducts', [false])
        })
}

export function createProduct({commit}, product) {
    // debugger
    if (product.image instanceof File) {
        let form = new FormData();
        form.append('title', product.title);
        form.append('image', product.image);
        form.append('description', product.description);
        form.append('price', product.price);
        product = form;
        // console.log(form)
    }
    return axiosClient.post('/products', product)
}

export function updateProduct({commit}, product) {
    const id = product.id;
    if (product.image instanceof File) {
        const form = new FormData();
        form.append('id', product.id);
        form.append('title', product.title);
        form.append('image', product.image);
        form.append('description', product.description);
        form.append('price', product.price);
        form.append('_method', 'PUT');
        product = form;
    } else {
        product._method = 'PUT';
    }
    return axiosClient.post(`/products/${id}`, product);
}
export function getProduct({},id){
return axiosClient.get(`/products/${id}`);
}

export function deleteProduct({commit}, id) {
    return axiosClient.delete(`/products/${id}`)
}
