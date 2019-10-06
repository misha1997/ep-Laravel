<template>
  <tr>
    <td class="text-center">{{ data.index + 1 }}</td>
        <td class="text-center">{{ data.item.subjects.name }}</td>
        <td class="text-center">{{ data.item.credits }}</td>
        <td class="text-center">{{ data.item.credits*30 }}</td>
        <td class="text-center">{{ data.item.lectures | zeroValue }}</td>
        <td class="text-center">{{ this.amountOfHours - data.item.lectures | zeroValue }}</td>
        <td class="text-center">{{ data.item.laboratories | zeroValue }}</td>
        <td class="justify-center layout px-1 pr-4">
          <v-icon
            title="Лекції/Лабораторні"
            small
            class="mr-2"
            @click="distributionOfLearningForm(data.item.education_item_id)"
          >
          school
          </v-icon>

          <v-icon
            title="Заповнити данні розподілу по модулям" 
            small
            class="mr-2"
            @click="modulesForm(data.item.education_item_id)"
          >
          today
          </v-icon>

          <v-icon
            title="Видалити"
            small
            @click="deleteItem(data.item)"
          >
          delete
          </v-icon>
        </td>
  </tr>
</template>

<script>
  import {mapMutations} from 'vuex';

  import { EventBus } from '../../../event-bus.js';

  export default {
    props: {
      data: {
        type: Object,
        require: true
      }
    },

    filters: {
      zeroValue: function (value) {
        if (value == 0) return ' - '
        return value;
      }
    },

    computed: {
      getDistributionOfHours(){
        return this.data.item.hours;
      },

      isDistributionOfHours(){
        return this.hours != null;
      },

      amountOfHours(){
        return _.sumBy(this.getDistributionOfHours, (item) => {return +item.value}) * 8;
      },

      getLearningData(){
        return {
          lectures: this.data.item.lectures,
          laboratories: this.data.item.laboratories
        }
      }
    },

    methods: {
      ...mapMutations({
        'updateEducationItem': 'plan/updateEducationItem',
        'removeEducationItem': 'plan/removeEducationItem',
        'enableLoading': 'overlay/enableLoading',
        'disableLoading': 'overlay/disableLoading'
      }),

      editItem(){
        EventBus.$emit('toggle-item-form', educationItemId);
      },

      deleteItem (item) {
        let isDelete = confirm('Ви впевнені, що хочете видалити цей елемент?');
        if(isDelete) {
          this.enableLoading();

          axios.delete(`distribution-of-controls/${item.education_item_id}`)
            .then(() => {
              console.log("distribution-of-controls видалений");
            })
            .catch((err) => {
              console.log(err);
            })

          axios.delete(`distribution-of-hours/${item.education_item_id}`)
            .then(() => {
              console.log("distribution-of-hours видалений");
            })
            .catch((err) => {
              console.log(err);
            })

          axios.delete(`education-item/${item.education_item_id}`)
            .then(() => {
              this.removeEducationItem(item.education_item_id);
              successAlert("Запис був видалений");
            })
            .catch((err) => {
              errorAlert(err);
            })
            .then(()=>{
              this.disableLoading();
            })
        }
      },

      modulesForm(educationItemId){ 

        axios.post('education-item', {
          id: this.data.item.education_plans_id
        }).then((res) => {
          var controls = []
          console.log('aaaaaaaa')
          res.data.educationItems.forEach(elem => {
            elem.distribution_of_hours.forEach(hour => {
              controls.push(hour)
            })
          });
          axios.get(`plan-controls/${this.data.item.education_plans_id}`).then((controlsPlan)=>{
            EventBus.$emit('toggle-modules-form', educationItemId, this.getDistributionOfHours, this.data.item.credits, controlsPlan.data, controls);
          });
        })
      },

      distributionOfLearningForm(educationItemId){
        EventBus.$emit('toggle-distribution-of-learning-form', educationItemId, this.getLearningData, this.amountOfHours);
      }
    }
  }
</script>
