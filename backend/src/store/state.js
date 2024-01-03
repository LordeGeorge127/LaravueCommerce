import {createStore} from "vuex";
import * as actions from './actions.js';
import * as mutations from './mutations.js';

const state = {
    user: {
        token:sessionStorage.getItem('TOKEN'),
        data:{}
    },
    products:{
        loading: false,
        data:[],

        links:[],
        from:null,
        to:null,
        page:1,
        limit:null,
        total:null
    }

};
export default state
