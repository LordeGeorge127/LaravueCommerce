import {createStore} from "vuex";
import * as actions from './actions.js';
import * as mutations from './mutations.js';
import state from './state.js'

const store = createStore({
    state,
    actions,
    mutations

});
export default store
