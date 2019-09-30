import snackbar from './withSnackbar';
import { mapGetters } from 'vuex';

export default {

  mixins: [snackbar],

  data(){
    return {
      apiUrl: '',
      primaryKey: '',
      data: [],
      dialog: false,
      rowsPerPageItems: [100, 200, 300, {
        text: "$vuetify.dataIterator.rowsPerPageAll",
        value: -1,
      }],
      editedIndex: -1,
    }
  },

  computed: {
    ...mapGetters([
      'snackbarTimeout'
    ])
  },

  methods: {
    fetchData(){
      axios.get(this.apiUrl)
        .then((response) => {
          this.data = response.data;
        })
        .catch((err) => {
          this.showError(err);
        })
    },

    editItem (item) {
      this.editedIndex = this.data.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem (item) {
      const index = this.data.indexOf(item);
      let isDelete = confirm('Ви впевнені, що хочете видалити цей елемент?');
      if(isDelete) {
        axios.delete(`${this.apiUrl}/${item[this.primaryKey]}`)
          .then(() => {
            this.data.splice(index, 1);
            this.showMessage("Запис був видалений");
          }).catch((err) => {
            this.showError(err);
          })
      }
    },

    close () {
      this.dialog = false;
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
        this.$refs.form.reset();
      }, 300)
    },

    save () {
      if(!this.$refs.form.validate())
        return;

      if (this.editedIndex > -1) {
        axios.post(`${this.apiUrl}/${this.getRequestId}`, this.editedItem)
        .then(()=>{
          this.fetchData();
          this.showMessage("Запис був збережений");
        })
        .catch((err)=>{
          this.showError(err);
        })
      } else {
        axios.post(this.apiUrl, this.editedItem)
          .then(()=>{
            this.fetchData();
            this.showMessage("Запис був збережений");
          })
          .catch((err)=>{
            this.showError(err);
          })
      }
      this.close();
    }
  },

  watch: {
    dialog (val) {
      val || this.close()
    }
  }
}
