<template>
  <div>
    <v-toolbar dark color="primary">
      <v-toolbar-title>Кафедри</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-dialog v-model="dialog" max-width="500px">
        <v-btn slot="activator" icon color="primary" v-if="$store.state.auth.user.role == 'admin'" dark class="mb-2"> <v-icon title="Додати">add</v-icon></v-btn>
        <v-form ref="form" @submit.prevent="save()">
          <v-card>
            <v-card-title>
              <span class="headline">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container grid-list-md>
                <v-layout wrap>
                  <v-flex xs12>
                    <v-text-field v-model="editedItem.name" label="Назва кафедри" :rules="requiredField"></v-text-field>
                  </v-flex>
                  <v-flex xs12>
                    <v-select
                      :rules="requiredField"
                      :items="subdivisions"
                      v-model="editedItem.subdivision_id"
                      item-text="name"
                      item-value="subdivision_id"
                      label="Факультет"
                      required
                    ></v-select>
                  </v-flex>
                </v-layout>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" flat @click="close">Відміна</v-btn>
              <v-btn color="blue darken-1" type="submit" flat>Зберегти</v-btn>
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
        <td>{{ props.item.subdivisions.name }}</td>
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
      <template slot="no-data">
        <v-btn color="primary">Reset</v-btn>
      </template>
    </v-data-table>
  </div>
</template>

<script>
  import crud from './mixins/crud';
  import validation from './mixins/validation';

  export default{

    mixins: [validation, crud],

    data() {
      return {
        apiUrl: 'department',
        primaryKey: 'department_id',

        subdivisions: [],

        headers: [
          { text: 'Назва кафедри', value: 'name' },
          { text: 'Назва факультету', value: 'subdivision' },
          { text: '', value: 'name', sortable: false }
        ],

        editedItem: {
          name: '',
          subdivision_id: ''

        },
        defaultItem: {
          name: '',
          subdivision_id: ''
        }
      }
    },

    created(){
      this.fetchData(); 
      this.getSubdivisions();
    },

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'Нова кафедра' : 'Редагувати кафедру'
      },
      getRequestId(){
        return this.editedItem.department_id;
      }
    },
    methods: {
      getSubdivisions() {
        axios.get('subdivision').then(response => {
          this.subdivisions = response.data;
        })
      }
    }
  }

</script>
