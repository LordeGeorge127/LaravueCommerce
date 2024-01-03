export function setUser(state, user) {
    state.user.data = user;
}

export function setToken(state, token) {
    state.user.token = token;
    if (token) {
        sessionStorage.setItem('TOKEN', token);
    } else {
        sessionStorage.removeItem('TOKEN');
    }
}

// export function setProducts(state,[loading, response= {}]){
//     state.products.loading = loading;
//     state.products.data = response.data
// }
export function setProducts(state, [loading, response = null]) {
    if (response) {
        // debugger
        state.products = {
            data: response.data,
            links: response.meta.links,
            from: response.meta.from,
            to: response.meta.to,
            limit: response.meta.per_page,
            total: response.meta.total,
            page: response.meta.current_page
        }
    }
    state.products.loading = loading;
    // state.products.data = response.data
}
