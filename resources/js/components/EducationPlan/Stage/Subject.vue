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
        'removeEducationItem': 'plan/removeEducationItem'
      }),

      editItem(){
        EventBus.$emit('toggle-item-form', educationItemId);
      },

      deleteItem (item) {
        let isDelete = confirm('Ви впевнені, що хочете видалити цей елемент?');
        if(isDelete) {
          axios.delete(`plan-items/${item.education_item_id}`)
            .then(() => {
              this.removeEducationItem(item.education_item_id);
              console.log("Запис видалений");
            })
            .catch((err) => {
              console.log(err);
            })
        }
      },

      modulesForm(educationItemId){ 

        axios.get('plan-items/'+this.data.item.education_plans_id).then((res) => {
          var controls = []
          res.data.educationItems.forEach(elem => {
            elem.hours.forEach(hour => {
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
