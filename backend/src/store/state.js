import {createStore} from "vuex";
import * as actions from './actions.js';
import * as mutations from './mutations.js';

const state = {
    user: {
        token:sessionStorage.getItem('TOKEN'),
        data:{}
    }

};
export default state
