// export function request(method, url, data = {}) {
// return fetch(url,{
//     method,
//     headers: {
//         'Content-Type':'application/json',
//         'Accept':'application/json',
//         'X-CSRF-TOKEN':document.head.querySelector('meta[name=csrf-token]').content
//     },
//     ...(method === 'get' ? {} : {body:JSON.stringify(data)})
////Promise return then we check
// }).then(async (response)=>{
//     if (response.status >= 200 && response.status < 300){
//         console.log(response)
//         return response.json();
//     }
//     throw await response.json();
// })
// }
//
// export function get(url) {
//     return request('get', url)
// }
//
// export function post(url, data) {
//     return request('post', url, data)
// }
import axios from 'axios';

export function request(method, url, data = {}) {
    const csrfToken = document.head.querySelector('meta[name=csrf-token]').content;
    const headers = {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': csrfToken
    };

    return axios({
        method,
        url,
        headers,
        ...(method.toLowerCase() === 'get' ? {} : { data })
    }).then(response => {
        console.log(response);
        return response.data;
    }).catch(error => {
        throw error.response.data;
    });
}

export function get(url) {
    return request('get', url);
}

export function post(url, data) {
    return request('post', url, data);
}
