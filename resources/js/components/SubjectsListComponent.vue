<template>
  <div>
    <v-toolbar dark color="primary">
      <v-toolbar-title>Список предметів</v-toolbar-title>
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
                    <v-text-field v-model="editedItem.name" label="Назва предмету" :rules="requiredField"></v-text-field>
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

    data(){
      return{

        apiUrl: 'subject',

        primaryKey: 'subject_id',

        headers: [
          { text: 'Назва предмету', value: 'name' },
          { text: '', value: 'name', sortable: false }
        ],

        editedItem: {
          name: ''
        },
        defaultItem: {
          name: ''
        }
      }
    },

    created(){
      this.fetchData();
    },

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'Новий предмет' : 'Редагувати предмет'
      },

      getRequestId(){
        return this.editedItem.subject_id;
      }
    }
  }


</script>
