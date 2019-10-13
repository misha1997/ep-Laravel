require('./bootstrap');

window.Vue = require('vue');

import AppComponent from './components/App'

import LoginComponent from './components/LoginComponent';
import SnackBarComponent from './components/SnackBarComponent';

window.Vuetify = require('vuetify');
import 'vuetify/dist/vuetify.min.css';
Vue.use(Vuetify)

import VueRouter from 'vue-router';

Vue.use(VueRouter);

import store from './store'
import router from './routes'
import * as actions from './store/action-types'
import * as mutations from './store/mutation-types'

import { mapGetters } from 'vuex'
import withSnackbar from './components/mixins/withSnackbar'

if (window.user) {
  store.commit(mutations.USER,  user)
  store.commit(mutations.LOGGED, true)
}

const app = new Vue({
  el: '#app',
  loginLoading: false,
  components: {
    AppComponent,
    LoginComponent,
    SnackBarComponent
  },
  store,
  router,
  mixins: [ withSnackbar ],
  data: () => ({
    drawer: null,
    logoutLoading: false,
    items: [
      { icon: 'home', text: 'Робота з планами', href: '/' },
      { icon: 'file_copy', text: 'Цикли', href: '/cycles' },
      { icon: 'file_copy', text: 'Категорії', href: '/categories' },
      { icon: 'description', text: 'Підкатегорії', href: '/sub-categories' },
      { icon: 'school', text: 'Факультети', href: '/subdivisions' },
      { icon: 'school', text: 'Кафедри', href: '/departments' },
      { icon: 'school', text: 'Предмети', href: '/subjects' },
      { icon: 'assignment', text: 'Користувачі', href: '/users', role: 'admin' }
    ]
  }),
  computed: {
    ...mapGetters({
      user: 'user'
    })
  },
  methods: {
    checkRoles (item) {
      if (item.role == this.$store.state.auth.user.role || !item.role) {
        return true
      }
      return false
    },
    logout () {
      this.logoutLoading = true;
      this.$store.dispatch(actions.LOGOUT).then(() => {
        window.location = '/'
      }).catch(() => {
        window.location = '/'
      })
    },
    menuItemSelected (item) {
      if (item.href) {
        if (item.new) {
          window.open(item.href)
        } else {
          window.location.href = item.href
        }
      }
    }
  }
});
