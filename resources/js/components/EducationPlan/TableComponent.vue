<template>
  <div>
    <v-toolbar dark color="primary">
      <v-toolbar-title>Цикли навчального плану</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-dialog v-model="dialog" max-width="500px">
        <v-btn slot="activator" icon color="primary" dark class="mb-2"> <v-icon title="Додати">add</v-icon></v-btn>
        <v-form ref="form">
          <v-card>
            <v-card-title>
              <span class="headline">ddfsd</span>
            </v-card-title>

            <v-card-text>
              <v-container grid-list-md>
                <v-layout wrap>
                  <v-flex xs12>
                    <v-text-field label="Назва циклу"></v-text-field>
                  </v-flex>
                  <v-flex xs12>
                    <v-text-field label="Кількість кредитів" type="number"></v-text-field>
                  </v-flex>
                </v-layout>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" flat>Відміна</v-btn>
              <v-btn color="blue darken-1" type="submit" flat>Зберегти</v-btn>
            </v-card-actions>
          </v-card>
        </v-form>
      </v-dialog>
    </v-toolbar>

    <v-data-table
      :headers="headers"
      rows-per-page-text="Кількість рядків на сторінці"
      class="elevation-1"
    >
      <template>
        <td>name</td>
        <td>credits</td>
        <td class="justify-center layout px-1 pr-4">
          <v-icon
          title="Редагувати"
            small
            class="mr-2"
          >
            edit
          </v-icon>
          <v-icon
          title="Видалити"
            small
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
  export default{
    data(){
      return{
        headers: [
          { text: 'Назва циклу', value: 'name' },
          { text: 'Кількість кредитів', value: 'credits' },
          { text: '', value: 'name', sortable: false }
        ],
      }
    },

    created(){

    },

    filters: {

    },

    computed: {

    }
  }


</script>
