import {createStore} from "vuex";
import * as actions from './actions.js';
import * as mutations from './mutations.js';

const store = createStore({
    state:{
        user: {
            token:sessionStorage.getItem('TOKEN'),
            data:{}
        }
    },
    actions,
    mutations

});
export default store
