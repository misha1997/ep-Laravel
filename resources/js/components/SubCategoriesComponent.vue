<template>
  <div>
    <v-toolbar dark color="primary">
      <v-toolbar-title>Підкатегорії навчального плану</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-dialog v-model="dialog" max-width="500px">
        <v-btn slot="activator" icon color="primary" v-if="$store.state.auth.user.role == 'admin'" dark class="mb-2"> <v-icon title="Додати">add</v-icon></v-btn>
        <v-form ref="form" @submit.prevent="save()">
          <v-card>
            <v-card-title>
              <span class="headline">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-alert
                :value="validator"
                color="error"
                icon="new_releases"
              >
              <div v-if="creditsAll - subCategoriesCredits <= 0">
                Кількість допустимих кредитів вичерпана
              </div>
              <div v-else>
                Кількість кредитів повинна бути не більше {{ creditsAll - subCategoriesCredits }}
              </div>
              </v-alert>
              <v-container grid-list-md>
                <v-layout wrap>
                <v-flex xs12>
                  <v-text-field v-model="editedItem.name" label="Назва підкатегорії" :rules="requiredField"></v-text-field>
                </v-flex>
                 <v-flex xs12>
                    <v-select
                      :rules="requiredField"
                      :items="categories"
                      v-model="editedItem.category_id"
                      item-text="name"
                      item-value="category_id"
                      label="Назва категорії"
                      required
                    ></v-select>
                  </v-flex>
                <v-flex xs12>
                  <v-text-field v-model="editedItem.credits" label="Усього кредитів" :rules="requiredField"></v-text-field>
                </v-flex>
                </v-layout>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" flat @click="close">Відміна</v-btn>
              <v-btn color="blue darken-1" flat type="submit" v-if="!validator">Зберегти</v-btn>
            </v-card-actions>
          </v-card>
        </v-form>
      </v-dialog>
    </v-toolbar>

    <v-data-table
      :headers="headers"
      :items="data"
      :rows-per-page-items="rowsPerPageItems"
      rows-per-page-text="Кількість рядків на сторінці"
      class="elevation-1"
    >
      <template slot="items" slot-scope="props">
      
        <td>{{ props.item.name }}</td>
        <td>{{ props.item.credits | zeroValue }}</td>
        <td>{{ props.item.categories.name }}</td>
        <td class="justify-center layout px-1 pr-4">
          <v-icon
          title="Редагувати"
            small
            class="mr-2"
            v-if="$store.state.auth.user.role == 'admin'"
            @click="editItem(props.item)"
          >
            edit
          </v-icon>
          <v-icon
          title="Видалити"
            small
            v-if="$store.state.auth.user.role == 'admin'"
            @click="deleteItem(props.item)"
          >
            delete
          </v-icon>
        </td>
      </template>
    </v-data-table>
  </div>
</template>

<script>

  import validation from './mixins/validation';
  import crud from './mixins/crud';

  export default{

    mixins: [validation, crud],

    data() {
      return {
        apiUrl: 'sub-category',
        primaryKey: 'sub_category_id',

        categories: [],
        cycles: [],
        subCategories: [],

        headers: [
          { text: 'Назва підкатегорії', value: 'name' },
          { text: 'Кількість кредитів', value: 'credits' },
          { text: 'Назва категорії', value: 'subCategoryName' },
          { text: '', value: 'name', sortable: false }
        ],

        creditsAll: 0,
        subCategoriesCredits: 0,

        editedItem: {
          name: '',
          credits: '',
          category_id: 0
        },

        credits: '',

        defaultItem: {
          name: '',
          credits: '',
          category_id: 0
        }
      }
    },

    created(){
      this.fetchData();
      this.getCycles();
      this.getCategories();
    },

    filters: {
      zeroValue: function (value) {
        if (value == 0) return ' - '
        return value;
      }
    },

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'Нова підкатегорія' : 'Редагувати підкатегорію'
      },
      getRequestId(){
        return this.editedItem.sub_category_id;
      },
      validator(){
        for(let i = 0; i < this.categories.length; i++) {
          if(this.categories[i].category_id == this.editedItem.category_id) {
            var cycleId = this.categories[i].cycles_id;
          }
        }
        for(let i = 0; i < this.cycles.length; i++) {
          if(this.cycles[i].cycles_id == cycleId) {
            this.creditsAll = this.cycles[i].credits;
          }
        }
        this.subCategoriesCredits = _.sumBy(this.subCategories, (item) => 
        {
          return (item.sub_category_id != this.editedItem.sub_category_id) ? +item.credits : 0 
        });
        return (this.editedItem.credits) ? this.subCategoriesCredits + +this.editedItem.credits > this.creditsAll : false;
      }
    },

    methods: {
      getCycles() {
        axios.get('cycle').then(response => {
          this.cycles = response.data;
        })
      },
      getCategories() {
        axios.get('category').then(response => {
          this.categories = response.data;
        })
      }
    }
  }
  
</script>
