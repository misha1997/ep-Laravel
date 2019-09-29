<template>
  <div>
    <v-toolbar dark color="primary">
      <v-toolbar-title>Навчальні плани</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-dialog v-model="dialog" max-width="600px">
        <v-btn slot="activator" icon color="primary" dark class="mb-2"> <v-icon title="Додати">add</v-icon></v-btn>
        <v-form ref="form">
          <v-card>
            <v-card-title>
              <span class="headline"></span>
            </v-card-title>

            <v-card-text>
              <v-container grid-list-md>
                <v-layout wrap>
                  <v-flex xs12>
                    <v-text-field label="Назва освітнього плану"></v-text-field>
                  </v-flex>
                  <v-flex xs12>
                    <v-select
                      item-text="name"
                      item-value="subdivision_id"
                      label="Факультет"
                      required
                    ></v-select>
                  </v-flex>
                  <v-flex xs12>
                    <v-select
                      item-text="name"
                      item-value="department_id"
                      label="Кафедра"
                      required
                    ></v-select>
                  </v-flex>

                  <v-flex xs12>
                    <v-select
                      item-text="name"
                      item-value="name"
                      label="Кваліфікація"
                      required
                    ></v-select>
                  </v-flex>

                  <v-flex xs12>
                    <v-text-field label="Термін навчання"></v-text-field>
                  </v-flex>

                  <v-flex xs12>
                    <v-text-field label="Галузь знань"></v-text-field>
                  </v-flex>

                  <v-flex xs12>
                    <v-text-field label="Спеціальність"></v-text-field>
                  </v-flex>

                  <v-flex xs12>
                    <v-text-field label="Спеціалізація"></v-text-field>
                  </v-flex>

                  <v-flex xs12>
                    <v-text-field label="Освітня програма"></v-text-field>
                  </v-flex>

                  <v-flex xs12>
                    <v-text-field label="Освітній (освітньо-науковий) рівень"></v-text-field>
                  </v-flex>

                  <v-flex xs12>
                    <v-text-field label="Форма навчання"></v-text-field>
                  </v-flex>

                  <v-flex xs12>
                    <v-text-field
                      label="Рік прийому"
                      prepend-icon="event"
                    ></v-text-field>
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
    <v-flex xs4 class="px-3 mt-3">
      <v-text-field
        append-icon="search"
        label="Пошук"
      ></v-text-field>
    </v-flex>
    <v-data-table
      :headers="headers"
      rows-per-page-text="Кількість рядків на сторінці"
      class="elevation-1"
    >
      <template>
        <td>name</td>
        <td>department.name</td>
        <td>Шаблон</td>
        <td>year</td>
        <td>created_at</td>
        <td class="right layout px-1 pr-4">

          <v-icon
            title="Норми котролю"
            small
            class="mr-2"
          >
            widgets
          </v-icon>

          <v-icon
            title="Видалити"
            small
            class="mr-2"
          >
            delete
          </v-icon>

          <v-icon
            title="Редагувати"
            small
            class="mr-2"
          >
            edit
          </v-icon>

          <v-icon
            title="Відкрити"
            small
          >
            remove_red_eye
          </v-icon>
        </td>

      </template>
    </v-data-table>
  </div>
</template>

<script>
  import {mapMutations} from 'vuex';

  export default{

    data() {
      return{
        headers: [
          { text: 'Назва', value: 'name' },
          { text: 'Кафедра', value: 'department' },
          { text: 'Статус', value: 'status' },
          { text: 'Рік', value: 'year' },
          { text: 'Дата створення', value: 'created_at' },
          { text: '', sortable: false }
        ],
      }
    },

    created(){

    },

    computed: {

    },

    methods: {

    }
  }
</script>
