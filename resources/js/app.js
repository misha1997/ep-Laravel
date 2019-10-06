require('./bootstrap');

window.Vue = require('vue');

import App from './components/App'

import LoginButtonComponent from './components/LoginButtonComponent';
import RegisterButtonComponent from './components/RegisterButtonComponent';
import RememberPasswordComponent from './components/RememberPasswordComponent';
import ResetPasswordComponent from './components/ResetPasswordComponent';
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
  components: {
    App,
    LoginButtonComponent,
    RegisterButtonComponent,
    RememberPasswordComponent,
    ResetPasswordComponent,
    SnackBarComponent
  },
  store,
  router,
  mixins: [ withSnackbar ],
  data: () => ({
    drawer: null,
    drawerRight: false,
    editingUser: false,
    logoutLoading: false,
    changingPassword: false,
    updatingUser: false,
    items: [
      { icon: 'home', text: 'Робота з планами', href: '/' },
      { icon: 'file_copy', text: 'Цикли', href: '/cycles' },
      { icon: 'file_copy', text: 'Категорії', href: '/categories' },
      { icon: 'description', text: 'Підкатегорії', href: '/sub-categories' },
      { icon: 'school', text: 'Факультети', href: '/subdivisions' },
      { icon: 'school', text: 'Кафедри', href: '/departments' },
      { icon: 'school', text: 'Предмети', href: '/subjects' },
      { icon: 'assignment', text: 'Користувачі', href: '/users' }
    ]
  }),
  computed: {
    ...mapGetters({
      user: 'user'
    })
  },
  methods: {
    editUser () {
      this.editingUser = true
      this.$nextTick(this.$refs.email.focus)
    },
    updateUser () {
      this.updatingUser = true
      this.$store.dispatch(actions.UPDATE_USER, this.user).then(response => {
        this.showMessage('User modified ok!')
      }).catch(error => {
        console.dir(error)
        this.showError(error)
      }).then(() => {
        this.editingUser = false
        this.updatingUser = false
      })
    },
    updateEmail (email) {
      this.$store.commit(mutations.USER, {...this.user, email})
    },
    updateName (name) {
      this.$store.commit(mutations.USER, {...this.user, name})
    },
    toogleRightDrawer () {
      this.drawerRight = !this.drawerRight
    },
    checkRoles (item) {
      if (item.role) {
        return this.$store.getters.roles.find(function (role) {
          return role == item.role // eslint-disable-line
        })
      }
      return true
    },
    logout () {
      this.logoutLoading = true
      this.$store.dispatch(actions.LOGOUT).then(response => {
        window.location = '/'
      }).catch(error => {
        console.log(error)
      }).then(() => {
        this.logoutLoading = false
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
    },
    changePassword () {
      this.changingPassword = true
      this.$store.dispatch(actions.REMEMBER_PASSWORD, this.user.email).then(response => {
        this.showMessage(`Email sent to change password`)
      }).catch(error => {
        console.dir(error)
        this.showError(error)
      }).then(() => {
        this.changingPassword = false
      })
    }
  }
});
