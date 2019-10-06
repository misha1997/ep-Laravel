import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from './components/HomeComponent';
import Cycles from './components/CyclesComponent';
import Categories from './components/CategoriesComponent';
import Departments from './components/DepartmentsComponent';
import SubCategories from './components/SubCategoriesComponent';
import Subdivisions from './components/SubdivisionsComponent';
import Subjects from './components/SubjectsListComponent';
import Users from './components/UsersComponent';

import Detail from './components/EducationPlan/Detail';
import Table from './components/EducationPlan/Table';

Vue.use(VueRouter);

export default new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/cycles',
      name: 'cycles',
      component: Cycles
    },
    {
      path: '/categories',
      name: 'categories',
      component: Categories
    },
    {
      path: '/subdivisions',
      name: 'subdivisions',
      component: Subdivisions
    },
    {
      path: '/sub-categories',
      name: 'sub-categories',
      component: SubCategories
    },
    {
      path: '/subjects',
      name: 'subjects',
      component: Subjects
    },
    {
      path: '/departments',
      name: 'departments',
      component: Departments
    },
    {
      path: '/users',
      name: 'users',
      component: Users
    },
    {
      path: '/:id',
      name: 'plan-detail',
      component: Detail,
    }
  ]
});
