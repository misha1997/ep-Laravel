<template>
  <div class="mb-5">
    <v-toolbar dark color="primary mb-4">
      <v-toolbar-title>{{ plan.name }}</v-toolbar-title>
      <v-spacer></v-spacer>
    </v-toolbar>

    <distributionOfLearning></distributionOfLearning>
    <creation-item></creation-item>
    <modules-form></modules-form>

    <v-btn color="info" class="mx-0" @click="viewHome('/')">Перейти до роботи з планами</v-btn>
    <v-btn color="info" class="mx-0" @click="openTable()">Переглянути</v-btn>
    <v-btn color="info" class="mx-0" @click="clonePlan()">Створити план за шаблоном</v-btn>
    <v-btn color="info" class="mx-0" v-if="status == 'cloned'" @click="clonePlan()">Зробити копію плану</v-btn>

    <v-btn class="mx-0" @click="sendVerify()">Відправити на верифікацію</v-btn>

    <v-btn color="info right" class="mx-1" @click="verify()">Підтвердити</v-btn>
    <v-btn color="info right" class="mx-1" @click="refinement()">Відправити на доопрацювання</v-btn>

    <div v-for="cycles in data" :key="cycles.cycles_id" class="mt-4">
      <h3 class="text-md-center">{{ cycles.name.toUpperCase() }}</h3>
      <Cycles :cycle="cycles" :status="status" v-if="cycles.categories.length == 0"></Cycles>
      <div v-for="category in cycles.categories" :key="category.id" class="mt-3 mb-4">
        <h3 class="text-md-center">{{ category.name }}</h3>
          <Category :category="category" :status="status" v-if="category.subcategory.length == 0"></Category>
          <div v-for="subcategory in category.subcategory" :key="subcategory.sub_category_id" class="mt-3 mb-4">
            <h4 class="text-md-center">{{ subcategory.name }}</h4>
              <SubCategory :subCategory="subcategory" :status="status"></SubCategory>
          </div>
      </div>
    </div>
  </div>
</template>

<script>

  import {mapGetters, mapMutations} from 'vuex';
  import snackbar from '../mixins/withSnackbar';

  import DistributionOfLearning from './Forms/DistributionOfLearning';
  import CreationItem from './Forms/CreationItem';
  import ModulesForm from './Forms/ModulesForm';
  import SubCategory from './SubCategory';
  import Category from './Category';
  import Cycles from './Cycles';

  export default {

    mixins: [snackbar],

    components: {
      SubCategory,
      Category,
      Cycles,
      CreationItem,
      ModulesForm,
      DistributionOfLearning
    },

    data(){
      return {
        data: [],
        plan: '',
        status: ''
      }
    },

    computed:{
      ...mapGetters({
        'snackbarTimeout': 'snackbarTimeout',
        'getEducationPlanId': 'plan/getEducationPlanId'
      }),
    },

    created(){
      this.fetchData();
    },

    methods: {

      ...mapMutations({
        'setEducationPlanId': 'plan/setEducationPlanId',
        'setEducationItems': 'plan/setEducationItems'
      }),

      fetchData(){
        this.setEducationPlanId(parseInt(this.$route.params.id));
        if(this.getEducationPlanId){
          axios.get(`plan-items/${this.$route.params.id}`).then((response)=>{
            this.plan = response.data.plan[0];
            this.data = response.data.data;
            this.setEducationItems(response.data.educationItems);
          })
          .catch((err)=>{
            this.showError(err);
          })
        }
      },

      openTable(){
        this.$router.push(`view/${this.getEducationPlanId}`);
      },

      clonePlan(){
        axios.post(`clone-plan`, {
          plan: this.plan,
          user_id : 1
        }).then((res) => {
          this.showMessage("Навчальний план склоновано");
        })
      },

      sendVerify(){
        axios.post(`change-status/${this.plan.id}`, {
          status: 'На перевірці'
        }).then(() => {
          this.showMessage("Навчальний план відправлено на верифікацію");
        })
      },

      verify(){
        axios.post(`change-status/${this.plan.id}`, {
          status: 'Верифіковано'
        }).then(() => {
          this.showMessage("Навчальний план верифіковано");
        })
      },

      refinement(){
        axios.post(`change-status/${this.plan.id}`, {
          status: 'На доопрацюванні'
        }).then(() => {
          this.showMessage("Навчальний план відправлено на доопрацювання");
        })
      },

      viewHome(link){
        this.$router.push(link);
      }
    }
  }

</script>
