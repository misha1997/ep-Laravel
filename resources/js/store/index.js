import Vue from 'vue'
import Vuex from 'vuex'
import auth from './modules/auth'
import snackbar from './modules/snackbar'
import users from './modules/users'
import plan from './modules/plan'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
  modules: {
    auth,
    snackbar,
    users,
    plan
  },
  strict: debug
})
